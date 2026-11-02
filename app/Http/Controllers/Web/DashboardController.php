<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\Pelanggan;
use App\Models\BahanBaku;
use App\Models\Pembayaran;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPesanan = Pesanan::count();
        $pesananProses = Pesanan::where('status_pesanan', 'Proses')->count();
        $pesananSelesai = Pesanan::where('status_pesanan', 'Selesai')->count();
        $totalPendapatan = Pembayaran::sum('jumlah_bayar');

        $pesananTerbaru = Pesanan::with('pelanggan')->latest()->take(5)->get();

        return view('dashboard', compact(
            'totalPesanan', 
            'pesananProses', 
            'pesananSelesai', 
            'totalPendapatan', 
            'pesananTerbaru'
        ));
    }
}