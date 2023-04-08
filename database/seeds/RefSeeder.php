<?php

use Illuminate\Database\Seeder;
use App\Models\RefPeriode;
use App\Models\RefProduk;
use App\Models\RefStruktur;

class RefSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RefPeriode::create([
            'nama' => 'Rancangan Anggaran',
            'tahun' => 2022,
            'status' => get_status('aktif'),
        ]);
        
        foreach ($this->getRefStruktur() as $item) {
            RefStruktur::create([
                'nama' => $item,
            ]);
        }

        foreach ($this->getRefProduk() as $item) {
            RefProduk::create([
                'nama' => $item['name'],
                'kode_barang' => $item['kode'],
                'status' => $item['status'],
            ]);
        }
        
    }

    public function getRefStruktur()
    {
        return [
            'Menteri / Pejabat setara Menteri',
            'Wakil Menteri',
            'Eselon IA Kepala Kantor / Setingkat',
            'Eselon IB Non. Kepala Kantor / Setingkat',
            'Eselon IB Kepala Kantor / Setingkat',
            'Eselon IIA Kepala Kantor / Setingkat',
            'Eselon IIA Non. Kepala Kantor / Setingkat',
            'Eselon IIB Kepala Kantor / Setingkat',
            'Eselon IIB Non. Kepala Kantor / Setingkat',
            'Eselon III Kepala Kantor / Setingkat',
            'Eselon III Non. Kepala Kantor / Setingkat',
            'Pejabat Fungsional Golongan IV',
            'Pejabat Fungsional Golongan III',
            'Staff / Pelaksana',
        ];
    }

    public function getRefProduk()
    {
        return [
            [
                'kode' => '3100102001',
                'name' => 'PC Unit',
                'status' => get_status('aktif')
            ],
            [
                'kode' => '3100102002',
                'name' => 'Laptop / Notebook',
                'status' => get_status('aktif')
            ],
            [
                'kode' => '3100203003',
                'name' => 'Printer',
                'status' => get_status('aktif')
            ],
            [
                'kode' => '3050105048',
                'name' => 'LCD Monitor',
                'status' => get_status('aktif')
            ],
            [
                'kode' => '3100203004',
                'name' => 'Scanner',
                'status' => get_status('aktif')
            ],
        ];
    }
}
