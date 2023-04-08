<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-5 align-self-center">
                        <h5 class="card-title mb-0 py-0">Permohonan PSP</h5>
                        <p>Daftar Permohonan Penetapan Status Pengguna (PSP) BMN</p>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            {{-- <a type="button" href="{{ route('Satker::pegawai.create') }}" class="btn btn-primary text-white">
                            <i class="fa fa-plus-circle"></i> Tambah Data
                            </a> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body pt-4">
                <div class="row">
                    @if($items->count() > 0)
                    @foreach($items as $psp)
                    <div class="col-md-4">
                        @include('satker.psp._table-pengajuan')
                    </div>
                    @endforeach
                    @else
                    <p class="text-center">Belum ada pengajuan PSP</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
