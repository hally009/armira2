<table class="table table-bordered" style="font-size:12px">
    <thead class="text-center">
        <tr>
            <th>NAMA BARANG</th>
            <th>SBSK BMN</th>
            <th>BMN EKSISTING</th>
            <th>KEBUTUHAN RIIL</th>
            <th>JUMLAH USULAN</th>
            <th>PELUANG USULAN DISETUJUI </th>
            @if($item->status_apip == get_status('aktif'))
                <th>APIP</th>
                <th colspan="2">UAPB</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach($produkSbsk as $produk)
        <tr>
            <td>{{ $produk->nama }}</td>
            <td class="text-center">{{ $rakbm[$produk->id]->sbsk_bmn }}</td>
            <td class="text-center">{{ $rakbm[$produk->id]->existing_bmn }}</td>
            <td class="text-center">{{ $rakbm[$produk->id]->kebutuhan }}</td>
            <td class="text-center">{{ $rakbm[$produk->id]->total }}</td>
            <td class="text-center">{{ $rakbm[$produk->id]->peluang_setuju }}</td>
            @if($item->status_apip == get_status('aktif'))
                <td class="text-center">{{ $rakbm[$produk->id]->apip }}</td>
                @if($rakbm[$produk->id]->status != get_status_alur('on-progress'))
                    <td class="text-left">{{ status_alur_name($rakbm[$produk->id]->status) }}</td>

                    @if($rakbm[$produk->id]->status == get_status_alur('disetujui'))
                    <td class="text-center">{{ $rakbm[$produk->id]->uapb }}</td>
                    @else
                    <td class="text-center">{{ $rakbm[$produk->id]->keterangan }}</td>
                    @endif
                @else
                    <th colspan="2">-</th>
                @endif
            @endif
        </tr>
        @endforeach
    </tbody>
</table>
