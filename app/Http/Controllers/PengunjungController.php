<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengunjungController extends Controller
{
    public function index()
    {
        return view('admin.layouts.pengunjung.index');
    }

    public function select(Request $request)
    {
        try {
            $operation = DB::table("absen_pengunjungs")
                        ->join("anggotas","absen_pengunjungs.anggota_id","=","anggotas.id")
                        ->orderBy('absen_pengunjungs.created_at','desc')
                        ->get();
            return $this->response($operation);
        } catch (\Exception $e) {
            return $this->response($e->getMessage(), true);
        }
    }

    public function onFilter(Request $request)
    {
        try {
            if ($_GET['tahun'] != "" && $_GET['bulan'] == "" && $_GET['tanggal'] == ""){
                $operation = db::select('select absen_pengunjungs.*, anggotas.* from absen_pengunjungs 
                                        JOIN anggotas ON absen_pengunjungs.anggota_id = anggotas.id 
                                        where YEAR(absen_pengunjungs.created_at) = '. $_GET['tahun']);
            } elseif($_GET['tahun'] != "" && $_GET['bulan'] != "" && $_GET['tanggal'] == ""){
                $operation = db::select('select absen_pengunjungs.*, anggotas.* from absen_pengunjungs 
                                        JOIN anggotas ON absen_pengunjungs.anggota_id = anggotas.id 
                                        where YEAR(absen_pengunjungs.created_at) = '. $_GET['tahun'] .' AND MONTH(absen_pengunjungs.created_at) ='. $_GET['bulan']);
            } elseif($_GET['tahun'] != "" && $_GET['bulan'] != "" && $_GET['tanggal'] != ""){
                $operation = db::select('select absen_pengunjungs.*, anggotas.* from absen_pengunjungs 
                                        JOIN anggotas ON absen_pengunjungs.anggota_id = anggotas.id 
                                        where YEAR(absen_pengunjungs.created_at) = '. $_GET['tahun'] .' AND MONTH(absen_pengunjungs.created_at) ='. $_GET['bulan'] .' AND DAY(absen_pengunjungs.created_at) ='. $_GET['tanggal']);
            }
            return $this->response($operation);
        } catch (\Exception $e) {
            return $this->response($e->getMessage(), true);
        }
    }
}
