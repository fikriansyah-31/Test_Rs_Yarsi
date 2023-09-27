<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Buku::orderBy('judul','asc')-> get();
        return response()->json([
            'status' => true,
            'message' => 'Data Berhasil',
            'data' => $data
        ], 200 );    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dataBuku = new Buku;

        $rules = [
            'judul' => 'required',
            'pengarang' => 'required',
            'tanggal_publikasi' => 'required|date',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
              'status' => false,
              'message' => 'Error create book',
              'data' => $validator->errors()
            ], 400);
        }

        $dataBuku->judul = $request->judul;
        $dataBuku->pengarang = $request->pengarang;
        $dataBuku->tanggal_publikasi = $request->tanggal_publikasi;
        
        // Save the book to the database
        $dataBuku->save();
        
        // Get the ID of the newly created book
        $bookId = $dataBuku->id;
        
        return response()->json([
            'id' => $bookId,
            'status' => 'aktif',
            'message' => 'Successfully Create a New Book',
            'data' => $dataBuku
        ], 200);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Buku::find($id);
        if($data) {
            return response()->json([
              'status' => true,
              'message' => 'Data Berhasil',
                'data' => $data
            ], 200 );
        } else {
            return response()->json([
              'status' => false,
              'message' => 'Data Tidak Ditemukan',
                'data' => $data
            ], 404 );
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dataBuku = Buku::find($id);

        if (empty($dataBuku)) {
            return response()->json([
              'status' => false,
              'message' => 'Data Tidak Ditemukan',
                'data' => $dataBuku
            ], 404 );   
        }

        $rules = [
            'judul' => 'required',
            'pengarang' => 'required',
            'tanggal_publikasi' => 'required|date',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
              'status' => false,
              'message' => 'Error create book',
              'data' => $validator->errors()
            ], 400);
        }

        $dataBuku->judul = $request->judul;
        $dataBuku->pengarang = $request->pengarang;
        $dataBuku->tanggal_publikasi = $request->tanggal_publikasi;
        
        // Save the book to the database
        $dataBuku->save();
        
        // Get the ID of the newly created book
        $bookId = $dataBuku->id;
        
        return response()->json([
            'id' => $bookId,
            'status' => 'aktif',
            'message' => 'Success Update Book',
            'data' => $dataBuku
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dataBuku = Buku::find($id);

        if (empty($dataBuku)) {
            return response()->json([
              'status' => false,
              'message' => 'Data Tidak Ditemukan',
                'data' => $dataBuku
            ], 404 );   
        }

        // Delete the book to the database
        $dataBuku->delete();
        
        // Get the ID of the newly created book
        $bookId = $dataBuku->id;
        
        return response()->json([
            'id' => $bookId,
            'status' => 'aktif',
            'message' => 'Success delete Book',
            'data' => $dataBuku
        ], 200);
    }
}
