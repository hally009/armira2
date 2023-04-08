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
                        <button class="nav-link 
                        @if(app('request')->input('tab') == '') active @endif
                        " id="aset-tab" data-bs-toggle="tab" data-bs-target="#tab-aset" type="button" role="tab" aria-controls="aset" aria-selected="true">Data Aset</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link 
                        @if(app('request')->input('tab') == 'pembaruan') active @endif
                        " id="pembaruan-tab" data-bs-toggle="tab" data-bs-target="#tab-pembaruan" type="button" role="tab" aria-controls="pembaruan" aria-selected="false">Pembaruan</button>
                    </li>
                </ul>
                <div class="tab-content pt-2" id="borderedTabContent">
                    <div class="tab-pane fade 
                    @if(app('request')->input('tab') == '') show active  @endif
                    " id="tab-aset" role="tabpanel">
                        @include('satker.master._table-aset')
                    </div>
                    <div class="tab-pane fade 
                    @if(app('request')->input('tab') == 'pembaruan') show active  @endif
                    " id="tab-pembaruan" role="tabpanel">
                        @include('satker.master._table-pembaruan')
                    </div>
                </div><!-- End Bordered Tabs -->
            </div>
        </div>
    </div>
</div>

@endsection
