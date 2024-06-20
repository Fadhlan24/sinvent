<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = Kategori::all();
        $data = array("data"=>$kategori);

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'deskripsi'   => 'required',
            'kategori'    => 'required',
        ]);
        
        $kategoribaru = Kategori::create([
            'deskripsi'  => $request->deskripsi,
            'kategori'   => $request->kategori,
        ]);

        $data = array("data"=>$kategoribaru);
        return response()->json($data);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {   
        $kategori = Kategori::find($id);
        
        if(!$kategori){
            return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
        }else{
            $data=array("data"=>$kategori);
            return response()->json($data);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kategori = Kategori::find($id);

        $request->validate([
            'deskripsi'   => 'required',
            'kategori'    => 'required',
        ]);
        
        if (!$kategori) {
            return response()->json(['status' => 'Kategori tidak ditemukan'], 404);
        }else{
            $kategori->update([
                'deskripsi'=>$request->deskripsi,
                'kategori'=>$request->kategori,
            ]);

        return response()->json(['status' => 'Kategori berhasil diubah'], 200);          
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategori = Kategori::find($id);

        if (!$kategori) {
            return response()->json(['status' => 'Kategori tidak ditemukan'], 404);
        }
        
        try {
            $kategori->delete();
            return response()->json(['status' => 'Kategori berhasil dihapus'], 200);
        } catch (\Illuminate\Database\QueryException) {
            // Tangkap pengecualian spesifik dari database (termasuk constraints foreign key)
            return response()->json(['status' => 'Kategori tidak dapat dihapus'], 500);
        }
    
    }
}
