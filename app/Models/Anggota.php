<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;
    protected $table        = 'anggotas';

    protected $fillable = [
        'id',
        'user_id',
        'no_induk', 
        'nama_anggota', 
        'jenis_kelamin', 
        'tempat_lahir', 
        'tanggal_lahir',
        'jenis_anggota', 
        'alamat', 
        'email', 
        'no_telp',
        'is_active',
    ];
    
}
