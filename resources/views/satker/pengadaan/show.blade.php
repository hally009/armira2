@extends('layouts.app')
@section('body')
<div class="row">
    <div class="col-md-12">
        @include('layouts._alert')
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-9 align-self-center">
                        <h4 class="card-title mb-0 py-0">Progress</h4>
                        <h5 class="mb-0 py-0">
                            Status Permohonan Pengadaan BMN nomor tiket {{ $item->kode_transaksi }}
                        </h5>
                    </div>
                    <div class="col-md-3 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">

                            <a href="{{ route('Satker::pengadaan.index') }}" class="btn btn-outline-secondary">
                                Kembali
                            </a>
                            &nbsp;
                            @if($item->status_progress == get_status_alur('perbaikan') || 
                                $item->status_progress == get_status_alur('on-progress'))
                            <button class="btn btn-outline-primary" id="button-perbaikan">
                                Edit
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row mt-3">
                    <div class="col-lg-7">
                        <table class="table table-bordered" style="font-size:12px">
                            <thead class="text-center">
                                <tr>
                                    <th>NAMA BARANG</th>
                                    <th>SBSK BMN</th>
                                    <th>BMN EKSISTING</th>
                                    <th>KEBUTUHAN RIIL</th>
                                    <th>JUMLAH USULAN</th>
                                    <th>PELUANG USULAN DISETUJUI </th>
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
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-4 ms-3">
                        <div class="timeline-steps aos-init aos-animate" data-aos="fade-up">
                            <ul class="timeline">
                                @foreach($item->pengadaanAlur as $alur)
                                <li class="timeline-inverted">
                                    @if($alur->status == get_status_alur('ditolak'))
                                    <div class="timeline-badge danger">
                                        <i class="bi bi-journal-x"></i>
                                    </div>
                                    @elseif($alur->status == get_status_alur('perbaikan'))
                                    <div class="timeline-badge warning">
                                        <i class="bi bi-arrow-repeat"></i>
                                    </div>
                                    @else
                                    <div class="timeline-badge primary">
                                        <i class="bi bi-patch-check"></i>
                                    </div>
                                    @endif
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h4 class="timeline-title">
                                                {{ $alur->kepada_name }}
                                            </h4>
                                            <p>
                                                <small class="text-muted">
                                                    <i class="glyphicon glyphicon-time"></i>
                                                    {{ human_date($alur->created_at) }} {{ get_time($alur->created_at)
                                                    }}
                                                </small>
                                            </p>
                                        </div>
                                        <div class="timeline-body">
                                            <p>
                                                {{ $alur->keterangan }}
                                            </p>

                                            @if($alur->status == get_status_alur('pengesahan'))
                                            <div class="col">
                                                <a href="{{ asset($item->file) }}">
                                                    <i class="bi bi-square-fill"></i> SK PENGADAAN
                                                </a>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-perbaikan" tabindex="-1">
    <div class="modal-dialog modal-fullscreen modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Perbaikan Permohonan Pengadaan BMN</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="body-perbaikan"></div>
        </div>
    </div>
</div>

@endsection

@push('script')
<script>
    
    $("#button-perbaikan").click(function() {
        $.ajax({
            url: "{{ route('Satker::pengadaan.perbaikan.show', $item) }}",
            success: function(data) {
                $("#body-perbaikan").html(data)
                $("#modal-perbaikan").modal('show')
            }
        });
    })
</script>
@endpush
