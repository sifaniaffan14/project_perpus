<?php

namespace App\Http\Controllers;

use App\Models\AbsenPengunjung;
use App\Models\Anggota;
use App\Models\DetailBuku;
use App\Models\Peminjaman;
use App\Models\PeminjamanDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function admin()
    {
        return view('admin/layouts/dashboard/index');
    }

    public function selectData()
    {
        try {
            $today = Carbon::today();
            $getBuku = DetailBuku::where('is_active', '=', '1')->count();
            $getPeminjaman = PeminjamanDetail::whereIn('status_peminjaman', ['1', '4'])->count();
            $getAbsenToday = AbsenPengunjung::whereDate('waktu', $today)->count();
            $getAbsen = AbsenPengunjung::count();
            $getAnggota = Anggota::where('is_active', '=', '1')->count();
            $getDataPengajuan = DB::table('peminjaman_details')
                ->join('peminjamen', 'peminjaman_details.peminjaman_detail_peminjaman_id', '=', 'peminjamen.peminjaman_id')
                ->whereIn('status_peminjaman', ['3']) // status proses diperpanjang
                ->select('peminjaman_details.peminjaman_detail_peminjaman_id')
                ->distinct()
                ->get();
                $getPengajuanPerpanjangan = $getDataPengajuan->count();
            return response()->json([
                'getBuku' => $getBuku,
                'getPeminjaman' => $getPeminjaman,
                'getAbsen' => $getAbsen,
                'getAbsenToday' => $getAbsenToday,
                'getAnggota' => $getAnggota,
                'getPengajuanPerpanjangan' => $getPengajuanPerpanjangan,
            ]);
        } catch (\Exception $e) {
            return $this->response($e->getMessage(), true);
        }
    }

    public function selectAbsensi()
    {
        try {
            $today = Carbon::today();
            $operation = DB::table("absen_pengunjungs")
                ->join("anggotas", "absen_pengunjungs.anggota_id", "=", "anggotas.id")
                ->join("users", "anggotas.user_id", "=", "users.id") // Menambahkan join dengan tabel "users"
                ->whereDate('absen_pengunjungs.waktu', $today)
                ->orderBy('absen_pengunjungs.waktu', 'desc')
                ->get();
            return $this->response($operation);
        } catch (\Exception $e) {
            return $this->response($e->getMessage(), true);
        }
    }

    public function selectPengajuanPerpanjangan()
    {
        try {
            $operation = DB::table('peminjaman_details')
                ->join('peminjamen', 'peminjaman_details.peminjaman_detail_peminjaman_id', '=', 'peminjamen.peminjaman_id')
                ->join('anggotas', 'peminjamen.anggota_id', '=', 'anggotas.id')
                ->join("users", "anggotas.user_id", "=", "users.id")
                ->whereIn('status_peminjaman', ['3']) // status proses diperpanjang
                ->select(
                    'peminjamen.peminjaman_id',
                    'peminjaman_details.peminjaman_detail_peminjaman_id',
                    'peminjaman_details.status_peminjaman',
                    'anggotas.nama_anggota',
                    'anggotas.no_induk',
                    'users.picture',
                    'peminjamen.jumlah_peminjaman',
                )
                ->distinct()
                ->get();

            $countBuku = DB::select("SELECT peminjaman_detail_peminjaman_id, MAX(tgl_pinjam) as tgl_pinjam, MAX(tgl_kembali) as tgl_kembali,
                            SUM(CASE WHEN status_peminjaman = '1' OR status_peminjaman = '3' THEN 1 ELSE 0 END) AS belum_verif
                            FROM peminjaman_details
                            GROUP BY peminjaman_detail_peminjaman_id");

            $operation = Collection::make($operation);
            $countBuku = Collection::make($countBuku);

            $result = $operation->map(function ($item) use ($countBuku) {
                $count = $countBuku->firstWhere('peminjaman_detail_peminjaman_id', $item->peminjaman_detail_peminjaman_id);
                $item->belum_verif = $count ? $count->belum_verif : 0;
                $item->tgl_pinjam = $count ? $count->tgl_pinjam : 0;
                $item->tgl_kembali = $count ? $count->tgl_kembali : 0;
                return $item;
            })->toArray();
            // print_r($result);exit;
            return $this->response($operation);
        } catch (\Exception $e) {
            return $this->response($e->getMessage(), true);
        }
    }
}