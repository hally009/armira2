<?php

namespace App\Http\Controllers\Satker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PemeliharaanController extends Controller
{
    public function index()
    {
        $menu = get_home_menu()['perencanaan']['child'];
        return view('satker.pemeliharaan.index', compact(['menu',]));
    }
}
