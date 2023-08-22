<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perpanjangan extends Model
{
    protected $table = 'perpanjangans';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'peminjaman_detail_id',
        'tgl_kembali_baru', 
        'alasan_perpanjangan', 
    ];
    
}
