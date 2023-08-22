<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class AnggotaProfileController extends Controller
{
    public function index()
    {
        return view('anggota.layouts.profile.index');
    }

    public function select()
    {
        try {
            $operation = Anggota::join('users', 'anggotas.user_id', '=', 'users.id')
                            ->where("anggotas.user_id", Auth::id())
                            ->select(
                                "anggotas.*",
                                "users.username",
                                "users.picture"
                                )
                            ->get()->toArray();
            return $this->response($operation);
        } catch (\Exception $e) {
            return $this->response($e->getMessage(), true);
        }
    }

    public function updateProfile(Request $request){
        try {
            $data = $request->all();

            $user = User::find(Auth::id());

            if ($data['oldPass'] != null || $data['oldPass'] != ''){
                if (password_verify($data['oldPass'], $user->password)) {
                    $user->password = bcrypt($data['newPass']);
                } else {
                    $operation['success'] = false;
                    return $this->response($operation);
                }
            }

            $user->username = $data['username'];

            if ($data['avatar_remove'] == 1){
                unlink(public_path('storage/user/'.$user->picture));
                $user->picture = null;
            }
          
            $avatar = $request->file('avatar');
            if (!empty($avatar)) {
                $request->avatar = $user->username . '-user.' . $avatar->getClientOriginalExtension();
                $avatar->move(public_path('storage/user/') , $request->avatar);
                $user->picture = $request->avatar;
            }

            $user->save();
            $operation['success'] = true;
            return $this->response($operation);
        } catch (\Exception $e) {
            return $this->responseUpdate($e->getMessage(), true);
        }
    }

    public function updateBiodata(Request $request){
        try {
            $data = $request->all();

            $anggota = Anggota::where('user_id', Auth::id())->first();
            $anggota->nama_anggota = $data['nama_anggota'];
            $anggota->jenis_kelamin = $data['jenis_kelamin'];
            $anggota->tempat_lahir = $data['tempat_lahir'];
            $anggota->tanggal_lahir = $data['tanggal_lahir'];
            $anggota->alamat = $data['alamat'];
            $anggota->email = $data['email'];
            $anggota->no_telp = $data['no_telp'];

            $operation = $anggota->save();
            return $this->responseUpdate($operation);
        } catch (\Exception $e) {
            return $this->responseUpdate($e->getMessage(), true);
        }
    }
}
