<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request) {
        
        $credentials = [
            "email" => request("email"),
            "password" => request("password")
        ];

        if(request("role") == roles('uapb') || request("role") == roles('apip')) {
            $credentials['role'] = request("role");
        }
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            session([
                'user_login' => [
                    'name' => $user->name,
                    'satker' => $user->satker->name,
                ],
                'tahun' => date('Y')
            ]);

            return redirect()->route('home');
        }
    
        return redirect("login")->withError('User tidak ditemukan');
    }
}
