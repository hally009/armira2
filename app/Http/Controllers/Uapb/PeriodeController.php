<?php

namespace App\Http\Controllers\Uapb;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repositories\ProfileRepository as Repository;
use App\Http\Services\ProfileService as Service;

class PeriodeController extends Controller
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
        $items = $this->repository->getPeriode();
        
        return view('uapb.periode.index', compact(['menu', 'items']));
    }

    public function create()
    {
        $menu = get_home_menu()['profil']['child'];
        
        return view('uapb.periode.create', compact(['menu']));
    }

    public function store(Request $request)
    {
        $data = [
            'nama' => $request->nama,
            'tahun' => $request->tahun,
            'status' => get_status('non-aktif'),
        ];

        try {
            $this->service->storePeriode($data);
            return redirect()->route('Uapb::periode.index')->withSuccess('Data Berhasil Disimpan');
        } catch (\Exception$e) {
            return redirect()->back()->withError($e->getMessage())->withInput();
        }
    }


    public function edit(Request $request, $id)
    {
        $item = $this->repository->getSinglePeriode($id);
        if (!$item) {
            return redirect()->back()->withError('Data tidak ditemukan')->withInput();
        }
        
        $menu = get_home_menu()['profil']['child'];
        
        return view('uapb.periode.edit', compact(['menu', 'item']));
    }

    public function update(Request $request, $id)
    {
        $item = $this->repository->getSinglePeriode($id);
        if (!$item) {
            return redirect()->back()->withError('Data tidak ditemukan')->withInput();
        }
        
        $data = [
            'nama' => $request->nama,
            'tahun' => $request->tahun,
        ];

        try {
            $item->fill($data)->save();

            return redirect()->route('Uapb::perriode.index')->withSuccess('Data Berhasil Disimpan');
        } catch (\Exception$e) {
            return redirect()->back()->withError($e->getMessage())->withInput();
        }
    }

    public function activate(Request $request, $id)
    {
        $item = $this->repository->getSinglePeriode($id);
        if (!$item) {
            return redirect()->back()->withError('Data tidak ditemukan')->withInput();
        }
        $periode = $this->repository->getPeriodeExclude($id);
        
        $data = [
            'status' => $item->status == '1' ? '0' : '1',
        ];

        try {
            $item->fill($data)->save();
            if($periode->count() > 0 && $data['status'] == '1') {
                $this->service->disablePeriode($id);
            }

            $massage = $data['status'] == '1' ? 
                'Periode '.$item->tahun.' Telah di Aktifkan' : 
                'Periode '.$item->tahun.' Telah di Non Aktifkan';
            
            return redirect()->route('Uapb::periode.index')->withSuccess($massage);
        } catch (\Exception$e) {
            return redirect()->back()->withError($e->getMessage())->withInput();
        }
    }
}
