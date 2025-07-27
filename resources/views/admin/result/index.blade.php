@extends('layouts.app')

@section('title', 'Hasil Rekomendasi')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Hasil Rekomendasi Produk</h3>

    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <strong>Aturan Asosiasi</strong>
        </div>
        <div class="card-body table-responsive">
            @if(count($rules))
            <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-secondary">
                    <tr>
                        <th>No</th>
                        <th>Nama Produk 1</th>
                        <th>Nama Produk 2</th>
                        <th>Frekuensi Kemunculan 2 Itemset</th>
                        <th>Frekuensi Kemunculan Produk 1</th>
                        <th>Confidence (%)</th>
                        <th>Aturan Asosiasi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rules as $index => $rule)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $rule['lhs'] }}</td>
                            <td>{{ $rule['rhs'] }}</td>
                            <td>{{ $rule['frequency_itemset'] }}</td>
                            <td>{{ $rule['frequency_lhs'] }}</td>
                            <td>{{ $rule['confidence'] }}%</td>
                            <td>{{ $rule['rule_narrative'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Narasi rekomendasi --}}
            <div class="mt-4">
                <h5>Kesimpulan Rekomendasi:</h5>
                <ul>
                    @foreach($rules as $rule)
                        @php
                            $parts = explode(' => ', $rule['rule']);
                            $lhs = $parts[0] ?? '';
                            $rhs = $parts[1] ?? '';
                        @endphp
                        <li>
                            Jika membeli <strong>{{ $lhs }}</strong>, maka kemungkinan juga akan membeli <strong>{{ $rhs }}</strong> 
                            dengan support <strong>{{ $rule['support'] }}</strong> dan confidence <strong>{{ $rule['confidence'] }}</strong>.
                        </li>
                    @endforeach
                </ul>
            </div>
        @else
            <div class="alert alert-warning mb-0">
                Belum ada hasil rekomendasi. Silakan proses data terlebih dahulu.
            </div>
        @endif
        </div>
    </div>
</div>
@endsection
