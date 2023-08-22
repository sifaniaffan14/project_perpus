<?php

namespace App\Http\Controllers;
use App\Models\AbsenPengunjung;

use Illuminate\Http\Request;

class AbsenPengunjungController extends Controller
{
    public function list(){
        $list=AbsenPengunjung::all();
        return $list;
    }
    public function add(){
        $add=AbsenPengunjung::create([
            'waktu' => request()->waktu,
        ]);
        return $add;
    }    
    public function delete($id){
        $delete=AbsenPengunjung::find($id);
        $delete->delete();
        return $delete;
    }
}
