<?php

namespace App\Http\Controllers\Uapb;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repositories\PengadaanRepository as Repository;
use App\Http\Services\PengadaanService as Service;

class PengadaanAgreementController extends Controller
{
    protected $repository;
    protected $service;

    public function __construct(Repository $repository, Service $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    public function approve(Request $request, $id)
    {
        $argumen = [
            'with' => ['pengadaanAlur', 'satker']
        ];
        $item = $this->repository->getSinglePengadaan($id, $argumen);
        
        if(!$item) {
            return redirect()->back()->withError('Data tidak ditemukan')->withInput();
        }
        
        $alur = $item->pengadaanAlur->last();
        if(!$alur || $alur->status != get_status_alur('on-progress')) {
            return redirect()->back()->withError('Data tidak ditemukan')->withInput();
        }

        $sequence = $alur->sequence + 1;
        
        try {
            $dataStatus = [
                'status_progress' => get_status_alur('disetujui'),
                'kepada' => roles('apip'),
            ];
            $this->service->updateStatusPengadaan($item, $dataStatus);
            $alur->fill([
                'status' => get_status_alur('disetujui')
            ])->save();

            $argumen = [
                'status' => get_status_alur('on-progress'),
                'kepada' => roles('apip'),
                'dari' => roles('uapb'),
                'keterangan' => 'Pengajuan anda telah distujui oleh UAPB dan akan diperiksa oleh APIP',
            ];
            $this->service->storePengadaanAlur($item, $sequence, $argumen);


            $this->storeNotif([
                'role' => roles('apip'),
                'dari' => roles('uapb'),
                'content' => 'Permohonan pengajuan pengadaan BMN Satker '.$item->satker->name.' Telah disetujui oleh UAPB',
                'link' => route('Apip::pengadaan.show', $item->id),
            ]);

            $this->storeNotif([
                'role' => roles('satker'),
                'dari' => roles('uapb'),
                'satker_id' => $item->satker->id,
                'content' => 'Permohonan pengajuan pengadaan BMN Satker '.$item->satker->name.' Telah disetujui oleh UAPB',
                'link' => route('Satker::pengadaan.show', $item->id),
            ]);

            return redirect()->route('Uapb::pengadaan.show', $item)->withSuccess('Pengadaan approved');
        } catch (\Exception$e) {
            return redirect()->back()->withError($e->getMessage())->withInput();
        }
    }

    public function repeat(Request $request, $id)
    {
        $argumen = [
            'with' => ['pengadaanAlur', 'satker']
        ];
        $item = $this->repository->getSinglePengadaan($id, $argumen);
        
        if(!$item) {
            return redirect()->back()->withError('Data tidak ditemukan')->withInput();
        }
        
        $alur = $item->pengadaanAlur->last();
        if(!$alur || $alur->status != get_status_alur('on-progress')) {
            return redirect()->back()->withError('Data tidak ditemukan')->withInput();
        }

        $sequence = $alur->sequence + 1;
        
        try {
            $dataStatus = [
                'status_progress' => get_status_alur('perbaikan'),
                'kepada' => roles('satker'),
            ];
            
            $this->service->updateStatusPengadaan($item, $dataStatus);
            $alur->fill([
                'status' => get_status_alur('disetujui')
            ])->save();

            $argumen = [
                'status' => get_status_alur('perbaikan'),
                'kepada' => roles('satker'),
                'dari' => roles('uapb'),
                'keterangan' => 'Pengajuan Anda Perlu diperbaiki dengan keterangan, '.$request->keterangan,
            ];
            $this->service->storePengadaanAlur($item, $sequence, $argumen);
            
            $this->storeNotif([
                'role' => roles('satker'),
                'dari' => roles('uapb'),
                'satker_id' => $item->satker->id,
                'content' => 'Permohonan pengajuan pengadaan BMN Satker '.$item->satker->name.' perlu perbaikan',
                'link' => route('Satker::pengadaan.show', $item->id),
            ]);

            return redirect()->route('Uapb::pengadaan.show', $item)->withSuccess('Pengajuan Rejected');
        } catch (\Exception$e) {
            return redirect()->back()->withError($e->getMessage())->withInput();
        }
    }

    public function rejected(Request $request, $id)
    {
        $argumen = [
            'with' => ['pengadaanAlur', 'satker']
        ];
        $item = $this->repository->getSinglePengadaan($id, $argumen);
        
        if(!$item) {
            return redirect()->back()->withError('Data tidak ditemukan')->withInput();
        }
        
        $alur = $item->pengadaanAlur->last();
        if(!$alur || $alur->status != get_status_alur('on-progress')) {
            return redirect()->back()->withError('Data tidak ditemukan')->withInput();
        }

        $sequence = $alur->sequence + 1;
        
        try {
            $dataStatus = [
                'status_progress' => get_status_alur('ditolak'),
                'kepada' => roles('satker'),
            ];
            
            $this->service->updateStatusPengadaan($item, $dataStatus);
            $alur->fill([
                'status' => get_status_alur('disetujui')
            ])->save();

            $argumen = [
                'status' => get_status_alur('ditolak'),
                'kepada' => roles('satker'),
                'dari' => roles('uapb'),
                'keterangan' => 'Pengajuan Anda Tidak Disetujui oleh UAPB, '.$request->keterangan,
            ];
            $this->service->storePengadaanAlur($item, $sequence, $argumen);
            
            $this->storeNotif([
                'role' => roles('satker'),
                'dari' => roles('uapb'),
                'satker_id' => $item->satker->id,
                'content' => 'Permohonan pengajuan pengadaan BMN Satker '.$item->satker->name.' Tidak Disetujui oleh UAPB',
                'link' => route('Satker::pengadaan.show', $item->id),
            ]);

            return redirect()->route('Uapb::pengadaan.show', $item)->withSuccess('Pengajuan Rejected');
        } catch (\Exception$e) {
            return redirect()->back()->withError($e->getMessage())->withInput();
        }
    }

    public function upload(Request $request)
    {
        $argumen = [
            'with' => ['pengadaanAlur', 'satker'],
            'statusApip' => get_status_alur('disetujui'),
            'statusProgress' => get_status_alur('disetujui'),
        ];
        $all = true;

        $items = $this->repository->getTahunPengadaan(date('Y'), $argumen, $all);
        
        if($items->count() <= 0) {
            return redirect()->back()->withError('Data tidak ditemukan')->withInput();
        }
        
        $file = $request->file('file_sk');
        if(!$file) {
            return redirect()->back()->withError('File tidak ditemukan')->withInput();
        }
        
        $nameFile = 'SK_PENGADAAN';

        try {
            $file = $this->service->uploadPengesahan($file, $nameFile);

            $dataStatus = [
                'status_pengesahan' => get_status_alur('disetujui'),
                'file' => $file['file']
            ];

            foreach ($items as $item) {
                $this->service->updateStatusPengadaan($item, $dataStatus);
                
                $alur = $item->pengadaanAlur->last();
                $sequence = $alur->sequence + 1;
                
                if($alur->status != get_status_alur('pengesahan')) {
                    $alur->fill([
                        'status' => get_status_alur('disetujui')
                    ])->save();

                    $argumen = [
                        'status' => get_status_alur('pengesahan'),
                        'kepada' => roles('satker'),
                        'dari' => roles('uapb'),
                        'keterangan' => 'Pengajuan anda telah disahkan oleh UAPB',
                    ];
                    $this->service->storePengadaanAlur($item, $sequence, $argumen);
                }

                $this->storeNotif([
                    'role' => roles('satker'),
                    'dari' => roles('uapb'),
                    'satker_id' => $item->satker->id,
                    'content' => 'Permohonan pengajuan pengadaan BMN Satker '.$item->satker->name.' Telah disahkan oleh UAPB',
                    'link' => route('Satker::pengadaan.show', $item->id),
                ]);
            }

            return redirect()->route('Uapb::pengadaan.show', $item)->withSuccess('Pengesahan Permohoanan Pengadaan BMN telah berhasil');
        } catch (\Exception$e) {
            return redirect()->back()->withError($e->getMessage())->withInput();
        }
    }
}
