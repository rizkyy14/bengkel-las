<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{

    public function index()
    {
        $pelanggan = Pelanggan::all();
        return response()->json([
            'status' => 'success',
            'data' => $pelanggan
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'no_hp'          => 'required|string|max:20',
            'alamat'         => 'nullable|string',
        ]);

        $pelanggan = Pelanggan::create($validated);

        return response()->json([
            'status'  => 'success',
            'message' => 'Data pelanggan berhasil ditambahkan!',
            'data'    => $pelanggan
        ], 201);
    }
}