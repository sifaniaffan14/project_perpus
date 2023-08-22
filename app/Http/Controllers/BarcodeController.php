<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailBuku;
use PDF;

class BarcodeController extends Controller
{
    public function getBarcode(Request $request){
        if(isset($request->detail_check)){
            $barcodebuku = DetailBuku::wherein('KodeBuku',$request->detail_check)->get();
        } else{
            $barcodebuku = DetailBuku::all();
        }
        return view('admin.layouts.Buku.barcodeBuku',['barcodebuku'=>$barcodebuku]);

    }

    public function printBarcode(){
        $list = DetailBuku::all();

        view()->share('list',$list);
        $pdf = PDF::loadView('pdfTemplate.pdfBarcode',['barcodebuku'=>$list])->setPaper('a4', 'potrait');
        return $pdf->download('barcodeBuku.pdf');
    }

    public function showpdf(){
        $list = DetailBuku::all();
        return view('pdfTemplate.pdfBarcode',['barcodebuku'=>$list]); 
    }
}
