<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformasiPenting extends Model
{
    use HasFactory;
    protected $guarded =['id'];
    protected $table = 'informasi_pentings';
    protected $fillable = [
        'isi_informasi',
        'tgl_informasi',
    ];
}
