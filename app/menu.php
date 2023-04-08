<?php

if (!function_exists('get_home_menu')) {
    function get_home_menu()
    {
        $user = auth()->user();
        switch ($user->role) {
            case roles('satker'):
                $link = [
                    'profil' => [
                        'parent' => Route::has('Satker::dashboard.index') ? route('Satker::dashboard.index') : '#',
                        'child' => [
                            [
                                'route' => Route::has('Satker::dashboard.index') ? route('Satker::dashboard.index') : '#',
                                'name' => 'DASHBOARD',
                                'icon' => 'bi bi-clipboard-data',
                            ],
                            [
                                'route' => Route::has('Satker::profile.index') ? route('Satker::profile.index') : '#',
                                'name' => 'IDENTITAS',
                                'icon' => 'bi bi-postcard',
                            ],
                            [
                                'route' => Route::has('Satker::pegawai.index') ? route('Satker::pegawai.index') : '#',
                                'name' => 'PEGAWAI',
                                'icon' => 'bi bi-people',
                            ],
                            [
                                'route' => Route::has('Satker::admin.index') ? route('Satker::admin.index') : '#',
                                'name' => 'ADMIN',
                                'icon' => 'ri-admin-line',
                            ],
                        ],
                    ],
                    'master' => [
                        'parent' => Route::has('Satker::master.index') ? route('Satker::master.index') : '#',
                        'child' => [
                            [
                                'route' => Route::has('Satker::master.index') ? route('Satker::master.index') : '#',
                                'name' => 'MASTER ASET',
                                'icon' => 'bi bi-hdd-rack',
                            ],
                        ],
                    ],
                    'perencanaan' => [
                        'parent' => Route::has('Satker::pengadaan.index') ? route('Satker::pengadaan.index') : '#',
                        'child' => [
                            [
                                'route' => Route::has('Satker::pengadaan.index') ? route('Satker::pengadaan.index') : '#',
                                'name' => 'PENGADAAN',
                                'icon' => 'bi bi-journal-plus',
                            ],
                            [
                                'route' => Route::has('Satker::pemeliharaan.index') ? route('Satker::pemeliharaan.index') : '#',
                                'name' => 'PEMELIHARAAN',
                                'icon' => 'bi bi-journal-plus',
                            ],
                        ],
                    ],
                    'pengelolaan' => [
                        'parent' => Route::has('Satker::psp.index') ? route('Satker::psp.index') : '#',
                        'child' => [
                            [
                                'route' => Route::has('Satker::psp.index') ? route('Satker::psp.index') : '#',
                                'name' => 'PSP',
                                'icon' => 'bi bi-file-earmark-ruled',
                            ],
                            [
                                'route' => Route::has('Satker::penghapusan.index') ? route('Satker::penghapusan.index') : '#',
                                'name' => 'PENGHAPUSAN',
                                'icon' => 'ri-file-shred-line',
                            ],
                            [
                                'route' => Route::has('Satker::hibah.index') ? route('Satker::hibah.index') : '#',
                                'name' => 'HIBAH',
                                'icon' => 'ri-hand-coin-line',
                            ],
                        ],
                    ],
                ];
                break;
            case roles('operator_satker'):
                $link = [
                    'profil' => [
                        'parent' => Route::has('Satker::dashboard.index') ? route('Satker::dashboard.index') : '#',
                        'child' => [
                            [
                                'route' => Route::has('Satker::dashboard.index') ? route('Satker::dashboard.index') : '#',
                                'name' => 'DASHBOARD',
                                'icon' => 'bi bi-clipboard-data',
                            ],
                            [
                                'route' => Route::has('Satker::profile.index') ? route('Satker::profile.index') : '#',
                                'name' => 'IDENTITAS',
                                'icon' => 'bi bi-postcard',
                            ],
                            [
                                'route' => Route::has('Satker::pegawai.index') ? route('Satker::pegawai.index') : '#',
                                'name' => 'PEGAWAI',
                                'icon' => 'bi bi-people',
                            ],
                        ],
                    ],
                    'master' => [
                        'parent' => Route::has('Satker::master.index') ? route('Satker::master.index') : '#',
                        'child' => [
                            [
                                'route' => Route::has('Satker::master.index') ? route('Satker::master.index') : '#',
                                'name' => 'MASTER ASET',
                                'icon' => 'bi bi-hdd-rack',
                            ],
                        ],
                    ],
                    'perencanaan' => [
                        'parent' => Route::has('Satker::pengadaan.index') ? route('Satker::pengadaan.index') : '#',
                        'child' => [
                            [
                                'route' => Route::has('Satker::pengadaan.index') ? route('Satker::pengadaan.index') : '#',
                                'name' => 'PENGADAAN',
                                'icon' => 'bi bi-journal-plus',
                            ],
                            [
                                'route' => Route::has('Satker::pemeliharaan.index') ? route('Satker::pemeliharaan.index') : '#',
                                'name' => 'PEMELIHARAAN',
                                'icon' => 'bi bi-journal-plus',
                            ],
                        ],
                    ],
                    'pengelolaan' => [
                        'parent' => Route::has('Satker::psp.index') ? route('Satker::psp.index') : '#',
                        'child' => [
                            [
                                'route' => Route::has('Satker::psp.index') ? route('Satker::psp.index') : '#',
                                'name' => 'PSP',
                                'icon' => 'bi bi-file-earmark-ruled',
                            ],
                            [
                                'route' => Route::has('Satker::penghapusan.index') ? route('Satker::penghapusan.index') : '#',
                                'name' => 'PENGHAPUSAN',
                                'icon' => 'ri-file-shred-line',
                            ],
                            [
                                'route' => Route::has('Satker::hibah.index') ? route('Satker::hibah.index') : '#',
                                'name' => 'HIBAH',
                                'icon' => 'ri-hand-coin-line',
                            ],
                        ],
                    ],
                ];
                break;
            case roles('uapb'):
                $link = [
                    'profil' => [
                        'parent' => Route::has('Uapb::dashboard.index') ? route('Uapb::dashboard.index') : '#',
                        'child' => [
                            [
                                'route' => Route::has('Uapb::dashboard.index') ? route('Uapb::dashboard.index') : '#',
                                'name' => 'DASHBOARD',
                                'icon' => 'bi bi-clipboard-data',
                            ],
                            [
                                'route' => Route::has('Uapb::profile.index') ? route('Uapb::profile.index') : '#',
                                'name' => 'IDENTITAS',
                                'icon' => 'bi bi-postcard',
                            ],
                            [
                                'route' => Route::has('Uapb::periode.index') ? route('Uapb::periode.index') : '#',
                                'name' => 'PERIODE',
                                'icon' => 'bi bi-hourglass-split',
                            ],
                            [
                                'route' => Route::has('Uapb::sbsk.index') ? route('Uapb::sbsk.index') : '#',
                                'name' => 'SBSK',
                                'icon' => 'ri-file-list-3-line',
                            ],
                            [
                                'route' => Route::has('Uapb::admin.index') ? route('Uapb::admin.index') : '#',
                                'name' => 'ADMIN',
                                'icon' => 'ri-admin-line',
                            ],
                        ],
                    ],
                    'master' => [
                        'parent' => Route::has('Uapb::master.index') ? route('Uapb::master.index') : '#',
                        'child' => [
                            [
                                'route' => Route::has('Uapb::master.index') ? route('Uapb::master.index') : '#',
                                'name' => 'MASTER ASET',
                                'icon' => 'bi bi-hdd-rack',
                            ],
                        ],
                    ],
                    'perencanaan' => [
                        'parent' => Route::has('Uapb::pengadaan.index') ? route('Uapb::pengadaan.index') : '#',
                        'child' => [
                            [
                                'route' => Route::has('Uapb::pengadaan.index') ? route('Uapb::pengadaan.index') : '#',
                                'name' => 'PENGADAAN',
                                'icon' => 'bi bi-journal-plus',
                            ],
                        ],
                    ],
                    'pengelolaan' => [
                        'parent' => Route::has('Uapb::psp.index') ? route('Uapb::psp.index') : '#',
                        'child' => [
                            [
                                'route' => Route::has('Uapb::psp.index') ? route('Uapb::psp.index') : '#',
                                'name' => 'PSP',
                                'icon' => 'bi bi-file-earmark-ruled',
                            ],
                            [
                                'route' => Route::has('Uapb::penghapusan.index') ? route('Uapb::penghapusan.index') : '#',
                                'name' => 'PENGHAPUSAN',
                                'icon' => 'ri-file-shred-line',
                            ],
                            [
                                'route' => Route::has('Uapb::hibah.index') ? route('Uapb::hibah.index') : '#',
                                'name' => 'HIBAH',
                                'icon' => 'ri-hand-coin-line',
                            ],
                        ],
                    ],
                ];
                break;
            case roles('apip'):
                $link = [
                    'profil' => [
                        'parent' => Route::has('Apip::dashboard.index') ? route('Apip::dashboard.index') : '#',
                        'child' => [
                            [
                                'route' => Route::has('Apip::dashboard.index') ? route('Apip::dashboard.index') : '#',
                                'name' => 'DASHBOARD',
                                'icon' => 'bi bi-clipboard-data',
                            ],
                            [
                                'route' => Route::has('Apip::profile.index') ? route('Apip::profile.index') : '#',
                                'name' => 'IDENTITAS',
                                'icon' => 'bi bi-postcard',
                            ],
                        ],
                    ],
                    'master' => [
                        'parent' => Route::has('Apip::master.index') ? route('Apip::master.index') : '#',
                        'child' => [
                            [
                                'route' => Route::has('Apip::master.index') ? route('Apip::master.index') : '#',
                                'name' => 'MASTER ASET',
                                'icon' => 'bi bi-hdd-rack',
                            ],
                        ],
                    ],
                    'perencanaan' => [
                        'parent' => Route::has('Apip::pengadaan.index') ? route('Apip::pengadaan.index') : '#',
                        'child' => [
                            [
                                'route' => Route::has('Apip::pengadaan.index') ? route('Apip::pengadaan.index') : '#',
                                'name' => 'PENGADAAN',
                                'icon' => 'bi bi-journal-plus',
                            ],
                        ],
                    ],
                ];
                break;
        }

        return $link;
    }
}

