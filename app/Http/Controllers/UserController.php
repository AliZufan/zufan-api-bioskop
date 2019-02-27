<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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

    public function showAll()
    {
        $data = User::all();
        
        if ($data) {
            return response()->json([
                'success' => true,
                'message' => 'Semua User Ditemukan!',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Semua User Tidak Ditemukan!',
                'data' => ''
            ], 404);
        }
    }
    public function showOne($id)
    {
        $data = User::find($id);
        
        if ($data) {
            return response()->json([
                'success' => true,
                'message' => 'User Ditemukan!',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User Tidak Ditemukan!',
                'data' => ''
            ], 404);
        }
    }

    public function create(Request $request)
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
                    'message' => 'User Berhasil Ditambah!',
                    'data' => $data
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'User Gagal Ditambah!',
                    'data' => ''
                ], 400);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Mohon Isi Form Dengan Benar!'
            ], 404);
        }
    }
    public function update($id, Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        
        if (!empty($name || $email)) {
            $data = User::where('id', $id)->first();
            $data->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Update Data Berhasil',
                'data' => [
                    'id' => $id,
                    'updated' => $request->all()
                ]
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Tolong Isi Form Dengan Benar!',
                'data' => [
                    'id' => $id,
                    'updated' => $request->all()
                ]
            ], 400);
        }
    }
    public function delete($id)
    {
        $data = User::where('id', $id)->first();
        $data->delete();
        if($data) {
            return response()->json([
                'success' => true,
                'message' => 'Data Terhapus!',
                'id' => $id
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data Gagal Dihapus!',
            ], 400);
        }
    }   
}
