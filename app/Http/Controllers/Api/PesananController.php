<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\DetailBahan;
use App\Models\BahanBaku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    // 1. Ambil Semua Pesanan + Relasi Pelanggan
    public function index()
    {
        $pesanan = Pesanan::with(['pelanggan', 'detailBahan.bahanBaku', 'pembayaran'])->get();

        return response()->json([
            'status' => 'success',
            'data'   => $pesanan
        ]);
    }

    // 2. Buat Pesanan Baru + Detail Bahan + Potong Stok
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_pelanggan'  => 'required|exists:pelanggan,id_pelanggan',
            'tgl_pesan'     => 'required|date',
            'jenis_produk'  => 'required|string|max:255',
            'spesifikasi'   => 'required|string',
            'total_biaya'  => 'required|numeric',
            'items'         => 'required|array', // List bahan baku yang dipakai
            'items.*.id_bahan'        => 'required|exists:bahan_bakus,id_bahan',
            'items.*.jumlah_terpakai' => 'required|integer|min:1',
            'items.*.subtotal_harga'  => 'required|numeric',
        ]);

        DB::beginTransaction();
        try {
            // A. Simpan Pesanan
            $pesanan = Pesanan::create([
                'id_pelanggan'   => $validated['id_pelanggan'],
                'tgl_pesan'      => $validated['tgl_pesan'],
                'jenis_produk'   => $validated['jenis_produk'],
                'spesifikasi'    => $validated['spesifikasi'],
                'total_biaya'   => $validated['total_biaya'],
                'status_pesanan' => 'Proses',
            ]);

            // B. Simpan Detail Bahan & Potong Stok
            foreach ($validated['items'] as $item) {
                DetailBahan::create([
                    'id_pesanan'      => $pesanan->id_pesanan,
                    'id_bahan'        => $item['id_bahan'],
                    'jumlah_terpakai' => $item['jumlah_terpakai'],
                    'subtotal_harga'  => $item['subtotal_harga'],
                ]);

                // Kurangi Stok Bahan Baku
                $bahan = BahanBaku::find($item['id_bahan']);
                if ($bahan->stok < $item['jumlah_terpakai']) {
                    throw new \Exception("Stok bahan {$bahan->nama_bahan} tidak cukup!");
                }
                $bahan->decrement('stok', $item['jumlah_terpakai']);
            }

            DB::commit();

            return response()->json([
                'status'  => 'success',
                'message' => 'Pesanan berhasil dibuat & stok bahan baku telah berkurang!',
                'data'    => $pesanan->load('detailBahan')
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status'  => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }
}