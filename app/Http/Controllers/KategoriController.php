<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Models\Kategori;
use App\Models\Barang;
use Illuminate\Validation\Rule;

class KategoriController extends Controller
{
    public function index(Request $request)
    {

        // Query builder 
        // $query = DB::table('kategori')->select('id', 'deskripsi', 'kategori', DB::raw('ketKategori(kategori) as ketKategori'));

        // // Jika ada parameter pencarian
        // if ($request->has('search') && !empty($request->input('search'))) {
        //     $query->where('deskripsi', 'like', '%' . $request->input('search') . '%');
        // }


        // Pangill Table menggunakan View
        // $rsetKategori = DB::table('vKategori')->paginate(10);


        // pakai Eloquent ORM
        $query = Kategori::select(
            'id',
            'deskripsi',
            'kategori',
            \DB::raw('CASE
                WHEN kategori = "M" THEN "Modal"
                WHEN kategori = "A" THEN "Alat"
                WHEN kategori = "BHP" THEN "Bahan Habis Pakai"
                ELSE "Bahan Tidak Habis Pakai"
                END AS ketKategori')
        );

        // Jika ada parameter pencarian
        if ($request->has('search') && !empty($request->input('search'))) {
            $query->where('deskripsi', 'like', '%' . $request->input('search') . '%');
        }

        $rsetKategori = $query->paginate(10);

        return view('v_kategori.index', compact('rsetKategori'));
    }

    public function create()
    {
        $aKategori = array(
            'blank' => 'Pilih Kategori',
            'M' => 'Barang Modal',
            'A' => 'Alat',
            'BHP' => 'Bahan Habis Pakai',
            'BTHP' => 'Bahan Tidak Habis Pakai'
        );
        return view('v_kategori.create', compact('aKategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'deskripsi' => 'required|string|unique:kategori',
            'kategori' => 'required|in:M,A,BHP,BTHP',
        ], [
            'deskripsi.unique' => 'Deskripsi sudah ada dalam Kategori.', // Pesan kesalahan untuk deskripsi duplikat
        ]);

        // Eloquent ORM
        // Kategori::create([
        //     'deskripsi' => $request->deskripsi,
        //     'kategori' => $request->kategori,
        // ]);

        // memulai transaksi
        try {
            DB::beginTransaction();

            // Eloquent
            Kategori::create([
                'deskripsi' => $request->deskripsi,
                'kategori' => $request->kategori,
            ]);

            // store function
            // $kategoribaru = Kategori::store([
            //     'deskripsi' => $request->deskripsi,
            //     'kategori' => $request->kategori,
            //     'status'    => 'pending',
            // ]);

            DB::commit(); // Commit the changes

            // Flash success message to the session
            Session::flash('success', 'Kategori berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback transaksi jika terjadi kesalahan
            report($e); // Report kesalahan

            // Flash failure message to the session
            Session::flash('Gagal', 'Kategori gagal disimpan!');
        }

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function show($id)
    {
        // query builder
        // $rsetKategori = DB::table('kategori')->select('id','deskripsi', 'kategori',DB::raw('getKetKategori(kategori) as ketKategori'))
        // ->where('id', '=', $id)
        // ->first();

        // pakai store procedure
        $rsetKategori = Kategori::getKategoriAll()
            ->where('id', '=', $id)
            ->first();


        // Eloquent ORM
        // $rsetKategori = Kategori::select('id', 'deskripsi', 'kategori',
        // \DB::raw('CASE
        //     WHEN kategori = "M" THEN "Modal"
        //     WHEN kategori = "A" THEN "Alat"
        //     WHEN kategori = "BHP" THEN "Bahan Habis Pakai"
        //     ELSE "Bahan Tidak Habis Pakai"
        //     END AS ketKategori'))
        // ->find($id);

        return view('v_kategori.show', compact('rsetKategori'));
    }

    public function edit($id)
    {
        $rsetKategori = Kategori::find($id);
        return view('v_kategori.edit', compact('rsetKategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'deskripsi' => 'required|string',
            'kategori' => 'required|in:M,A,BHP,BTHP',
        ]);

        // query builder
        DB::table('kategori')
            ->where('id', $id)
            ->update([
                'deskripsi' => $request->deskripsi,
                'kategori' => $request->kategori,
                'updated_at' => now(), // Mengupdate timestamp
            ]);

        // Eloquent ORM
        // $rsetKategori = Kategori::findOrFail($id);
        // $rsetKategori->deskripsi = $request->deskripsi;
        // $rsetKategori->kategori = $request->kategori;
        // $rsetKategori->save();

        return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Diupdate!']);
    }

    public function destroy($id)
    {
        if (\DB::table('barang')->where('kategori_id', $id)->exists()) {
            return redirect()->route('kategori.index')->with(['Gagal' => 'Data Gagal Dihapus!']);
        } else {
            $rsetKategori = Kategori::find($id);
            $rsetKategori->delete();

            return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Dihapus!']);
        }
    }
}