<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\InformasiPenting;
use App\Models\PeminjamanDetail;
use App\Models\AbsenPengunjung;
use App\Models\Buku;
use App\Models\DetailBuku;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return view('anggota/layouts/dashboard/index');
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

    public function selectInformasi()
    {
        try {
            $operation = InformasiPenting::latest('created_at')->take(2)->get();
            return $this->response($operation);
        } catch (\Exception $e) {
            return $this->response($e->getMessage(), true);
        }
    }

    public function selectCount()
    {
        try {
            $operation['countPeminjaman'] = PeminjamanDetail::join('peminjamen','peminjaman_details.peminjaman_detail_peminjaman_id','=','peminjamen.peminjaman_id')
                                ->join('anggotas','peminjamen.anggota_id','=','anggotas.id')
                                ->where('anggotas.user_id', Auth::id())
                                ->whereIn('peminjaman_details.status_peminjaman', [1,3,4,5])
                                ->count();

            $operation['countKunjungan'] = AbsenPengunjung::join('anggotas','absen_pengunjungs.anggota_id','=','anggotas.id')
                                            ->where('anggotas.user_id',Auth::id())->count();

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

    public function selectKoleksi()
    {
        try {
            $operation = Buku::latest('created_at')
                            ->take(8)
                            ->where('bukus.is_active', '1')
                            ->get();

            return $this->response($operation);
        } catch (\Exception $e){
            return $this->response($e->getMessage(), true);
        }
    }

    public function selectDetail(Request $request){
        try {
            $value = $request->all();

            $operation = Buku::join('kategori_bukus','bukus.buku_kategori_id','=','kategori_bukus.id')
                            ->where('bukus.id', $value['id'])
                            ->select(
                                'bukus.*',
                                'kategori_bukus.nama_kategori'
                            )->get()->toArray();
            return $this->response($operation);
        } catch(\Exception $e){
            return $this->response($e->getMessage(), true);
        }
    }


    public function selectEksemplar()
    {
        try {
            $operation = DetailBuku::leftJoin('peminjaman_details','detail_bukus.eksemplar_id','=','peminjaman_details.detail_buku_id')
                            ->where('is_active', 1)
                            ->where('buku_id', $_GET['id'])
                            ->get();
            return $this->response($operation);
        } catch (\Exception $e) {
            return $this->response($e->getMessage(), true);
        }
    }
}
