<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\AbsenPengunjung;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;

class AbsensiController extends Controller
{
    public function index()
    {
        return view('admin.layouts.absensi.index');
    }

    public function insert(Request $request)
    {
        try {
            $operation = Anggota::join('users', 'anggotas.user_id', '=', 'users.id')
                            ->where("anggotas.no_induk", $_POST['no_induk'])
                            ->select(
                                "anggotas.id",
                                "anggotas.nama_anggota",
                                "anggotas.no_induk",
                                "anggotas.jenis_anggota",
                                "users.picture"
                                )
                            ->get()->toArray();
            if ($operation == []){
                $operation['message'] = "Anggota tidak ditemukan!";
                return $this->response($operation);
            }
            $date = Carbon::now('Asia/Jakarta');
            // $waktu = $date->format('H:i');
            $uuid = Uuid::uuid5(Uuid::NAMESPACE_DNS, Str::random());
            $uuid1 = md5($uuid->toString());
            $add = AbsenPengunjung::create([
                'anggota_id' => $operation[0]["id"],
                'waktu' => $date
            ]);
            return $this->response($operation);
        } catch (\Exception $e) {
            return $this->response($e->getMessage(), true);
        }
    }
}
