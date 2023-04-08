<table class="table table-bordered">
    <thead>
        <tr>
            <th>NAMA BARANG</th>
            <th>SBSK BMN</th>
            <th>BMN EKSISTING</th>
            <th>KEBUTUHAN RIIL</th>
            <th>JUMLAH USULAN</th>
            <th>PELUANG USULAN DISETUJUI </th>
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
        </tr>
        @endforeach
    </tbody>
</table>
