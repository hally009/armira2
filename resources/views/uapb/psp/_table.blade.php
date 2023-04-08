<table class="table table-bordered">
    <thead class="text-bg-secondary">
        <tr>
            <th>No Tiket</th>
            <th>Nama Satker</th>
            <th>Perihal</th>
            <th>Tanggal Usulan</th>
            <th>Status Pengajuan</th>
            <th>Status Pengesahan</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($items as $item)
        @php
        $form = json_decode($item->pengelolaanForm->form);
        @endphp
        <tr>
            <td>{{ $item->kode_transaksi }}</td>
            <td>{{ $item->satker->name }}</td>
            <td>{{ $form->perihal_surat }}</td>
            <td>{{ human_date($item->created_at) }}</td>
            <td>{{ status_progress_name($item->status_progress) }}</td>
            <td>{{ status_pengesahan_name($item->status_pengesahan) }}</td>
            <td width="10%">
                <a href="{{ route('Uapb::psp.show', $item) }}" class="btn btn-sm btn-outline-secondary">
                    Detail <i class="bi bi-pencil-square"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
