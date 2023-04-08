<?php
namespace App\Http\Services;

use Illuminate\Support\Arr;
use App\Models\Pengadaan;
use App\Models\PengadaanRakbm;
use App\Models\PengadaanTemp;
use Auth;
use File;

class PengadaanService
{
    public function uploadFile($file, $name, $argumen = false)
    {
        $satker = Auth::user()->satker;
        $lastName = '';
        $directoryName = 'file_temp';
        if ($argumen && Arr::has($argumen, 'direktory')) {
            $directoryName = $argumen['direktory'];
        }

        if ($argumen && Arr::has($argumen, 'lastname')) {
            $lastName = '_'.$argumen['lastname'];
        }


        $directory = public_path($directoryName);

        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $fileName = $name . '_' . $satker->id . $lastName . '.' . $file->getClientOriginalExtension();
        $file->move($directory, $fileName);

        $resultFile = $directoryName . '/' . $fileName;

        return [
            'file' => $resultFile,
        ];
    }

    public function storePengadaanTemp($dataSave)
    {
        $satker = Auth::user()->satker;
        $temp = new PengadaanTemp();
        $temp->satker()->associate($satker)->fill($dataSave)->save();

        return $temp;
    }

    public function storePengadaan($dataSave, $temp)
    {
        $sequence = 1;
        $satker = Auth::user()->satker;
        $pengadaan = new Pengadaan();
        $pengadaan->satker()->associate($satker)->fill($dataSave)->save();

        $argumen = [
            'status' => get_status_alur('on-progress'),
            'kepada' => roles('uapb'),
            'dari' => roles('satker'),
            'keterangan' => 'Pengajuan anda telah diterima oleh UAPB dan sedang diperiksa kelengkapan dokumen',
        ];
        $this->storePengadaanAlur($pengadaan, $sequence, $argumen);
        $this->pengadaanRakbm($pengadaan, $temp);
        if($temp->file) {
            $this->storePengadaanFile($pengadaan, $temp);
        }
        return $pengadaan;
    }

    public function pengadaanRakbm($pengadaan, $temp)
    {
        $usulan = json_decode($temp->usulan_rakbm, true);
        foreach($usulan as $produkId => $item) {
            $dataStore = [
                'produk_id' => $produkId,
                'sbsk_bmn' => $item['sbsk'],
                'existing_bmn' => $item['aset'],
                'kebutuhan' => $item['riil'],
                'total' => $item['usulan'],
                'peluang_setuju' => $item['peluang'],
                'status' => get_status_alur('on-progress')
            ];
            $pengadaan->pengadaanRakbm()->create($dataStore);
        }
    }

    public function storePengadaanAlur($pengadaan, $sequence, $argumen)
    {
        $data = [
            'sequence' => $sequence,
            'status' => $argumen['status'],
            'kepada' => $argumen['kepada'],
            'dari' => $argumen['dari'],
            'keterangan' => $argumen['keterangan'],
            'tanggal_status' => date('Y-m-d'),
        ];

        $pengadaan->pengadaanAlur()->create($data);
    }

    public function storePengadaanFile($pengadaan, $temp)
    {
        $dataFile = json_decode($temp->file, true);
        $directoryName = 'file/pengadaan/';
        $directory = public_path($directoryName);

        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        foreach ($dataFile as $nama => $file) {
            $moveFile = explode("/", $file);
            $resultFile = $directoryName . $moveFile[1];
            $newName = explode(".", $moveFile[1]);
            $resultNewFile = $directoryName . $newName[0] . '_' . time() . '.' . $newName[1];
            File::move(public_path($file), public_path($resultFile));
            rename(public_path($resultFile), public_path($resultNewFile));

            $dataStore = [
                'name' => $nama,
                'file' => $resultNewFile,
            ];

            $pengadaan->pengadaanFile()->create($dataStore);
        }
    }

    public function updateStatusPengadaan($pengadaan, $dataStatus)
    {
        $pengadaan->fill($dataStatus)->save();
    }

    public function uploadPengesahan($file, $name)
    {
        $directoryName = 'file/pengesahan';
        $directory = public_path($directoryName);

        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $fileName = $name .  '_' . time() . '.' . $file->getClientOriginalExtension();
        $file->move($directory, $fileName);

        $resultFile = $directoryName . '/' . $fileName;

        return [
            'file' => $resultFile,
        ];
    }

    public function peluangRakbm($usulan, $rakbm) {
        $peluang = 0;
        if(!$usulan) {
            return $peluang;
        }

        $riil = $rakbm->kebutuhan;
        if($usulan <= $riil) {
            return $usulan;
        }

        $peluang = $riil - $usulan;
        if($peluang > 0) {
            return $peluang;
        }

        return $riil;
    }

}
