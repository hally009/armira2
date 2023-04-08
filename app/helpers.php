<?php
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

if (!function_exists('roles')) {
    function roles($argumen = false)
    {
        $roles = [
            'satker' => '1',
            'uapb' => '2',
            'apip' => '3',
            'operator_satker' => '4',
        ];

        if ($argumen) {
            return $roles[$argumen];
        }

        return $roles;
    }
}

if (!function_exists('human_date')) {
    function human_date($date, $format = false)
    {
        if($format) {
            return Carbon::parse($date)->isoFormat($format);    
        }
        return Carbon::parse($date)->isoFormat('D/MMM/Y');
    }
}

if (!function_exists('get_time')) {
    function get_time($date)
    {
        return Carbon::parse($date)->isoFormat('HH:mm');
    }
}

if (!function_exists('is_date')) {
    function is_date($date)
    {
        try {
            if(is_numeric($date)) {
                return false;    
            }
            return Carbon::parse($date);
        } catch(InvalidArgumentException $e) {
            return false;
        }
    }
}

if (!function_exists('terbilang')) {
    function terbilang($nilai)
    {
        if($nilai<0) {
			$hasil = "minus ". trim(penyebut($nilai));
		} else {
			$hasil = trim(penyebut($nilai));
		}     		
		return $hasil;
    }
}

if (!function_exists('penyebut')) {
    function penyebut($nilai)
    {
        $nilai = abs($nilai);
		$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = penyebut($nilai - 10). " belas";
		} else if ($nilai < 100) {
			$temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " seratus" . penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " seribu" . penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
		}     
		return $temp;
    }
}

if (!function_exists('get_status')) {
    function get_status($argumen = false)
    {
        $status = [
            'aktif' => '1',
            'non-aktif' => '0',
        ];

        if ($argumen) {
            return $status[$argumen];
        }

        return $status;
    }
}

if (!function_exists('get_status_alur')) {
    function get_status_alur($argumen = false)
    {
        $status = [
            'on-progress' => 0,
            'disetujui' => 1,
            'perbaikan' => 2,
            'pengesahan' => 3,
            'ditolak' => 99,
        ];

        if ($argumen) {
            return $status[$argumen];
        }

        return $status;
    }
}

if (!function_exists('status_alur_name')) {
    function status_alur_name($argumen = false)
    {
        $status = [
            get_status_alur('on-progress') => 'Memeriksa',
            get_status_alur('disetujui') => 'Disetujui',
            get_status_alur('perbaikan') => 'Perbaikan',
            get_status_alur('pengesahan') => 'Pengesahan',
            get_status_alur('ditolak') => 'Ditolak',
        ];

        if ($argumen) {
            return $status[$argumen];
        }

        return $status;
    }
}


if (!function_exists('status_progress_name')) {
    function status_progress_name($argumen)
    {
        $status = [
            0 => 'Proses Pengajuan',
            1 => 'Disetujui',
            99 => 'Ditolak',
        ];

        return $status[$argumen];
    }
}

if (!function_exists('status_pengesahan_name')) {
    function status_pengesahan_name($argumen)
    {
        $status = [
            get_status('non-aktif') => 'Belum Disahakan',
            get_status('aktif') => 'Telah Disahakan',
        ];

        return $status[$argumen];
    }
}

if (!function_exists('cek_mime')) {
    function cek_mime($file, $mime)
    {
        if (!in_array($file->getClientMimeType(), $mime)) {
            return false;
        }
        return true;
    }
}

if (!function_exists('jenis_pengelolaan')) {
    function jenis_pengelolaan($argumen = false)
    {
        $items = [
            'psp' => '1',
            'penghapusan' => '2',
            'hibah' => '3',
        ];

        if ($argumen) {
            return $items[$argumen];
        }

        return $items;
    }
}

if (!function_exists('jenis_pengelolaan_nama')) {
    function jenis_pengelolaan_nama($argumen = false)
    {
        $items = array_flip(jenis_pengelolaan());

        if ($argumen) {
            return $items[$argumen];
        }

        return $items;
    }
}

