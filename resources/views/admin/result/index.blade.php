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
                        <th>Rule</th>
                        <th>Support</th>
                        <th>Confidence</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rules as $index => $rule)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $rule['rule'] }}</td>
                            <td>{{ $rule['support'] }}</td>
                            <td>{{ $rule['confidence'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <div class="alert alert-warning mb-0">
                    Belum ada hasil rekomendasi. Silakan proses data terlebih dahulu.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
