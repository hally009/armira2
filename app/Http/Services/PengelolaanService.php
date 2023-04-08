<?php
namespace App\Http\Services;

use Illuminate\Support\Arr;
use App\Models\Pengelolaan;
use App\Models\PengelolaanTemp;
use Auth;
use File;

class PengelolaanService
{
    public function uploadFile($file, $name, $argumen = false)
    {
        $satker = Auth::user()->satker;

        $directoryName = 'file_temp';
        $lastName = '';
        
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
        
        if ($argumen && Arr::has($argumen, 'dokumen_id') && Arr::has($argumen, 'kategori_id')) {
            $lastName = '_'.$argumen['dokumen_id'].'_'.$argumen['kategori_id'];
        }

        $fileName = $name . '_' . $satker->id . $lastName . '.' . $file->getClientOriginalExtension();
        $file->move($directory, $fileName);

        $resultFile = $directoryName . '/' . $fileName;

        return [
            'file' => $resultFile,
        ];
    }

    public function storePengelolaanTemp($dataSave)
    {
        $satker = Auth::user()->satker;
        $temp = new PengelolaanTemp();
        $temp->satker()->associate($satker)->fill($dataSave)->save();

        return $temp;
    }

    public function storePengelolaan($dataSave, $temp)
    {
        $sequence = 1;
        $statusAlur = status_alur_pengelolaan('periksa');
        $satker = Auth::user()->satker;
        $pengelolaan = new Pengelolaan();
        $pengelolaan->satker()->associate($satker)->fill($dataSave)->save();

        $this->storePengelolaanForm($pengelolaan, $temp);
        if($temp->file) {
            $this->storePengelolaanFile($pengelolaan, $temp);
        }

        $argumen = [
            'status' => get_status_alur('on-progress'),
            'kepada' => roles('uapb'),
            'dari' => roles('satker'),
            'keterangan' => 'Pengajuan anda telah diterima oleh UAPB dan sedang diperiksa kelengkapan dokumen',
        ];
        $this->storePengelolaanAlur($pengelolaan, $sequence, $argumen);

        return $pengelolaan;
    }

    public function storePengelolaanAlur($pengelolaan, $sequence, $argumen)
    {
        $data = [
            'sequence' => $sequence,
            'status' => $argumen['status'],
            'kepada' => $argumen['kepada'],
            'dari' => $argumen['dari'],
            'keterangan' => $argumen['keterangan'],
            'tanggal_status' => date('Y-m-d'),
        ];

        $pengelolaan->pengelolaanAlur()->create($data);
    }

    public function storePengelolaanForm($pengelolaan, $temp)
    {
        $data = [
            'form' => $temp->form,
        ];

        $pengelolaan->pengelolaanForm()->create($data);
    }

    public function storePengelolaanFile($pengelolaan, $temp)
    {
        $dataFile = json_decode($temp->file, true);
        $directoryName = 'file/pengelolaan/';
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

            $pengelolaan->pengelolaanFile()->create($dataStore);
        }

    }

    public function updateStatusPengelolaan($pengelolaan, $dataStatus)
    {
        $pengelolaan->fill($dataStatus)->save();
    }

    public function uploadPengesahan($file, $name, $pengelolaan)
    {
        $satker = $pengelolaan->satker_id;

        $directoryName = 'file/pengesahan';
        $directory = public_path($directoryName);

        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $fileName = $name . '_' . $satker . '_' . time() . '.' . $file->getClientOriginalExtension();
        $file->move($directory, $fileName);

        $resultFile = $directoryName . '/' . $fileName;

        return [
            'file' => $resultFile,
        ];
    }

}
