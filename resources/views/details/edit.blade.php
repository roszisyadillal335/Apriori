@extends('layouts.app')

@section('content')
<h2>Edit Detail Order</h2>
<form action="{{ route('details.update', $detail->idorderdetail) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="nama_produk">Nama Produk</label>
        <input type="text" name="namaproduk" class="form-control" value="{{ $detail->namaproduk }}" required>
    </div>
    <div class="mb-3">
        <label for="qty">Qty</label>
        <input type="number" name="qty" class="form-control" value="{{ $detail->qty }}" required>
    </div>
    <button type="submit" class="btn btn-success">Update</button>
    <a href="{{ route('details.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
