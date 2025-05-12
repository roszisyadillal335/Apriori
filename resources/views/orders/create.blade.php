@extends('layouts.app')

@section('content')
<h2>Tambah Order</h2>
<form action="{{ route('orders.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Nama Customer</label>
        <input type="text" name="nama_customer" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('orders.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
