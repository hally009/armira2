<?php

namespace App\Http\Controllers\Uapb;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Http\Repositories\PengelolaanRepository as Repository;
use PDF;

class PenghapusanController extends Controller
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
            'jenis' => jenis_pengelolaan('penghapusan'),
            'order' => ['id', 'desc']
        ];
        
        $items = $this->repository->getTahunPengelolaan(date('Y'), $argumen);
        
        return view('uapb.penghapusan.index', compact(['menu', 'items']));
    }

    public function show(Request $request, $id)
    {
        $menu = get_home_menu()['pengelolaan']['child'];
        
        $argumen = [
            'with'=>['pengelolaanAlur', 'pengelolaanForm', 'satker', 'pengelolaanFile']
        ];
        
        $item = $this->repository->getSinglePengelolaan($id, $argumen);

        $id = $item->dokumen_id.'_'.$item->kategori_id;
        $formPenghapusan = form_penghapusan($id);
        $files = $item->pengelolaanFile->pluck('file', 'name')->all();
        
        return view('uapb.penghapusan.show', compact(['formPenghapusan', 'menu', 'item', 'files']));
    }

    public function draftPenghapusan(Request $request, $id)
    {
        $argumen = [
            'with'=>['pengelolaanAlur', 'pengelolaanForm', 'satker']
        ];
        
        $item = $this->repository->getSinglePengelolaan($id, $argumen);
        
        $form = form_penghapusan($item->dokumen_id.'_'.$item->kategori_id);
        
        $pdf = PDF::loadview('uapb.penghapusan.'.$form['draft'], [
            'item' => $item,
        ])->setPaper('a4', 'portrait');
        return $pdf->stream('draft-penghapusan-'.$item->satker->name.'-pdf');
    }
}
