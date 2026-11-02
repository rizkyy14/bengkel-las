<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBahan extends Model
{
    use HasFactory;

    protected $table = 'detail_bahans';
    protected $primaryKey = 'id_detail';
    protected $guarded = [];

    public function bahanBaku()
    {
        return $this->belongsTo(BahanBaku::class, 'id_bahan', 'id_bahan');
    }
}