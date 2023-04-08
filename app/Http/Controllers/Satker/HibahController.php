<?php

namespace App\Http\Controllers\Satker;

use App\Http\Controllers\Controller;
use App\Http\Repositories\PengelolaanRepository as Repository;
use App\Http\Services\PengelolaanService as Service;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class HibahController extends Controller
{
    protected $repository;
    protected $service;

    public function __construct(Repository $repository, Service $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    public function index()
    {
        $menu = get_home_menu()['pengelolaan']['child'];
        $items = $this->repository->getSatkerPengelolaan(jenis_pengelolaan('hibah'), date('Y'));
        $temp = $this->repository->getTempPengelolaan(jenis_pengelolaan('hibah'), date('Y'));

        return view('satker.hibah.index', compact(['menu', 'items', 'temp']));
    }

    public function show(Request $request, $id)
    {
        $menu = get_home_menu()['pengelolaan']['child'];
        $argumen = [
            'with' => ['pengelolaanAlur', 'pengelolaanForm'],
        ];

        $item = $this->repository->getSinglePengelolaan($id, $argumen);
        $alur = $item->pengelolaanAlur;

        return view('satker.hibah.show', compact(['menu', 'item', 'alur']));
    }

    public function store(Request $request)
    {
        $item = $this->repository->getLastPengelolaan();
        $temp = $this->repository->getTempPengelolaan(jenis_pengelolaan('hibah'), date('Y'));
        
        if (!$temp->file) {
            return redirect()->route('Satker::hibah.index')->withError('Pengajuan Gagal, Dokumen Belum diupload');
        }

        $dataStore = [
            'periode' => $temp->periode,
            'jenis' => $temp->jenis,
            'kode_transaksi' => $item && $item->kode_transaksi ? $item->next_kode : default_kode(),
            'status_progress' => get_status_alur('on-progress'),
            'status_pengesahan' => get_status_alur('on-progress'),
            'kepada' => roles('uapb'),
        ];

        try {
            $pengelolaan = $this->service->storePengelolaan($dataStore, $temp);
            $temp->delete();

            $this->storeNotif([
                'role' => roles('uapb'),
                'dari' => roles('satker'),
                'content' => 'Permohonan pengajuan Hibah BMN Satker ' . Auth::user()->satker->name,
                'link' => route('Uapb::hibah.show', $pengelolaan->id),
            ]);

            return redirect()->route('Satker::hibah.index')->withSuccess('Pengajuan Hibah berhasil dikirim');
        } catch (\Exception$e) {
            return redirect()->back()->withError($e->getMessage())->withInput();
        }
    }

    public function result()
    {
        $temp = $this->repository->getTempPengelolaan(jenis_pengelolaan('hibah'), date('Y'));

        return view('satker.hibah.result', compact(['temp']));
    }

    public function draftPerbaikan(Request $request, $id)
    {
        $satker = Auth::user()->satker;

        $argumen = [
            'with' => ['pengelolaanAlur', 'pengelolaanForm', 'pengelolaanFile'],
        ];

        $item = $this->repository->getSinglePengelolaan($id, $argumen);
        if ($item->status_progress != get_status_alur('perbaikan') && 
            $item->status_progress != get_status_alur('on-progress')) {
            return false;
        }

        if (!$item || $item->satker_id != $satker->id) {
            return redirect()->route('Satker::hibah.index')
                ->withWarning('Data tidak ditemukan');
        }

        return view('satker.hibah.perbaikan', compact(['item']));
    }

    public function uploadPerbaikan(Request $request, $id, $nama)
    {
        $file = Arr::flatten($request->file());
        if (count($file) == 0) {
            return false;
        }

        $argumen = [
            'with' => ['pengelolaanFile'],
        ];

        $pengelolaan = $this->repository->getSinglePengelolaan($id, $argumen);
        $pengelolaanFile = $pengelolaan->pengelolaanFile->where('name', $nama)->first();

        $argumen = [
            'direktory' => 'file/pengelolaan',
            'lastname' => time(),
        ];

        $upload = $this->service->uploadFile($file[0], $nama, $argumen);

        if ($pengelolaanFile) {
            @unlink(public_path($pengelolaanFile->file));
            $pengelolaanFile->fill($upload)->save();

            $file = $pengelolaanFile->file;
            return view('component.embed', compact('file'));
        }

        $create = $pengelolaan->pengelolaanFile()->create([
            'name' => $nama,
            'file' => $upload['file'],
        ]);
        $file = $create->file;
        return view('component.embed', compact(['file']));

    }

    public function updatePerbaikan(Request $request, $id)
    {
        $satker = Auth::user()->satker;
        $argumen = [
            'with' => ['pengelolaanAlur', 'pengelolaanForm', 'satker'],
        ];

        $item = $this->repository->getSinglePengelolaan($id, $argumen);

        if ($item->status_progress != get_status_alur('perbaikan') && 
            $item->status_progress != get_status_alur('on-progress')) {
                return redirect()->route('Satker::hibah.index')
                ->withWarning('Data tidak ditemukan');
        }

        if (!$item || $item->satker_id != $satker->id) {
            return redirect()->route('Satker::hibah.index')
                ->withWarning('Data tidak ditemukan');
        }

        $request = $request->except('_method', '_token');

        $alur = $item->pengelolaanAlur->last();
        if (!$alur || $alur->status != get_status_alur('perbaikan')) {
            return redirect()->back()->withError('Data tidak ditemukan')->withInput();
        }

        $sequence = $alur->sequence + 1;
        try {
            // update form
            $dataUpdate = [
                'form' => json_encode($request)
            ];
            $item->pengelolaanForm->fill($dataUpdate)->save();
            
            // insert alur
            $argumen = [
                'status' => get_status_alur('on-progress'),
                'kepada' => roles('uapb'),
                'dari' => roles('satker'),
                'keterangan' => 'Pengajuan anda telah diterima oleh UAPB dan sedang diperiksa kelengkapan dokumen',
            ];
            $this->service->storePengelolaanAlur($item, $sequence, $argumen);

            // update pengelolaan
            $dataStatus = [
                'status_progress' => get_status_alur('on-progress'),
                'kepada' => roles('uapb'),
            ];

            $this->service->updateStatusPengelolaan($item, $dataStatus);

            // insert log
            $this->storeNotif([
                'role' => roles('uapb'),
                'dari' => roles('satker'),
                'content' => 'Permohonan pengajuan perbaikan HIBAH BMN Satker ' . Auth::user()->satker->name,
                'link' => route('Uapb::hibah.show', $item->id),
            ]);

            return redirect()->route('Satker::hibah.index')->withSuccess('Perbaikan perbaikan HIBAH BMN berhasil dikirim');
        } catch (\Exception$e) {
            return redirect()->back()->withError($e->getMessage())->withInput();
        }
    }

    public function destroy(Request $request, $id)
    {
        $argumen = [
            'with' => ['pengelolaanAlur', 'pengelolaanForm', 'pengelolaanFile'],
        ];

        $item = $this->repository->getSinglePengelolaan($id, $argumen);
        
        if (!$item || 
            !$item->isDeletable() ||
            !$item->isOwner()
        ) {
            return redirect()->back()->withError('Data tidak ditemukan')->withInput();
        }
        
        try {
            //detete pengelolaan alur
            $item->pengelolaanAlur()->delete();
            
            //delete pengelolaan Form
            $item->pengelolaanForm()->delete();
            
            // delete pengelolaanfile
            if($item->pengelolaanFile->count() > 0) {
                foreach($item->pengelolaanFile as $pengelolaanFile) {
                    @unlink(public_path($pengelolaanFile->file));
                }
                $item->pengelolaanFile()->delete();
            }

            //delete pengelolaan
            $item->delete();
            return redirect()->route('Satker::hibah.index')->withSuccess('Hapus Pengelolaan berhasil');
        } catch (\Exception$e) {
            return redirect()->back()->withError($e->getMessage())->withInput();
        }
    }
}
