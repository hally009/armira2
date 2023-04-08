@extends('layouts.app')
@section('body')
<div class="row">
    <div class="col-md-12">
        @include('layouts._alert')
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-5 align-self-center">
                        <h5 class="card-title mb-0 py-0">List Satker Request Periode {{ $tahun }}</h5>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <a type="button" href="{{ route('Uapb::periode.index') }}" class="btn btn-primary text-white">
                            <i class="fa fa-plus-circle"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <!-- Bordered Tabs -->
                <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="perencanaan-tab" data-bs-toggle="tab" data-bs-target="#tab-perencanaan" type="button" role="tab" aria-controls="perencanaan" aria-selected="true">Perencanaan</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pengelolaan-tab" data-bs-toggle="tab" data-bs-target="#tab-pengelolaan" type="button" role="tab" aria-controls="pengelolaan" aria-selected="false">Pengelolaan</button>
                    </li>
                </ul>
                <div class="tab-content pt-2" id="borderedTabContent">
                    <div class="tab-pane fade show active" id="tab-perencanaan" role="tabpanel">
                        @include('uapb.periode._table-pengadaan')
                    </div>
                    <div class="tab-pane fade" id="tab-pengelolaan" role="tabpanel">
                        @include('uapb.periode._table-pengelolaan')
                    </div>
                </div><!-- End Bordered Tabs -->
            </div>
        </div>
    </div>
</div>

@endsection
