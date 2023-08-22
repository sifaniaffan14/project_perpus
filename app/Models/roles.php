<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class roles extends Model
{
    use HasFactory;
    protected $table = 'roles';
    protected $fillable = [
        'nama_role',
        'is_active',
    ];

    public function Anggota()
    {
    	return $this->belongsTo(Anggota::class);
    }

}