if (!function_exists('default_kode')) {
    function default_kode($argumen = false)
    {
        
        return 202201010001;
    }
}

if (!function_exists('get_mime')) {
    function get_mime($file)
    {
        $mime = mime_content_type(public_path($file));
        if($mime == 'image/jpeg' || $mime == 'image/png') {
            return 'image';
        }

        if($mime == 'application/pdf' || $mime == 'application/x-pdf') {
            return 'pdf';
        }

        if(
            $mime == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' || 
            $mime == 'application/x-xls' ||
            $mime == 'application/vnd.ms-excel'
        ) {
            return 'excel';
        }
    }
}

if (!function_exists('get_prooduk_item')) {
    function get_prooduk_item($produk, $items)
    {
        if($items->count() == 0) {
            return $produk->map(function($item) {
                return [
                    "id" => $item->id,
                    "nama" => $item->nama,
                    "checked" => true,
                ];
            });
        }
        
        return $produk->map(function($el) use ($items) {
            return [
                "id" => $el->id,
                "nama" => $el->nama,
                "checked" => ($items->where('produk_id', $el->id)->count() > 0)?true:false,
            ];
        });
    }
}

if (!function_exists('sbsk_bmn')) {
    function sbsk_bmn($sbsk, $pegawai)
    {
        $sbsk = $sbsk->whereIn('struktur_id', $pegawai->pluck('struktur_id'))->pluck('total', 'struktur_id');
        $pegawai = $pegawai->pluck('total', 'struktur_id');

        $result = 0;
        foreach($sbsk as $key=>$value){
            $result += $value * $pegawai[$key];
        }
        
        return $result;
    }
}

if (!function_exists('kebutuhan_riil')) {
    function kebutuhan_riil($sbsk, $existing)
    {
        if($existing >= $sbsk) {
            return 0;
        }
        return $sbsk - $existing;
        // return $detail->whereIn('struktur_id', $pegawai->pluck('struktur_id'))->sum('total');
    }
}

if (!function_exists('cek_sbsk_excel')) {
    function cek_sbsk_excel($excel)
    {
        $fields = [
            'kode_barang',
            'nama_barang',
            'kuantitas',
        ];
        
        $converted = [];
        
        foreach($excel as $index => $item) {
            $found = 0;
            foreach($item as $key => $value) {
                if(in_array(Str::snake(strtolower($key)), $fields)) {
                    $converted[$index][Str::snake(strtolower($key))] = $value;
                    $found++;
                }
            }
            if($found < count($fields)) {
                return [
                    'error' => 'Excel tidak sesuai foormat'
                ];
            }
        }

        if(count($converted) == 0) {
            return [
                'error' => 'Excel tidak sesuai foormat'
            ];
        }

        $result = [];
        foreach($converted as $key => $item) {
            if($item['kode_barang']) {
                if(Arr::has($result, $item['kode_barang'])) {
                    $result[$item['kode_barang']] += $item['kuantitas'];
                    continue;
                }
                $result[$item['kode_barang']] = $item['kuantitas'];
            }
        }
        
        return $result;
    }
}

if (!function_exists('rekap_excel')) {
    function rekap_excel($excel)
    {
        $fields = [
            'kondisi',
            'kuantitas',
        ];
        
        $converted = [];
        
        foreach($excel as $index => $item) {
            $found = 0;
            foreach($item as $key => $value) {
                if(in_array(Str::snake(strtolower($key)), $fields)) {
                    $converted[$index][Str::snake(strtolower($key))] = $value;
                    $found++;
                }
            }
            if($found < count($fields)) {
                return [
                    'error' => 'Excel tidak sesuai foormat'
                ];
            }
        }

        if(count($converted) == 0) {
            return [
                'error' => 'Excel tidak sesuai foormat'
            ];
        }

        $result = [];
        foreach($converted as $key => $item) {
            if($item['kondisi']) {
                $kondisi = Str::snake(strtolower($item['kondisi']));
                if(Arr::has($result, $kondisi)) {
                    $result[$kondisi] += $item['kuantitas'];
                    continue;
                }
                $result[$kondisi] = $item['kuantitas'];
            }
        }
        
        return $result;
    }
}
