<?php

namespace App\Http\Controllers\Satker;

use App\Http\Controllers\Controller;
use App\Http\Repositories\MasterRepository as Master;
use App\Http\Repositories\PengadaanRepository as Repository;
use App\Http\Repositories\ProfileRepository as Profile;
use App\Http\Services\PengadaanService as Service;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class PengadaanController extends Controller
{
    protected $repository;
    protected $service;
    protected $profile;
    protected $master;

    public function __construct(Repository $repository, Service $service, Profile $profile, Master $master)
    {
        $this->repository = $repository;
        $this->service = $service;
        $this->profile = $profile;
        $this->master = $master;
    }

    public function index()
    {
        $periode = $this->profile->getPeriode([
            'status' => get_status('aktif'),
        ])->first();

        $satker = $this->profile->getUserSatker();
        $pegawai = $this->profile->getPegawai();

        if ($pegawai->count() == 0) {
            return redirect()->route('Satker::pegawai.index')
                ->withWarning('Silahkan input data Pegawai Satker terlebih dahulu');
        }

        $aset = $this->master->getAsetBySatker($satker->id);

        if (!$aset) {
            return redirect()->route('Satker::master.index')
                ->withWarning('Silahkan perbarui data aset terlebih dahulu');
        }

        $aset = json_decode($aset->content, true);
        $items = $this->repository->getPengadaanBySatker(session('tahun'));
        
        $temp = $periode ? $this->repository->getTempPengadaan($periode->tahun) : null;
        $usulanRakbm = [];

        if ($temp) {
            $usulanRakbm = json_decode($temp->usulan_rakbm, true);
        }

        $argumen = [
            'with' => ['produk', 'detail'],
            'status' => get_status('aktif'),
        ];

        $produkSbsk = $this->profile->getSbsk();
        $menu = get_home_menu()['perencanaan']['child'];
        return view('satker.pengadaan.index', compact([
            'menu',
            'items',
            'temp',
            'produkSbsk',
            'pegawai',
            'aset',
            'usulanRakbm',
            'periode',
        ]));
    }

    public function show(Request $request, $id)
    {
        $satker = Auth::user()->satker;

        $argumen = [
            'with' => ['pengadaanAlur', 'pengadaanRakbm', 'pengadaanFile', 'satker'],
        ];

        $item = $this->repository->getSinglePengadaan($id, $argumen);

        if (!$item || $item->satker_id != $satker->id) {
            return redirect()->route('Satker::pengadaan.index')
                ->withWarning('Data tidak ditemukan');
        }

        $produkSbsk = $this->profile->getSbsk();
        $files = $item->pengadaanFile->pluck('file', 'name')->all();
        $rakbm = $item->pengadaanRakbm->keyBy('produk_id');
        $menu = get_home_menu()['perencanaan']['child'];

        return view('satker.pengadaan.show', compact([
            'menu',
            'item',
            'files',
            'rakbm',
            'produkSbsk',
        ]));
    }

    public function store(Request $request)
    {
        $periode = $this->profile->getPeriode([
            'status' => get_status('aktif'),
        ])->first();

        if (!$periode) {
            return redirect()->route('Satker::pengadaan.index')->withError('Pengajuan Perencanaan SBSK telah ditutup');
        }

        $item = $this->repository->getLastPengadaan();

        $temp = $this->repository->getTempPengadaan($periode->tahun);
        if (!$temp->file) {
            return redirect()->route('Satker::pengadaan.index')->withError('Pengajuan Gagal, Dokumen Belum diupload');
        }

        $dataStore = [
            'periode' => $temp->periode,
            'nama' => $temp->nama_usulan,
            'kode_transaksi' => $item && $item->kode_transaksi ? $item->next_kode : default_kode(),
            'status_progress' => get_status('non-aktif'),
            'status_pengesahan' => get_status('non-aktif'),
            'kepada' => roles('uapb'),
        ];

        try {
            $pengadaan = $this->service->storePengadaan($dataStore, $temp);

            $this->storeNotif([
                'role' => roles('uapb'),
                'dari' => roles('satker'),
                'content' => 'Permohonan pengajuan pengadaan BMN Satker ' . Auth::user()->satker->name,
                'link' => route('Uapb::pengadaan.show', $pengadaan->id),
            ]);

            $temp->delete();

            return redirect()->route('Satker::pengadaan.index')->withSuccess('Pengajuan Perencanaan SBSK berhasil dikirim');
        } catch (\Exception$e) {
            return redirect()->back()->withError($e->getMessage())->withInput();
        }
    }

    public function result()
    {
        $temp = $this->repository->getTempPengadaan(date('Y'));
        $produkSbsk = $this->profile->getSbsk();

        return view('satker.pengadaan.result', compact(['temp', 'produkSbsk']));
    }

    public function draftPerbaikan(Request $request, $id)
    {
        $satker = Auth::user()->satker;

        $argumen = [
            'with' => ['pengadaanAlur', 'pengadaanRakbm.produk', 'pengadaanFile', 'satker'],
        ];

        $pengadaan = $this->repository->getSinglePengadaan($id, $argumen);
        
        if ($pengadaan->status_progress != get_status_alur('perbaikan') && 
            $pengadaan->status_progress != get_status_alur('on-progress')) {
            return false;
        }

        if (!$pengadaan || $pengadaan->satker_id != $satker->id) {
            return redirect()->route('Satker::pengadaan.index')
                ->withWarning('Data tidak ditemukan');
        }

        $pegawai = $this->profile->getPegawai();

        if ($pegawai->count() == 0) {
            return redirect()->route('Satker::pegawai.index')
                ->withWarning('Silahkan input data Pegawai Satker terlebih dahulu');
        }

        $aset = $this->master->getAsetBySatker($satker->id);
        if (!$aset) {
            return redirect()->route('Satker::master.index')
                ->withWarning('Silahkan perbarui data aset terlebih dahulu');
        }

        $aset = json_decode($aset->content, true);
        $produkSbsk = $this->profile->getSbsk();
        $files = $pengadaan->pengadaanFile->pluck('file', 'name')->all();
        $rakbm = $pengadaan->pengadaanRakbm->keyBy('produk_id');

        return view('satker.pengadaan.perbaikan', compact([
            'pengadaan',
            'files',
            'rakbm',
            'aset',
            'pegawai',
            'produkSbsk',
        ]));
    }

    public function uploadPerbaikan(Request $request, $id, $nama)
    {
        $file = Arr::flatten($request->file());

        if (count($file) == 0) {
            return false;
        }

        $argumen = [
            'with' => ['pengadaanFile'],
        ];

        $pengadaan = $this->repository->getSinglePengadaan($id, $argumen);
        $pengadaanFile = $pengadaan->pengadaanFile->where('name', $nama)->first();

        $argumen = [
            'direktory' => 'file/pengadaan',
            'lastname' => time(),
        ];

        $upload = $this->service->uploadFile($file[0], $nama, $argumen);

        if ($pengadaanFile) {
            @unlink(public_path($pengadaanFile->file));
            $pengadaanFile->fill($upload)->save();
            $file = $pengadaanFile->file;
            return view('component.embed', compact('file'));
        }

        $create = $pengadaan->pengadaanFile()->create([
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
            'with' => ['pengadaanAlur', 'pengadaanRakbm', 'pengadaanFile', 'satker'],
        ];

        $item = $this->repository->getSinglePengadaan($id, $argumen);
        $request = $request->except('_method', '_token');
        $alur = $item->pengadaanAlur->last();

        if ($item->status_progress != get_status_alur('perbaikan') && 
            $item->status_progress != get_status_alur('on-progress')) {
            return redirect()->back()->withError('Data tidak ditemukan')->withInput();
        }

        // if ((!$alur || $alur->status != get_status_alur('perbaikan'))) {
        //     return redirect()->back()->withError('Data tidak ditemukan')->withInput();
        // }

        $sequence = $alur->sequence + 1;
        try {
            // update rakbm
            foreach ($request as $key => $value) {
                list($nama, $idRakbm) = explode("_", $key);

                if ($nama == 'usulan') {
                    $rakbm = $item->pengadaanRakbm->where('id', $idRakbm)->first();

                    $dataUpdate = [
                        'total' => $value,
                        'peluang_setuju' => $this->service->peluangRakbm($value, $rakbm),
                    ];

                    $rakbm->fill($dataUpdate)->save();
                }
            }

            // insert alur
            $argumen = [
                'status' => get_status_alur('on-progress'),
                'kepada' => roles('uapb'),
                'dari' => roles('satker'),
                'keterangan' => 'Pengajuan anda telah diterima oleh UAPB dan sedang diperiksa kelengkapan dokumen',
            ];

            $this->service->storePengadaanAlur($item, $sequence, $argumen);

            // update pengadaan
            $dataStatus = [
                'status_progress' => get_status_alur('on-progress'),
                'kepada' => roles('uapb'),
                'nama' => $request['nama_usulan'],
            ];

            $this->service->updateStatusPengadaan($item, $dataStatus);

            // insert log
            $this->storeNotif([
                'role' => roles('uapb'),
                'dari' => roles('satker'),
                'content' => 'Permohonan pengajuan perbaikan pengadaan BMN Satker ' . Auth::user()->satker->name,
                'link' => route('Uapb::pengadaan.show', $item->id),
            ]);

            return redirect()->route('Satker::pengadaan.index')->withSuccess('Perbaikan Perencanaan SBSK berhasil dikirim');
        } catch (\Exception$e) {
            return redirect()->back()->withError($e->getMessage())->withInput();
        }
    }

    public function destroy(Request $request, $id)
    {
        $argumen = [
            'with' => ['pengadaanAlur', 'pengadaanRakbm', 'pengadaanFile'],
        ];

        $item = $this->repository->getSinglePengadaan($id, $argumen);

        if (!$item || 
            !$item->isDeletable() ||
            !$item->isOwner()
        ) {
            return redirect()->back()->withError('Data tidak ditemukan')->withInput();
        }
        
        try {
            //detete pengadaan alur
            $item->pengadaanAlur()->delete();
            
            //delete pengadaan Rakbm
            $item->pengadaanRakbm()->delete();
            
            // delete pengadaanfile
            if($item->pengadaanFile->count() > 0) {
                foreach($item->pengadaanFile as $pengadaanFile) {
                    @unlink(public_path($pengadaanFile->file));
                }
                $item->pengadaanFile()->delete();
            }

            //delete pengadaan
            $item->delete();
            return redirect()->route('Satker::pengadaan.index')->withSuccess('Hapus Pengadaan berhasil');
        } catch (\Exception$e) {
            return redirect()->back()->withError($e->getMessage())->withInput();
        }
    }
}
