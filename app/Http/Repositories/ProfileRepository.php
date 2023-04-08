<?php
namespace App\Http\Repositories;

use App\Models\RefPeriode;
use App\Models\RefProduk;
use App\Models\RefStruktur;
use App\Models\Satker;
use App\Models\SatkerStruktur;
use App\Models\Sbsk;
use App\Models\RekapAset;
use App\User;
use Auth;
use Illuminate\Support\Arr;

class ProfileRepository
{
    public function getRefSatker($id = false, $argumen = false)
    {
        if ($id) {
            return Satker::find($id);
        }
        return Satker::whereNotNull('kode')->get();
    }

    public function getRefStruktur($id = false, $argumen = false)
    {
        if ($id) {
            return RefStruktur::find($id);
        }

        return RefStruktur::all();
    }

    public function getRekapAset($satkerId = false, $argumen = false)
    {
        if ($satkerId) {
            return RekapAset::whereSatkerId($satkerId)->first();
        }

        return RekapAset::all();
    }

    public function getUsers($argumen = false)
    {
        return User::with('satker')->get();
    }

    public function getUsersSatker($argumen = false, $paginate = false)
    {
        $user = User::with('satker')->whereIn('role', [roles('satker')]);

        if($paginate){
            return $user->paginate();
        }
        return $user->get();
    }

    public function getOperatorSatker($argumen = false)
    {
        return User::with('satker')
            ->whereIn('role', [roles('operator_satker')])
            ->whereSatkerId(auth()->user()->satker_id)
            ->get();
    }

    public function getUserById($id)
    {
        return User::with('satker')->find($id);
    }

    public function getUserSatker($argumen = false)
    {
        return Auth::user()->satker;
    }

    public function getPegawai($argumen = false)
    {
        $satker = Auth::user()->satker;
        return SatkerStruktur::bySatker($satker->id)->with('ref')->get();
    }

    public function getPegawaiSatker($satker, $argumen = false)
    {
        return SatkerStruktur::bySatker($satker)->with('ref')->get();
    }

    public function getSinglePegawai($id)
    {
        return SatkerStruktur::find($id);
    }

    public function getPeriode($argumen = false)
    {
        $periode = new RefPeriode();

        if ($argumen && Arr::has($argumen, 'status')) {
            $periode = $periode->byStatus($argumen['status']);
        }
        return $periode->get();
    }

    public function getPeriodeExclude($id)
    {
        return RefPeriode::whereNotIn('id', [$id])->get();
    }

    public function getSinglePeriode($id)
    {
        return RefPeriode::find($id);
    }

    public function getSbsk($argumen = false)
    {
        return RefProduk::with(['sbsk'])->byStatus(get_status('aktif'))->get();
    }

    public function getSingleSbsk($id, $argumen = false)
    {
        return Sbsk::find($id);
    }

    public function getSatker($argumen = false)
    {
        $satker = new Satker();

        if ($argumen && Arr::has($argumen, 'with')) {
            $satker = $satker->with($argumen['with']);
        }

        if ($argumen && Arr::has($argumen, 'hasPengadaan')) {
            $satker = $satker->whereHas('pengadaan', function ($query) use ($argumen) {
                $arg = $argumen['hasPengadaan'];

                if (Arr::has($arg, 'statusApip')) {
                    $query = $query->byStatusApip($arg['statusApip']);
                }
                if (Arr::has($arg, 'statusProgress')) {
                    $query = $query->byStatusProgress($arg['statusProgress']);
                }
                if (Arr::has($arg, 'tahun')) {
                    $query = $query->byPeriode($arg['tahun']);
                }
                // if(Arr::has($arg, 'hasRakbm')) {
                //     $query = $query->whereHas('pengadaanRakbm',  function($q) use ($arg) {
                //         return $q->byStatus($arg['hasRakbm']['status']);
                //     });
                // }
                return $query;
            });
        }

        return $satker->byRole(roles('satker'))->get();
    }

    public function getRefProduk($argumen = false)
    {
        return RefProduk::get();
    }

    public function getProdukById($id, $argumen = false)
    {
        return RefProduk::find($id);
    }
}
