@extends('layouts.app')

@section('title', 'Tambah Penjualan')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Tambah Penjualan</h3>

    <form action="{{ route('admin.sales.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nomerorder" class="form-label">No. Order</label>
            <input type="text" name="nomerorder" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="iduser" class="form-label">User</label>
            <select name="iduser" class="form-select" required>
                <option value="">-- Pilih User --</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="tanggalorder" class="form-label">Tanggal Order</label>
            <input type="date" name="tanggalorder" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="ordertotal" class="form-label">Total Order</label>
            <input type="number" name="ordertotal" class="form-control" required>
        </div>

        <a href="{{ route('admin.sales.index') }}" class="btn btn-secondary">← Kembali</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
