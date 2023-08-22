<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class buku extends Model
{
    use HasFactory;

    protected $table        = 'bukus';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;
    protected $dateFormat = 'Y-m-d H:i:s';

    protected $fillable = [
        'id',
        'buku_kategori_id',
        'kode_buku', 
        'judul', 
        'penerbit', 
        'pengarang', 
        'no_isbn',
        'halaman', 
        'image', 
        'is_active', 
        'created_at', 
        'updated_at'
    ];
    // protected $guarded =['id'];
    // protected $table='buku';

    // public function KategoriBuku()
    // {
    // 	return $this->belongsTo(KategoriBuku::class);
    // }

    public function detail_buku()
    {
    	return $this->hashMany(DetailBuku::class,'buku_id');
    }

    // public function scopeJoinKategoriBuku($q)
	// {
	// 	return $q->leftJoin('kategori_bukus', 'kategori_bukus.id', '=', 'buku.buku_kategori_id');
	// }


}
