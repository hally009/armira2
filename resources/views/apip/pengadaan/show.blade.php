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
                        <a type="button" href="{{ route('Apip::pengadaan.index') }}" class="btn btn-outline-danger me-1">
                            Kembali
                        </a>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            @if($item->status_progress == get_status('aktif') &&
                                $item->pengadaanAlur->last()->status == get_status_alur('on-progress') &&
                                $item->pengadaanAlur->last()->kepada == roles('apip')
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

<div class="modal fade" id="modal-periksa" tabindex="-1">
    <div class="modal-dialog modal-lg modal-large modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pengadaan BMN</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3" id="uploadSk" action="{{ route('Apip::pengadaan.update', $item) }}" method="POST" enctype="multipart/form-data">
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
                                    <th>PELUANG USULAN DISETUJUI </th>
                                    <th>APIP </th>
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
                                    <td class="text-center">
                                        <input class="form-control form-control-sm apip" type="number" id="apip_{{ $produk->id }}" 
                                        name="apip_{{ $produk->id }}" 
                                        value="0">
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
