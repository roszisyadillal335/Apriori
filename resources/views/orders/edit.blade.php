@extends('layouts.app')

@section('content')
<h2>Edit Order</h2>
<form action="{{ route('orders.update', $order->idorder) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="nama_customer">Nama Customer</label>
        <input type="text" name="nama_customer" class="form-control" value="{{ $order->nama_customer }}" required>
    </div>
    <button type="submit" class="btn btn-success">Update</button>
    <a href="{{ route('orders.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
