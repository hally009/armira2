@extends('layouts.app')
@section('body')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 col-sm-12 mt-3 text-center">
                        <a href="contact-detail.html"><img src="{{ asset('images/profile-img.jpg') }}" alt="user" class="rounded-circle" style="max-height: 210px;"></a>
                    </div>
                    <div class="col-md-9 mt-3">
                        <div class="row">
                            <div class="col-md-4">
                                <h5 class="card-title mb-0 py-0"><small>Nama</small></h5>
                            </div>
                            <div class="col-md-8">
                                <p class="mb-0">{{ $item->name }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <h5 class="card-title mb-0 py-0"><small>Alamat</small></h5>
                            </div>
                            <div class="col-md-8">
                                <p class="mb-0">{{ $item->alamat }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                            <h5 class="card-title mb-0 py-0"><small>Pejabat Pengesahan</small></h5>                                
                            </div>
                            <div class="col-md-8">
                                <p class="mb-0">{{ $item->pejabat_pengesahan }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <button class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#modal-uapb">
                        UBAH
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        @include('component.info-component')
    </div>
</div>

<div class="modal fade" id="modal-uapb" tabindex="-1">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3" action="{{ route('Uapb::profile.store') }}" method="POST" enctype="multipart/form-data">
                    @method('POST')
                    @csrf
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="pejabat_pengesahan" placeholder="Your Name" name="pejabat_pengesahan" value="{{ isset($item) ? $item->pejabat_pengesahan : '' }}">
                            <label for="pejabat_pengesahan">Pejabat Pengesahan</label>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="tutup">TUTUP</button>
                    {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">TUTUP</button> --}}
                    <button type="submit" class="btn btn-primary text-white">SIMPAN</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
