<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AprioriController extends Controller
{
    public function index()
    {
        // 1. Data transaksi (bisa diganti dengan query dari tabel order_detail)
        $transactions = [
            ['milk', 'bread', 'butter'],
            ['beer', 'bread'],
            ['milk', 'bread', 'butter', 'beer'],
            ['bread', 'butter'],
            ['milk', 'bread'],
        ];

        $minSupport = 0.05; // 5%
        $minConfidence = 0.3; // 30%
        $totalTransactions = count($transactions);

        // Step 1: Hitung support 1-itemset
        $itemCounts = [];
        foreach ($transactions as $transaction) {
            foreach ($transaction as $item) {
                $itemCounts[$item] = ($itemCounts[$item] ?? 0) + 1;
            }
        }

        $frequentItems = [];
        foreach ($itemCounts as $item => $count) {
            $support = $count / $totalTransactions;
            if ($support >= $minSupport) {
                $frequentItems[$item] = [
                    'count' => $count,
                    'support' => $support,
                ];
            }
        }

        // Step 2: Generate 2-itemset dari frequentItems
        $items = array_keys($frequentItems);
        $pairs = [];
        for ($i = 0; $i < count($items); $i++) {
            for ($j = $i + 1; $j < count($items); $j++) {
                $pairs[] = [$items[$i], $items[$j]];
            }
        }

        // Hitung support 2-itemset
        $pairCounts = [];
        foreach ($pairs as $pair) {
            $count = 0;
            foreach ($transactions as $transaction) {
                if (in_array($pair[0], $transaction) && in_array($pair[1], $transaction)) {
                    $count++;
                }
            }
            $support = $count / $totalTransactions;
            if ($support >= $minSupport) {
                $pairKey = implode(',', $pair);
                $pairCounts[$pairKey] = [
                    'items' => $pair,
                    'count' => $count,
                    'support' => $support,
                ];
            }
        }

        // Step 3: Hitung confidence
        $rules = [];
        foreach ($pairCounts as $pairKey => $data) {
            [$A, $B] = $data['items'];
            $supportAB = $data['support'];

            $supportA = $frequentItems[$A]['support'];
            $supportB = $frequentItems[$B]['support'];

            $confAB = $supportAB / $supportA;
            $confBA = $supportAB / $supportB;

            if ($confAB >= $minConfidence) {
                $rules[] = [
                    'rule' => "$A → $B",
                    'support' => round($supportAB, 2),
                    'confidence' => round($confAB, 2),
                ];
            }

            if ($confBA >= $minConfidence) {
                $rules[] = [
                    'rule' => "$B → $A",
                    'support' => round($supportAB, 2),
                    'confidence' => round($confBA, 2),
                ];
            }
        }

        dump([
            'frequent_1_itemset' => $frequentItems,
            'frequent_2_itemset' => $pairCounts,
            'association_rules' => $rules,
        ]);
    }
}
