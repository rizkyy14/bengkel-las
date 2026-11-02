<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    // Arahkan nama tabel secara eksplisit ke 'pelanggan'
    protected $table = 'pelanggan';

    // Set primary key kustom sesuai migration kamu
    protected $primaryKey = 'id_pelanggan';

    protected $guarded = [];
}