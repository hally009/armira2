<table class="table">
    <thead>
        <tr>
            <th>Nama Satker</th>
            <th>Pengadaan</th>
            <th>Tanggal Registrasi</th>
            <th>Status</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @if($itemPengadaan->count() > 0)
        @foreach($itemPengadaan as $item)
        <tr>
            <td>{{ $item->satker_id }}</td>
            <td>{{ $item->kode_transaksi }}</td>
            <td>{{ human_date($item->created_at) }}</td>
            <td>{{ $item->status_progress }}</td>
            <td>
                {{-- <a href="{{ route('Uapb::satker.request', $item->tahun) }}" class="text-inverse p-r-10 text-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat Detail">
                    <i class="bi bi-pencil-square"></i>
                </a> --}}
                <a href="#" class="text-inverse p-r-10 text-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat Detail">
                    <i class="bi bi-pencil-square"></i>
                </a>
            </td>
        </tr>
        @endforeach
        @else
        <tr>
            <td class="text-center" colspan="5">Data tidak ditemukan</td>
        </tr>
        @endif
    </tbody>
</table>
