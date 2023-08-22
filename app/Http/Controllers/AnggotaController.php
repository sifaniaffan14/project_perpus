<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\User;
use App\Models\roles;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

use DB;

use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function list()
    {
        // $list=Anggota::where('is_active','=',1)->get();
        $list = Anggota::all();
        return View('admin.layouts.Anggota.anggotaManagement', ['list' => $list]);
    }
    public function form()
    {
        $anggota = Anggota::find(request()->id_anggota);
        return view('admin.layouts.Anggota.anggotaForm', ['anggota' => $anggota]);
    }
    public function formEdit()
    {
        $anggota = Anggota::find(request()->id_anggota);
        return view('admin.layouts.Anggota.anggotaForm', ['anggota' => $anggota]);
    }

    public function select(){
        try {
            $operation = Anggota::all();
            return $this->response($operation);
        } catch (\Exception $e) {
            return $this->response($e->getMessage(),true);
        }
    }

    public function insert(Request $request)
    {
        try {
            $data = $request->all();
            $request->validate([
                'no_induk' => 'required',
                'nama_anggota' => 'required',
                'jenis_kelamin' => 'required',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required',
                'jenis_anggota' => 'required',
                'alamat' => 'required',
                'email' => 'required',
                'no_telp' => 'required',
            ]);

            DB::transaction(function () use ($data) {
                $role = roles::where('nama_role', '=', 'Anggota')->first();
                $add = User::create([
                    'role_id' => $role['id'],
                    'username' => $data['no_induk'],
                    'password' => bcrypt('perpus_' . $data['no_induk']),
                ]);
                $data['user_id'] = $add['id'];
                // $data = $request->post();
                // print_r($data['id']);exit;
                $anggota = Anggota::create($data);

            });

            $operation['success'] = true;
            return $this->responseCreate($operation);

        } catch (\Exception $e) {
            return $this->responseCreate($e->getMessage(), true);
        }
    }
    // public function add()
    // {
    //     $role = Roles::where('nama', '=', 'Anggota')->first();
    //     $user = User::create([
    //         'role_id' => $role->id,
    //         'username' => request()->no_induk,
    //         'password' => bcrypt('perpus_' . request()->no_induk),
    //     ]);
    //     if (isset($user)) {
    //         Anggota::create([
    //             'no_induk' => request()->no_induk,
    //             'nama' => request()->nama,
    //             'jenis_kelamin' => request()->jenis_kelamin,
    //             'TTL' => request()->TTL,
    //             'jenis_anggota' => request()->jenis_anggota,
    //             'alamat' => request()->alamat,
    //             'email' => request()->email,
    //             'no_telp' => request()->no_telp,
    //             'user_id' => $user->id,
    //         ]);
    //     }
    //     return response()->json(['success' => true]);
    // }


    public function update(Request $request)
    {
        $updateAnggota = Anggota::find($request->id);
        $updateAnggota->update($request->all());
        return response()->json(['success' => true, 'updateAnggota' => $updateAnggota]);
    }

    public function detailAnggota(Request $request)
    {
        $detailAnggota = Anggota::find($request->id);
        return view('admin.layouts.Anggota.detailAnggota', ['detailAnggota' => $detailAnggota]);
    }

    public function delete($id)
    {
        $delete = Anggota::find($id);
        $delete->delete();
        return $delete;
    }
}
