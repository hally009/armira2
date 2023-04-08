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
    <p>Kepala Perwakilan BKKBN Provinsi {{ $item->satker->name }}</p>
    <p>di- Tempat</p>
    <p class="mt-05">
        Sehubungan dengan surat nomor {{ $form->nomor_surat }} tanggal {{ human_date($form->tanggal_surat) }} hal {{ $form->perihal_surat }}, dengan ini diberitahukan bahwa permohonan Penjualan Barang Milik Negara selain tanah dan/atau bangunan pada Perwakilan Badan Kependudukan dan Keluarga Berencana Nasional Provinsi {{ $item->satker->name }} dengan harga perolehan/nilai buku sebesar {{ $form->total_nilai }} {{ terbilang($form->total_nilai) }} sebagaimana tercantum dalam lampiran surat ini, pada prinsipnya dapat disetujui dengan ketentuan penjualan dilaksanakan secara lelang.
    </p>
    <p class="mt-05">
        Guna tertib administrasi pengelolaan Barang Milik Negara, pelaksanaan Penjualan tersebut agar berpedoman pada Peraturan Pemerintah Nomor 27 Tahun 2014 tentang Pengelolaan Barang Milik Negara/Daerah dan Peraturan Menteri Keuangan Nomor 111/PMK.06/2016 tentang Tata Cara Pelaksanaan Pemindahtanganan Barang Milik Negara, dengan ketentuan sebagai berikut :
    </p>
    <ol style="margin-top: 1cm">
        <li>
            Penjualan Barang Milik Negara tidak mengganggu tugas operasional kantor Saudara dan persetujuan Penjualan ini tidak merupakan jaminan disediakannya dana anggaran untuk pengadaan Barang Milik Negara yang baru sebagai pengganti Barang Milik Negara yang sudah dijual.
        </li>
        <li>
            Persetujuan ini segera ditindaklanjuti dengan Penjualan Barang Milik Negara secara Lelang.
        </li>
        <li>
            Pengajuan permohonan atas pelaksanaan lelang secara lengkap paling lama 2 (dua) bulan sejak tanggal surat persetujuan ini diterbitkan.
        </li>
        <li>
            Penjualan secara lelang atas Barang Milik Negara agar dilakukan melalui Kantor Pelayanan Kekayaan Negara dan Lelang (KPKNL) dengan nilai limit {{ $form->nilai_limit }} {{ terbilang($form->nilai_limit) }} berdasarkan hasil penilaian tim penghapusan dan hasil penjualan seluruhnya disetor ke Kas Umum Negara.
        </li>
        <li style="margin-bottom: 2cm">
            Pelaksanaan penjualan secara lelang dituangkan ke dalam Berita Acara Serah Terima paling lama 1(satu) bulan setelah tanggal pelaksanaan lelang.
        </li>
        <li>
            Keputusan Penghapusan Barang Milik Negara ditetapkan oleh Pengguna Barang paling lama 2 (dua) bulan sejak tanggal Berita Acara Serah Terima ditandatangani. 
        </li>
        <li>
            Kebenaran materiil atas jenis, jumlah, tahun dan nilai Barang Milik Negara yang dihapus tersebut menjadi tanggung jawab Kuasa Pengguna Barang. 
        </li>
        <li>
            Pengguna barang menyampaikan laporan pelaksanaan Penjualan secara lelang dan pelaksanaan Penghapusan barang kepada Pengelola Barang c.q. KPKNL {{ $item->satker->kpknl }} paling lama 1 (satu) bulan sejak Keputusan Penghapusan ditandatangani dengan melampirkan Risalah Lelang, Berita Acara Serah Terima, Keputusan Penghapusan yang ditetapkan oleh Pengguna Barang dan bukti setor ke Rekening Kas Umum Negara.
        </li>
        <li>
            Apabila di kemudian hari terdapat kekeliruan dalam persetujuan ini, maka akan diadakan perbaikan sebagaimana mestinya.
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
                            Kepala Kantor Wilayah Direktorat Jenderal Kekayaan Negara/Kantor Pelayanan Kekayaan Negara dan Lelang {{ $item->satker->kpknl }}.
                        </li>
                    </ol>
                </td>
            </tr>
        </tbody>
    </table>


    <div class="page-break"></div>

</main>
@endsection