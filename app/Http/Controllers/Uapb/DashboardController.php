<?php

namespace App\Http\Controllers\Uapb;

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

        $rekap = $this->repository->getRekapAset();
        
        $chartData = [
            'data' => [
                $rekap->count() > 0 ? $rekap->sum('baik') : 0, 
                $rekap->count() > 0 ? $rekap->sum('rusak_ringan') : 0, 
                $rekap->count() > 0 ? $rekap->sum('rusak_berat') : 0,
            ],
            'label' => ['Baik', 'Rusak Ringan', 'Rusak Berat']
        ];
        
        return view('satker.dashboard.index', compact(['menu', 'chartData']));
    }
}
