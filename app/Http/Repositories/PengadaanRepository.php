<?php
namespace App\Http\Repositories;

use Illuminate\Support\Arr;
use App\Models\Pengadaan;
use Auth;

class PengadaanRepository
{

    public function getSinglePengadaan($id, $argumen)
    {
        $pengadaan = new Pengadaan();
        if ($argumen && Arr::has($argumen, 'with')) {
            $pengadaan = $pengadaan->with($argumen['with']);
        }
        return $pengadaan->find($id);
    }

    public function getTahunPengadaan($tahun, $argumen = false, $all = false)
    {
        $pengadaan = new Pengadaan();

        if ($argumen && Arr::has($argumen, 'with')) {
            $pengadaan = $pengadaan->with($argumen['with']);
        }

        if ($argumen && Arr::has($argumen, 'withCount')) {
            $pengadaan = $pengadaan->withCount($argumen['withCount']);
        }

        if ($argumen && Arr::has($argumen, 'kepada')) {
            $pengadaan = $pengadaan->byKepada($argumen['kepada']);
        }

        if($argumen && Arr::has($argumen, 'statusApip')){
            $pengadaan = $pengadaan->byStatusApip($argumen['statusApip']);
        }
        
        if($argumen && Arr::has($argumen, 'statusProgress')){
            $pengadaan = $pengadaan->byStatusProgress($argumen['statusProgress']);
        }

        if ($argumen && Arr::has($argumen, 'order')) {
            $pengadaan = $pengadaan->orderBy($argumen['order'][0], $argumen['order'][1]);
        }

        if($all) {
            return $pengadaan->byPeriode($tahun)->get();
        }


        return $pengadaan->byPeriode($tahun)->paginate(10);
    }

    public function getPengadaanBySatker($tahun, $argumen = false)
    {
        $satker = Auth::user()->satker;
        $pengadaan = $satker->pengadaan()->byPeriode($tahun);

        return $pengadaan->paginate(10);
    }

    public function getTempPengadaan($tahun, $argumen = false)
    {
        $satker = Auth::user()->satker;
        $temp = $satker->pengadaanTemp()
            ->byPeriode($tahun);
        
        return $temp->first();
    }

    public function getLastPengadaan()
    {
        return Pengadaan::latest()->first();
    }

    public function setUsulanTemp($sbsk, $pegawai, $aset, $dataForm)
    {
        $dataSbsk = [];
        foreach ($sbsk as $item) {
            $countSbsk = sbsk_bmn($item->sbsk, $pegawai);
            $countAset = array_key_exists($item->kode_barang, $aset) ? $aset[$item->kode_barang] : 0;
            $countRiil = kebutuhan_riil($countSbsk, $countAset);

            $usulan = intval($dataForm['usulan_'.$item->id]);
            
            $countPeluang = $usulan;
            if($usulan >  $countRiil) {
                $peluang = $countRiil - $usulan;
                $countPeluang = ($peluang > 0) ? $peluang : $countRiil;
            }
            
            $dataSbsk[$item->id] = [
                'sbsk' => $countSbsk,
                'aset' => $countAset,
                'riil' => $countRiil,
                'usulan' => $usulan,
                'peluang' => $countPeluang
            ];
        }


        return $dataSbsk;
    }

    function forDetailPengadaan($periode, $approval) {
        return [
            'with' => ['pengadaan' => function($query) use($approval) {
                return $query->with(['pengadaanRakbm' => function($q) use($approval) {
                    return $q->with(['produk'])->byStatus($approval);
                }]);
            }],
            'hasPengadaan' => [
                'tahun' => $periode->tahun,
                'statusProgress' => get_status_alur('disetujui'),
                'statusApip' => get_status_alur('disetujui'),
                'hasRakbm' => [
                    'status' => $approval,
                ]
            ],
        ];
    }
}