if (!function_exists('status_alur_pengelolaan')) {
    function status_alur_pengelolaan($argumen = false)
    {
        $status = [
            'periksa' => 1,
            'setuju' => 2,
            'pengesahan' => 3,
            'perbaikan' => 99,
        ];

        if($argumen) {
            return $status[$argumen];
        }

        $status = [
            [
                'kode' => 1,
                'role' => 'UAPB',
                'title' => 'Memeriksa',
                'content' => 'Ajuan anda telah diterima oleh UAPB dan sedang diperiksa kelengkapan dokumen',
            ],
            [
                'kode' => 2,
                'role' => 'UAPB',
                'title' => 'Disetujui',
                'content' => 'Ajuan anda telah disetujui oleh UAPB',
            ],
            [
                'kode' => 3,
                'role' => 'UAPB',
                'title' => 'Pengesahan',
                'content' => 'Pengesahan dokumen oleh UAPB',
            ],
        ];
        return $status;
    }
}


if (!function_exists('kategori_penghapusan')) {
    function kategori_penghapusan($argumen = false)
    {
        $data = [
            [
                'id' => '1',
                'name' => 'Persetujuan Penghapusan',
                'dokumen' => [
                    [
                        'id' => '1',
                        'name' => 'Inventaris Kantor (<100Juta) dan/atau BMN tanpa bukti kepemilikan',
                    ],
                    [
                        'id' => '2',
                        'name' => 'Persediaan',
                    ],
                    [
                        'id' => '3',
                        'name' => 'Bongkaran',
                    ],
                    [
                        'id' => '4',
                        'name' => 'ATB',
                    ],
                ]
            ],
            [
                'id' => '2',
                'name' => 'SK Penghapusan',
                'dokumen' => [
                    [
                        'id' => '1',
                        'name' => 'Inventaris Kantor (<100Juta) dan/atau BMN tanpa bukti kepemilikan',
                    ],
                    [
                        'id' => '2',
                        'name' => 'Persediaan',
                    ],
                    [
                        'id' => '3',
                        'name' => 'BMN >100juta dan/atau BMN dengan bukti kepemilikan',
                    ],
                    [
                        'id' => '4',
                        'name' => 'Hibah BMN',
                    ],
                ]
            ],
        ];
        
        return $data;
    }
}

