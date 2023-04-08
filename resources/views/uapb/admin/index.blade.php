@extends('layouts.app')
@section('body')
<div class="row">
    <div class="col-md-12">
        @include('layouts._alert')
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-5 align-self-center">
                        <h5 class="card-title mb-0 py-0">Admin</h5>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <a type="button" href="{{ route('Uapb::admin.create') }}" class="btn btn-outline-success">
                            <i class="fa fa-plus-circle"></i> Tambah Data
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama Satker</th>
                            <th>Nama Pengguna</th>
                            <th>Email</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($items->count() > 0)
                        @foreach($items as $item)
                        <tr>
                            <td>{{ $item->satker->name }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>
                                <a href="{{ route('Uapb::admin.edit', $item) }}" class="text-inverse p-r-10 text-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                &nbsp;|&nbsp;
                                <a href="{{ route('Uapb::admin.edit-password', $item) }}" class="text-inverse p-r-10 text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Password">
                                    <i class="ri-key-line"></i>
                                </a>
                                &nbsp;|&nbsp;
                                <a href="#" onclick="deleteById({{ $item->id }})" class="text-inverse p-r-10 text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus">
                                    <i class="bi bi-trash3"></i>
                                </a>
                                <form id="del-form-{{ $item->id }}" action="{{ route('Uapb::admin.destroy', $item) }}"
                                    method="POST" class="d-none">
                                    @csrf
                                    @method('delete')
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td class="text-center" colspan="4">Data belum diinput</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                {{ $items->links() }}
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-md-5 align-self-center"></div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            {{-- <a type="button" href="{{ route('Uapb::periode.create') }}" class="btn btn-primary text-white">
                                <i class="fa fa-plus-circle"></i> Tambah Data
                            </a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('script')
<script>
function deleteById(id) {
  if (confirm("Apakah anda yakin menghapus data ini?") == true) {
    document.getElementById('del-form-'+id).submit();
  }
}
</script>
@endpush
