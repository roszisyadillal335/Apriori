@extends('layouts.app')

@section('content')
<h2>Tambah Detail Order</h2>
<form action="{{ route('details.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Nama Produk</label>
        <input type="text" name="nama_produk" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Qty</label>
        <input type="number" name="qty" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('details.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
