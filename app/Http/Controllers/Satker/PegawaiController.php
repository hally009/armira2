<?php

namespace App\Http\Controllers\Satker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repositories\ProfileRepository as Repository;
use App\Http\Services\ProfileService as Service;

class PegawaiController extends Controller
{
    protected $repository;
    protected $service;

    public function __construct(Repository $repository, Service $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    public function index()
    {
        $menu = get_home_menu()['profil']['child'];
        $items = $this->repository->getPegawai();
        
        return view('satker.pegawai.index', compact(['items', 'menu']));
    }

    public function create()
    {
        $menu = get_home_menu()['profil']['child'];
        $struktur = $this->repository->getRefStruktur();
        
        return view('satker.pegawai.create', compact(['menu', 'struktur']));
    }

    public function store(Request $request)
    {
        $data = [
            'struktur_id' => $request->struktur_id,
            'total' => $request->total_pegawai,
        ];

        try {
            $this->service->storeSatkerStruktur($data);
            return redirect()->route('Satker::pegawai.index')->withSuccess('Data Berhasil Disimpan');
        } catch (\Exception$e) {
            return redirect()->back()->withError($e->getMessage())->withInput();
        }
    }


    public function edit(Request $request, $id)
    {
        $item = $this->repository->getSinglePegawai($id);
        if (!$item) {
            return redirect()->back()->withError('Data tidak ditemukan')->withInput();
        }
        
        $menu = get_home_menu()['profil']['child'];
        $struktur = $this->repository->getRefStruktur();
        
        return view('satker.pegawai.edit', compact(['menu', 'struktur', 'item']));
    }

    public function update(Request $request, $id)
    {
        $item = $this->repository->getSinglePegawai($id);
        if (!$item) {
            return redirect()->back()->withError('Data tidak ditemukan')->withInput();
        }

        $data = [
            'struktur_id' => $request->struktur_id,
            'total' => $request->total_pegawai,
        ];

        try {
            $item->fill($data)->save();

            return redirect()->route('Satker::pegawai.index')->withSuccess('Data Berhasil Disimpan');
        } catch (\Exception$e) {
            return redirect()->back()->withError($e->getMessage())->withInput();
        }
    }
}
