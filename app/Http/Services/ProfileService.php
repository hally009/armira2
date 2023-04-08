<?php
namespace App\Http\Services;

use App\Models\RefPeriode;
use App\Models\RefProduk;
use App\Models\SatkerStruktur;
use App\Models\SbskDetail;
use App\Models\Sbsk;
use App\Models\Satker;
use Auth;

class ProfileService
{

    public function storeSatkerStruktur($data)
    {
        $satker = Auth::user()->satker;
        $item = new SatkerStruktur($data);

        $item->satker()->associate($satker)->save();

        return $item;
    }

    public function storePeriode($data)
    {
        return RefPeriode::create($data);
    }

    public function storeOperatorSatker($satkerId, $data)
    {
        $satker = Satker::find($satkerId);
        $satker->user()->create($data);
    }

    public function storeProduk($data)
    {
        return RefProduk::create($data);
    }

    public function disablePeriode($id)
    {
        return RefPeriode::whereNotIn('id', [$id])->update([
            'status' => get_status('non-aktif'),
        ]);
    }

    public function storeSbsk($data)
    {
        return Sbsk::create($data);
    }

    public function updateSbskDetail($request)
    {
        foreach ($request as $keys => $value) {
            $keys = explode("-", $keys);
            Sbsk::where('id', $keys[1])
                ->update([
                    'total' => ($value)?$value:0,
                ]);
        }
    }

    public function setDefaultSbsk($sbskId)
    {
        SbskDetail::where('sbsk_id', $sbskId)
            ->update([
                'total' => 0,
            ]);
    }
}
