<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Roles;

class RoleController extends Controller
{
    // public function list(){
    //     $list=Roles::all();
    //     return $list;
    // }
    // public function add(){
    //     $add=Roles::create([
    //         'nama_role' => request()->nama_role,
    //     ]);
    //     return $add;
    // }    
    // public function update(Request $request){
    //     $update=Roles::find($request->id);
    //     $update->update($request->all());
    //     return $update;
    // }
    // public function delete($id){
    //     $delete=Roles::find($id);
    //     $delete->delete();
    //     return $delete;
    // }
    public function index(){
        return view('admin.layouts.role.index');
    }
    public function select(){
        try {
            if(isset($_GET['id'])){
                $operation = Roles::where('id',$_GET['id'])->where('is_active',1)->get();
            } else{ 
                $operation = Roles::where('is_active',1)->get();
            }
            return $this->response($operation);
        } catch (\Exception $e) {
            return $this->response($e->getMessage(),true);
        }
    }
    public function insert(Request $request){
        try {
            $data = $request->all();
            // print_r($data);exit;
            $request->validate([
                'nama_role'=> 'required',
            ]);
            
            $data = $request->post();
            $operation = Roles::create($data);
            return $this->responseCreate($operation);
        } catch (\Exception $e) {
            return $this->responseCreate($e->getMessage(),true);
        }
    }    
    public function update(Request $request){

        try {
            $data = $request->all();
            // print_r($data);exit;
            $request->validate([
                'nama_role'=> 'required',
            ]);
            
            $data = Roles::find(request()->id);
            $operation = $data->update($request->post());
            return $this->responseUpdate($operation);
        } catch (\Exception $e) {
            return $this->responseCreate($e->getMessage(),true);
        }
    }
    public function delete(Request $request){
        
        try {            
            $data = $request->all();
            $data['is_active'] = 0;
            $operation = Roles::find($data['id'])->update($data);

            return $this->responseDelete($operation);
        } catch (\Exception $e) {
            return $this->responseDelete($e->getMessage());
        }
    }
}
