<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $link = get_home_menu();
        $notif = $this->countNotif();
        return view('layouts.admin-home', compact(['link', 'notif']));
    }

    public function notif(Request $request, $id)
    {
        $notif = $this->notifById($id);
        $this->updateNotif($notif->id);
        return redirect($notif->link);
    }
}
