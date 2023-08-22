<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PeminjamanDetail;
use App\Models\Perpanjangan;
use Illuminate\Support\Collection;

class PerpanjanganController extends Controller
{
    public function index()
    {
        return view('admin.layouts.perpanjangan.index');
    }

    public function select()
    {
        try {
            if ($_GET['name'] == 'belum_verif') {
                $operation = DB::table('peminjaman_details')
                            ->join('peminjamen', 'peminjaman_details.peminjaman_detail_peminjaman_id', '=', 'peminjamen.peminjaman_id')
                            ->join('anggotas', 'peminjamen.anggota_id', '=', 'anggotas.id')
                            ->whereIn('status_peminjaman',['3']) // status proses diperpanjang
                            ->select(
                                'peminjamen.peminjaman_id',
                                'peminjaman_details.peminjaman_detail_peminjaman_id',
                                'anggotas.nama_anggota',
                                'peminjamen.jumlah_peminjaman',
                            )
                            ->distinct()
                            ->get();

                $countBuku = DB::select("SELECT peminjaman_detail_peminjaman_id, MAX(tgl_pinjam) as tgl_pinjam, MAX(tgl_kembali) as tgl_kembali,
                            SUM(CASE WHEN status_peminjaman = '3' THEN 1 ELSE 0 END) AS belum_verif
                            FROM peminjaman_details
                            GROUP BY peminjaman_detail_peminjaman_id");
                            
            } else {
                $operation = DB::table('peminjaman_details')
                            ->join('peminjamen','peminjaman_details.peminjaman_detail_peminjaman_id','=','peminjamen.peminjaman_id')
                            ->join('anggotas','peminjamen.anggota_id','=','anggotas.id')
                            ->whereIn('status_peminjaman',['4','5']) // status diperpanjang atau ditolak perpanjangan
                            ->select(
                                'peminjamen.peminjaman_id',
                                'peminjaman_details.peminjaman_detail_peminjaman_id',
                                'anggotas.nama_anggota',
                                'peminjamen.jumlah_peminjaman',
                            )
                            ->distinct()
                            ->get();
                $countBuku = DB::select("SELECT peminjaman_detail_peminjaman_id, MAX(tgl_pinjam) as tgl_pinjam, MAX(tgl_kembali) as tgl_kembali,
                                        SUM(CASE WHEN status_peminjaman = '4' OR status_peminjaman = '5' THEN 1 ELSE 0 END) AS sudah_verif
                                        FROM peminjaman_details
                                        GROUP BY peminjaman_detail_peminjaman_id");
            }

            // Mengubah hasil query builder menjadi koleksi Laravel
            $operation = Collection::make($operation);
            $countBuku = Collection::make($countBuku);
            
            // Menggabungkan kedua koleksi menjadi satu array
            $result = $operation->map(function ($item) use ($countBuku) {
                $count = $countBuku->firstWhere('peminjaman_detail_peminjaman_id', $item->peminjaman_detail_peminjaman_id);
                if ($_GET['name'] == 'belum_verif'){
                    $item->belum_verif = $count ? $count->belum_verif : 0;
                    $item->tgl_pinjam = $count ? $count->tgl_pinjam : 0;
                    $item->tgl_kembali = $count ? $count->tgl_kembali : 0;
                } else {
                    $item->sudah_verif = $count ? $count->sudah_verif : 0;
                    $item->tgl_pinjam = $count ? $count->tgl_pinjam : 0;
                    $item->tgl_kembali = $count ? $count->tgl_kembali : 0;
                }
                return $item;
            })->toArray();

            return $this->response($result);
        } catch (\Exception $e) {
            return $this->response($e->getMessage(), true);
        }
    }

    public function selectDetail(){
        try {
            if ($_GET['name'] == 'belum_verif') {
                $operation = DB::table('peminjamen')
                            ->join('anggotas','peminjamen.anggota_id','=','anggotas.id')
                            ->join('peminjaman_details','peminjamen.peminjaman_id','=','peminjaman_details.peminjaman_detail_peminjaman_id')
                            ->join('perpanjangans','peminjaman_details.peminjaman_detail_id','=','perpanjangans.peminjaman_detail_id')
                            ->join('detail_bukus','peminjaman_details.detail_buku_id','=','detail_bukus.eksemplar_id')
                            ->join('bukus','detail_bukus.buku_id','=','bukus.id')
                            ->where('peminjamen.peminjaman_id', $_GET['id'])
                            ->where('peminjaman_details.status_peminjaman','3')
                            ->select(
                                'peminjamen.peminjaman_id',
                                'peminjaman_details.peminjaman_detail_id',
                                'anggotas.no_induk',
                                'anggotas.jenis_anggota',
                                'peminjaman_details.status_peminjaman',
                                'peminjaman_details.tgl_pinjam',
                                'peminjaman_details.tgl_kembali',
                                'perpanjangans.alasan_perpanjangan',
                                'perpanjangans.tgl_kembali_baru',
                                'detail_bukus.no_panggil',
                                'bukus.judul'
                            )
                            ->get();
            } else {
                $operation = DB::table('peminjamen')
                            ->join('anggotas','peminjamen.anggota_id','=','anggotas.id')
                            ->join('peminjaman_details','peminjamen.peminjaman_id','=','peminjaman_details.peminjaman_detail_peminjaman_id')
                            ->join('detail_bukus','peminjaman_details.detail_buku_id','=','detail_bukus.eksemplar_id')
                            ->join('bukus','detail_bukus.buku_id','=','bukus.id')
                            ->where('peminjamen.peminjaman_id', $_GET['id'])
                            ->whereIn('peminjaman_details.status_peminjaman',['4','5'])
                            ->select(
                                'peminjamen.peminjaman_id',
                                'peminjaman_details.peminjaman_detail_id',
                                'anggotas.no_induk',
                                'anggotas.jenis_anggota',
                                'peminjaman_details.status_peminjaman',
                                'peminjaman_details.tgl_pinjam',
                                'peminjaman_details.tgl_kembali',
                                'detail_bukus.no_panggil',
                                'bukus.judul'
                            )
                            // ->orderBy('peminjaman_details.tgl_kembali', 'asc')
                            ->get();
            }
                            
            return $this->response($operation);
        } catch (\Exception $e) {
            return $this->response($e->getMessage(), true);
        }
    }

    public function update(){
        try {
            if ($_POST['dataSubmit'] != ''){
                foreach ($_POST['dataSubmit'] as $id){
                    $perpanjangan = Perpanjangan::where('peminjaman_detail_id',$id)->first()->toArray();
                    PeminjamanDetail::where('peminjaman_detail_id',$id)->where('status_peminjaman','3')->update([
                        'status_peminjaman' => '4', 'tgl_kembali' => $perpanjangan['tgl_kembali_baru']
                    ]);
                    Perpanjangan::where('peminjaman_detail_id', $id)->delete();
                }
            }  
            if ($_POST['dataReject'] != ''){
                foreach ($_POST['dataReject'] as $id){
                    PeminjamanDetail::where('peminjaman_detail_id',$id)->where('status_peminjaman','3')->update([
                        'status_peminjaman' => '5'
                    ]);
                    Perpanjangan::where('peminjaman_detail_id', $id)->delete();
                }
            }  
    
            $operation['success'] = true;
            return $this->response($operation);
        } catch (\Exception $e) {
            return $this->response($e->getMessage(), true);
        }
    }

}
