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
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-pengadaan" type="button" role="tab" aria-controls="pengadaan" aria-selected="true">PENGADAAN</button>
                    </li>
                    @if($periode)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-form" type="button" role="tab" aria-controls="form" aria-selected="false">Form PENGADAAN</button>
                    </li>
                    @endif
                </ul>
                <div class="tab-content pt-2" id="borderedTabContent">
                    <div class="tab-pane fade show active" id="tab-pengadaan" role="tabpanel">
                        @include('satker.pengadaan._tab-pengadaan')
                    </div>
                    @if($periode)
                    <div class="tab-pane fade" id="tab-form" role="tabpanel">
                        @include('satker.pengadaan._tab-form')
                    </div>
                    @endif
                </div>
                <!-- End Bordered Tabs -->
            </div>
        </div>
    </div>
</div>

@endsection
