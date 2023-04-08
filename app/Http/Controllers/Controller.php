<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Crypt;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function storeNotif($data)
    {
        $data['url_id'] = Crypt::encryptString($data['role'] . '-' . time());
        Notification::create($data);
    }

    protected function getNotif()
    {
        $user = Auth::user();
        if ($user->role == roles('uapb') || $user->role == roles('apip')) {
            return Notification::byRole($user->role)
                ->byStatus(get_status('aktif'))
                ->orderBy('id', 'desc')
                ->get();
        }
        return Notification::byRole($user->role)
            ->bySatker($user->satker_id)
            ->byStatus(get_status('aktif'))
            ->orderBy('id', 'desc')
            ->get();
    }

    protected function countNotif()
    {
        $user = Auth::user();
        if ($user->role == roles('uapb') || $user->role == roles('apip')) {
            return Notification::byRole($user->role)
                ->byStatus(get_status('aktif'))
                ->orderBy('id', 'desc')
                ->count();
        }
        return Notification::byRole($user->role)
            ->bySatker($user->satker_id)
            ->byStatus(get_status('aktif'))
            ->orderBy('id', 'desc')
            ->count();
    }

    protected function notifById($id)
    {
        return Notification::byUrl($id)->first();
    }

    protected function updateNotif($id)
    {
        Notification::find($id)->fill([
            'status' => get_status('non-aktif')
        ])->save();
    }
}
