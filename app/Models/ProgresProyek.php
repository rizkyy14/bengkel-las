<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgresProyek extends Model
{
    use HasFactory;

    protected $table = 'progres_proyeks';
    protected $primaryKey = 'id_progres';
    protected $guarded = [];

    public function worker()
    {
        return $this->belongsTo(User::class, 'id_worker', 'id');
    }
}