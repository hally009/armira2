<?php
namespace App\Http\Repositories;

use Auth;
use App\Models\AsetBmn;

class MasterRepository
{
    public function getMasterByUser()
    {
        $satker = Auth::user()->satker;

        return $satker->aset;
    }

    public function getAsetBySatker($satker)
    {
        return AsetBmn::bySatker($satker)->first();
    }
}