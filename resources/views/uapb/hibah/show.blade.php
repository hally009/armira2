@extends('layouts.app')
@section('body')
<div class="row">
    <div class="col-md-12">
        @include('layouts._alert')
        <div class="card">
            <div class="card-header pt-0 pe-0 pb-0">
                <div class="row">
                    <div class="col-md-6 bg-light ps-0 pe-0">
                        <h5 class="card-title mt-3 mb-0 py-0 ms-3">Dokumen</h5>
                        <h6 class="mb-0 py-0 ms-3">Lampiran dokumen permohonan HIBAH</h6>
                    </div>
                    <div class="col-md-6 ps-0 align-self-center">
                        <div class="d-flex justify-content-end align-items-center">
                            @include('uapb.hibah._table-show')
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row mt-3">
                    <div class="col-md-5 align-self-center">
                        <a type="button" href="{{ route('Uapb::hibah.index') }}" class="btn btn-outline-secondary me-1">
                            Kembali
                        </a>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            @if($item->status_progress == get_status_alur('on-progress'))
                            <button class="btn btn-outline-danger me-1" data-bs-toggle="modal" data-bs-target="#modal-rejected">
                                Ditolak <i class="bi bi-journal-x"></i>
                            </button>
                            <button class="btn btn-outline-primary me-1" data-bs-toggle="modal" data-bs-target="#modal-repeat">
                                Perbaikan <i class="bi bi-arrow-repeat"></i>
                            </button>
                            <a type="button" href="#" class="btn btn-outline-success me-1" onclick="event.preventDefault(); document.getElementById('aggreement-form').submit();">
                                Disetujui<i class="bi bi-chevron-right"></i>
                            </a>
                            <form id="aggreement-form" action="{{ route('Uapb::hibah.approve', $item) }}" method="POST" class="d-none">
                                @method('PUT')
                                @csrf
                            </form>
                            @endif

                            @if($item->status_progress == get_status_alur('disetujui'))
                            <div class="btn-group me-1">
                                <button type="button" class="btn btn-outline-success dropdown-toggle" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Download Draft
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" target="blank"
                                            href="{{ route('Uapb::hibah.draft', $item) }}">
                                            Format PDF
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" target="blank"
                                            href="{{ route('Uapb::hibah.draft.word', $item) }}">
                                            Format Doc
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            {{-- <a type="button" href="{{ route('Uapb::hibah.draft', $item) }}" target="blank" class="btn btn-outline-success me-1">
                                Download Draft <i class="bi bi-file-earmark-arrow-down"></i>
                            </a> --}}
                            <button class="btn btn-outline-success me-1" data-bs-toggle="modal" data-bs-target="#modal-upload">
                                Upload SK <i class="bi bi-file-earmark-arrow-up"></i>
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
                <hr>
                @include('uapb.hibah._show-file')
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-repeat" tabindex="-1">
    <div class="modal-dialog modal-small">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Alasan Perbaikan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3" id="uploadSk" action="{{ route('Uapb::hibah.repeat', $item) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="col-md-12">
                        <input type="text" class="form-control" name="keterangan">
                    </div>
                    <div class="row ps-0 pe-0 mt-3">
                        <div class="col-md-5 ps-4">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" id="tutup">Tutup</button>
                        </div>
                        <div class="col-md-7 pe-0 align-self-center text-right">
                            <div class="d-flex justify-content-end align-items-center">
                                <button type="submit" class="btn btn-outline-primary">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-rejected" tabindex="-1">
    <div class="modal-dialog modal-small">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Alasan Penolakan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3" id="uploadSk" action="{{ route('Uapb::hibah.rejected', $item) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="col-md-12">
                        <input type="text" class="form-control" name="keterangan">
                    </div>
                    <div class="row ps-0 pe-0 mt-3">
                        <div class="col-md-5 ps-4">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" id="tutup">Tutup</button>
                        </div>
                        <div class="col-md-7 pe-0 align-self-center text-right">
                            <div class="d-flex justify-content-end align-items-center">
                                <button type="submit" class="btn btn-outline-danger">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
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
                <form class="row g-3" id="uploadSk" action="{{ route('Uapb::hibah.uploadsk', $item) }}" method="POST" enctype="multipart/form-data">
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
    let uploadFile = (formId) => {
        let form = $(formId)
        let dataForm = form.serialize()
        let formData = new FormData(form[0]);

        $.ajax({
            url: form.attr('action')
            , method: 'post'
            , data: formData
            , contentType: false
            , processData: false
            , success: function(data) {
                alert('Upload Success')
            }
        });

    }

</script>
@endpush