if (!function_exists('form_penghapusan')) {
    function form_penghapusan($id)
    {
        $data = [
            '1_1' => [
                'draft' => 'draft-1_1',
                'form' => [
                    [
                        'name' => "Nomor Surat Permohonan Persetujuan Penghapusan",
                        'id' => 'nomor_surat',
                        'property' => 'text'

                    ],
                    [
                        'name' => "Tanggal Surat Permohonan",
                        'id' => 'tanggal_surat',
                        'property' => 'date'

                    ],
                    [
                        'name' => "Perihal Surat Permohoan Persetujuan Penghapusan",
                        'id' => 'perihal_surat',
                        'property' => 'text'

                    ],
                    [
                        'name' => "Total Nilai Objek Penghapusan",
                        'id' => 'total_nilai',
                        'property' => 'number'
                    ],
                    [
                        'name' => "Nilai Limit",
                        'id' => 'nilai_limit',
                        'property' => 'number'
                    ],

                ],
                'tabs' => [
                    [
                        'name' => 'Surat Permohonan',
                        'id' => 'tab-permohonan-penghapusan',
                        'name_file' => 'Surat_Permohonan_Penghapusan',
                        'id_upload' => 'uploadPenghapusan',
                    ],
                    [
                        'name' => 'Lampiran Barang',
                        'id' => 'tab-lampiran',
                        'name_file' => 'Lampiran_Barang',
                        'id_upload' => 'uploadLampiran',
                    ],
                    [
                        'name' => 'SPTJM Bermeterai',
                        'id' => 'tab-sptjm',
                        'name_file' => 'SPTJM_Bermeterai',
                        'id_upload' => 'uploadSptjm',
                    ],
                    [
                        'name' => 'SK PSP',
                        'id' => 'tab-skpsp',
                        'name_file' => 'SK_PSP',
                        'id_upload' => 'uploadSkPsp',
                    ],
                    [
                        'name' => 'SK Tim Penghapusan',
                        'id' => 'tab-sktim',
                        'name_file' => 'SK_Tim_Penghapusan',
                        'id_upload' => 'uploadSktim',
                    ],
                    [
                        'name' => 'BA Penelitian Barang',
                        'id' => 'tab-ba',
                        'name_file' => 'BA_Penelitian_Barang',
                        'id_upload' => 'uploadBa',
                    ],
                    [
                        'name' => 'Foto BMN',
                        'id' => 'tab-foto',
                        'name_file' => 'Foto_BMN',
                        'id_upload' => 'uploadFoto',
                    ],
                    [
                        'name' => 'Lainnya',
                        'id' => 'tab-lainnya',
                        'name_file' => 'Lainnya',
                        'id_upload' => 'uploadLainnya',
                    ],
                ],
            ],
            '1_2' => [
                'draft' => 'draft-1_2',
                'form' => [
                    [
                        'name' => "Nomor Surat Permohonan Persetujuan Penghapusan",
                        'id' => 'nomor_surat',
                        'property' => 'text'

                    ],
                    [
                        'name' => "Tanggal Surat Permohonan",
                        'id' => 'tanggal_surat',
                        'property' => 'date'

                    ],
                    [
                        'name' => "Perihal Surat Permohoan Persetujuan Penghapusan",
                        'id' => 'perihal_surat',
                        'property' => 'text'

                    ],
                    [
                        'name' => "Total Nilai Objek Penghapusan",
                        'id' => 'total_nilai',
                        'property' => 'number'
                    ],

                ],
                'tabs' => [
                    [
                        'name' => 'Surat Permohonan',
                        'id' => 'tab-permohonan-penghapusan',
                        'name_file' => 'Surat_Permohonan_Penghapusan',
                        'id_upload' => 'uploadPenghapusan',
                    ],
                    [
                        'name' => 'Lampiran Barang',
                        'id' => 'tab-lampiran',
                        'name_file' => 'Lampiran_Barang',
                        'id_upload' => 'uploadLampiran',
                    ],
                    [
                        'name' => 'SPTJM Bermeterai',
                        'id' => 'tab-sptjm',
                        'name_file' => 'SPTJM_Bermeterai',
                        'id_upload' => 'uploadSptjm',
                    ],
                    [
                        'name' => 'SK Tim Penghapusan',
                        'id' => 'tab-sktim',
                        'name_file' => 'SK_Tim_Penghapusan',
                        'id_upload' => 'uploadSktim',
                    ],
                    [
                        'name' => 'BA Penelitian Barang',
                        'id' => 'tab-ba',
                        'name_file' => 'BA_Penelitian_Barang',
                        'id_upload' => 'uploadBa',
                    ],
                    [
                        'name' => 'Foto BMN',
                        'id' => 'tab-foto',
                        'name_file' => 'Foto_BMN',
                        'id_upload' => 'uploadFoto',
                    ],
                    [
                        'name' => 'Lainnya',
                        'id' => 'tab-lainnya',
                        'name_file' => 'Lainnya',
                        'id_upload' => 'uploadLainnya',
                    ],
                ],
            ],
            '1_3' => [
                'draft' => 'draft-1_3',
                'form' => [
                    [
                        'name' => "Nomor Surat Permohonan Persetujuan Penghapusan",
                        'id' => 'nomor_surat',
                        'property' => 'text'

                    ],
                    [
                        'name' => "Tanggal Surat Permohonan",
                        'id' => 'tanggal_surat',
                        'property' => 'date'

                    ],
                    [
                        'name' => "Perihal Surat Permohoan Persetujuan Penghapusan",
                        'id' => 'perihal_surat',
                        'property' => 'text'

                    ],
                    [
                        'name' => "Total Nilai Objek Penghapusan",
                        'id' => 'total_nilai',
                        'property' => 'number'
                    ],
                    [
                        'name' => "Nilai Limit",
                        'id' => 'nilai_limit',
                        'property' => 'number'
                    ],

                ],
                'tabs' => [
                    [
                        'name' => 'Surat Permohonan',
                        'id' => 'tab-permohonan-penghapusan',
                        'name_file' => 'Surat_Permohonan_Penghapusan',
                        'id_upload' => 'uploadPenghapusan',
                    ],
                    [
                        'name' => 'Lampiran Barang',
                        'id' => 'tab-lampiran',
                        'name_file' => 'Lampiran_Barang',
                        'id_upload' => 'uploadLampiran',
                    ],
                    [
                        'name' => 'SPTJM Bermeterai',
                        'id' => 'tab-sptjm',
                        'name_file' => 'SPTJM_Bermeterai',
                        'id_upload' => 'uploadSptjm',
                    ],
                    [
                        'name' => 'SK Tim Penghapusan',
                        'id' => 'tab-sktim',
                        'name_file' => 'SK_Tim_Penghapusan',
                        'id_upload' => 'uploadSktim',
                    ],
                    [
                        'name' => 'BA Penelitian Barang',
                        'id' => 'tab-ba',
                        'name_file' => 'BA_Penelitian_Barang',
                        'id_upload' => 'uploadBa',
                    ],
                    [
                        'name' => 'Foto BMN',
                        'id' => 'tab-foto',
                        'name_file' => 'Foto_BMN',
                        'id_upload' => 'uploadFoto',
                    ],
                    [
                        'name' => 'Lainnya',
                        'id' => 'tab-lainnya',
                        'name_file' => 'Lainnya',
                        'id_upload' => 'uploadLainnya',
                    ],
                ],
            ],
            '1_4' => [
                'draft' => 'draft-1_4',
                'form' => [
                    [
                        'name' => "Nomor Surat Permohonan Persetujuan Penghapusan",
                        'id' => 'nomor_surat',
                        'property' => 'text'

                    ],
                    [
                        'name' => "Tanggal Surat Permohonan",
                        'id' => 'tanggal_surat',
                        'property' => 'date'

                    ],
                    [
                        'name' => "Perihal Surat Permohoan Persetujuan Penghapusan",
                        'id' => 'perihal_surat',
                        'property' => 'text'

                    ],
                    [
                        'name' => "Total Nilai Objek Penghapusan",
                        'id' => 'total_nilai',
                        'property' => 'number'
                    ],

                ],
                'tabs' => [
                    [
                        'name' => 'Surat Permohonan',
                        'id' => 'tab-permohonan-penghapusan',
                        'name_file' => 'Surat_Permohonan_Penghapusan',
                        'id_upload' => 'uploadPenghapusan',
                    ],
                    [
                        'name' => 'Lampiran Barang',
                        'id' => 'tab-lampiran',
                        'name_file' => 'Lampiran_Barang',
                        'id_upload' => 'uploadLampiran',
                    ],
                    [
                        'name' => 'SPTJM Bermeterai',
                        'id' => 'tab-sptjm',
                        'name_file' => 'SPTJM_Bermeterai',
                        'id_upload' => 'uploadSptjm',
                    ],
                    [
                        'name' => 'SK Tim Penghapusan',
                        'id' => 'tab-sktim',
                        'name_file' => 'SK_Tim_Penghapusan',
                        'id_upload' => 'uploadSktim',
                    ],
                    [
                        'name' => 'BA Penelitian Barang',
                        'id' => 'tab-ba',
                        'name_file' => 'BA_Penelitian_Barang',
                        'id_upload' => 'uploadBa',
                    ],
                    [
                        'name' => 'Foto BMN',
                        'id' => 'tab-foto',
                        'name_file' => 'Foto_BMN',
                        'id_upload' => 'uploadFoto',
                    ],
                    [
                        'name' => 'Lainnya',
                        'id' => 'tab-lainnya',
                        'name_file' => 'Lainnya',
                        'id_upload' => 'uploadLainnya',
                    ],
                ],
            ],
            '2_1' => [
                'draft' => 'draft-2_1',
                'form' => [
                    [
                        'name' => "Nomor Surat Permohonan Persetujuan Penghapusan",
                        'id' => 'nomor_surat',
                        'property' => 'text'

                    ],
                    [
                        'name' => "Perihal Surat Permohoan Persetujuan Penghapusan",
                        'id' => 'perihal_surat',
                        'property' => 'text'

                    ],
                    [
                        'name' => "Nomor Surat Persetujuan Penghapusan",
                        'id' => 'nomor_surat_persetujuan',
                        'property' => 'text'

                    ],
                    [
                        'name' => "Perihal Surat Persetujuan Penghapusan",
                        'id' => 'perihal_surat_persetujuan',
                        'property' => 'text'
                    ],
                    [
                        'name' => "Nomor Surat Permohonan SK Penghapusan",
                        'id' => 'nomor_sk',
                        'property' => 'text'
                    ],
                    [
                        'name' => "Perihal Surat Permohoan SK Penghapusan",
                        'id' => 'perihal_sk',
                        'property' => 'text'
                    ],

                ],
                'tabs' => [
                    [
                        'name' => 'Surat SK Penghapusan BMN',
                        'id' => 'tab-surat-sk',
                        'name_file' => 'Surat_SK_Penghapusan_BMN',
                        'id_upload' => 'uploadSuratSk',
                    ],
                    [
                        'name' => 'Lampiran Barang',
                        'id' => 'tab-lampiran',
                        'name_file' => 'Lampiran_Barang',
                        'id_upload' => 'uploadLampiran',
                    ],
                    [
                        'name' => 'Surat Persetujuan Penghapusan',
                        'id' => 'tab-persetujuan',
                        'name_file' => 'Surat_Persetujuan_Penghapusan',
                        'id_upload' => 'uploadSptjm',
                    ],
                    [
                        'name' => 'Risalah Lelang/Berita Acara Pemusnahan/Berita Acara Serah terima Hibah',
                        'id' => 'tab-risalah',
                        'name_file' => 'Risalah_Lelang',
                        'id_upload' => 'uploadRisalah',
                    ],
                    [
                        'name' => 'Lainnya',
                        'id' => 'tab-lainnya',
                        'name_file' => 'Lainnya',
                        'id_upload' => 'uploadLainnya',
                    ],
                ],
            ],
            '2_2' => [
                'draft' => 'draft-2_2',
                'form' => [
                    [
                        'name' => "Nomor Surat Permohonan Persetujuan Penghapusan",
                        'id' => 'nomor_surat',
                        'property' => 'text'

                    ],
                    [
                        'name' => "Perihal Surat Permohoan Persetujuan Penghapusan",
                        'id' => 'perihal_surat',
                        'property' => 'text'

                    ],
                    [
                        'name' => "Nomor Surat Persetujuan Penghapusan",
                        'id' => 'nomor_surat_persetujuan',
                        'property' => 'text'

                    ],
                    [
                        'name' => "Perihal Surat Persetujuan Penghapusan",
                        'id' => 'perihal_surat_persetujuan',
                        'property' => 'text'
                    ],
                    [
                        'name' => "Nomor Surat Permohonan SK Penghapusan",
                        'id' => 'nomor_sk',
                        'property' => 'text'
                    ],
                    [
                        'name' => "Perihal Surat Permohoan SK Penghapusan",
                        'id' => 'perihal_sk',
                        'property' => 'text'
                    ],

                ],
                'tabs' => [
                    [
                        'name' => 'Surat SK Penghapusan BMN',
                        'id' => 'tab-surat-sk',
                        'name_file' => 'Surat_SK_Penghapusan_BMN',
                        'id_upload' => 'uploadSuratSk',
                    ],
                    [
                        'name' => 'Lampiran Barang',
                        'id' => 'tab-lampiran',
                        'name_file' => 'Lampiran_Barang',
                        'id_upload' => 'uploadLampiran',
                    ],
                    [
                        'name' => 'Surat Persetujuan Penghapusan',
                        'id' => 'tab-persetujuan',
                        'name_file' => 'Surat_Persetujuan_Penghapusan',
                        'id_upload' => 'uploadSptjm',
                    ],
                    [
                        'name' => 'Risalah Lelang/Berita Acara Pemusnahan/Berita Acara Serah terima Hibah',
                        'id' => 'tab-risalah',
                        'name_file' => 'Risalah_Lelang',
                        'id_upload' => 'uploadRisalah',
                    ],
                    [
                        'name' => 'Lainnya',
                        'id' => 'tab-lainnya',
                        'name_file' => 'Lainnya',
                        'id_upload' => 'uploadLainnya',
                    ],
                ],
            ],
            '2_3' => [
                'draft' => 'draft-2_3',
                'form' => [
                    [
                        'name' => "Nomor Surat Permohonan Persetujuan Penghapusan",
                        'id' => 'nomor_surat',
                        'property' => 'text'

                    ],
                    [
                        'name' => "Perihal Surat Permohoan Persetujuan Penghapusan",
                        'id' => 'perihal_surat',
                        'property' => 'text'

                    ],
                    [
                        'name' => "Nomor Surat Persetujuan Penghapusan",
                        'id' => 'nomor_surat_persetujuan',
                        'property' => 'text'

                    ],
                    [
                        'name' => "Perihal Surat Persetujuan Penghapusan",
                        'id' => 'perihal_surat_persetujuan',
                        'property' => 'text'
                    ],
                    [
                        'name' => "Nomor Surat Permohonan SK Penghapusan",
                        'id' => 'nomor_sk',
                        'property' => 'text'
                    ],
                    [
                        'name' => "Perihal Surat Permohoan SK Penghapusan",
                        'id' => 'perihal_sk',
                        'property' => 'text'
                    ],

                ],
                'tabs' => [
                    [
                        'name' => 'Surat SK Penghapusan BMN',
                        'id' => 'tab-surat-sk',
                        'name_file' => 'Surat_SK_Penghapusan_BMN',
                        'id_upload' => 'uploadSuratSk',
                    ],
                    [
                        'name' => 'Lampiran Barang',
                        'id' => 'tab-lampiran',
                        'name_file' => 'Lampiran_Barang',
                        'id_upload' => 'uploadLampiran',
                    ],
                    [
                        'name' => 'Surat Persetujuan Penghapusan',
                        'id' => 'tab-persetujuan',
                        'name_file' => 'Surat_Persetujuan_Penghapusan',
                        'id_upload' => 'uploadSptjm',
                    ],
                    [
                        'name' => 'Risalah Lelang/Berita Acara Pemusnahan/Berita Acara Serah terima Hibah',
                        'id' => 'tab-risalah',
                        'name_file' => 'Risalah_Lelang',
                        'id_upload' => 'uploadRisalah',
                    ],
                    [
                        'name' => 'Lainnya',
                        'id' => 'tab-lainnya',
                        'name_file' => 'Lainnya',
                        'id_upload' => 'uploadLainnya',
                    ],
                ],
            ],
            '2_4' => [
                'draft' => 'draft-2_4',
                'form' => [
                    [
                        'name' => "Nomor Surat Permohonan Persetujuan Hibah BMN",
                        'id' => 'nomor_surat',
                        'property' => 'text'

                    ],
                    [
                        'name' => "Perihal Surat Permohoan Persetujuan Hibah BMN",
                        'id' => 'perihal_surat',
                        'property' => 'text'

                    ],
                    [
                        'name' => "Nomor Surat Persetujuan Hibah BMN",
                        'id' => 'nomor_surat_persetujuan',
                        'property' => 'text'

                    ],
                    [
                        'name' => "Perihal Surat Persetujuan Hibah BMN",
                        'id' => 'perihal_surat_persetujuan',
                        'property' => 'text'
                    ],
                    [
                        'name' => "Nomor Surat Permohonan SK Hibah BMN",
                        'id' => 'nomor_sk',
                        'property' => 'text'
                    ],
                    [
                        'name' => "Perihal Surat Permohoan SK Hibah BMN",
                        'id' => 'perihal_sk',
                        'property' => 'text'
                    ],

                ],
                'tabs' => [
                    [
                        'name' => 'Surat SK Penghapusan BMN',
                        'id' => 'tab-surat-sk',
                        'name_file' => 'Surat_SK_Penghapusan_BMN',
                        'id_upload' => 'uploadSuratSk',
                    ],
                    [
                        'name' => 'Lampiran Barang',
                        'id' => 'tab-lampiran',
                        'name_file' => 'Lampiran_Barang',
                        'id_upload' => 'uploadLampiran',
                    ],
                    [
                        'name' => 'Surat Persetujuan Penghapusan',
                        'id' => 'tab-persetujuan',
                        'name_file' => 'Surat_Persetujuan_Penghapusan',
                        'id_upload' => 'uploadSptjm',
                    ],
                    [
                        'name' => 'Risalah Lelang/Berita Acara Pemusnahan/Berita Acara Serah terima Hibah',
                        'id' => 'tab-risalah',
                        'name_file' => 'Risalah_Lelang',
                        'id_upload' => 'uploadRisalah',
                    ],
                    [
                        'name' => 'Lainnya',
                        'id' => 'tab-lainnya',
                        'name_file' => 'Lainnya',
                        'id_upload' => 'uploadLainnya',
                    ],
                ],
            ],
        ];
        
        return $data[$id];
    }
}


