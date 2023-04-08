<?php

use App\Models\RefProduk;
use App\Models\RefStruktur;
use App\Models\Sbsk;
use Illuminate\Database\Seeder;

class SbskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $produks = RefProduk::get();
        $strukturs = RefStruktur::get();

        foreach ($produks as $produk) {
            foreach($strukturs as $struktur) {
                $data = [
                    'struktur_id' => $struktur->id,
                    'produk_id' => $produk->id,
                    'total' => 0,
                ];
                $sbsk = Sbsk::create($data);
            }
        }

    }
}
