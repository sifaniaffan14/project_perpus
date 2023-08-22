<?php

namespace App\Http\Controllers;

use App\Models\roles;
use App\Models\User;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Mockery\Undefined;

class UserController extends Controller
{
    // public function list(){
    //     $list=User::where('is_active','=',1)->get();
    //     return $list;
    // }
    // public function add(){
    //     $add=User::create([
    //         'role_id' => request()->role_id,
    //         'username' => request()->username,
    //         'password' => bcrypt(request()->password),
    //     ]);
    //     return $add;
    // }    
    // public function delete($id){
    //     $update=User::find($id);
    //     $data['is_active']='0';
    //     $update->update($data);
    //     return $update;
    // }

    public function index()
    {
        return view('admin.layouts.user.index');
    }

    public function select(Request $request)
    {
        try {
            if(isset($_GET['id'])){

                $operation = db::select('SELECT users.*,roles.nama_role FROM `users`
                LEFT JOIN roles
                ON users.role_id = roles.id
                WHERE users.id = "' . $_GET['id'] . '" AND users.is_active = 1');
            } else{ 
                $operation = db::select('SELECT users.*,roles.nama_role FROM `users`
               LEFT JOIN roles
                ON users.role_id = roles.id
                WHERE users.is_active = 1');
            }
            return $this->response($operation);
        } catch (\Exception $e) {
            return $this->response($e->getMessage(), true);
        }
    }
    public function getRole()
    {
        $role = roles::select('nama_role', 'id')->where('is_active', 1)->orderBy('nama_role', 'asc')->get();
        return $this->response($role);
    }

    public function insert(Request $request)
    {
        try {
            $data = $request->all();
            $request->validate([
                'role_id' => 'required',
                'username' => 'required',
                'password' => 'required',
            ]);
            $data['password'] = bcrypt(request()->password);
            // $data = $request->post();
            // print_r($data);exit;
            $operation = User::create($data);
            // print_r($operation);exit;
            // $image = $request->file('picture');
            // if (!empty($image)) {
            //     $time = request()->input('carbon');
            //     $originalFilename = $image->getClientOriginalName();
            //     $newFilename = $request->judul . '-cover.' . $image->getClientOriginalExtension();
            //     $image->move(storage_path('app/public/buku/' . $newFilename));
            //     // $operation->update(['image' => $newFilename],['updated_at' => Carbon::now()]);
            //     // $oldpic = get_setting('image');
            //     // Storage::delete('app/public/buku/'. $oldpic);

            //     // DB::table('bukus')->where('id',0)->update([
            //     //     'image' => $newFilename,               
            //     //     ]);
            // }
            return $this->responseCreate($operation);
        } catch (\Exception $e) {
            return $this->responseCreate($e->getMessage(), true);
        }
    }
    public function update(Request $request)
    {  
        try {
            $request->validate([
                'role_id' => 'required',
                'username' => 'required',
                // 'password' => 'required',
            ]);

            $user = User::find($request->all()['id']);
            $user->role_id = $request->all()['role_id'];
            $user->username = $request->all()['username'];
            
            if ($request->all()['password'] != null){
                $user->password = bcrypt(request()->password);
            } 

            if ($request->all()['isremoved'] == 1){
                unlink(public_path('storage/user/'.$user->picture));
                $user->picture = null;
            } else {
                try {
                    $photo = $request->file('photo');
                    if (!empty($photo)) {
                        $request->photo = $request->username . '-user.' . $photo->getClientOriginalExtension();
                        $photo->move(public_path('storage/user/') , $request->photo);
                    }
    
                    $user->picture = $request->photo;
                } catch (\Exception $e) {
                }
            }
          
            $operation = $user->save();
            return $this->responseUpdate($operation);
        } catch (\Exception $e) {
            return $this->responseUpdate($e->getMessage(), true);
        }
    }
    
    public function delete(Request $request)
    {
        try {
            $data = $request->all();
            $data['is_active'] = 0;
            $operation = User::find($data['id'])->update($data);

            return $this->responseDelete($operation);
        } catch (\Exception $e) {
            return $this->responseDelete($e->getMessage());
        }
    }
}
