@extends('layouts.app')
@section('body')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-9 align-self-center">
                        <h5 class="card-title mb-0 py-0">Master Aset</h5>
                    </div>
                    <div class="col-md-3 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <select class="form-select" id="satker">
                                <option value="">Pilih satker</option>
                                @foreach($satker as $value)
                                <option value="{{ $value->id }}" @if(isset($satkerId) && $satkerId==$value->id)
                                    selected
                                    @endif
                                    >{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if(isset($item))
                @if($item->file)
                <div class="row mt-2 mb-2">
                    <div class="col-md-5 align-self-center">
                        <a type="button" href="{{ asset($item->file) }}" class="btn btn-outline-secondary">
                            <i class="ri-file-excel-2-line"></i> Unduh Excel
                        </a>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center"></div>
                    </div>
                </div>
                <iframe src='https://view.officeapps.live.com/op/embed.aspx?src={{ asset($item->file) }}' width='100%' height='565px' frameborder='0'> </iframe>
                @else
                <p class="mt-3 text-center">Satker belum upload Master Aset</p>
                @endif
                @else
                <p class="mt-3 text-center">Silahkan Pilih Satker terlebih dahulu untuk menampilkan data</p>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection

@push('script')
<script>
    $("#satker").on('change', function() {
        if (this.value) {
            window.location.replace("{{route('Uapb::master.index')}}?satker=" + this.value);
            return
        }
        window.location.replace("{{route('Uapb::master.index')}}");
    })

</script>
@endpush
