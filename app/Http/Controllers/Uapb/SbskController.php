<?php

namespace App\Http\Controllers\Uapb;

use App\Http\Controllers\Controller;
use App\Http\Repositories\ProfileRepository as Repository;
use App\Http\Services\ProfileService as Service;
use Illuminate\Http\Request;

class SbskController extends Controller
{
    protected $repository;
    protected $service;

    public function __construct(Repository $repository, Service $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $menu = get_home_menu()['profil']['child'];
        
        return view('uapb.sbsk.index', compact([
            'menu',
        ]));
    }

    public function showForm()
    {
        $items = $this->repository->getSbsk();
        $strukturs = $this->repository->getRefStruktur();
        return view('uapb.sbsk._tab-sbsk', compact([
            'items',
            'strukturs',
        ]));
    }

    // public function activate(Request $request, $id)
    // {
    //     $item = $this->repository->getSingleSbsk($id);
    //     if (!$item) {
    //         return redirect()->back()->withError('Data tidak ditemukan')->withInput();
    //     }
    //     $data = [
    //         'status' => count($request->except('_token', '_method')) == 0?get_status('non-aktif'):get_status('aktif')
    //     ];
        
    //     try {
    //         $item->fill($data)->save();
    //         if($data['status'] ==  get_status('non-aktif')) {
    //             $this->service->setDefaultSbsk($item->id);
    //         }
            
    //         return redirect()->route('Uapb::sbsk.index', ['satker' => $item->satker_id]);
    //     } catch (\Exception$e) {
    //         return redirect()->back()->withError($e->getMessage())->withInput();
    //     }
    // }

    public function updateSbsk(Request $request)
    {
        try {
            $this->service->updateSbskDetail($request->except('_token', '_method'));
            
            return redirect()->route('Uapb::sbsk.index');
        } catch (\Exception$e) {
            return redirect()->back()->withError($e->getMessage())->withInput();
        }
    }
}
