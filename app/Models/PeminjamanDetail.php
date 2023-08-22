<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeminjamanDetail extends Model
{
    protected $table = 'peminjaman_details';
    protected $primaryKey = 'peminjaman_detail_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'peminjaman_detail_id',
        'peminjaman_detail_peminjaman_id',
        'detail_buku_id',
        'status_peminjaman',
        'tgl_pinjam', 
        'tgl_kembali',
    ];

    public function detail_buku()
    {
    	return $this->belongsTo(DetailBuku::class,'detail_buku_id')->select(['eksemplar_id','no_panggil','buku_id']);
    }

    public function peminjaman()
    {
    	return $this->belongsTo(Peminjaman::class,'peminjaman_detail_peminjaman_id');
    }
}
