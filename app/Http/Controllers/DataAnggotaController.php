<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\User;
use App\Models\roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataAnggotaController extends Controller
{
    public function index()
    {
        return view('admin.layouts.data-anggota.index');
    }

    public function select(Request $request)
    {
        try {
            if (isset($_GET['id'])) {
                $operation = DB::table("anggotas")
                            ->where("id", $_GET['id'])
                            ->where("is_active", 1)
                            ->get();
            } else {
                $operation = DB::table("anggotas")
                            ->where("is_active", 1)
                            ->get();
            }
            return $this->response($operation);
        } catch (\Exception $e) {
            return $this->response($e->getMessage(), true);
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
            ]);

            DB::transaction(function () use ($data) {
                $role = roles::where('nama_role', '=', 'Anggota')->first();
                $add = User::create([
                    'role_id' => $role['id'],
                    'username' => $data['no_induk'],
                    'password' => bcrypt('perpus_' . $data['no_induk']),
                ]);
                $data['user_id'] = $add['id'];

                $anggota = Anggota::create($data);

            });

            $operation['success'] = true;
            return $this->responseCreate($operation);

        } catch (\Exception $e) {
            return $this->responseCreate($e->getMessage(), true);
        }
    }
    public function update(Request $request)
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
            ]);
            unset($data['_token']);
            
            DB::transaction(function () use ($data) {
                $anggota = DB::table('anggotas')
                ->where('id', '=', $data['id'])
                ->update([
                    'no_induk' => $data['no_induk'],
                    'nama_anggota' => $data['nama_anggota'],
                    'jenis_kelamin' => $data['jenis_kelamin'],
                    'tempat_lahir' => $data['tempat_lahir'],
                    'tanggal_lahir' => $data['tanggal_lahir'],
                    'jenis_anggota' => $data['jenis_anggota'],
                    'alamat' => $data['alamat'],
                    'email' => $data['email'],
                    'no_telp' => $data['no_telp']
                ]);
        
                $getAnggota = DB::table('anggotas')->where('id', '=', $data['id'])->first();
                $user = DB::table('users')
                            ->where('id', $getAnggota->user_id)
                            ->update([
                                'username' => $data['no_induk'],
                                'password' => bcrypt('perpus_' . $data['no_induk']),
                            ]
                );
            });
            
            $operation['success'] = true;
            return $this->responseUpdate($operation);
        } catch (\Exception $e) {
            return $this->responseUpdate($e->getMessage(), true);
        }
    }
    public function delete(Request $request)
    {
        try {
            $data = $request->all();

            DB::transaction(function () use ($data) {
                $anggota = DB::table('anggotas')
                        ->where('id', '=', $data['id'])
                        ->update([
                            'is_active' => '0'
                        ]);

                $getAnggota = DB::table('anggotas')->where('id', '=', $data['id'])->first();
                $user = DB::table('users')
                            ->where('id', $getAnggota->user_id)
                            ->update([
                                'is_active' => '0'
                            ]);
            });

            $operation['success'] = true;
            return $this->responseDelete($operation);
        } catch (\Exception $e) {
            return $this->responseDelete($e->getMessage());
        }
    }
}
