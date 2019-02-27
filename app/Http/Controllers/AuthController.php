<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct()
    {
        //
    }
    
    public function register(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $password = Hash::make($request->input('password'));
        if (!empty($name && $email && $password)) {
            $data = User::create([
                'name' => $name,
                'email' => $email,
                'password' => $password
            ]);
            if ($data) {
                return response()->json([
                    'success' => true,
                    'message' => 'Register Berhasil!',
                    'data' => $data
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Register Gagal!',
                    'data' => ''
                ], 400);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Mohon Isi Form Dengan Benar!'
            ], 400);
        }
    }
    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        if (!empty($email && $password)) {
            $data = User::where('email', $email)->first();

            if (Hash::check($password, $data->password)) {

                $apiToken = base64_encode(str_random(40));
                $data->update([
                    'api_token' => $apiToken
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Login Berhasil!',
                    'data' => [
                        'user' => $data,
                        'api_token' => $apiToken
                    ]
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Login Gagal!',
                    'data' => ''
                ], 400);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Tolong Isi Form Login dengan Benar!'
            ], 400);
        }
        
    }
}
