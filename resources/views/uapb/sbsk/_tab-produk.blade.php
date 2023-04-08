<table class="table table-bordered">
    <thead style="font-size:14px !important" class="text-center">
        <tr>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Status</th>
            <th width="10%"></th>
        </tr>
    </thead>
    <tbody  style="font-size:14px !important">
        @if($produks->count() > 0)
        @foreach($produks as $item)
        <tr>
            <td>{{ $item->kode_barang }}</td>
            <td>{{ $item->nama }}</td>
            <td>{{ $item->status_name }}</td>
            <td>
                <a href="#" class="btn btn-sm btn-outline-secondary edit-produk" data-action="{{ route('Uapb::produk.update', $item) }}" data-form="{{ $item->kode_barang }}|{{ $item->nama }}|{{ $item->status }}">
                    Edit
                </a>
                {{-- <a href="{{ route('Uapb::satker.request', $item->tahun) }}" class="text-inverse p-r-10 text-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat Detail">
                    <i class="bi bi-pencil-square"></i>
                </a> --}}
            </td>
        </tr>
        @endforeach
        @else
        <tr>
            <td class="text-center" colspan="4">Data belum diinput</td>
        </tr>
        @endif
    </tbody>
</table>
