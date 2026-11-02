<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Ambil role user dari DB dan ubah ke huruf kecil semua
        $userRole = strtolower(trim(Auth::user()->role ?? ''));

        // Ubah semua role yang diizinkan di routes ke huruf kecil juga
        $allowedRoles = array_map('strtolower', $roles);

        if (in_array($userRole, $allowedRoles)) {
            return $next($request);
        }

        abort(403, 'Akses Ditolak: Role Anda (' . Auth::user()->role . ') tidak diizinkan.');
    }
}