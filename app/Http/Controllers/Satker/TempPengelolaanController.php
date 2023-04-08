<?php

namespace App\Http\Controllers\Satker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Http\Repositories\PengelolaanRepository as Repository;
use App\Http\Services\PengelolaanService as Service;

class TempPengelolaanController extends Controller
{
    protected $repository;
    protected $service;

    public function __construct(Repository $repository, Service $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    public function store(Request $request, $jenis)
    {
        $dataForm = Arr::except($request->all(), ['_method', '_token']);
        
        $dataStore = [
            'periode' => date('Y'),
            'jenis' => jenis_pengelolaan($jenis),
            'form' => json_encode($dataForm),
        ];

        if($request->dokumen_id) {
            $dataStore['dokumen_id'] = $request->dokumen_id;
        }
        if($request->kategori_id) {
            $dataStore['kategori_id'] = $request->kategori_id;
        }
        
        $item = $this->repository->getTempPengelolaan(jenis_pengelolaan($jenis), date('Y'));

        if($item) {
            $item->fill($dataStore)->save();
            return $item;
        }

        $item = $this->service->storePengelolaanTemp($dataStore);
        return $item;
        
    }

    public function upload(Request $request, $jenis, $nama)
    {

        $file = Arr::flatten($request->file());
        if(count($file) == 0) {
            return false;
        }

        $argumen = false;
        if($request->dokumen_id && $request->kategori_id) {
            $argumen = [
                'dokumen_id' => $request->dokumen_id,
                'kategori_id' => $request->kategori_id,
            ];
        }
        
        
        $item = $this->repository->getTempPengelolaan(jenis_pengelolaan($jenis), date('Y'), $argumen);
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
