@extends('layouts.app')
@section('body')
<div class="row">
    <div class="col-md-12">
        @include('layouts._alert')
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-5 align-self-center">
                        <h5 class="card-title mb-0 py-0">ADMIN</h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form class="row g-3" action="{{ route('Satker::admin.update-password', $item) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="password" class="form-control" name="password" value="">
                            <label>Password</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="password" class="form-control" name="confirm_password" value="">
                            <label>Confirm Passsword</label>
                        </div>
                    </div>
                    <div class="text-left">
                        <div class="row">
                            <div class="col-md-6 align-self-center text-left">
                                <a href="{{ route('Satker::admin.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                            <div class="col-md-6 align-self-center text-right">
                                <div class="d-flex justify-content-end align-items-center">
                                    <button type="submit" class="btn btn-success text-white">SIMPAN</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
