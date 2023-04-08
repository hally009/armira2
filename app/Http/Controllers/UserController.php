<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Services\ProfileService as Service;
use Auth;

class UserController extends Controller
{
    protected $repository;
    protected $service;

    public function __construct(Service $service)
    {
        $this->middleware('auth');
        $this->service = $service;
    }

    public function show(Request $request, $id)
    {
        $user = Auth::user();
        return view('component.user-component', compact([
            'user'
        ]));
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        if(!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan',
                'data' => null,
            ], 404);
        }

        $data = [
            'email' => $request->email,
        ];
        
        try {
            $user->fill($data)->save();
            
            return response()->json([
                'success' => true,
                'message' => 'Update Email berhasil',
                'data' => null,
            ], 201);
        } catch (\Exception$e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
                'data' => null,
            ], 500);
        }
    }

    public function changePasssword(Request $request, $id)
    {
        $user = Auth::user();
        if(!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan',
                'data' => null,
            ], 404);
        }

        if(!Hash::check($request->old_password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Password tidak valid',
                'data' => null,
            ], 401);
        }
        
        $data = [
            'password' => Hash::make($request->new_password),
        ];
        
        try {
            $user->fill($data)->save();
            
            return response()->json([
                'success' => true,
                'message' => 'Update Password berhasil',
                'data' => null,
            ], 201);
        } catch (\Exception$e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
                'data' => null,
            ], 500);
        }
    }




}
