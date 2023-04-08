@extends('layouts.pdf')

@section('page')
<script type="text/php">
    if ( isset($pdf) ) {
        $pdf->page_text(410, 574, "Hal: {PAGE_NUM}", "poppins", 8, array(0,0,0));
    }
</script>
@endsection

@section('header')
<h4 class="center">RENCANA KEBUTUHAN BARANG MILIK NEGARA</h4>
<h4 class="center">PENGGUNA BARANG</h4>
<h4 class="center">PENGADAAN</h4>
<h4 class="center">TAHUN {{ $periode->tahun }}</h4>
<h4 style="margin-top:0.5cm" class="left">KEMENTERIAN/LEMBAGA : 068 - BADAN KEPENDUDUKAN DAN KELUARGA BERENCANA NASIONAL</h4>
@endsection

@section('content')
<style>
    body {
        margin-top: 4cm !important;
    }

    tr td {
        line-height: 8pt !important;
        background-color: #fff;
    }
    .bg-blue {
        background-color: #a1d6f7 !important;
    }
    .bg-red {
        background-color: #faafac !important;
    }
</style>
<main>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Satuan Kerja</th>
                <th>Kode Barang</th>
                <th>Uraian Barang</th>
                <th>Usulan BMN</th>
                <th>SBSK</th>
                <th>Opt. Eksisting BMN</th>
                <th>Kebutuhan Riil BMN</th>
                <th>Usulan Yang Distujui</th>
            </tr>
        </thead>
        <tbody>
            @foreach($accepted as $satker)
            <tr>
                <td class="bg-blue">{{ $loop->iteration }}</td>
                <td colspan="8" class="bg-blue"><b>{{ $satker->name }}</b></td>
            </tr>
            @foreach($satker->pengadaan as $pengadaan)
            @foreach($pengadaan->pengadaanRakbm as $rakbm)
            <tr>
                <td colspan="2" nowrap></td>s
                <td nowrap>{{ $rakbm->produk->kode_barang }}</td>
                <td nowrap>{{ $rakbm->produk->nama }}</td>
                <td style="text-align: center" nowrap>{{ $rakbm->total }}</td>
                <td style="text-align: center" nowrap>{{ $rakbm->sbsk_bmn }}</td>
                <td style="text-align: center" nowrap>{{ $rakbm->existing_bmn }}</td>
                <td style="text-align: center" nowrap>{{ $rakbm->kebutuhan }}</td>
                <td style="text-align: center" nowrap>{{ $rakbm->uapb }}</td>
            </tr>
            @endforeach
            @endforeach
            @endforeach
        </tbody>
    </table>
    <h4 style="padding-top:2cm; padding-right:3cm" class="right">Kepala BKKBN selaku Pengguna Barang,</h4>
    <h4 style="padding-top:3cm; padding-right:4cm" class="right">(…Nama Penandatangan…)</h4>

    <div class="page-break"></div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Satuan Kerja</th>
                <th>Kode Barang</th>
                <th>Uraian Barang</th>
                <th>Usulan BMN</th>
                <th>SBSK</th>
                <th>Opt. Eksisting BMN</th>
                <th>Kebutuhan Riil BMN</th>
                <th>Usulan Yang Distujui</th>
                <th>Ket.</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rejected as $satker)
            <tr>
                <td class="bg-red">{{ $loop->iteration }}</td>
                <td colspan="9" class="bg-red"><b>{{ $satker->name }}</b></td>
            </tr>
            @foreach($satker->pengadaan as $pengadaan)
            @foreach($pengadaan->pengadaanRakbm as $rakbm)
            <tr>
                <td colspan="2" nowrap></td>s
                <td nowrap>{{ $rakbm->produk->kode_barang }}</td>
                <td nowrap>{{ $rakbm->produk->nama }}</td>
                <td style="text-align: center" nowrap>{{ $rakbm->total }}</td>
                <td style="text-align: center" nowrap>{{ $rakbm->sbsk_bmn }}</td>
                <td style="text-align: center" nowrap>{{ $rakbm->existing_bmn }}</td>
                <td style="text-align: center" nowrap>{{ $rakbm->kebutuhan }}</td>
                <td style="text-align: center" nowrap>{{ $rakbm->uapb }}</td>
                <td nowrap>{{ $rakbm->keterangan }}</td>
            </tr>
            @endforeach
            @endforeach
            @endforeach
        </tbody>
    </table>
    <h4 style="padding-top:2cm; padding-right:3cm" class="right">Kepala BKKBN selaku Pengguna Barang,</h4>
    <h4 style="padding-top:3cm; padding-right:4cm" class="right">(…Nama Penandatangan…)</h4>
</main>
@endsection