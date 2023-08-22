<?php

namespace App\Http\Controllers;

use App\Models\roles;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Mockery\Undefined;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.layouts.profile.index');
    }

    public function selectUser(){
        try {
            $operation = User::join('roles','users.role_id','=','roles.id')
                        ->where('users.id', Auth::id())
                        ->select(
                            'users.*',
                            'roles.nama_role'
                        )
                        ->get()->toArray();
            return $this->response($operation);
        } catch (\Exception $e) {
            return $this->response($e->getMessage(), true);
        }
    }

    public function update(Request $request){
        try {
            $data = $request->all();
            $request->validate([
                'profile_username' => 'required',
            ]);

            $user = User::find($data['id']);

            $user->username = $data['profile_username'];

            if ($data['isremoved'] == 1){
                unlink(public_path('storage/user/'.$user->picture));
                $user->picture = null;
            }
          
            $photo = $request->file('photo');
            if (!empty($photo)) {
                $request->photo = $user->username . '-user.' . $photo->getClientOriginalExtension();
                $photo->move(public_path('storage/user/') , $request->photo);
                $user->picture = $request->photo;
            }

            $operation = $user->save();
            return $this->responseUpdate($operation);
        } catch (\Exception $e) {
            return $this->responseUpdate($e->getMessage(), true);
        }
    }

    public function updatePassword(Request $request){
        try {
            $data = $request->all();
            $user = User::find(Auth::id());

            if (password_verify($data['oldPass'], $user->password)) {
                $user->password = bcrypt($data['newPass']);
                $user->save();
                $operation['success'] = true;
                return $this->response($operation);
            } else {
                $operation['success'] = false;
                return $this->response($operation);
            }
        } catch (\Exception $e) {
            return $this->responseUpdate($e->getMessage(), true);
        }
    }
}
