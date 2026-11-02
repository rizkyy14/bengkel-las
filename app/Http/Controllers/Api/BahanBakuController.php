<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BahanBaku;
use Illuminate\Http\Request;

class BahanBakuController extends Controller
{

    public function index()
    {
        $bahan = BahanBaku::all();
        return response()->json([
            'status' => 'success',
            'data' => $bahan
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_bahan'   => 'required|string|max:255',
            'stok'         => 'required|integer',
            'satuan'       => 'required|string|max:50',
            'harga_satuan' => 'required|numeric',
        ]);

        $bahan = BahanBaku::create($validated);

        return response()->json([
            'status'  => 'success',
            'message' => 'Data bahan baku berhasil ditambahkan!',
            'data'    => $bahan
        ], 201);
    }
}