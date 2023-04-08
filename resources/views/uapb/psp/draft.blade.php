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
    }

    .sa::after {
        content: ":";
        text-align: right; 
        float: right; 
    }

    .mr-05 {
        margin-right: 0.5cm
    }

    .mb-05 {
        margin-bottom: 0.5cm
    }
</style>
<main>
    <p class="center">KEPUTUSAN KEPALA BADAN KEPENDUDUKAN</p>
    <p class="center">DAN KELUARGA BERENCANA NASIONAL</p>
    <p class="center">NOMOR {{ $item->kode_transaksi }}</p>
    <p class="center">TENTANG</p>
    <p class="center">PENETAPAN STATUS PENGGUNAAN BARANG MILIK NEGARA</p>
    <p class="center">PADA {{ strtoupper($item->satker->name) }}</p>
    <p class="center">KEPALA BADAN KEPENDUDUKAN DAN KELUARGA BERENCANA NASIONAL,</p>

    <table style="margin-top:1cm">
        <tbody>
            <tr>
                <td width="15%">
                    <p class="mr-05 sa">Menimbang</p>
                </td>
                <td width="5%">
                    <p class="mr-05">a.</p>
                </td>
                <td>
                    <p>
                        bahwa berdasarkan surat permohonan Kepala {{ $item->satker->name }} Nomor {{ $form->nomor_surat
                        }}
                        tentang {{ $form->perihal_surat }};
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
                        bahwa Penetapan Status Penggunaan Barang Milik Negara dilakukan untuk kepentingan
                        penyelenggaraan tugas dan fungsi Pengguna Barang;
                    </p>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <p class="mr-05">c.</p>
                </td>
                <td>
                    <p class="mb-05">
                        bahwa berdasarkan pertimbangan sebagaimana dimaksud dalam huruf a dan huruf b, perlu menetapkan
                        Keputusan Kepala Badan Kependudukan dan Keluarga Berencana Nasional tentang Penetapan Status
                        Penggunaan Barang Milik Negara pada {{ $item->satker->djkn }}.
                    </p>
                </td>
            </tr>
            <tr>
                <td width="15%">
                    <p class="mr-05 sa">Mengingat</p>
                </td>
                <td width="5%">
                    <p class="mr-05">1.</p>
                </td>
                <td>
                    <p>
                        Undang-Undang Nomor 1 Tahun 2004 tentang Perbendaharaan Negara (Lembaran Negara Republik
                        Indonesia Tahun 2004 Nomor 5, Tambahan Lembaran Negara Republik Indonesia Nomor 4355);
                    </p>
                </td>
            </tr>
            <tr>
                <td width="15%"></td>
                <td width="5%">
                    <p class="mr-05">2.</p>
                </td>
                <td>
                    <p>
                        Undang-Undang Nomor 52 Tahun 2009 tentang Perkembangan Kependudukan Dan Pembangunan Keluarga
                        (Lembaran Negara Republik Indonesia Tahun 2009 Nomor 161, Tambahan Lembaran Negara Republik
                        Indonesia Nomor 5080);
                    </p>
                </td>
            </tr>
            <tr>
                <td width="15%"></td>
                <td width="5%">
                    <p class="mr-05">3.</p>
                </td>
                <td>
                    <p>
                        Peraturan Pemerintah Nomor 27 Tahun 2014 tentang Pengelolaan Barang Milik Negara/Daerah
                        (Lembaran Negara Republik Indonesia Tahun 2014 Nomor 92, Tambahan Lembaran Negara Republik
                        Indonesia Nomor 5533);
                    </p>
                </td>
            </tr>
            <tr>
                <td width="15%"></td>
                <td width="5%">
                    <p class="mr-05">4.</p>
                </td>
                <td>
                    <p>
                        Keputusan Presiden Nomor 103 Tahun 2001 tentang Kedudukan, Tugas, Fungsi, Kewenangan, Susunan
                        Organisasi, dan Tata Kerja Lembaga Pemerintah Non Departemen, sebagaimana telah beberapa kali
                        diubah terakhir dengan Peraturan Presiden Nomor 145 Tahun 2015 tentang Perubahan Kedelapan atas
                        Keputusan Presiden Nomor 103 Tahun 2001 Tentang Kedudukan, Tugas, Fungsi, Kewenangan, Susunan
                        Organisasi, dan Tata Kerja Lembaga Pemerintah Non Kementerian (Lembaran Negara Republik
                        Indonesia Tahun 2015 Nomor 322);
                    </p>
                </td>
            </tr>
            <tr>
                <td width="15%"></td>
                <td width="5%">
                    <p class="mr-05">5.</p>
                </td>
                <td>
                    <p>
                        Peraturan Kepala Badan Kependudukan dan Keluarga Berencana Nasional Nomor 82/PER/B5/2011 tentang
                        Organisasi dan Tata Kerja Perwakilan Badan Kependudukan dan Keluarga Berencana Nasional
                        Provinsi;
                    </p>
                </td>
            </tr>
            <tr>
                <td width="15%"></td>
                <td width="5%">
                    <p class="mr-05">6.</p>
                </td>
                <td>
                    <p>
                        Peraturan Menteri Keuangan Nomor 4/PMK.06/2015 tentang Pendelegasian Kewenangan dan Tanggung
                        Jawab Tertentu Dari Pengelola Barang Kepada Pengguna Barang (Berita Negara Republik Indonesia
                        Tahun 2015 Nomor 20);
                    </p>
                </td>
            </tr>
            <tr>
                <td width="15%"></td>
                <td width="5%">
                    <p class="mr-05">7.</p>
                </td>
                <td>
                    <p>
                        Peraturan Menteri Keuangan Nomor 246/PMK.06/2014 tentang Tata Cara Pelaksanaan Penggunaan Barang
                        Milik Negara sebagaimana telah diubah dengan Peraturan Menteri Keuangan Nomor 87/PMK.06/2016
                        tentang perubahan Atas Peraturan Menteri Keuangan Nomor 246/PMK.06/2014 tentang Tata Cara
                        Pelaksanaan Penggunaan Barang Milik (Berita Negara Republik Indonesia Tahun 2016 Nomor 791);
                    </p>
                </td>
            </tr>
            <tr>
                <td width="15%"></td>
                <td width="5%">
                    <p class="mr-05">8.</p>
                </td>
                <td>
                    <p>
                        Peraturan Kepala Badan Kependudukan dan Keluarga Berencana Nasional Nomor 230/PER/B3/2014
                        tentang Pedoman Penghapusan Barang Milik Negara di Lingkungan Badan Kependudukan dan Keluarga
                        Berencana Nasional;
                    </p>
                </td>
            </tr>
            <tr>
                <td width="15%"></td>
                <td width="5%">
                    <p class="mr-05">9.</p>
                </td>
                <td>
                    <p>
                        Peraturan Badan Kependudukan dan Keluarga Berencana Nasional Nomor 11 Tahun 2020 tentang
                        Organisasi dan Tata Kerja Badan Kependudukan dan Keluarga Berencana Nasional (Berita Negara
                        Republik Indonesia Tahun 2020 Nomor 703);
                    </p>
                </td>
            </tr>
            <tr>
                <td width="15%"></td>
                <td width="5%">
                    <p class="mr-05">10.</p>
                </td>
                <td>
                    <p class="mb-05">
                        Peraturan Badan Kependudukan dan Keluarga Berencana Nasional Nomor 12 Tahun 2020 tentang
                        Organisasi dan Tata Kerja Unit Pelaksana Teknis Balai Pendidikan, dan Pelatihan Kependudukan,
                        Dan Keluarga Berencana (Berita Negara Republik Indonesia Tahun 2020 Nomor 779);
                    </p>
                </td>
            </tr>
            <tr>
                <td colspan="3" class="mb-05" style="text-align: center;">M E M U T U S K A N:</td>
            </tr>
            <tr>
                <td width="15%">
                    <p class="mr-05 sa">Menetapkan</p>
                </td>
                <td colspan="2">
                    <p class="mb-05">
                        KEPUTUSAN KEPALA BADAN KEPENDUDUKAN DAN KELUARGA BERENCANA NASIONAL TENTANG STATUS PENGGUNAAN
                        BARANG MILIK NEGARA PADA {{ $item->satker->name }}.
                    </p>
                </td>
            </tr>
            <tr>
                <td width="15%">
                    <p class="mr-05 sa">KESATU</p>
                </td>
                <td colspan="2">
                    <p class="mb-05">
                        Menetapkan Status Penggunaan Barang Milik Negara berupa selain Tanah dan/atau Bangunan sebagai
                        Barang Milik Negara pada {{ $item->satker->name }}.
                    </p>
                </td>
            </tr>
            <tr>
                <td width="15%">
                    <p class="mr-05 sa">KEDUA</p>
                </td>
                
                <td colspan="2">
                    <p class="mb-05">
                        Barang Milik Negara berupa Daftar Barang sebagaimana dimaksud dalam Diktum KESATU yang
                        seluruhnya sebesar {{ number_format($form->nilai_psp) }} {{ terbilang($form->nilai_psp) }}
                        tercantum dalam Lampiran yang merupakan bagian tidak terpisahkan dari Keputusan ini.
                    </p>
                </td>
            </tr>
            <tr>
                <td width="15%">
                    <p class="mr-05 sa">KETIGA</p>
                </td>
                
                <td colspan="2">
                    <p class="mb-05">
                        Barang Milik Negara sebagaimana dimaksud dalam Diktum KEDUA dicatat dalam Daftar Barang Kuasa
                        Pengguna pada Kuasa Pengguna Barang, Daftar Barang Pengguna pada Pengguna Barang dan Daftar
                        Barang Milik Negara pada Pengelola Barang.
                    </p>
                </td>
            </tr>
            <tr>
                <td width="15%">
                    <p class="mr-05 sa">KEEMPAT</p>
                </td>
                
                <td colspan="2">
                    <p class="mb-05">
                        {{ $item->satker->name }} dapat melakukan pemanfaatan atau pemindahtanganan Barang Milik Negara
                        kepada Pihak lain setelah mendapat persetujuan Pengelola Barang sesuai dengan ketentuan
                        Peraturan Perundang-undangan.
                    </p>
                </td>
            </tr>
            <tr>
                <td width="15%">
                    <p class="mr-05 sa">KELIMA</p>
                </td>
                
                <td colspan="2">
                    <p class="mb-05">
                        Penggunaan Barang wajib melakukan monitoring dan evaluasi paling sedikit satu kali dalam satu
                        tahun atas optimalisasi penggunaan Barang Milik Negara.
                    </p>
                </td>
            </tr>
            <tr>
                <td width="15%">
                    <p class="mr-05 sa">KEENAM</p>
                </td>
                
                <td colspan="2">
                    <p class="mb-05">
                        Segala biaya pengamanan dan pemeliharaan Barang Milik Negara yang digunakan menjadi tanggung
                        jawab {{ $item->satker->name }}.
                    </p>
                </td>
            </tr>
            <tr>
                <td width="15%">
                    <p class="mr-05 sa">KETUJUH</p>
                </td>
                <td colspan="2">
                    <p class="mb-05">
                        Keputusan ini mulai berlaku pada tanggal ditetapkan dengan ketentuan apabila terdapat kekeliruan
                        di dalam keputusan ini akan diadakan perbaikan sebagaimana mestinya.
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
    <p class="left"><b>KEPUTUSAN</b>, ini disampaikan kepada:</p>
    <ol class="left">
        <li>Kepala {{ $item->satker->name }};</li>
        <li>Direktur Barang Milik Negara, Direktorat Jendral Kekayaan Negara <b>(berupa salinan Keputusan)</b>;</li>
        <li>Kepala Kantor Wilayah {{ $item->satker->djkn }} <b>(berupa salinan Keputusan)</b>;</li>
        <li>Kepala {{ $item->satker->kpknl }} <b>(berupa salinan Keputusan)</b>;</li>
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
                    <p style="margin-top:2cm">
                        TAVIP AGUS RAYANTO
                    </p>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="page-break"></div>

</main>
@endsection