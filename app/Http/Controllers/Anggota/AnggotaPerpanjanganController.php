<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Anggota;
use App\Models\PeminjamanDetail;
use App\Models\Perpanjangan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class AnggotaPerpanjanganController extends Controller
{
    public function index()
    {
        return view('anggota.layouts.perpanjangan.index');
    }

    public function insert(){
        try {
            PeminjamanDetail::where('peminjaman_detail_id', $_GET['id'])->update([
                'status_peminjaman' => '3', 
            ]);
            $uuid = Uuid::uuid5(Uuid::NAMESPACE_DNS, Str::random());
            $uuid1 = md5($uuid->toString());
            Perpanjangan::create([
                'id' => $uuid1,
                'peminjaman_detail_id' => $_GET['id'],
                'tgl_kembali_baru' => $_GET['tgl_kembali_baru'],
                'alasan_perpanjangan' => $_GET['alasan']
            ]);

            $operation['success'] = true;
            return $this->response($operation);
        } catch (\Exception $e) {
            return $this->response($e->getMessage(), true);
        }
    }

    public function selectAnggota()
    {
        try {
            $operation = Anggota::join('users', 'anggotas.user_id', '=', 'users.id')
                            ->where("anggotas.user_id", Auth::id())
                            ->select(
                                "anggotas.id",
                                "anggotas.nama_anggota",
                                "anggotas.no_induk",
                                "users.picture"
                                )
                            ->get()->toArray();
            return $this->response($operation);
        } catch (\Exception $e) {
            return $this->response($e->getMessage(), true);
        }
    }

    public function selectPeminjaman()
    {
        try {
            $operation = PeminjamanDetail::join('peminjamen','peminjaman_details.peminjaman_detail_peminjaman_id','=','peminjamen.peminjaman_id')
                        ->join('anggotas','peminjamen.anggota_id','=','anggotas.id')
                        ->join('detail_bukus','peminjaman_details.detail_buku_id','=','detail_bukus.eksemplar_id')
                        ->join('bukus','detail_bukus.buku_id','=','bukus.id')
                        ->join('kategori_bukus','bukus.buku_kategori_id','=','kategori_bukus.id')
                        ->where('anggotas.user_id', Auth::id())
                        ->whereIn('peminjaman_details.status_peminjaman', [1,4,5])
                        ->select(
                            "peminjaman_details.peminjaman_detail_id",
                            "bukus.judul",
                            "bukus.penerbit",
                            "kategori_bukus.nama_kategori",
                            "peminjaman_details.tgl_pinjam",
                            "peminjaman_details.tgl_kembali",
                            "peminjaman_details.status_peminjaman"
                        )->get();
            return $this->response($operation);
        } catch (\Exception $e) {
            return $this->response($e->getMessage(), true);
        }
    }
}
