<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProgresProyek;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class ProgresProyekController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_pesanan'   => 'required|exists:pesanans,id_pesanan',
            'persentase'   => 'required|integer|min:0|max:100',
            'keterangan'   => 'nullable|string',
            'foto_progres' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'tgl_update'   => 'required|date',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto_progres')) {
            $fotoPath = $request->file('foto_progres')->store('progres_fotos', 'public');
        }

        $progres = ProgresProyek::create([
            'id_pesanan'   => $validated['id_pesanan'],
            'id_worker'    => $request->user()->id, 
            'persentase'   => $validated['persentase'],
            'keterangan'   => $validated['keterangan'] ?? null,
            'foto_progres' => $fotoPath,
            'tgl_update'   => $validated['tgl_update'],
        ]);

        if ($validated['persentase'] == 100) {
            Pesanan::where('id_pesanan', $validated['id_pesanan'])->update(['status_pesanan' => 'Selesai']);
        }

        return response()->json([
            'status'  => 'success',
            'message' => 'Progres proyek berhasil diperbarui!',
            'data'    => $progres
        ], 201);
    }

    public function show($id_pesanan)
    {
        $progres = ProgresProyek::with('worker')->where('id_pesanan', $id_pesanan)->get();

        return response()->json([
            'status' => 'success',
            'data'   => $progres
        ]);
    }
}