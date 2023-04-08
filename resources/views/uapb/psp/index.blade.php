@extends('layouts.app')
@section('body')
<div class="row">
    <div class="col-md-12">
        @include('layouts._alert')
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-9 align-self-center">
                        <h5 class="card-title mb-0 py-0">PSP BMN</h5>
                        <h6 class="mb-0 py-0">Daftar Permohonan PSP BMN </h6>
                    </div>
                    <div class="col-md-3 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            {{-- <select class="form-select" id="satker">
                                <option value="">Pilih satker</option>
                                @foreach($satker as $value)
                                <option value="{{ $value->id }}" @if(isset($satkerId) && $satkerId==$value->id)
                                    selected
                                    @endif
                                    >{{ $value->name }}</option>
                                @endforeach
                            </select> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if(isset($items) && $items->count() > 0 )
                @include('uapb.psp._table')
                @else
                <p class="mt-3 text-center">
                    Belum ada pengajuan
                </p>
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
            window.location.replace("{{route('Uapb::sbsk.index')}}?satker=" + this.value);
            return
        }
        window.location.replace("{{route('Uapb::sbsk.index')}}");
    })

</script>
@endpush
