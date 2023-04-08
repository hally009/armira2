<?php

namespace App\Http\Controllers\Uapb;

use App\Http\Controllers\Controller;
use App\Http\Repositories\PengadaanRepository as Repository;
use App\Http\Repositories\ProfileRepository as Profile;
use App\Http\Services\PengadaanService as Service;
use Illuminate\Http\Request;
use PDF;

class PengadaanController extends Controller
{
    protected $repository;
    protected $profile;
    protected $service;

    public function __construct(Repository $repository, Profile $profile, Service $service)
    {
        $this->repository = $repository;
        $this->profile = $profile;
        $this->service = $service;
    }

    public function index()
    {
        $menu = get_home_menu()['perencanaan']['child'];

        $argumen = [
            'kepada' => roles('uapb'),
            'with' => ['satker'],
            'order' => ['id', 'desc'],
        ];

        $items = $this->repository->getTahunPengadaan(date('Y'), $argumen);

        return view('uapb.pengadaan.index', compact(['menu', 'items']));
    }

    public function show(Request $request, $id)
    {
        $menu = get_home_menu()['perencanaan']['child'];

        $argumen = [
            'with' => ['pengadaanAlur', 'pengadaanRakbm', 'pengadaanFile', 'satker'],
        ];

        $produkSbsk = $this->profile->getSbsk();
        $item = $this->repository->getSinglePengadaan($id, $argumen);
        $files = $item->pengadaanFile->pluck('file', 'name')->all();
        $rakbm = $item->pengadaanRakbm->keyBy('produk_id');

        return view('uapb.pengadaan.show', compact(['menu', 'item', 'files', 'rakbm', 'produkSbsk']));
    }

    public function update(Request $request, $id)
    {
        $argumen = [
            'with' => ['pengadaanAlur', 'pengadaanRakbm'],
        ];
        $item = $this->repository->getSinglePengadaan($id, $argumen);

        $form = $request->except(['_method', '_token']);

        $formUpdate = [];
        foreach ($form as $key => $value) {
            list($field, $produkId) = explode("_", $key);
            if ($field != 'status') {
                continue;
            }
            $formUpdate[] = [
                'produk_id' => $produkId,
                'status' => $value,
                'uapb' => $value == get_status_alur('disetujui') ? $form['uapb_' . $produkId] : 0,
                'keterangan' => $value == get_status_alur('ditolak') ? $form['keterangan_' . $produkId] : null,
            ];
        }

        if (count($formUpdate) == 0) {
            return redirect()->back()->withError('Form Tidak valid')->withInput();
        }

        if (!$item || $item->status_apip == get_status('non-aktif')) {
            return redirect()->back()->withError('Data tidak ditemukan')->withInput();
        }

        $alur = $item->pengadaanAlur->last();
        if (!$alur || $alur->kepada != roles('uapb')) {
            return redirect()->back()->withError('Data tidak ditemukan')->withInput();
        }

        $sequence = $alur->sequence + 1;

        try {
            if ($alur->status == get_status_alur('on-progress') && $alur->kepada != roles('uapb')) {
                $alur->fill([
                    'status' => get_status_alur('disetujui'),
                ])->save();
            }

            $argumen = [
                'status' => get_status_alur('on-progress'),
                'kepada' => roles('uapb'),
                'dari' => roles('uapb'),
                'keterangan' => 'Ajuan anda telah diperiksa oleh UAPB dan akan disahkan oleh UAPB',
            ];
            $this->service->storePengadaanAlur($item, $sequence, $argumen);

            foreach ($formUpdate as $update) {
                $item->pengadaanRakbm->where('produk_id', $update['produk_id'])->first()->fill($update)->save();
            }

            $this->storeNotif([
                'role' => roles('uapb'),
                'dari' => roles('uapb'),
                'content' => 'Permohonan pengajuan pengadaan BMN Satker '.$item->satker->name.' Telah diperiksa oleh UAPB',
                'link' => route('Apip::pengadaan.show', $item->id),
            ]);

            $this->storeNotif([
                'role' => roles('satker'),
                'dari' => roles('uapb'),
                'satker_id' => $item->satker->id,
                'content' => 'Permohonan pengajuan pengadaan BMN Satker '.$item->satker->name.' Telah diperiksa oleh UAPB',
                'link' => route('Satker::pengadaan.show', $item->id),
            ]);



            return redirect()->route('Uapb::pengadaan.show', $item)->withSuccess('Pengadaan approved');
        } catch (\Exception$e) {
            return redirect()->back()->withError($e->getMessage())->withInput();
        }
    }

    public function draftPengadaan()
    {
        $periode = $this->profile->getPeriode([
            'status' => get_status('aktif'),
        ])->first();

        $argumen = $this->repository->forDetailPengadaan($periode,  get_status_alur('disetujui'));
        $accepted = $this->profile->getSatker($argumen);


        $argumen = $this->repository->forDetailPengadaan($periode,  get_status_alur('ditolak'));
        $rejected = $this->profile->getSatker($argumen);
        
        if ($accepted->count() <= 0) {
            return redirect()->back()->withWarning('Belum ada pengajuan Pengadaan BMN')->withInput();
        }
        
        $pdf = PDF::loadview('uapb.pengadaan.draft', [
            'accepted' => $accepted,
            'rejected' => $rejected,
            'periode' => $periode
        ]);
        return $pdf->stream('draft-pengadaan-pdf');
    }
}
