<div class="row mb-3 mt-3">
    <div class="col-md-3 ps-0">
        <div class="form-floating">
            <input type="text" class="form-control" id="nama_usulan" value="{{ ($temp)?$temp->nama_usulan:'' }}" name="nama_usulan">
            <label for="nama_usulan">Nama Usulan</label>
        </div>
    </div>
</div>
<div class="row mb-3 mt-3">
    <table class="table  table-bordered">
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
            @foreach($produkSbsk as $item)
            @php
                $asetSbsk = array_key_exists($item->kode_barang, $aset) ? $aset[$item->kode_barang] : 0;
                $countSbsk = sbsk_bmn($item->sbsk, $pegawai);
            @endphp
            <tr>
                <td>{{ $item->nama }}</td>
                <td id="sbsk_{{ $item->id }}">
                    {{ $countSbsk }}
                </td>
                <td id="existing_{{ $item->id }}">
                    {{ $asetSbsk }}
                </td>
                <td id="riil_{{ $item->id }}">
                    {{ kebutuhan_riil($countSbsk, $asetSbsk) }}
                </td>
                <td>
                    <input class="form-control usulan" type="number" id="usulan_{{ $item->id }}" name="usulan_{{ $item->id }}" value="{{ (count($usulanRakbm) > 0)? $usulanRakbm[$item->id]['usulan']:0 }}" 
                    @if(count($usulanRakbm) == 0)
                    disabled
                    @endif
                    >
                </td>
                <td id="peluang_{{ $item->id }}">{{ (count($usulanRakbm) > 0)? $usulanRakbm[$item->id]['peluang']:0 }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>