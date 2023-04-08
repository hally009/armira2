<?php

namespace App\Http\Controllers\Uapb;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repositories\PengelolaanRepository as Repository;
use PDF;

class HibahController extends Controller
{
    protected $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $menu = get_home_menu()['pengelolaan']['child'];
        
        $argumen = [
            'kepada' => roles('uapb'),
            'with'=>['pengelolaanAlur', 'pengelolaanForm', 'satker'],
            'jenis' => jenis_pengelolaan('hibah'),
            'order' => ['id', 'desc']
        ];
        
        $items = $this->repository->getTahunPengelolaan(date('Y'), $argumen);
        
        return view('uapb.hibah.index', compact(['menu', 'items']));
    }

    public function show(Request $request, $id)
    {
        $menu = get_home_menu()['pengelolaan']['child'];
        
        $argumen = [
            'with'=>['pengelolaanAlur', 'pengelolaanForm', 'satker', 'pengelolaanFile']
        ];
        
        $item = $this->repository->getSinglePengelolaan($id, $argumen);
        $files = $item->pengelolaanFile->pluck('file', 'name')->all();
        
        return view('uapb.hibah.show', compact(['menu', 'item', 'files']));
    }

    public function draftHibah(Request $request, $id)
    {
        $argumen = [
            'with'=>['pengelolaanAlur', 'pengelolaanForm', 'satker']
        ];
        
        $item = $this->repository->getSinglePengelolaan($id, $argumen);
        
        $pdf = PDF::loadview('uapb.hibah.draft', [
            'item' => $item,
        ])->setPaper('a4', 'portrait');
        return $pdf->stream('draft-hibah-'.$item->satker->name.'-pdf');
    }
}
