<div class="row">
    <div class="col-md-12">
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
                @php
                $usulan = json_decode($temp->usulan_rakbm, true);
                @endphp
                @foreach($produkSbsk as $item)
                <tr>
                    <td>{{ $item->nama }}</td>
                    <td class="text-center">{{ $usulan[$item->id]['sbsk'] }}</td>
                    <td class="text-center">{{ $usulan[$item->id]['aset'] }}</td>
                    <td class="text-center">{{ $usulan[$item->id]['riil'] }}</td>
                    <td class="text-center">{{ $usulan[$item->id]['usulan'] }}</td>
                    <td class="text-center">{{ $usulan[$item->id]['peluang'] }}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="6" class="text-center">
                        @if($temp && $temp->file)
                        <div class="row">
                            @foreach(json_decode($temp->file, true) as $key => $value)
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h1><i class="bi bi-file-earmark-text"></i></h1>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            {{ str_replace("_", " ", $key) }}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
