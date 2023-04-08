<table class="table mt-2 mb-0">
    <tbody>
        <tr>
            <td class="bg-{{ $item->status_text }} border-{{ $item->status_text }} text-white"
                style="border-width: 1px 1px 0 1px; " width="50%">
                No Tiket {{ $item->kode_transaksi }}
            </td>
            <td style="border: none;"></td>
        </tr>
    </tbody>
</table>
<table class="table table-bordered border-{{ $item->status_text }}">
    <tbody>
        <tr>
            <td>
                <div class="row">
                    <div class="col-12 col-sm-12 text-center">
                        <p class="mb-0">{{ strtoupper($item->nama) }} </p>
                        <p>Periode {{ $item->periode }}</p>
                    </div>
                </div>
                <div class="row">
                    @foreach($item->pengadaanFile as $file)
                    <div class="col-md-12">
                        <a href="{{ asset($file->file) }}">
                            <i class="bi bi-square-fill"></i> {{ str_replace("_", " ", $file->name) }}
                        </a>
                    </div>
                    @endforeach
                </div>
                <hr class="mb-3 mt-1">

                <div class="row text-secondary">
                    <div class="col-2 col-sm-2">
                        <h1>
                            @if ($item->isDeletable())
                            <a href="#" onclick="deleteById({{ $item->id }})">
                                <i class="bi bi-trash3 text-danger"></i>
                            </a>
                            <form id="del-form-{{ $item->id }}" action="{{ route('Satker::pengadaan.destroy', $item) }}"
                                method="POST" class="d-none">
                                @csrf
                                @method('delete')
                            </form>
                            @else
                            {!! $item->status_icon !!}
                            @endif
                        </h1>
                    </div>
                    <div class="col-5 col-sm-5">
                        <h6 class="text-xs">{{ human_date($item->created_at, 'D MMM Y') }}</h6>
                        <h6 class="text-xs">{{ get_time($item->created_at) }}</h6>
                    </div>
                    <div class="col-5 col-sm-5">
                        <a href="{{ route('Satker::pengadaan.show', $item) }}" class="btn btn-outline-secondary btn-sm">
                            Lihat Detail<i class="bi bi-chevron-right"></i>
                        </a>
                    </div>
                </div>
            </td>
        </tr>
    </tbody>
</table>

@push('script')
<script>
function deleteById(id) {
  if (confirm("Apakah anda yakin menghapus data ini?") == true) {
    document.getElementById('del-form-'+id).submit();
  }
}
</script>
@endpush