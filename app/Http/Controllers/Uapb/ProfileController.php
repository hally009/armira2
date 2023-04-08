<?php

namespace App\Http\Controllers\Uapb;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repositories\ProfileRepository as Repository;

class ProfileController extends Controller
{
    protected $repository;
    // protected $service;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
        // $this->service = $service;
    }

    public function index()
    {
        $menu = get_home_menu()['profil']['child'];
        $notifs = $this->getNotif();
        $item = $this->repository->getUserSatker();
        
        return view('uapb.identitas.index', compact(['item', 'menu', 'notifs']));
    }

    public function store(Request $request)
    {
        $item = $this->repository->getUserSatker();
        if (!$item) {
            return redirect()->back()->withError('Data tidak ditemukan')->withInput();
        }

        $data = [
            'pejabat_pengesahan' => $request->pejabat_pengesahan,
        ];

        try {
            $item->fill($data)->save();

            return redirect()->route('Uapb::profile.index')->withSuccess('Data Berhasil Disimpan');
        } catch (\Exception$e) {
            return redirect()->back()->withError($e->getMessage())->withInput();
        }
    }
}
