<?php

namespace App\Http\Controllers\Uapb;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repositories\MasterRepository as Repository;
use App\Http\Repositories\ProfileRepository as Profile;

class MasterController extends Controller
{
    protected $repository;
    protected $profile;
    
    public function __construct(Repository $repository, Profile $profile)
    {
        $this->repository = $repository;
        $this->profile = $profile;
    }

    public function index(Request $request)
    {
        $menu = get_home_menu()['master']['child'];
        $satker = $this->profile->getSatker();

        if (!$request->satker) {
            return view('uapb.master.index', compact(['menu', 'satker']));
        }
        
        $satkerId = $request->satker;
        $item = $this->repository->getAsetBySatker($satkerId);
        
        return view('uapb.master.index', compact(['menu', 'satker', 'item', 'satkerId']));
    }
}
