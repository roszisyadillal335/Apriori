@extends('layouts.app')

@section('content')
<h2>Data Detail Order</h2>
<a href="{{ route('details.create') }}" class="btn btn-primary mb-3">Tambah Detail</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Produk</th>
            <th>Qty</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($details as $detail)
        <tr>
            <td>{{ $detail->idorderdetail }}</td>
            <td>{{ $detail->namaproduk }}</td>
            <td>{{ $detail->qty }}</td>
            <td>
                <a href="{{ route('details.edit', ['idorderdetail' => $detail->idorderdetail]) }}" class="btn btn-sm btn-warning">Edit</a>

                <!-- Delete Button with Confirmation Modal -->
                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal{{ $detail->idorderdetail }}">
                    Hapus
                </button>

                <!-- Modal -->
                <div class="modal fade" id="deleteModal{{ $detail->idorderdetail }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Penghapusan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Apakah Anda yakin ingin menghapus detail order ini?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <form action="{{ route('details.destroy', ['idorderdetail' => $detail->idorderdetail]) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
