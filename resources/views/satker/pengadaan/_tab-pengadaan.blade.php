<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-5 align-self-center">
                        <h5 class="card-title mb-0 py-0">PERENCANAAN SBSK PERIODE {{ session('tahun') }}</h5>
                        <p>Daftar usulan perencanaan SBSK</p>
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
                    @foreach($items as $item)
                    <div class="col-md-4">
                        @include('satker.pengadaan._table-pengajuan')
                    </div>
                    @endforeach
                    @else
                    <p class="text-center">Belum ada usulan perenacanaan SBSK</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
