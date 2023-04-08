<div class="row">
    <div class="col-md-2">
        <p class="text-center">{{ $satker->find($satkerId)->name }}</p>
        @foreach($items as $item)
        <div class="form-check">
            <form action="{{ route('Uapb::sbsk.activate', $item) }}" id="form-{{ $item->id }}" method="POST">
            @csrf
            @method('PUT')
                <input class="form-check-input sbsk-input" type="checkbox" name="sbsk-{{ $item->id }}" id="sbsk-{{ $item->id }}" @if(get_status('aktif')==$item->status)checked @endif>
                <label class="form-check-label" for="produk-{{ $item->id }}">
                    {{ $item->produk->nama }}
                </label>
            </form>
        </div>
        @endforeach
    </div>
    <div class="col-md-10">
        @include('uapb.sbsk._form-table')
    </div>
</div>

@push('script')
<script>
$(".sbsk-input").click(function() {
    let arrId = this.id.split("-")
    $("#form-"+arrId[1]).submit();
})
</script>
@endpush
