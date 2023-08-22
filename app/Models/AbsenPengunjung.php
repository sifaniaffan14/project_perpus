<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsenPengunjung extends Model
{
    protected $fillable = [
        // 'id',
        'anggota_id',
        'waktu'
    ];
}
