<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Anggota;
use App\Models\PeminjamanDetail;

class CekPinjamanController extends Controller
{
    public function index()
    {
        return view('anggota.layouts.cekPeminjaman.index');
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
                        ->where('anggotas.user_id', Auth::id())
                        ->whereIn('peminjaman_details.status_peminjaman', [1,3,4,5])
                        ->select(
                            "bukus.judul",
                            "peminjaman_details.tgl_pinjam",
                            "peminjaman_details.tgl_kembali",
                            "peminjaman_details.status_peminjaman"
                        )->get();
            return $this->response($operation);
        } catch (\Exception $e) {
            return $this->response($e->getMessage(), true);
        }
    }

    public function selectRiwayatPeminjaman()
    {
        try {
            $operation = PeminjamanDetail::join('peminjamen','peminjaman_details.peminjaman_detail_peminjaman_id','=','peminjamen.peminjaman_id')
                        ->join('anggotas','peminjamen.anggota_id','=','anggotas.id')
                        ->join('detail_bukus','peminjaman_details.detail_buku_id','=','detail_bukus.eksemplar_id')
                        ->join('bukus','detail_bukus.buku_id','=','bukus.id')
                        ->where('anggotas.user_id', Auth::id())
                        ->where('peminjaman_details.status_peminjaman', 2)
                        ->select(
                            "bukus.judul",
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
