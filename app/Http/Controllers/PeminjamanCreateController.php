<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PeminjamanCreateController extends Controller
{
    public function index()
    {
        return view('admin.layouts.peminjaman.formCreate');
    }
}
