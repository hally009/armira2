<?php

use Illuminate\Database\Seeder;
use App\Models\Satker;
use Illuminate\Support\Str;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ini_set('memory_limit', '-1');

        $dataSatker = __DIR__.'/../../resources/ref_database/satker.sql';
        DB::unprepared(file_get_contents($dataSatker));

        $contents = Satker::get();
        foreach($contents as $item) {
            $user = [
                'name'              => $item->name,
                'email'             => Str::snake(Str::lower($item->name)).'@email.com',
                'email_verified_at' => now(),
                'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role'              => 1,
            ];
            $item->user()->create($user);
        }
        
        
        $data = [
            // table user
            [
                'name'              => 'Admin Uapb',
                'email'             => 'uapb@email.com',
                'email_verified_at' => now(),
                'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role'              => 2,
            ],
            [
                'name'              => 'Admin Apip',
                'email'             => 'apip@email.com',
                'email_verified_at' => now(),
                'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role'              => 3,
            ],
        ];

        $satker = [
            [
                'name'               => 'Bkkbn Jakarta',
                'alamat'             => 'DKI Jakarta',
                'pejabat_pengesahan' => 'DR. Amir Hamzah, MM',
                'role'               => 2,
            ],
            [
                'name'               => 'Bkkbn Jakarta',
                'alamat'             => 'DKI Jakarta',
                'pejabat_pengesahan' => 'DR. Amir Hamzah, MM',
                'role'               => 3,
            ],
        ];
        
        foreach($satker as $key => $value) {
            $satker = Satker::create($value);
            $satker->user()->create($data[$key]);
        }
    }
}
