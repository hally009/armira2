<?php

namespace App\Http\Controllers\Satker;

use App\Http\Controllers\Controller;
use App\Http\Repositories\MasterRepository as Repository;
use App\Http\Repositories\ProfileRepository as Profile;
use App\Http\Services\MasterService as Service;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Rap2hpoutre\FastExcel\FastExcel;

class MasterController extends Controller
{
    protected $repository;
    protected $profile;
    protected $service;

    protected $mime = [
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'application/vnd.ms-excel',
    ];

    public function __construct(
        Repository $repository,
        Profile $profile,
        Service $service
    ) {
        $this->repository = $repository;
        $this->service = $service;
        $this->profile = $profile;
    }

    public function index()
    {
        $menu = get_home_menu()['master']['child'];
        $item = $this->repository->getMasterByUser();

        return view('satker.master.index', compact(['menu', 'item']));
    }

    public function store(Request $request)
    {
        $file = $request->file('file_excel');
        if (!$file) {
            return redirect()->route('Satker::master.index', ['tab' => 'pembaruan'])->withError('Masukkan File Excel')->withInput();
        }

        $master = $this->repository->getMasterByUser();

        try {
            $fileUpload = $this->service->uploadFile($file, $this->mime);
            $collection = (new FastExcel)->import(public_path($fileUpload['file']));
            $cekSbsk = cek_sbsk_excel($collection);

            if (Arr::has($cekSbsk, 'error')) {
                unlink(public_path($fileUpload['file']));
                return redirect()->route('Satker::master.index', ['tab' => 'pembaruan'])
                    ->withError($cekSbsk['error'])
                    ->withInput();
            }

            $saveData = [
                'file_temp' => $fileUpload['file'],
            ];
            (!$master) ? $this->service->storeMaster($saveData) : $master->fill($saveData)->save();

            return redirect()->route('Satker::master.index', ['tab' => 'pembaruan'])->withSuccess('File berhasil di Upload');
        } catch (\Exception$e) {
            return redirect()->back()->withError($e->getMessage())->withInput();
        }

    }

    public function syncronize(Request $request)
    {
        $master = $this->repository->getMasterByUser();
        if (!$master) {
            return redirect()->route('Satker::master.index', ['tab' => 'pembaruan'])
                ->withError('Proses tidak bisa dikerjakan')
                ->withInput();
        }

        if (!file_exists(public_path($master->file_temp))) {
            return redirect()
                ->route('Satker::master.index', ['tab' => 'pembaruan'])
                ->withError('File tidak ditemukan')
                ->withInput();
        }

        try {
            $produk = $this->profile->getRefProduk();
            $this->service->sincronize($master, $produk);

            return redirect()->route('Satker::master.index')->withSuccess('File berhasil di Sinkron');
        } catch (\Exception$e) {
            return redirect()->back()->withError($e->getMessage())->withInput();
        }

    }
}
