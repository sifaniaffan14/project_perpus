<?php

namespace App\Http\Controllers;

use App\Models\DetailBuku;
use App\Models\Peminjaman;
use App\Models\PeminjamanDetail;
use App\Models\Anggota;
use App\Models\Perpanjangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengembalianController extends Controller
{
    public function index()
    {
        return view('admin.layouts.pengembalian.index');
    }

    public function select()
    {
        try {
            $peminjaman = Peminjaman::where('anggota_id', $_GET['anggota_id'])->get()->toArray();
            foreach($peminjaman as $val){
                $operation = PeminjamanDetail::where('peminjaman_detail_peminjaman_id', $val['peminjaman_id'])->where('status_peminjaman', '!=', 2)->get()->toArray();
                if ($operation != []){
                    $where = array();
                    if (isset($_GET['anggota_id'])) {
                        $condition = ['anggota_id',$_GET['anggota_id']];
                        array_push($where,$condition);
                    } 
                    $operation = Peminjaman::with('peminjaman_detail.detail_buku.buku','anggota')->where($where)
                    ->where('peminjamen.peminjaman_id', $val['peminjaman_id'])->get();
                }
            }
            return $this->response($operation);
        } catch (\Exception $e) {
            return $this->response($e->getMessage(), true);
        }
    }

    public function select_eksemplar(){
        try {
            $where = array();
            if (isset($_GET['no_panggil'])) {
                $condition = ['no_panggil',$_GET['no_panggil']];
                array_push($where,$condition);
            } 

            $operation = DetailBuku::where($where)->get();
 
            return $this->response($operation);
        } catch (\Exception $e) {
            return $this->response($e->getMessage(), true);
        }
    }

    public function update(Request $request)
    {
        try {
            $data = $request->all();
            DB::transaction(function () use ($data) {   
                foreach ($data['eksemplar_id'] as $key => $value) {
                    $where = array(
                        ['peminjaman_detail_peminjaman_id',$data['peminjaman_id']],
                        ['detail_buku_id', $value]
                    );
                    
                    $peminjamanDetail =  PeminjamanDetail::where($where)->whereNotIn('status_peminjaman', [2])->first();
                    $peminjamanDetail->status_peminjaman = 2;
                    $peminjamanDetail->save();

                    DetailBuku::where('eksemplar_id',$value)->update([
                        'status' => 'tersedia'
                    ]);

                    Perpanjangan::where('peminjaman_detail_id', $peminjamanDetail->peminjaman_detail_id)->delete();
                    
                }
            });

            $operation['success'] = true;
            return $this->responseUpdate($operation);
        } catch (\Exception $e) {
            return $this->responseUpdate($e->getMessage(), true);
        }
    }

    public function selectDataAnggota(){
        $operation = Anggota::all();

        return $this->response($operation);
    }
}
