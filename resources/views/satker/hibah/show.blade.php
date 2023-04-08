@extends('layouts.app')
@section('body')

@php
$form = json_decode($item->pengelolaanForm->form);
@endphp

<div class="row">
    <div class="col-md-12">
        @include('layouts._alert')
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-9 align-self-center">
                        <h4 class="card-title mb-0 py-0">Progress</h4>
                        <h5 class="mb-0 py-0">
                            Status Permohonan HIBAH nomor tiket {{ $item->kode_transaksi }}
                        </h5>
                    </div>
                    <div class="col-md-3 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <a href="{{ route('Satker::hibah.index') }}" class="btn btn-outline-secondary">Kembali</a>
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
                            <tbody>
                                <tr>
                                    <td width="25%">No Tiket</td>
                                    <td>{{ $item->kode_transaksi }}</td>
                                </tr>
                                <tr>
                                    <td>No Surat</td>
                                    <td>{{ $form->nomor_surat }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Surat</td>
                                    <td>{{ human_date($form->tanggal_surat) }}</td>
                                </tr>
                                <tr>
                                    <td>Perihal Surat</td>
                                    <td>{{ $form->perihal_surat }}</td>
                                </tr>
                                <tr>
                                    <td>Total Nilai Objek</td>
                                    <td>{{ number_format($form->nilai_hibah) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-4 ms-3">
                        @include('component.timeline-pengelolaan-component')
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
                <h5 class="modal-title">Perbaikan Permohonan HIBAH BMN</h5>
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
            url: "{{ route('Satker::hibah.perbaikan.show', $item) }}",
            success: function(data) {
                $("#body-perbaikan").html(data)
                $("#modal-perbaikan").modal('show')
            }
        });
    })
</script>
@endpush