<?php

namespace App\Http\Controllers\Satker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Http\Repositories\PengadaanRepository as Repository;
use App\Http\Repositories\ProfileRepository as Profile;
use App\Http\Repositories\MasterRepository as Master;
use App\Http\Services\PengadaanService as Service;

class TempPengadaanController extends Controller
{
    protected $repository;
    protected $service;
    protected $profile;
    protected $master;

    public function __construct(
        Repository $repository,
        Service $service,
        Profile $profile,
        Master $master
    )
    {
        $this->repository = $repository;
        $this->service = $service;
        $this->profile = $profile;
        $this->master = $master;
    }

    public function store(Request $request)
    {
        $periode = $this->profile->getPeriode([
            'status' => get_status('aktif'),
        ])->first();

        if(!$periode) {
             return redirect()->route('Satker::pengadaan.index')->withError('Pengajuan Perencanaan SBSK telah ditutup');
        }

        $satker = $this->profile->getUserSatker();

        $dataForm = Arr::except($request->all(), ['_method', '_token', 'nama_usulan']);
        $pegawai = $this->profile->getPegawai();

        $aset = $this->master->getAsetBySatker($satker->id);
        $aset = json_decode($aset->content, true);
        $produkSbsk = $this->profile->getSbsk();
        
        $dataStore = [
            'periode' => $periode->tahun,
            'nama_usulan' => $request->nama_usulan,
            'usulan_rakbm' => json_encode($this->repository->setUsulanTemp($produkSbsk, $pegawai, $aset, $dataForm)),
        ];
        
        $item = $this->repository->getTempPengadaan($periode->tahun);

        if($item) {
            $item->fill($dataStore)->save();
            return $item;
        }

        $item = $this->service->storePengadaanTemp($dataStore);
        return $item;
    }

    public function upload(Request $request, $nama)
    {
        $periode = $this->profile->getPeriode([
            'status' => get_status('aktif'),
        ])->first();

        if(!$periode) {
             return redirect()->route('Satker::pengadaan.index')->withError('Pengajuan Perencanaan SBSK telah ditutup');
        }

        $file = Arr::flatten($request->file());
        if(count($file) == 0) {
            return false;
        }

        $argumen = false;
        
        $item = $this->repository->getTempPengadaan($periode->tahun, $argumen);
        $upload = $this->service->uploadFile($file[0], $nama);
        $dataUpload = json_decode($item->file, true);

        $dataUpload[$nama] = $upload['file'];
        
        $dataStore = [
            'file' => json_encode($dataUpload),
        ];
        
        $item->fill($dataStore)->save();
        return $item;
    }
}
