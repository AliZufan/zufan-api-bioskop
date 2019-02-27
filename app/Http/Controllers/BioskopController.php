<?php

namespace App\Http\Controllers;

use App\Bioskop;
use Illuminate\Http\Request;

class BioskopController extends Controller
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
        $data = Bioskop::all();

        if ($data) {
            return response()->json([
                'success' => true,
                'message' => 'Semua Data Ditemukan!',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Semua Data Tidak Ditemukan!',
                'data' => 'Not Entry'
            ], 404);
        }
    }
    public function showOne($id)
    {
        $data = Bioskop::find($id);

        if ($data) {
            return response()->json([
                'success' => true,
                'message' => 'Data Ditemukan!',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data Tidak Ditemukan!',
                'data' => 'Not Entry'
            ], 404);
        }

    }
    public function create(Request $request)
    {
        //$array = ['judul', 'thumbnail', 'deksripsi', 'genre', 'bahasa', 'durasi', 'rilis', 'harga'];
        if (!empty($request->all())) {
            $data = Bioskop::create($request->all());

            if ($data) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data Telah Dibuat!',
                    'data' => $data
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Gagal Dibuat!',
                ], 400);
            }
        }
    }
    public function update($id, Request $request)
    {
        if (!empty($request->all())) {
            $data = Bioskop::where('id', $id)->first();
            $data->update($request->all());
            if ($data) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data Berhasil diupdate!',
                    'data' => [
                        'id' => $id,
                        'updated' => $data
                    ]
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Gagal diupdate!',
                    'data' => [
                        'id' => $id
                    ]
                ], 400);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Tolong Isi Form dengan Benar!',
                'data' => $request->all()
            ], 400);
        }

    }
    public function delete($id)
    {
        $data = Bioskop::where('id',$id)->first();
        if ($data) {
            $data->delete();
            return response()->json([
                'success' => true,
                'message' => 'Data Terhapus!',
                'data' => [
                    'id' => $id
                ]
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data Gagal Terhapus!',
                'data' => [
                    'id' => $id
                ]
            ]);
        }
    }
}
