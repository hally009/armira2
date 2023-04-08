<?php

namespace App\Http\Controllers\Satker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Repositories\ProfileRepository as Repository;
use App\Http\Services\ProfileService as Service;

class DashboardController extends Controller
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

        $rekap = $this->repository->getRekapAset(auth()->user()->satker_id);
        
        $chartData = [
            'data' => [
                $rekap ? $rekap->baik : 0, 
                $rekap ? $rekap->rusak_ringan : 0, 
                $rekap ? $rekap->rusak_berat : 0,
            ],
            'label' => ['Baik', 'Rusak Ringan', 'Rusak Berat']
        ];
        
        return view('satker.dashboard.index', compact(['menu', 'chartData']));
    }
}
