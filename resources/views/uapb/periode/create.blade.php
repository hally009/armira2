@extends('layouts.app')
@section('body')
<div class="row">
    <div class="col-md-12">
        @include('layouts._alert')
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-5 align-self-center">
                        <h5 class="card-title mb-0 py-0">Periode</h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form class="row g-3" action="{{ route('Uapb::periode.store') }}" method="POST" enctype="multipart/form-data">
                    @method('POST')
                    @csrf
                    @include('uapb.periode._form')
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
