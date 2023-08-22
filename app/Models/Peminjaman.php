<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjamen';
    protected $primaryKey = 'peminjaman_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'peminjaman_id',
        'anggota_id',
        'kode_peminjaman',
        'jumlah_peminjaman'
    ];

    public function anggota()
    {
    	return $this->belongsTo(Anggota::class,'anggota_id')->select(['id', 'nama_anggota','no_induk','jenis_anggota']);
    }

    public function peminjaman_detail()
    {
    	return $this->hasMany(PeminjamanDetail::class,'peminjaman_detail_peminjaman_id');
    }
}
