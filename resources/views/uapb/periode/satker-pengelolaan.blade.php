@extends('layouts.app')
@section('body')
<div class="row">
    <div class="col-md-12">
        @include('layouts._alert')
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-5 align-self-center">
                        <h5 class="card-title mb-0 py-0">Detail Pengelolaan Periode {{ $tahun }}</h5>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <a type="button" href="{{ route('Uapb::satker.request', $tahun) }}" class="btn btn-primary text-white">
                                <i class="fa fa-plus-circle"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama Periode</th>
                            <th>Tahun</th>
                            <th>Pengadaan BMN</th>
                            <th></th>
                        </tr>
                    </thead>
                    {{-- <tbody>
                        @if($items->count() > 0)
                        @foreach($items as $item)
                        <tr>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->tahun }}</td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" @if($item->status == '1')
                                    checked
                                    @endif
                                    onchange="event.preventDefault(); document.getElementById('activate-{{ $item->id }}').submit();">
                                    <form id="activate-{{ $item->id }}" action="{{ route('Uapb::periode.activate', $item->id) }}" method="POST" class="d-none">
                                        @method('PUT')
                                        @csrf
                                    </form>
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('Uapb::periode.edit', $item) }}" class="text-inverse p-r-10 text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Pengaturan">
                                    <i class="bi bi-gear-wide-connected"></i>
                                </a>
                                <a href="{{ route('Uapb::satker.request', $item->tahun) }}" class="text-inverse p-r-10 text-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat Detail">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td class="text-center" colspan="4">Data belum diinput</td>
                        </tr>
                        @endif
                    </tbody> --}}
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
