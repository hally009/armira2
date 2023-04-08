<?php

namespace App\Http\Controllers\Apip;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repositories\PengadaanRepository as Repository;
use App\Http\Repositories\ProfileRepository as Profile;
use App\Http\Services\PengadaanService as Service;

class PengadaanController extends Controller
{
    protected $repository;
    protected $profile;
    protected $service;

    public function __construct(Repository $repository, Profile $profile, Service $service)
    {
        $this->repository = $repository;
        $this->profile = $profile;
        $this->service = $service;
    }

    public function index()
    {
        $menu = get_home_menu()['perencanaan']['child'];
        
        $argumen = [
            'kepada'=> roles('apip'),
            'with'=>['satker'],
            'order' => ['id', 'desc']
        ];
        
        $items = $this->repository->getTahunPengadaan(date('Y'), $argumen);
        
        return view('apip.pengadaan.index', compact(['menu', 'items']));
    }

    public function show(Request $request, $id)
    {
        $menu = get_home_menu()['perencanaan']['child'];
        
        $argumen = [
            'with'=>['pengadaanAlur', 'pengadaanRakbm', 'pengadaanFile', 'satker'],
        ];
        
        $produkSbsk = $this->profile->getSbsk();
        $item = $this->repository->getSinglePengadaan($id, $argumen);
        $files = $item->pengadaanFile->pluck('file', 'name')->all();
        $rakbm = $item->pengadaanRakbm->keyBy('produk_id');
        
        return view('apip.pengadaan.show', compact(['menu', 'item', 'files', 'rakbm', 'produkSbsk']));
    }

    public function update(Request $request, $id)
    {
        $argumen = [
            'with' => ['pengadaanAlur', 'pengadaanRakbm']
        ];
        $item = $this->repository->getSinglePengadaan($id, $argumen);
        $apip = $request->except(['_method', '_token']);
        
        if(!$item || $item->status_apip != get_status('non-aktif')) {
            return redirect()->back()->withError('Data tidak ditemukan')->withInput();
        }

        $alur = $item->pengadaanAlur->last();
        if(!$alur || $alur->status != get_status_alur('on-progress') || $alur->kepada != roles('apip')) {
            return redirect()->back()->withError('Data tidak ditemukan')->withInput();
        }

        $sequence = $alur->sequence + 1;
        
        try {
            $dataStatus = [
                'status_apip' => get_status('aktif'),
                'kepada' => roles('uapb'),
            ];
            $this->service->updateStatusPengadaan($item, $dataStatus);


            $alur->fill([
                'status' => get_status_alur('disetujui')
            ])->save();

            $argumen = [
                'status' => get_status_alur('on-progress'),
                'kepada' => roles('uapb'),
                'dari' => roles('apip'),
                'keterangan' => 'Ajuan anda telah disetujui oleh APIP dan akan diperiksa oleh UAPB',
            ];
            $this->service->storePengadaanAlur($item, $sequence, $argumen);

            foreach ($apip as $key => $value) {
                list($field, $produkId) = explode("_", $key);
                $item->pengadaanRakbm->where('produk_id', $produkId)->first()->fill([
                    $field => $value
                ])->save();
            }

            $this->storeNotif([
                'role' => roles('uapb'),
                'dari' => roles('apip'),
                'content' => 'Permohonan pengajuan pengadaan BMN Satker '.$item->satker->name.' Telah diperiksa oleh APIP',
                'link' => route('Uapb::pengadaan.show', $item->id),
            ]);

            $this->storeNotif([
                'role' => roles('satker'),
                'dari' => roles('apip'),
                'satker_id' => $item->satker->id,
                'content' => 'Permohonan pengajuan pengadaan BMN Satker '.$item->satker->name.' Telah disetujui oleh UAPB',
                'link' => route('Satker::pengadaan.show', $item->id),
            ]);

            return redirect()->route('Apip::pengadaan.show', $item)->withSuccess('Pengadaan approved');
        } catch (\Exception$e) {
            return redirect()->back()->withError($e->getMessage())->withInput();
        }
    }
}
