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
    <table style="margin-top:1cm">
        <tbody>
            <tr>
                <td>
                    <p class="mr-05 sa">Nomor</p>
                </td>
                <td width="35%">
                    <p class="mr-05">{{ $item->kode_transaksi }}</p>
                </td>
                <td>
                    <p class="right pr-1">{{ human_date($item->created_at) }}</p>
                </td>
            </tr>
            <tr>
                <td width="15%">
                    <p class="mr-05 sa">Lampiran</p>
                </td>
                <td>
                    <p class="mr-05">1 (satu) berkas</p>
                </td>
                <td></td>
            </tr>
            <tr>
                <td>
                    <p class="mr-05 sa">Hal</p>
                </td>
                <td>
                    <p class="mr-05">
                        Persetujuan Penjualan Barang Milik Negara Selain Tanah dan/atau Bangunan Pada Perwakilan BKKBN Provinsi {{ $item->satker->name }}
                    </p>
                </td>
                <td></td>
            </tr>
        </tbody>
    </table>
    <p>Yth.</p>
    <p>Kepala {{ $item->satker->name }}</p>
    <p>di- Tempat</p>
    <p class="mt-05">
        Sehubungan dengan surat nomor {{ $form->nomor_surat }} tanggal {{ human_date($form->tanggal_surat) }} tentang {{ $form->perihal_surat }}, dengan ini diberitahukan bahwa permohonan Hibah Barang Milik Negara berupa Barang Persediaan dengan nilai seluruhnya sebesar  {{ $form->total_nilai }} {{ terbilang($form->total_nilai) }} kepada Pemerintah Daerah sebagaimana tercantum dalam lampiran surat ini untuk digunakan dalam mendukung program Pembangunan Keluarga, Kependudukan, dan Keluarga Berencana (Bangga Kencana) pada prinsipnya dapat disetujui.
    </p>
    <p class="mt-05">
        Guna tertib administrasi pengelolaan Barang Milik Negara, pelaksanaan Hibah tersebut agar berpedoman pada Peraturan Pemerintah Nomor 28 Tahun 2020 tentang Perubahan atas Peraturan Pemerintah Nomor 27 Tahun 2014 tentang Pengelolaan Barang Milik Negara/Daerah dan Peraturan Menteri Keuangan Nomor 165/PMK.06/2021 tentang Perubahan atas PMK 111/PMK.6/2016 tentang Tata Cara Pelaksanaan Pemindahtanganan Barang Milik Negara, dengan ketentuan sebagai berikut :
    </p>
    <ol style="margin-top: 1cm">
        <li>
            Berdasarkan persetujuan Hibah ini, agar Saudara menetapkan keputusan mengenai jenis, jumlah dan nilai Barang Milik Negara  yang akan dihibahkan.
        </li>
        <li>
            Persetujuan Hibah ini segera ditindaklanjuti dengan pelaksanaan Hibah Barang Milik Negara yang dituangkan dalam Naskah Hibah dan Berita Acara Serah Terima antara {{ $item->satker->name }} dan Pemerintah Daerah Selaku calon penerima Hibah pada tahun anggaran berjalan sejak tanggal surat persetujuan Hibah ini diterbitkan.
        </li>
        <li>
            Barang Milik Negara yang telah dihibahkan agar segera dihapus dari Daftar Barang Pengguna/Kuasa Pengguna Barang dan Penghapusan dimaksud didasarkan pada Keputusan Penghapusan yang ditetapkan oleh Pengguna Barang.
        </li>
        <li>
            Keputusan Penghapusan Barang Milik Negara ditetapkan oleh Pengguna Barang setiap 1 (satu) semester sejak tanggal Berita Acara Serah Terima ditandatangani berdasarkan permohonan penerbitan Keputusan Penghapusan dari satuan kerja.
        </li>
        <li style="margin-bottom: 2cm">
            Pengguna Barang menyampaikan laporan pelaksanaan Hibah kepada Pengelola Barang c.q. KPKNL {{ $item->satker->kpknl }}.
        </li>
        <li>
            setiap 1 (satu) semester dengan melampirkan Naskah Hibah, Berita Acara Serah Terima dan Keputusan Penghapusan.
        </li>
        <li>
            Menyampaikan fotokopi Berita Acara Serah Terima kepada Menteri Keuangan c.q. Direktur Jenderal Pengelolaan Pembiayaan dan Resiko selaku Unit Akuntansi Kuasa Pengguna Anggaran.
        </li>
        <li>
            Kebenaran materiil atas jenis, jumlah, tahun, dan nilai Barang Milik Negara yang dihibahkan serta calon penerima Hibah tersebut menjadi tanggung jawab Kuasa Pengguna Barang.
        </li>
        <li>
            Apabila di kemudian hari terdapat kekeliruan dalam surat persetujuan ini, maka akan dilakukan perbaikan sebagaimana mestinya.
            <br>
            Atas perhatian Saudara, kami ucapkan terima kasih.
        </li>
    </ol>
    <table style="margin-top:1cm">
        <tbody>
            <tr>
                <td width="40%" class="p-03" style="border: 1px solid #2e2e2e">
                    <p style="font-size:10pt !important">
                        <i>Perhatian :
                            <br>
                            Pelayanan Sekretariat Utama dilakukan cara profesional, penuh Integritas, bersih dari
                            korupsi dan gratifikasi, tidak ada konflik kepentingan, menerapkan sistem anti penyuapan,
                            serta berpedoman pada ketentuan yang berlaku
                        </i>
                    </p>
                </td>
                <td>
                    <div style="padding-left:1cm">
                        <p class="mr-05">
                            a.n. Kepala Badan Kependudukan dan
                        </p>
                        <p class="mr-05">
                            Keluarga Berencana Nasional
                        </p>
                        <br>
                        <p style="margin-top:1.5cm">
                            jabatan
                        </p>
                        <p class="mr-05">
                            Nama Pengirim
                        </p>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <p style="margin-top: 1cm">
                        Tembusan :
                    </p>
                    <ol>
                        <li>
                            Kepala BKKBN (sebagai laporan);
                        </li>
                        <li>
                            Inspektur Utama dam;
                        </li>
                        <li>
                            Kepala {{ $item->satker->kpknl }}.
                        </li>
                    </ol>
                </td>
            </tr>
        </tbody>
    </table>


    <div class="page-break"></div>

</main>
@endsection