<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Pelanggan;
use App\Models\BahanBaku;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed Akun Pengguna (Admin, Owner, Worker)
        User::create([
            'name' => 'Admin Bengkel',
            'email' => 'admin@berkahrizky.com',
            'password' => Hash::make('password123'),
            'role' => 'Admin',
        ]);

        User::create([
            'name' => 'Pak Suroto (Owner)',
            'email' => 'owner@berkahrizky.com',
            'password' => Hash::make('password123'),
            'role' => 'Owner',
        ]);

        User::create([
            'name' => 'Musbar (Worker)',
            'email' => 'worker1@berkahrizky.com',
            'password' => Hash::make('password123'),
            'role' => 'Worker',
        ]);

        User::create([
            'name' => 'Johannes (Worker)',
            'email' => 'worker2@berkahrizky.com',
            'password' => Hash::make('password123'),
            'role' => 'Worker',
        ]);

        // 2. Seed Data Pelanggan Dummy
        Pelanggan::create([
            'nama_pelanggan' => 'Bpk. Ahmad',
            'no_hp' => '081234567890',
            'alamat' => 'Jl. Karya Wisata No. 12, Medan',
        ]);

        Pelanggan::create([
            'nama_pelanggan' => 'Ibu Siti',
            'no_hp' => '089876543210',
            'alamat' => 'Jl. AH Nasution No. 45, Medan',
        ]);

        // 3. Seed Master Bahan Baku Initial
        BahanBaku::create([
            'nama_bahan' => 'Besi Hollow 4x4 (1.6mm)',
            'stok' => 50,
            'satuan' => 'Batang',
            'harga_satuan' => 125000,
        ]);

        BahanBaku::create([
            'nama_bahan' => 'Atap Spandek Transparan (6m)',
            'stok' => 20,
            'satuan' => 'Lembar',
            'harga_satuan' => 210000,
        ]);

        BahanBaku::create([
            'nama_bahan' => 'Kawat Las RB-26 (5kg)',
            'stok' => 10,
            'satuan' => 'Box',
            'harga_satuan' => 145000,
        ]);
    }
}