<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_pesanan'   => 'required|exists:pesanans,id_pesanan',
            'tgl_bayar'    => 'required|date',
            'jenis_bayar'  => 'required|in:DP,Pelunasan',
            'jumlah_bayar' => 'required|numeric|min:1',
        ]);

        $pembayaran = Pembayaran::create($validated);

        return response()->json([
            'status'  => 'success',
            'message' => 'Pembayaran berhasil dicatat!',
            'data'    => $pembayaran
        ], 201);
    }

    public function show($id_pesanan)
    {
        $pembayaran = Pembayaran::where('id_pesanan', $id_pesanan)->get();

        return response()->json([
            'status' => 'success',
            'data'   => $pembayaran
        ]);
    }
}