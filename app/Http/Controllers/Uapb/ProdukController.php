<?php

namespace App\Http\Controllers\Uapb;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repositories\ProfileRepository as Repository;
use App\Http\Services\ProfileService as Service;

class ProdukController extends Controller
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
        $produks = $this->repository->getRefProduk();
        
        return view('uapb.sbsk._tab-produk', compact(['produks']));
    }

    public function store(Request $request)
    {
        $strukturs = $this->repository->getRefStruktur();

        $data = [
            'nama' => $request->nama,
            'kode_barang' => $request->kode_barang,
            'status' => $request->status,
        ];

        try {
            $produk = $this->service->storeProduk($data);
            foreach ($strukturs as $value) {
                $dataSbsk = [
                    'produk_id' => $produk->id,
                    'struktur_id' => $value->id,
                    'total' => 0,
                ];
                $this->service->storeSbsk($dataSbsk);   
            }
            

            return [
                'status' => 'success'
            ];
        } catch (\Exception$e) {
            return [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }
    }

    public function update(Request $request, $id)
    {
        $data = [
            'nama' => $request->nama,
            'kode_barang' => $request->kode_barang,
            'status' => $request->status,
        ];

        $item = $this->repository->getProdukById($id);
        if(!$item)  {
            return [
                'status' => 'error',
                'message' => 'produk not found'
            ];
        }

        try {
            $item->fill($data)->save();
            return [
                'status' => 'success'
            ];
        } catch (\Exception$e) {
            return [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }
    }
}
