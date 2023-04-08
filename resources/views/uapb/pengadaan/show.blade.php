@extends('layouts.app')
@section('body')
<div class="row">
    <div class="col-md-12">
        @include('layouts._alert')
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6 bg-light">
                        <h5 class="card-title mb-0 py-0">PENGADAAN BMN</h5>
                        <h6 class="mb-0 py-0">Daftar Usulan Pengadaan BMN </h6>
                    </div>
                    <div class="col-md-6 ps-0 align-self-center">
                        <div class="d-flex justify-content-end align-items-center">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row mt-3">
                    <div class="col-md-5 align-self-center">
                        <a type="button" href="{{ route('Uapb::pengadaan.index') }}" class="btn btn-outline-secondary me-1">
                            Kembali
                        </a>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            @if($item->status_progress == get_status('non-aktif'))
                            <button class="btn btn-outline-danger me-1" data-bs-toggle="modal" data-bs-target="#modal-rejected">
                                Ditolak <i class="bi bi-journal-x"></i>
                            </button>
                            <button class="btn btn-outline-primary me-1" data-bs-toggle="modal" data-bs-target="#modal-repeat">
                                Perbaikan <i class="bi bi-arrow-repeat"></i>
                            </button>

                            <a type="button" href="#" class="btn btn-outline-success me-1" onclick="event.preventDefault(); document.getElementById('aggreement-form').submit();">
                                Disetujui<i class="bi bi-chevron-right"></i>
                            </a>
                            <form id="aggreement-form" action="{{ route('Uapb::pengadaan.approve', $item) }}" method="POST" class="d-none">
                                @method('PUT')
                                @csrf
                            </form>
                            @endif

                            @if($item->status_progress == get_status('aktif') &&
                            $item->status_apip == get_status('aktif')
                            )
                            <button class="btn btn-outline-success me-1" data-bs-toggle="modal" data-bs-target="#modal-periksa">
                                Periksa
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row mt-3">
                    <div class="col-md-12">
                        @include('uapb.pengadaan._table-show')
                    </div>
                </div>
                <hr>
                @include('uapb.pengadaan._show-file')
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
                <form class="row g-3" id="uploadSk" action="{{ route('Uapb::pengadaan.repeat', $item) }}" method="POST" enctype="multipart/form-data">
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
                <form class="row g-3" id="uploadSk" action="{{ route('Uapb::pengadaan.rejected', $item) }}" method="POST" enctype="multipart/form-data">
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

<div class="modal fade" id="modal-periksa" tabindex="-1">
    <div class="modal-dialog modal-fullscreen modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pengadaan BMN</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3" id="uploadSk" action="{{ route('Uapb::pengadaan.update', $item) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="col-md-12">
                        <table class="table table-bordered" style="font-size:14px">
                            <thead class="text-center">
                                <tr>
                                    <th>NAMA BARANG</th>
                                    <th>SBSK BMN</th>
                                    <th>BMN EKSISTING</th>
                                    <th>KEBUTUHAN RIIL</th>
                                    <th>JUMLAH USULAN</th>
                                    <th>PELUANG DISETUJUI</th>
                                    <th>APIP </th>
                                    <th colspan="2">UAPB</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($produkSbsk as $produk)
                                <tr>
                                    <td>{{ $produk->nama }}</td>
                                    <td class="text-center">{{ $rakbm[$produk->id]->sbsk_bmn }}</td>
                                    <td class="text-center">{{ $rakbm[$produk->id]->existing_bmn }}</td>
                                    <td class="text-center">{{ $rakbm[$produk->id]->kebutuhan }}</td>
                                    <td class="text-center">{{ $rakbm[$produk->id]->total }}</td>
                                    <td class="text-center">{{ $rakbm[$produk->id]->peluang_setuju }}</td>
                                    <td class="text-center">{{ $rakbm[$produk->id]->apip }}</td>
                                    <td>
                                        <div class="col-sm-10">
                                            <div class="form-check">
                                                <input class="form-check-input check-status-setuju" type="radio" id="status_{{ $produk->id }}" name="status_{{ $produk->id }}" value="{{ get_status_alur('disetujui') }}" checked>
                                                <label class="form-check-label">Disetujui</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input check-status-tolak" type="radio" id="status_{{ $produk->id }}" name="status_{{ $produk->id }}" value="{{ get_status_alur('ditolak') }}">
                                                <label class="form-check-label">Ditolak</label>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <input class="form-control form-control-sm" type="number" id="uapb_{{ $produk->id }}" name="uapb_{{ $produk->id }}" value="{{ $rakbm[$produk->id]->apip }}">

                                        <input class="form-control form-control-sm input-uapb" type="text" id="keterangan_{{ $produk->id }}" name="keterangan_{{ $produk->id }}" value="" placeholder="Keterangan">
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

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

@endsection

@push('script')
<script>
    $(".input-uapb").hide()
    $(".check-status-setuju").click(function() {
        let id = this.id.split("_")
        if ($(this).is(':checked')) {
            $("#keterangan_" + id[1]).hide()
            $("#uapb_" + id[1]).show()
        }
    })
    $(".check-status-tolak").click(function() {
        let id = this.id.split("_")
        if ($(this).is(':checked')) {
            $("#uapb_" + id[1]).hide()
            $("#keterangan_" + id[1]).show()
        }
    })

</script>
@endpush
