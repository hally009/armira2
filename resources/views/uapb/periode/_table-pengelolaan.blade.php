<table class="table">
    <thead>
        <tr>
            <th>Nama Satker</th>
            <th>Pengelolaan</th>
            <th>Jenis</th>
            <th>Tanggal Registrasi</th>
            <th>Status</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @if($itemPengelolaan->count() > 0)
        @foreach($itemPengelolaan as $item)
        <tr>
            <td>{{ $item->satker->name }}</td>
            <td>{{ $item->kode_transaksi }}</td>
            <td>{{ jenis_pengelolaan_nama($item->jenis) }}</td>
            <td>{{ human_date($item->created_at) }}</td>
            <td>{{ status_progress_name($item->status_progress) }}</td>
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
            <td class="text-center" colspan="6">Data tidak ditemukan</td>
        </tr>
        @endif
    </tbody>
</table>
