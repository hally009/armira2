<?php

namespace App\Http\Controllers\Uapb;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repositories\PengelolaanRepository as Repository;
use App\Http\Services\PengelolaanService as Service;

class PenghapusanAgreementController extends Controller
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
            'with' => ['pengelolaanAlur', 'satker']
        ];
        $item = $this->repository->getSinglePengelolaan($id, $argumen);
        
        if(!$item) {
            return redirect()->back()->withError('Data tidak ditemukan')->withInput();
        }
        
        $alur = $item->pengelolaanAlur->last();
        if(!$alur || $alur->status != get_status_alur('on-progress')) {
            return redirect()->back()->withError('Data tidak ditemukan')->withInput();
        }

        $sequence = $alur->sequence + 1;
        
        try {
            $dataStatus = [
                'status_progress' => get_status('aktif'),
                'kepada' => roles('uapb'),
            ];
            $this->service->updateStatusPengelolaan($item, $dataStatus);
            $alur->fill([
                'status' => get_status_alur('disetujui')
            ])->save();

            $argumen = [
                'status' => get_status_alur('on-progress'),
                'kepada' => roles('uapb'),
                'dari' => roles('uapb'),
                'keterangan' => 'Pengajuan anda telah distujui oleh UAPB dan akan disahkan oleh UAPB',
            ];
            $this->service->storePengelolaanAlur($item, $sequence, $argumen);

            $this->storeNotif([
                'role' => roles('satker'),
                'dari' => roles('uapb'),
                'satker_id' => $item->satker->id,
                'content' => 'Permohonan pengajuan Penghapusan BMN Satker '.$item->satker->name.' Telah disetujui oleh UAPB',
                'link' => route('Satker::penghapusan.show', $item->id),
            ]);

            return redirect()->route('Uapb::penghapusan.show', $item)->withSuccess('Permohonan Penghapusan Approved');
        } catch (\Exception$e) {
            return redirect()->back()->withError($e->getMessage())->withInput();
        }
    }

    public function rejected(Request $request, $id)
    {
        $argumen = [
            'with' => ['pengelolaanAlur', 'satker']
        ];
        $item = $this->repository->getSinglePengelolaan($id, $argumen);
        
        if(!$item) {
            return redirect()->back()->withError('Data tidak ditemukan')->withInput();
        }
        
        $alur = $item->pengelolaanAlur->last();
        if(!$alur || $alur->status != get_status_alur('on-progress')) {
            return redirect()->back()->withError('Data tidak ditemukan')->withInput();
        }

        $sequence = $alur->sequence + 1;
        
        try {
            $dataStatus = [
                'status_progress' => get_status_alur('ditolak'),
                'kepada' => roles('satker'),
            ];
            
            $this->service->updateStatusPengelolaan($item, $dataStatus);
            $alur->fill([
                'status' => get_status_alur('disetujui')
            ])->save();

            $argumen = [
                'status' => get_status_alur('ditolak'),
                'kepada' => roles('satker'),
                'dari' => roles('uapb'),
                'keterangan' => 'Pengajuan Anda Tidak Disetujui oleh UAPB, '.$request->keterangan,
            ];
            $this->service->storePengelolaanAlur($item, $sequence, $argumen);
            
            $this->storeNotif([
                'role' => roles('satker'),
                'dari' => roles('uapb'),
                'satker_id' => $item->satker->id,
                'content' => 'Permohonan pengajuan Hibah BMN Satker '.$item->satker->name.' Tidak Disetujui oleh UAPB',
                'link' => route('Satker::penghapusan.show', $item->id),
            ]);

            return redirect()->route('Uapb::penghapusan.show', $item)->withSuccess('Pengajuan Rejected');
        } catch (\Exception$e) {
            return redirect()->back()->withError($e->getMessage())->withInput();
        }
    }

    public function repeat(Request $request, $id)
    {
        $argumen = [
            'with' => ['pengelolaanAlur', 'satker']
        ];
        $item = $this->repository->getSinglePengelolaan($id, $argumen);
        
        if(!$item) {
            return redirect()->back()->withError('Data tidak ditemukan')->withInput();
        }
        
        $alur = $item->pengelolaanAlur->last();
        if(!$alur || $alur->status != get_status_alur('on-progress')) {
            return redirect()->back()->withError('Data tidak ditemukan')->withInput();
        }

        $sequence = $alur->sequence + 1;
        
        try {
            $dataStatus = [
                'status_progress' => get_status_alur('perbaikan'),
                'kepada' => roles('satker'),
            ];
            
            $this->service->updateStatusPengelolaan($item, $dataStatus);
            $alur->fill([
                'status' => get_status_alur('disetujui')
            ])->save();

            $argumen = [
                'status' => get_status_alur('perbaikan'),
                'kepada' => roles('satker'),
                'dari' => roles('uapb'),
                'keterangan' => 'Pengajuan Anda Perlu diperbaiki dengan keterangan, '.$request->keterangan,
            ];
            $this->service->storePengelolaanAlur($item, $sequence, $argumen);
            
            $this->storeNotif([
                'role' => roles('satker'),
                'dari' => roles('uapb'),
                'satker_id' => $item->satker->id,
                'content' => 'Permohonan pengajuan Penghapusan BMN Satker '.$item->satker->name.' perlu perbaikan',
                'link' => route('Satker::penghapusan.show', $item->id),
            ]);

            return redirect()->route('Uapb::penghapusan.index', $item)->withSuccess('Pengajuan perlu diperbaiki');
        } catch (\Exception$e) {
            return redirect()->back()->withError($e->getMessage())->withInput();
        }
    }

    public function upload(Request $request, $id)
    {
        $argumen = [
            'with' => ['pengelolaanAlur', 'satker']
        ];

        $item = $this->repository->getSinglePengelolaan($id, $argumen);
        if(!$item || $item->status_progress != get_status_alur('disetujui')) {
            return redirect()->back()->withError('Data tidak ditemukan')->withInput();
        }
        
        $file = $request->file('file_sk');
        if(!$file) {
            return redirect()->back()->withError('File tidak ditemukan')->withInput();
        }

        $alur = $item->pengelolaanAlur->last();
        $sequence = $alur->sequence + 1;
        $nameFile = 'SK_PENHAPUSAN';

        try {
            $file = $this->service->uploadPengesahan($file, $nameFile, $item);

            $dataStatus = [
                'status_pengesahan' => get_status_alur('disetujui'),
                'file' => $file['file']
            ];
            $this->service->updateStatusPengelolaan($item, $dataStatus);

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
                $this->service->storePengelolaanAlur($item, $sequence, $argumen);
            }

            $this->storeNotif([
                'role' => roles('satker'),
                'dari' => roles('uapb'),
                'satker_id' => $item->satker->id,
                'content' => 'Permohonan pengajuan Penghapusan BMN Satker '.$item->satker->name.' Telah disahkan oleh UAPB',
                'link' => route('Satker::penghapusan.show', $item->id),
            ]);

            return redirect()->route('Uapb::penghapusan.show', $item)->withSuccess('Pengesahan Permohoanan PENGHAPUSAN telah berhasil');
        } catch (\Exception$e) {
            return redirect()->back()->withError($e->getMessage())->withInput();
        }
    }
}
