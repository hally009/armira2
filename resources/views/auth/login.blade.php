@extends('layouts.web')

@section('body')

<div id="hero" class="h-100">
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="row" id="form-select-role" data-aos="zoom-in">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h4 class="text-muted">Pilih Tipe Akun</h4>
                    </div>
                    <div class="card-body">
                        <a href="javascript:void(0)" id="satker" class="text-black">
                            <div class="card mb-3" style="max-width: 540px;">
                                <div class="row g-0">
                                    <div class="col-md-3">
                                        <img src="{{ asset('images/satker-default.png') }}" class="img-fluid rounded-start">
                                    </div>
                                    <div class="col-md-9">
                                        <div class="card-body">
                                            <h5 class="card-title">SATKER</h5>
                                            <p class="card-text">
                                                Satuan Kerja mengintegrasikan data pegawai dan ajukan perencanaan kebutuhan BMN
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="javascript:void(0)" id="uapb" class="text-black">
                            <div class="card mb-3" style="max-width: 540px;">
                                <div class="row g-0">
                                    <div class="col-md-3">
                                        <img src="{{ asset('images/uapb-default.png') }}" class="img-fluid rounded-start">
                                    </div>
                                    <div class="col-md-9">
                                        <div class="card-body">
                                            <h5 class="card-title">UAPB</h5>
                                            <p class="card-text">
                                                UAPB meninjau data pegawai dan mengelola ajuan perencanaan kebutuhan BMN tiap satker
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="javascript:void(0)" id="apip" class="text-black">
                            <div class="card mb-3" style="max-width: 540px;">
                                <div class="row g-0">
                                    <div class="col-md-3">
                                        <img src="{{ asset('images/apip-default.png') }}" class="img-fluid rounded-start">
                                    </div>
                                    <div class="col-md-9">
                                        <div class="card-body">
                                            <h5 class="card-title">APIP</h5>
                                            <p class="card-text">
                                                APIP memeriksa proses pengajuan dan pengelolaan perencanaan kebutuhan BMN tiap satker
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="form-login" style="display:none" data-aos="zoom-in">
            <div class="col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <small id="role-text" class="text-muted"></small><br>
                        <small class="text-muted">isi email dan sandi</small>
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        <div class="card-body">
                            @csrf
                            <div class="form-group row mb-2">
                                <label for="email" class="col-md-12 col-form-label">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-12">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="password" class="col-md-4 col-form-label">{{ __('Password') }}</label>
                                <div class="col-md-12">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <input id="role" type="hidden" name="role">

                        </div>
                        <div class="card-footer">
                            <div class="form-group row mb-0">
                                <div class="col-md-9">
                                    <small class="text-muted">Hubungi Operator jika lupa sandi</small>
                                    <br>
                                    <a href="{{ route('landing') }}">
                                        <small class="text-muted">
                                            Kembali ke beranda
                                        </small>
                                    </a>
                                </div>
                                <div class="col-md-3 text-end">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    $("#satker").click(function() {
        $("#role").attr('value', 1)
        $("#form-select-role").fadeOut("slow", function() {
            $("#role-text").text('Masuk Sebagai Satker')
            $("#form-login").fadeIn()
        })
    })
    $("#uapb").click(function() {
        $("#role").attr('value', 2)
        $("#form-select-role").fadeOut("slow", function() {
            $("#role-text").text('Masuk Sebagai UAPB')
            $("#form-login").fadeIn()
        })
    })
    $("#apip").click(function() {
        $("#role").attr('value', 3)
        $("#form-select-role").fadeOut("slow", function() {
            $("#role-text").text('Masuk Sebagai APIP')
            $("#form-login").fadeIn()
        })
    })

</script>
@endpush
