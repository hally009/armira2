<?php
namespace App\Http\Repositories;

use App\Models\Pengelolaan;
use App\Models\PengelolaanTemp;
use Auth;
use Illuminate\Support\Arr;

class PengelolaanRepository
{
    public function getSinglePengelolaan($id, $argumen = false)
    {
        $pengelolaan = new Pengelolaan();
        if ($argumen && Arr::has($argumen, 'with')) {
            $pengelolaan = $pengelolaan->with($argumen['with']);
        }
        return $pengelolaan->find($id);
    }

    public function getLastPengelolaan()
    {
        return Pengelolaan::latest()->first();
    }

    public function getTahunPengelolaan($tahun, $argumen = false)
    {
        $pengelolaan = new Pengelolaan();

        if ($argumen && Arr::has($argumen, 'with')) {
            $pengelolaan = $pengelolaan->with($argumen['with']);
        }

        if ($argumen && Arr::has($argumen, 'withCount')) {
            $pengelolaan = $pengelolaan->withCount($argumen['withCount']);
        }

        if ($argumen && Arr::has($argumen, 'jenis')) {
            $pengelolaan = $pengelolaan->byJenis($argumen['jenis']);
        }

        if ($argumen && Arr::has($argumen, 'kepada')) {
            $pengelolaan = $pengelolaan->byKepada($argumen['kepada']);
        }

        if ($argumen && Arr::has($argumen, 'order')) {
            $pengelolaan = $pengelolaan->orderBy($argumen['order'][0], $argumen['order'][1]);
        }

        return $pengelolaan->byPeriode($tahun)->paginate(10);
    }

    public function getSatkerPengelolaan($jenis, $tahun)
    {
        $satker = Auth::user()->satker;

        $pengelolaan = $satker->pengelolaan()
            ->with(['pengelolaanFile', 'pengelolaanForm'])
            ->byPeriode($tahun)
            ->byJenis($jenis)
            ->paginate(10);

        return $pengelolaan;
    }

    public function getTempPengelolaan($jenis, $tahun, $argumen = false)
    {
        $satker = Auth::user()->satker;
        $temp = $satker->pengelolaanTemp()
            ->byPeriode($tahun)
            ->byJenis($jenis);
        if($argumen && Arr::has($argumen, 'dokumen_id')) {
            $temp = $temp->byDokumen($argumen['dokumen_id']);
        }

        if($argumen && Arr::has($argumen, 'kategori_id')) {
            $temp = $temp->byKategori($argumen['kategori_id']);
        }
        
        return $temp->first();
    }
}
