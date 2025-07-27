<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderDetail;
use App\Models\AprioriRule;

class AprioriController extends Controller
{
    // Halaman awal Apriori
    public function index()
    {
        return view('admin.apriori.index');
    }

    // Proses perhitungan algoritma Apriori
    public function process(Request $request)
    {
        // Ambil input dari form dan ubah ke float
        $minSupport1 = floatval($request->support1);     // Support minimum untuk 1-itemset
        $minSupport2 = floatval($request->support2);     // Support minimum untuk 2-itemset
        $minConfidence = floatval($request->confidence); // Confidence minimum untuk aturan asosiasi

        // Ambil data transaksi dan kelompokkan berdasarkan 'nomerorder'
        $transactions = OrderDetail::select('nomerorder', 'namaproduk')->get()
            ->groupBy('nomerorder')
            ->map(function ($group) {
                // Ambil hanya nama produk unik per transaksi
                return $group->pluck('namaproduk')->unique()->values()->toArray();
            })->values()->toArray();

        // Hitung total transaksi
        $totalTransactions = count($transactions);

        // ------------------- 1-ITEMSET -------------------
        $itemCounts = [];
        foreach ($transactions as $transaction) {
            foreach ($transaction as $item) {
                // Hitung berapa kali tiap item muncul
                $itemCounts[$item] = ($itemCounts[$item] ?? 0) + 1;
            }
        }

        $frequent1Itemsets = [];
        foreach ($itemCounts as $item => $count) {
            // Hitung support dalam persen
            $support = ($count / $totalTransactions) * 100;
            if ($support >= $minSupport1) {
                // Simpan item jika support ≥ minSupport1
                $frequent1Itemsets[] = [
                    'item' => [$item],
                    'frequency' => $count,
                    'support' => round($support, 2) // Simpan support dibulatkan 2 digit
                ];
            }
        }

        // ------------------- 2-ITEMSET CANDIDATES -------------------
        $candidates2 = [];
        $count = count($frequent1Itemsets);
        for ($i = 0; $i < $count; $i++) {
            for ($j = $i + 1; $j < $count; $j++) {
                // Gabungkan 2 item dari 1-itemset menjadi kandidat 2-itemset
                $combined = array_unique(array_merge(
                    $frequent1Itemsets[$i]['item'],
                    $frequent1Itemsets[$j]['item']
                ));
                sort($combined); // Urutkan untuk menghindari duplikat berbeda urutan
                if (count($combined) == 2) {
                    $candidates2[] = $combined;
                }
            }
        }

        // ------------------- 2-ITEMSET FREQUENT -------------------
        $frequent2Itemsets = [];
        foreach ($candidates2 as $itemset) {
            // Hitung berapa kali 2-itemset muncul dalam transaksi
            $supportCount = $this->getSupportCount($itemset, $transactions);
            $support = ($supportCount / $totalTransactions) * 100;
            if ($support >= $minSupport2) {
                // Simpan jika support ≥ minSupport2
                $frequent2Itemsets[] = [
                    'itemset' => $itemset,
                    'frequency' => $supportCount,
                    'support' => round($support, 2)
                ];
            }
        }

        // ------------------- GENERATE RULES -------------------
        // Hapus semua aturan sebelumnya
        AprioriRule::truncate();

        $rules = [];
        foreach ($frequent2Itemsets as $itemsetData) {
            $itemset = $itemsetData['itemset'];
            $supportCount = $this->getSupportCount($itemset, $transactions); // Support XY

            foreach ($itemset as $item) {
                $X = [$item];                        // Antecedent (jika membeli ini)
                $Y = array_diff($itemset, $X);       // Consequent (maka membeli ini)
                $supportX = $this->getSupportCount($X, $transactions); // Support X
                $confidence = $supportX > 0 ? ($supportCount / $supportX) * 100 : 0; // Confidence = support(XY)/support(X)

                if ($confidence >= $minConfidence) {
                    $lhs = implode(', ', $X);
                    $rhs = implode(', ', $Y);
                    $supportPercent = ($supportCount / $totalTransactions) * 100;

                    // Simpan rule ke database
                    AprioriRule::create([
                        'lhs' => $lhs,
                        'rhs' => $rhs,
                        'support' => round($supportPercent, 2),
                        'confidence' => round($confidence, 2),
                    ]);

                    // Simpan rule untuk ditampilkan ke user
                    $rules[] = [
                        'lhs' => $lhs,
                        'rhs' => $rhs,
                        'support' => round($supportPercent, 2),
                        'confidence' => round($confidence, 2),
                        'frequency_lhs' => $supportX,
                        'frequency_itemset' => $supportCount,
                        'rule_narrative' => "Jika membeli $lhs maka kemungkinan akan membeli $rhs dengan support " . round($supportPercent, 2) . "% dan confidence " . round($confidence, 2) . "%",
                    ];
                }
            }
        }

        // Simpan hasil ke session untuk digunakan di view
        session(['apriori_rules' => $rules]);

        // Kirim data ke view
        return view('admin.apriori.index', [
            'frequent1Itemsets' => $frequent1Itemsets,
            'frequent2Itemsets' => $frequent2Itemsets,
            'rules' => $rules,
            'minConfidence' => $minConfidence
        ]);
    }

    // ------------------- FUNCTION UNTUK MENGHITUNG SUPPORT COUNT -------------------
    private function getSupportCount($itemset, $transactions)
    {
        $count = 0;
        foreach ($transactions as $transaction) {
            // Jika semua item dalam itemset ada di dalam transaksi, tambah count
            if (count(array_intersect($itemset, $transaction)) === count($itemset)) {
                $count++;
            }
        }
        return $count;
    }
}
