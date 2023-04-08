<?php
namespace App\Http\Services;

use App\Models\AsetBmn;
use App\Models\RekapAset;
use Auth;
use File;
use Rap2hpoutre\FastExcel\FastExcel;

class MasterService
{
    public function uploadFile($file, $mime)
    {
        $satker = Auth::user()->satker;

        if (!cek_mime($file, $mime)) {
            return ['hasError' => 'Format file salah Coooooooyyyyyy'];
        }

        $directoryName = 'file_temp';
        $directory = public_path($directoryName);

        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $fileName = 'satker_' . $satker->id . '_' . time() . '.' . $file->getClientOriginalExtension();
        $file->move($directory, $fileName);

        $resultFile = $directoryName . '/' . $fileName;

        return [
            'file' => $resultFile,
        ];
    }

    public function storeMaster($saveData)
    {
        $satker = Auth::user()->satker;
        $aset = new AsetBmn();

        $aset = $aset->satker()->associate($satker)->fill($saveData);

        return $aset->save();
    }

    public function sincronize($aset, $produk)
    {
        $directoryName = 'file/aset_bmn';
        $directory = public_path($directoryName);

        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $moveFile = explode("/", $aset->file_temp);
        $resultFile = $directoryName . '/' . $moveFile[1];
        File::move(public_path($aset->file_temp), public_path($resultFile));
        $item = public_path($resultFile);
        $content = file_exists($item) ? (new FastExcel)->import($item) : '';

        $aset = $aset->fill([
            'file' => $resultFile,
            'file_temp' => null,
            'content' => json_encode(cek_sbsk_excel($content)),
        ]);

        $rekap = rekap_excel($content);
        $arrayRekap = [
            'baik' => isset($rekap['baik']) ? $rekap['baik'] : 0,
            'rusak_berat' => isset($rekap['rusak_berat']) ? $rekap['rusak_berat'] : 0,
            'rusak_ringan' => isset($rekap['rusak_ringan']) ? $rekap['rusak_ringan'] : 0,
        ];

        RekapAset::updateOrCreate(
            ['satker_id' => $aset->satker_id],
            $arrayRekap
        );
        
        return $aset->save();
    }
}
