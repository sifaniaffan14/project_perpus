<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBuku extends Model
{
    protected $table = 'detail_bukus';
    protected $primaryKey = 'eksemplar_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'eksemplar_id',
        'buku_id',
        'no_panggil', 
        'status', 
        'kondisi',
        'barcode',
    ];

    public function buku()
    {
    	return $this->belongsTo(Buku::class,'buku_id')->select(['id', 'judul']);
    }

    public function peminjaman_detail()
    {
    	return $this->hasMany(PeminjamanDetail::class,'detail_buku_id');
    }
}
