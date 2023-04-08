<?php

namespace App\Http\Controllers\Uapb;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repositories\PengadaanRepository as Pengadaan;
use App\Http\Repositories\PengelolaanRepository as Pengelolaan;

class SatkerRequestController extends Controller
{
    protected $pengadaan;
    protected $pengelolaan;

    public function __construct(
        Pengadaan $pengadaan,
        Pengelolaan $pengelolaan
    )
    {
        $this->pengadaan = $pengadaan;
        $this->pengelolaan = $pengelolaan;
    }

    public function index(Request $request, $tahun)
    {
        
        $menu = get_home_menu()['profil']['child'];
        $argumen = [
            'with' =>['satker']
        ];
        $itemPengadaan = $this->pengadaan->getTahunPengadaan($tahun);
        $itemPengelolaan = $this->pengelolaan->getTahunPengelolaan($tahun, $argumen);
        
        return view('uapb.periode.satker-request', compact([
            'menu', 
            'itemPengadaan', 
            'itemPengelolaan', 
            'tahun'
        ]));
    }

    public function pengadaan(Request $request, $tahun, $id)
    {
        $menu = get_home_menu()['profil']['child'];
        $item = $this->pengadaan->getSinglePengadaan($id);
        
        return view('uapb.periode.satker-pengadaan', compact([
            'menu', 
            'item',
            'tahun'
        ]));
    }

    public function pengelolaan(Request $request, $tahun, $id)
    {
        $menu = get_home_menu()['profil']['child'];
        $item = $this->pengelolaan->getSinglePengelolaan($id);
        
        return view('uapb.periode.satker-pengelolaan', compact([
            'menu', 
            'item',
            'tahun'
        ]));
    }
}
