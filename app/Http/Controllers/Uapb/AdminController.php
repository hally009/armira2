<?php

namespace App\Http\Controllers\Uapb;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Repositories\ProfileRepository as Repository;
use App\Http\Services\ProfileService as Service;

class AdminController extends Controller
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
        $items = $this->repository->getUsersSatker(false, true);
        
        return view('uapb.admin.index', compact(['menu', 'items']));
    }

    public function create()
    {
        $menu = get_home_menu()['profil']['child'];
        $satker = $this->repository->getRefSatker();
        
        return view('uapb.admin.create', compact(['menu', 'satker']));
    }

    public function store(Request $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => roles('satker'),
        ];

        try {
            $this->service->storeOperatorSatker($request->satker_id, $data);
            return redirect()->route('Uapb::admin.index')->withSuccess('Data Berhasil Disimpan');
        } catch (\Exception$e) {
            return redirect()->back()->withError($e->getMessage())->withInput();
        }
    }

    public function edit(Request $request, $id)
    {
        $item = $this->repository->getUserById($id);
        if (!$item) {
            return redirect()->back()->withError('Data tidak ditemukan')->withInput();
        }

        if ($item->role == '2') {
            return redirect()->back()->withError('Data tidak ditemukan')->withInput();
        }

        $menu = get_home_menu()['profil']['child'];
        $satker = $this->repository->getRefSatker();
        
        return view('uapb.admin.edit', compact(['menu', 'satker', 'item']));
    }

    public function update(Request $request, $id)
    {
        $item = $this->repository->getUserById($id);
        if (!$item) {
            return redirect()->back()->withError('Data tidak ditemukan')->withInput();
        }

        if ($item->role == roles('uapb')) {
            return redirect()->back()->withError('Data tidak ditemukan')->withInput();
        }

        $satker = $this->repository->getRefSatker($request->satker_id);
        
        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        try {
            $item->satker()->associate($satker)->fill($data)->save();
            
            return redirect()->route('Uapb::admin.index')->withSuccess('Data Berhasil Disimpan');
        } catch (\Exception$e) {
            return redirect()->back()->withError($e->getMessage())->withInput();
        }
    }

    public function editPassword(Request $request, $id)
    {
        $item = $this->repository->getUserById($id);
        if (!$item) {
            return redirect()->back()->withError('Data tidak ditemukan')->withInput();
        }

        if ($item->role == roles('uapb')) {
            return redirect()->back()->withError('Data tidak ditemukan')->withInput();
        }

        $menu = get_home_menu()['profil']['child'];
        
        return view('uapb.admin.edit-password', compact(['menu', 'item']));
    }

    public function updatePassword(Request $request, $id)
    {
        $item = $this->repository->getUserById($id);
        if (!$item) {
            return redirect()->back()->withError('Data tidak ditemukan')->withInput();
        }

        if ($item->role == roles('uapb')) {
            return redirect()->back()->withError('Data tidak ditemukan')->withInput();
        }
        
        $data = [
            'password' => Hash::make($request->password)
        ];
        
        try {
            $item->fill($data)->save();
            
            return redirect()->route('Uapb::admin.index')->withSuccess('Data Berhasil Disimpan');
        } catch (\Exception$e) {
            return redirect()->back()->withError($e->getMessage())->withInput();
        }
    }

    public function destroy(Request $request, $id)
    {
        $item = $this->repository->getUserById($id);
        if (!$item) {
            return redirect()->back()->withError('Data tidak ditemukan')->withInput();
        }

        if ($item->role == roles('uapb')) {
            return redirect()->back()->withError('Data tidak ditemukan')->withInput();
        }
        
        try {
            $item->delete();
            return redirect()->route('Uapb::admin.index')->withSuccess('Data Berhasil Dihapus');
        } catch (\Exception$e) {
            return redirect()->back()->withError($e->getMessage())->withInput();
        }
    }
}
