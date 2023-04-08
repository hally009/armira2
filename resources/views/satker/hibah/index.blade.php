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
                        <button class="nav-link active" id="hibah-tab" data-bs-toggle="tab" data-bs-target="#tab-hibah" type="button" role="tab" aria-controls="hibah" aria-selected="true">HIBAH</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="form-tab" data-bs-toggle="tab" data-bs-target="#tab-form" type="button" role="tab" aria-controls="form" aria-selected="false">Form HIBAH</button>
                    </li>
                </ul>
                <div class="tab-content pt-2" id="borderedTabContent">
                    <div class="tab-pane fade show active" id="tab-hibah" role="tabpanel">
                        @include('satker.hibah._tab-hibah')
                    </div>
                    <div class="tab-pane fade" id="tab-form" role="tabpanel">
                        @include('satker.hibah._tab-form')
                    </div>
                </div>
                <!-- End Bordered Tabs -->
            </div>
        </div>
    </div>
</div>

@endsection
