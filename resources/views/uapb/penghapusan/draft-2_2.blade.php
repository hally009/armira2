@extends('layouts.pdf')

@php
$form = json_decode($item->pengelolaanForm->form);
@endphp

@section('content')
<style>
    body {
        margin-top: 0.5cm !important;
    }

    p {
        text-align: justify;
        text-justify: inter-word;
        font-size: 12pt !important;
    }

    .sa::after {
        content: ":";
        text-align: right;
        float: right !important;
        margin-right: 0.1cm;
    }

    ol li {
        font-size: 12pt !important;
        margin-bottom: 0.3cm
    }

    .mt-05 {
        margin-top: 0.5cm
    }

    .mr-05 {
        margin-right: 0.5cm
    }

    .p-03 {
        padding: 0.3cm
    }

    .pr-1 {
        padding-right: 1cm
    }

    .mb-05 {
        margin-bottom: 0.5cm
    }
</style>
<main>
    <p class="center">KEPUTUSAN KEPALA BADAN KEPENDUDUKAN</p>
    <p class="center">DAN KELUARGA BERENCANA NASIONAL</p>
    <p class="center">NOMOR  ..../ KEP / B3 / 2022</p>
    <p class="center">TENTANG</p>
    <p class="center">PENGHAPUSAN BARANG MILIK NEGARA</p>
    <p class="center">DARI DAFTAR BARANG KUASA PENGGUNA PADA {{ strtoupper($item->satker->name) }}</p>
    <p class="center">KEPALA BADAN KEPENDUDUKAN DAN KELUARGA BERENCANA NASIONAL,</p>
    <table style="margin-top:1cm">
        <tbody>
            <tr>
                <td width="19%">
                    <p class="mr-05 sa">Menimbang</p>
                </td>
                <td width="5%">
                    <p class="mr-05">a.</p>
                </td>
                <td>
                    <p>
                        bahwa berdasarkan surat permohonan Kepala Satuan Kerja {{ $item->satker->name }} Nomor {{ $form->nomor_surat }} tentang {{ $form->perihal_surat }};
                    </p>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <p class="mr-05">b.</p>
                </td>
                <td>
                    <p>
                        bahwa berdasarkan surat persetujuan Kepala Badan Kependudukan dan Keluarga Berencana Nasional Nomor {{ $form->nomor_surat_persetujuan }} tentang {{ $form->perihal_surat_persetujuan }};
                    </p>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <p class="mr-05">c.</p>
                </td>
                <td>
                    <p>
                        bahwa berdasarkan surat Permohonan Kepala Satuan Kerja {{ $item->satker->name }} Nomor {{ $form->nomor_sk }} tentang {{ $form->perihal_sk }};
                    </p>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <p class="mr-05">d.</p>
                </td>
                <td>
                    <p class="mb-05">
                        bahwa berdasarkan pertimbangan sebagaimana dimaksud dalam huruf a, huruf b, dan huruf c, perlu menetapkan Keputusan Kepala Badan Kependudukan dan Keluarga Berencana Nasional tentang Penghapusan Barang Milik Negara dari Daftar Barang Kuasa Pengguna Pada {{ $item->satker->name }}.
                    </p>
                </td>
            </tr>
            <tr>
                <td width="19%">
                    <p class="mr-05 sa">Mengingat</p>
                </td>
                <td width="5%">
                    <p class="mr-05">1.</p>
                </td>
                <td>
                    <p>
                        Undang-Undang Nomor 1 Tahun 2004 tentang Perbendaharaan Negara (Lembaran Negara Republik Indonesia Tahun 2004 Nomor 5, Tambahan Lembaran Negara Republik Indonesia Nomor 4355);
                    </p>
                </td>
            </tr>
            <tr>
                <td width="19%"></td>
                <td width="5%">
                    <p class="mr-05">2.</p>
                </td>
                <td>
                    <p>
                        Undang-Undang Nomor 52 Tahun 2009 tentang Perkembangan Kependudukan dan Pembangunan Keluarga (Lembaran Negara Republik Indonesia Tahun  2009 Nomor 161, Tambahan Lembaran Negara Republik Indonesia Nomor 5080);
                    </p>
                </td>
            </tr>
            <tr>
                <td width="19%"></td>
                <td width="5%">
                    <p class="mr-05">3.</p>
                </td>
                <td>
                    <p>
                        Peraturan Pemerintah Nomor 27 Tahun 2014 tentang Pengelolaan Barang Milik Negara/Daerah (Lembaran Negara Republik Indonesia Tahun 2014 Nomor 92, Tambahan Lembaran Negara Republik Indonesia Nomor 5533) sebagaimana telah diubah dengan Peraturan Pemerintah Nomor 28 Tahun 2020 tentang Perubahan Atas Peraturan Pemerintah Nomor 27 Tahun 2014 tentang Pengelolaan Barang Milik Negara/Daerah (Lembaran Negara Republik Indonesia Tahun 2020 Nomor 142, Tambahan Lembaran Negara Republik Indonesia Nomor 6523);
                    </p>
                </td>
            </tr>
            <tr>
                <td width="19%"></td>
                <td width="5%">
                    <p class="mr-05">4.</p>
                </td>
                <td>
                    <p>
                        Keputusan Presiden Nomor 103 Tahun 2001 tentang Kedudukan, Tugas, Fungsi, Kewenangan, Susunan Organisasi, dan Tata Kerja Lembaga Pemerintah Non Departemen, sebagaimana telah beberapa kali diubah terakhir dengan Peraturan Presiden Nomor 145 Tahun 2015 tentang Perubahan Kedelapan atas Keputusan Presiden Nomor 103 Tahun 2001 Tentang Kedudukan, Tugas, Fungsi, Kewenangan, Susunan Organisasi, dan Tata Kerja Lembaga Pemerintah Non Kementerian (Lembaga Negara Republik Indonesia Tahun 2015 Nomor 322);
                    </p>
                </td>
            </tr>
            <tr>
                <td width="19%"></td>
                <td width="5%">
                    <p class="mr-05">5.</p>
                </td>
                <td>
                    <p>
                        Peraturan Menteri Keuangan Nomor 83/PMK.06/2016 tentang Tata Cara Pelaksanaan Pemusnahan dan Penghapusan Barang Milik Negara (Berita Negara Republik Indonesia Tahun 2016 Nomor 757); 
                    </p>
                </td>
            </tr>
            <tr>
                <td width="19%"></td>
                <td width="5%">
                    <p class="mr-05">6.</p>
                </td>
                <td>
                    <p>
                        Peraturan Kepala Badan Kependudukan dan Keluarga Berencana Nasional Nomor 82/PER/B5/2011 tentang Organisasi dan Tata Kerja Perwakilan Badan Kependudukan dan Keluarga Berencana Nasional Provinsi;
                    </p>
                </td>
            </tr>
            <tr>
                <td width="19%"></td>
                <td width="5%">
                    <p class="mr-05">7.</p>
                </td>
                <td>
                    <p>
                        Peraturan Kepala Badan Kependudukan dan Keluarga Berencana Nasional Nomor 230/PER/B3/2014 tentang Pedoman Penghapusan Barang Milik Negara di Lingkungan Badan Kependudukan dan Keluarga Berencana Nasional;
                    </p>
                </td>
            </tr>
            <tr>
                <td width="19%"></td>
                <td width="5%">
                    <p class="mr-05">8.</p>
                </td>
                <td>
                    <p>
                        Peraturan Badan Kependudukan dan Keluarga Berencana Nasional Nomor 11 Tahun 2020 tentang Organisasi dan Tata Kerja Badan Kependudukan dan Keluarga Berencana Nasional (Berita Negara Republik Indonesia Tahun 2020 Nomor 703);
                    </p>
                </td>
            </tr>
            <tr>
                <td width="19%"></td>
                <td width="5%">
                    <p class="mr-05">9.</p>
                </td>
                <td>
                    <p>
                        Peraturan Badan Kependudukan dan Keluarga Berencana Nasional Nomor 12 Tahun 2020 tentang Organisasi dan Tata Kerja Unit Pelaksana Teknis Balai Pendidikan, dan Pelatihan Kependudukan, dan Keluarga Berencana (Berita Negara Republik Indonesia Tahun 2020 Nomor 779).
                    </p>
                </td>
            </tr>
            <tr>
                <td colspan="3"><p class="mt-05 mb-05" style="text-align: center;">M E M U T U S K A N:</p></td>
            </tr>
            <tr>
                <td width="19%">
                    <p class="mr-05 sa">Menetapkan</p>
                </td>
                <td colspan="2">
                    <p class="mb-05">
                        KEPUTUSAN KEPALA BADAN KEPENDUDUKAN DAN KELUARGA BERENCANA NASIONAL TENTANG PENGHAPUSAN BARANG MILIK NEGARA DARI DAFTAR BARANG KUASA PENGGUNA PADA {{ $item->satker->name }}.
                    </p>
                </td>
            </tr>
            <tr>
                <td width="19%">
                    <p class="mr-05 sa">KESATU</p>
                </td>
                <td colspan="2">
                    <p class="mb-05">
                        Menghapuskan Barang Milik Negara berupa Barang Persediaan dari daftar barang Kuasa Pengguna pada {{ $item->satker->name }} yang sudah usang sebagaimana tercantum dalam Lampiran yang merupakan bagian tidak terpisahkan dari Keputusan ini.
                    </p>
                </td>
            </tr>
            <tr>
                <td width="19%">
                    <p class="mr-05 sa">KEDUA</p>
                </td>
                
                <td colspan="2">
                    <p class="mb-05">
                        Penghapusan Barang Persediaan sebagaimana dimaksud dalam Diktum KESATU dengan mekanisme pemusnahan:
                        <ol type="a">
                            <li>
                                pemusnahan Barang Milik Negara berupa Barang Persediaan tersebut tidak mengganggu tugas operasional kantor;
                            </li>
                            <li>
                                pemusnahan BMN dapat dilakukan dengan dibakar, dihancurkan, ditimbun, ditenggelamkan, dirobohkan atau cara lain sesuai dengan ketentuan peraturan perundang-undangan;
                            </li>
                            <li>
                                Kuasa Pengguna Barang {{ $item->satker->name }} menyampaikan Laporan Pelaksanaan Pemusnahan Barang Milik Negara berupa Barang Persediaan kepada Kementerian Keuangan c.q. KPKNL {{ $item->satker->kpknl }} paling lama 1 (satu) bulan sejak Keputusan Penghapusan Barang Milik Negara ditetapkan, dengan melampirkan Berita Acara Pemusnahan Barang Milik Negara, Foto, dan Keputusan Penghapusan yang ditetapkan;
                            </li>
                            <li>
                                kebenaran materiil atas jenis, jumlah, tahun, dan nilai Barang Milik Negara yang dimusnahkan serta semua biaya pelaksanaan penghapusan Barang Milik Negara tersebut menjadi tanggung jawab Kuasa Pengguna Barang {{ $item->satker->name }}; dan
                            </li>
                        </ol>
                    </p>
                </td>
            </tr>
            <tr>
                <td width="19%"></td>
                <td colspan="2">
                    <p class="mb-05">
                        <ol type="a" start="5">
                            <li>
                                perubahan daftar barang kuasa pengguna sebagai akibat dari pelaksanaan penghapusan Barang Milik Negara harus dicantumkan dalam Laporan Barang Milik Negara Semesteran dan Tahunan.
                            </li>
                        </ol>
                    </p>
                </td>
            </tr>
            <tr>
                <td width="19%">
                    <p class="mr-05 sa">KETIGA</p>
                </td>
                
                <td colspan="2">
                    <p class="mb-05">
                        Keputusan ini mulai berlaku pada tanggal ditetapkan dengan ketentuan apabila terdapat kekeliruan di dalam keputusan ini akan diadakan perbaikan sebagaimana mestinya.
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
    <p class="left"><b>KEPUTUSAN</b>, ini disampaikan kepada:</p>
    <ol class="left">
        <li>Kepala Perwakilan {{ $item->satker->name }};</li>
        <li>Sekretaris Perwakilan {{ $item->satker->name }};</li>
    </ol>
    <p class="mb-05 mt-05">untuk diketahui dan dilaksanakan dengan sebaik-baiknya.</p>
    <table>
        <tbody>
            <tr>
                <td width="50%"></td>
                <td>Ditetapkan di Jakarta</td>
            </tr>
            <tr>
                <td width="50%"></td>
                <td>pada tanggal ...</td>
            </tr>
            <tr>
                <td width="50%"></td>
                <td>a.n. KEPALA BADAN KEPENDUDUKAN</td>
            </tr>
            <tr>
                <td width="50%"></td>
                <td>DAN KELUARGA BERENCANA NASIONAL</td>
            </tr>
            <tr>
                <td width="50%"></td>
                <td>SEKRETARIS UTAMA,</td>
            </tr>
            <tr>
                <td width="50%"></td>
                <td>
                    <p style="margin-top:4cm">
                        Drs. TAVIP AGUS RAYANTO, M.Si
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
    <p class="left"><b>Tembusan disampaikan Kepada Yth. :</b></p>
    <ol class="left">
        <li>Menteri Keuangan R.I. di Jakarta;</li>
        <li>Kepala Kantor Pelayanan Kekayaan Negara dan Lelang {{ $item->satker->kpknl }}.</li>
    </ol>
    
    <div class="page-break"></div>

</main>
@endsection