<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use Illuminate\Support\Facades\Auth;

class AnggotaNavbarController extends Controller
{
    public function select()
    {
        try {
            $operation = Anggota::join('users', 'anggotas.user_id', '=', 'users.id')
                            ->where("anggotas.user_id", Auth::id())
                            ->select(
                                "anggotas.id",
                                "anggotas.nama_anggota",
                                "users.username",
                                "users.picture"
                                )
                            ->get()->toArray();
            return $this->response($operation);
        } catch (\Exception $e) {
            return $this->response($e->getMessage(), true);
        }
    }

}