if (!function_exists('tab_hibah')) {
    function tab_hibah()
    {
        $tabs = [
            [
                'name' => 'Surat Permohonan',
                'id' => 'tab-permohonan-hibah',
                'name_file' => 'Surat_Permohonan_Hibah',
                'id_upload' => 'uploadHibah',
            ],
            [
                'name' => 'Lampiran Barang Hibah',
                'id' => 'tab-lbh',
                'name_file' => 'Lampiran_Barang_Hibah',
                'id_upload' => 'uploadLampiran',
            ],
            [
                'name' => 'SPTJM Bermaterai',
                'id' => 'tab-sptjm',
                'name_file' => 'SPTJM_Bermaterai',
                'id_upload' => 'uploadSptjm',
            ],
            [
                'name' => 'Foto Hibah BMN',
                'id' => 'tab-foto-hibah',
                'name_file' => 'Foto_Hibah_BMN',
                'id_upload' => 'uploadFoto',
            ],
            [
                'name' => 'Surat Pernyataan Hibah',
                'id' => 'tab-sph',
                'name_file' => 'Surat_Pernyataan_Hibah',
                'id_upload' => 'uploadSph',
            ],
            [
                'name' => 'Lainnya',
                'id' => 'tab-lainnya',
                'name_file' => 'File_Lainnya',
                'id_upload' => 'uploadLainnya',
            ],
        ];
        return $tabs;
    }
}

