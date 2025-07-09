<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderDetail;
use App\Models\AprioriRule;

class AprioriController extends Controller
{
    public function index()
    {
        return view('admin.apriori.index');
    }

    public function process(Request $request)
    {
        $minSupport1 = floatval($request->support1);
        $minSupport2 = floatval($request->support2);
        $minConfidence = floatval($request->confidence);

        // Ambil transaksi: group berdasarkan nomerorder
        $transactions = OrderDetail::select('nomerorder', 'namaproduk')->get()
            ->groupBy('nomerorder')
            ->map(function ($group) {
                return $group->pluck('namaproduk')->unique()->values()->toArray();
            })->values()->toArray();

        $totalTransactions = count($transactions);

        // 1-itemset
        $itemCounts = [];
        foreach ($transactions as $transaction) {
            foreach ($transaction as $item) {
                $itemCounts[$item] = ($itemCounts[$item] ?? 0) + 1;
            }
        }

        $frequent1Itemsets = [];
        foreach ($itemCounts as $item => $count) {
            $support = ($count / $totalTransactions) * 100;
            if ($support >= $minSupport1) {
                $frequent1Itemsets[] = [
                    'item' => [$item],
                    'frequency' => $count
                ];
            }
        }

        // 2-itemset candidates
        $candidates2 = [];
        $count = count($frequent1Itemsets);
        for ($i = 0; $i < $count; $i++) {
            for ($j = $i + 1; $j < $count; $j++) {
                $combined = array_unique(array_merge(
                    $frequent1Itemsets[$i]['item'],
                    $frequent1Itemsets[$j]['item']
                ));
                sort($combined);
                if (count($combined) == 2) {
                    $candidates2[] = $combined;
                }
            }
        }

        // 2-itemset frequent
        $frequent2Itemsets = [];
        foreach ($candidates2 as $itemset) {
            $supportCount = $this->getSupportCount($itemset, $transactions);
            $support = ($supportCount / $totalTransactions) * 100;
            if ($support >= $minSupport2) {
                $frequent2Itemsets[] = [
                    'itemset' => $itemset,
                    'frequency' => $supportCount,
                    'support' => round($support, 2)
                ];
            }
        }

        // Hapus rules sebelumnya
        AprioriRule::truncate();

        // Generate rules
        $rules = [];
        foreach ($frequent2Itemsets as $itemsetData) {
            $itemset = $itemsetData['itemset'];
            $supportCount = $this->getSupportCount($itemset, $transactions);

            foreach ($itemset as $item) {
                $X = [$item];
                $Y = array_diff($itemset, $X);
                $supportX = $this->getSupportCount($X, $transactions);
                $confidence = $supportX > 0 ? ($supportCount / $supportX) * 100 : 0;

                if ($confidence >= $minConfidence) {
                    $lhs = implode(', ', $X);
                    $rhs = implode(', ', $Y);
                    $supportPercent = ($supportCount / $totalTransactions) * 100;

                    // Simpan ke database
                    AprioriRule::create([
                        'lhs' => $lhs,
                        'rhs' => $rhs,
                        'support' => round($supportPercent, 2),
                        'confidence' => round($confidence, 2),
                    ]);

                    // Simpan untuk ditampilkan di blade
                    $rules[] = [
                        'rule' => "$lhs => $rhs",
                        'support' => round($supportPercent, 2) . '%',
                        'confidence' => round($confidence, 2) . '%',
                    ];
                }
            }
        }

        // Simpan session
        session(['apriori_rules' => $rules]);

        return view('admin.apriori.index', [
            'frequent1Itemsets' => $frequent1Itemsets,
            'frequent2Itemsets' => $frequent2Itemsets,
            'rules' => $rules,
            'minConfidence' => $minConfidence
        ]);
    }

    private function getSupportCount($itemset, $transactions)
    {
        $count = 0;
        foreach ($transactions as $transaction) {
            if (count(array_intersect($itemset, $transaction)) === count($itemset)) {
                $count++;
            }
        }
        return $count;
    }
}
