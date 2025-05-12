@extends('layouts.app')

@section('content')
<h2>Data Orders</h2>
<a href="{{ route('orders.create') }}" class="btn btn-primary mb-3">Tambah Order</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
        <tr>
            <td>{{ $order->idorder }}</td>
            <td>
                <a href="{{ route('orders.edit', $order->idorder) }}" class="btn btn-sm btn-warning">Edit</a>
                <!-- Delete Button with Confirmation Modal -->
                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal{{ $order->idorder }}">
                    Hapus
                </button>

                <!-- Modal -->
                <div class="modal fade" id="deleteModal{{ $order->idorder }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Penghapusan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Apakah Anda yakin ingin menghapus order ini?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <form action="{{ route('orders.destroy', $order->idorder) }}" method="POST" class="d-inline">
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

@push('scripts')
<script>
    // Optional: Automatically open the modal if a certain action triggers it
</script>
@endpush
