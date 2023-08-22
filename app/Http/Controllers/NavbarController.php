<?php

namespace App\Http\Controllers;

use App\Models\roles;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Mockery\Undefined;
use App\Models\Anggota;
use Illuminate\Support\Facades\Auth;

class NavbarController extends Controller
{
    public function select()
    {
        try {
            $operation = User::join('roles','users.role_id','=','roles.id')
                        ->where('users.id', Auth::id())
                        ->select(
                            'users.id',
                            'users.username',
                            'users.picture',
                            'roles.nama_role'
                        )
                        ->get()->toArray();
            return $this->response($operation);
        } catch (\Exception $e) {
            return $this->response($e->getMessage(), true);
        }
    }
}