if (!function_exists('tab_psp')) {
    function tab_psp()
    {
        $tabs = [
            [
                'name' => 'Surat Permohonan PSP',
                'id' => 'tab-permohonan-psp',
                'name_file' => 'Surat_Permohonan_PSP',
                'id_upload' => 'uploadPsp',
            ],
            [
                'name' => 'SPTJM Bermaterai',
                'id' => 'tab-sptjm',
                'name_file' => 'SPTJM_Bermaterai',
                'id_upload' => 'uploadSptjm',
            ],
            [
                'name' => 'Lampiran Barang PSP (Excel)',
                'id' => 'tab-lampiran',
                'name_file' => 'Lampiran_Barang_PSP',
                'id_upload' => 'uploadLampiran',
            ],
        ];
        return $tabs;
    }
}

if (!function_exists('tab_perencanaan')) {
    function tab_perencanaan()
    {
        $tabs = [
            [
                'name' => 'Daftar Pegawai',
                'id' => 'tab-sbsk-doc',
                'name_file' => 'SBSK',
                'id_upload' => 'uploadSbsk',
            ],
            [
                'name' => 'Usulan Pengadaan',
                'id' => 'tab-kpb',
                'name_file' => 'Daftar_KPB',
                'id_upload' => 'uploadKpb',
            ],
            [
                'name' => 'Surat Pengantar',
                'id' => 'tab-pengantar',
                'name_file' => 'Surat_Pengantar',
                'id_upload' => 'uploadPengantar',
            ],
            [
                'name' => 'Surat Pernyataan',
                'id' => 'tab-pernyataan',
                'name_file' => 'Surat_Pernyataan',
                'id_upload' => 'uploadPernyataan',
            ],
            [
                'name' => 'Lainnya',
                'id' => 'tab-lainnyast',
                'name_file' => 'Lainnya_1',
                'id_upload' => 'uploadLainnyast',
            ],
            [
                'name' => 'Lainnya',
                'id' => 'tab-lainnyand',
                'name_file' => 'Lainnya_2',
                'id_upload' => 'uploadLainnyand',
            ],
        ];
        return $tabs;
    }
}