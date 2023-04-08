@extends('layouts.app')
@section('body')
<div class="row">
    <div class="col-md-12">
        @include('layouts._alert')
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6 align-self-center">
                        <h5 class="card-title mb-0 py-0">PENGADAAN BMN</h5>
                        <h6 class="mb-0 py-0">Daftar Usulan Pengadaan BMN </h6>
                    </div>
                    <div class="col-md-6 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <a class="btn btn-outline-primary" target="blank" href="{{ route('Uapb::pengadaan.draft') }}">
                                Unduh Draft Pengadaan
                            </a> &nbsp;
                            <button class="btn btn-outline-success me-1" data-bs-toggle="modal" data-bs-target="#modal-upload">
                                Upload SK <i class="bi bi-file-earmark-arrow-up"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if(isset($items) && $items->count() > 0)
                @include('uapb.pengadaan._table')
                @else
                <p class="mt-3 text-center">
                    Belum ada pengajuan
                </p>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-upload" tabindex="-1">
    <div class="modal-dialog modal-small">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload SK</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3" id="uploadSk" action="{{ route('Uapb::pengadaan.uploadsk') }}" method="POST" enctype="multipart/form-data">
                    @method('POST')
                    @csrf
                    <div class="col-md-12">
                        <input type="file" class="form-control" placeholder="Your Name" name="file_sk">
                    </div>
                    <div class="row ps-0 pe-0 mt-3">
                        <div class="col-md-5 ps-4">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" id="tutup">Tutup</button>
                        </div>
                        <div class="col-md-7 pe-0 align-self-center text-right">
                            <div class="d-flex justify-content-end align-items-center">
                                <button type="submit" class="btn btn-outline-primary">Upload</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('script')
<script>
    $("#satker").on('change', function() {
        if (this.value) {
            window.location.replace("{{route('Uapb::sbsk.index')}}?satker=" + this.value);
            return
        }
        window.location.replace("{{route('Uapb::sbsk.index')}}");
    })

</script>
@endpush
