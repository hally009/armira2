<?php

namespace App\Http\Controllers\Satker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repositories\ProfileRepository as Repository;

class ProfileController extends Controller
{
    protected $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $menu = get_home_menu()['profil']['child'];
        $item = $this->repository->getUserSatker();
        $notifs = $this->getNotif();
        
        return view('satker.identitas.index', compact(['item', 'menu', 'notifs']));
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

            return redirect()->route('Satker::profile.index')->withSuccess('Data Berhasil Disimpan');
        } catch (\Exception$e) {
            return redirect()->back()->withError($e->getMessage())->withInput();
        }
    }
}
