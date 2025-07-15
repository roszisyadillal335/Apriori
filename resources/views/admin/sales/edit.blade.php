@extends('layouts.app')

@section('title', 'Edit Penjualan')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Edit Penjualan</h3>

    <form action="{{ route('admin.sales.update', $order->idorder) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nomerorder" class="form-label">No. Order</label>
            <input type="text" name="nomerorder" class="form-control" value="{{ $order->nomerorder }}" disabled>
        </div>

        <div class="mb-3">
            <label for="iduser" class="form-label">User</label>
            <select name="iduser" class="form-select" required>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $order->iduser == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="tanggalorder" class="form-label">Tanggal Order</label>
            <input type="date" name="tanggalorder" class="form-control" value="{{ $order->tanggalorder }}" required>
        </div>

        <div class="mb-3">
            <label for="ordertotal" class="form-label">Total Order</label>
            <input type="number" name="ordertotal" class="form-control" value="{{ $order->ordertotal }}" required>
        </div>

        <a href="{{ route('admin.sales.index') }}" class="btn btn-secondary">← Batal</a>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
