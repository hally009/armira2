@extends('layouts.app')
@section('body')
<div class="row">
    <div class="col-md-12">
        @include('layouts._alert')
        <div class="card">
            <div class="card-body">
                <!-- Bordered Tabs -->
                <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-pengadaan"
                            type="button" role="tab" aria-controls="pengadaan"
                            aria-selected="true">PEMELIHARAAN</button>
                    </li>
                </ul>
                <div class="tab-content pt-2" id="borderedTabContent">
                    <div class="tab-pane fade show active" id="tab-pengadaan" role="tabpanel">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-md-5 align-self-center">
                                                <h5 class="card-title mb-0 py-0">
                                                    PEMELIHARAAN SBSK PERIODE {{session('tahun') }}
                                                </h5>
                                                <p>Daftar usulan pemeliharaan SBSK</p>
                                            </div>
                                            <div class="col-md-7 align-self-center text-right">
                                                <div class="d-flex justify-content-end align-items-center">
                                                    {{-- <a type="button" href="{{ route('Satker::pegawai.create') }}"
                                                        class="btn btn-primary text-white">
                                                        <i class="fa fa-plus-circle"></i> Tambah Data
                                                    </a> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body pt-4">
                                        <div class="row">
                                            <p class="text-center">Menu ini telah dinonaktifkan</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Bordered Tabs -->
            </div>
        </div>
    </div>
</div>

@endsection