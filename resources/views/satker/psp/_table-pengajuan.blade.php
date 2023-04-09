@php
$form = json_decode($psp->pengelolaanForm->form);
@endphp

<table class="table mt-2 mb-0">
    <tbody>
        <tr>
            <td class="bg-{{ $psp->status_text }} border-{{ $psp->status_text }} text-white" style="border-width: 1px 1px 0 1px; " width="50%">
                No Tiket {{ $psp->kode_transaksi }}
            </td>
            <td style="border: none;"></td>
        </tr>
    </tbody>
</table>
<table class="table table-bordered border-{{ $psp->status_text }}">
    <tbody>
        <tr>
            <td>
                <div class="row">
                    <div class="col-4 col-sm-4">
                        No
                    </div>
                    <div class="col-8 col-sm-8">
                        {{ $form->nomor_surat }}
                    </div>
                </div>
                <hr class="mb-1 mt-1">
                <div class="row">
                    <div class="col-4 col-sm-4">
                        Tanggal
                    </div>
                    <div class="col-8 col-sm-8">
                        {{ human_date($form->tanggal_surat) }}
                    </div>
                </div>
                <hr class="mb-1 mt-1">
                <div class="row">
                    <div class="col-4 col-sm-4">
                        Perihal
                    </div>
                    <div class="col-8 col-sm-8">
                        {{ $form->perihal_surat }}
                    </div>
                </div>
                <hr class="mb-1 mt-1">
                <div class="row">
                    <div class="col-4 col-sm-4">
                        Nilai Order
                    </div>
                    <div class="col-8 col-sm-8">
                        {{ number_format($form->nilai_psp) }}
                    </div>
                </div>
                <hr class="mb-1 mt-1">
                {{-- file --}}
                <div class="row">
                    @foreach($psp->pengelolaanFile as $file)
                    <div class="col-md-12">
                        <a href="{{ asset($file->file) }}">
                            <i class="bi bi-square-fill"></i> {{ str_replace("_", " ", $file->name) }}
                        </a>
                    </div>
                    @endforeach
                </div>
                <hr class="mb-3 mt-1">
                {{-- action --}}
                <div class="row text-secondary">
                    <div class="col-2 col-sm-2">
                        <h1>
                            @if ($psp->isDeletable())
                            <a href="#" onclick="deleteById({{ $psp->id }})">
                                <i class="bi bi-trash3 text-danger"></i>
                            </a>
                            <form id="del-form-{{ $psp->id }}" action="{{ route('Satker::psp.destroy', $psp) }}"
                                method="POST" class="d-none">
                                @csrf
                                @method('delete')
                            </form>
                            @else
                            {!! $psp->status_icon !!}
                            @endif
                        </h1>
                    </div>
                    <div class="col-5 col-sm-5">
                        <h6 class="text-xs">{{ human_date($psp->created_at, 'D MMM Y') }}</h6>
                        <h6 class="text-xs">{{ get_time($psp->created_at) }}</h6>
                    </div>
                    <div class="col-5 col-sm-5">
                        <a href="{{ route('Satker::psp.show', $psp) }}" class="btn btn-outline-secondary btn-sm">
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
