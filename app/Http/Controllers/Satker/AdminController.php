<?php

namespace App\Http\Controllers\Satker;

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
        $items = $this->repository->getOperatorSatker();
        
        return view('satker.admin.index', compact(['menu', 'items']));
    }

    public function create()
    {
        $menu = get_home_menu()['profil']['child'];
        
        return view('satker.admin.create', compact(['menu']));
    }

    public function store(Request $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => roles('operator_satker'),
        ];

        try {
            $this->service->storeOperatorSatker(auth()->user()->satker_id, $data);
            return redirect()->route('Satker::admin.index')->withSuccess('Data Berhasil Disimpan');
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

        if ($item->role != roles('operator_satker')) {
            return redirect()->back()->withError('Data tidak ditemukan')->withInput();
        }

        if ($item->satker_id != auth()->user()->satker_id) {
            return redirect()->back()->withError('Data tidak ditemukan')->withInput();
        }

        $menu = get_home_menu()['profil']['child'];
        $satker = $this->repository->getRefSatker();
        
        return view('satker.admin.edit', compact(['menu', 'satker', 'item']));
    }

    public function update(Request $request, $id)
    {
        $item = $this->repository->getUserById($id);
        if (!$item) {
            return redirect()->back()->withError('Data tidak ditemukan')->withInput();
        }

        if ($item->role != roles('operator_satker')) {
            return redirect()->back()->withError('Data tidak ditemukan')->withInput();
        }

        if ($item->satker_id != auth()->user()->satker_id) {
            return redirect()->back()->withError('Data tidak ditemukan')->withInput();
        }
        
        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        try {
            $item->fill($data)->save();
            
            return redirect()->route('Satker::admin.index')->withSuccess('Data Berhasil Disimpan');
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

        if ($item->role != roles('operator_satker')) {
            return redirect()->back()->withError('Data tidak ditemukan')->withInput();
        }

        if ($item->satker_id != auth()->user()->satker_id) {
            return redirect()->back()->withError('Data tidak ditemukan')->withInput();
        }

        $menu = get_home_menu()['profil']['child'];
        
        return view('satker.admin.edit-password', compact(['menu', 'item']));
    }

    public function updatePassword(Request $request, $id)
    {
        $item = $this->repository->getUserById($id);
        if (!$item) {
            return redirect()->back()->withError('Data tidak ditemukan')->withInput();
        }

        if ($item->role != roles('operator_satker')) {
            return redirect()->back()->withError('Data tidak ditemukan')->withInput();
        }

        if ($item->satker_id != auth()->user()->satker_id) {
            return redirect()->back()->withError('Data tidak ditemukan')->withInput();
        }
        
        $data = [
            'password' => Hash::make($request->password)
        ];
        
        try {
            $item->fill($data)->save();
            
            return redirect()->route('Satker::admin.index')->withSuccess('Data Berhasil Disimpan');
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

        if ($item->role != roles('operator_satker')) {
            return redirect()->back()->withError('Data tidak ditemukan')->withInput();
        }

        if ($item->satker_id != auth()->user()->satker_id) {
            return redirect()->back()->withError('Data tidak ditemukan')->withInput();
        }
        
        try {
            $item->delete();
            return redirect()->route('Satker::admin.index')->withSuccess('Data Berhasil Dihapus');
        } catch (\Exception$e) {
            return redirect()->back()->withError($e->getMessage())->withInput();
        }
    }
}
