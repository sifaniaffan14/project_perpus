<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KategoriBukuController;
use App\Http\Controllers\DetailBukuController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\RoleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//buku
Route::post("/addBuku",[BukuController::class,'add']);
Route::get("/listBuku",[BukuController::class,'list']);
Route::post("/updateBuku",[BukuController::class,'update']);
Route::delete("/deleteBuku/{id}",[BukuController::class,'delete']);
//anggota
Route::post("/addAnggota",[AnggotaController::class,'insert']);
Route::get("/viewAnggota",[AnggotaController::class,'select']);
//user
Route::get("/listUser",[UserController::class,'list']);
Route::post("/addUser",[UserController::class,'add']);
Route::post("/deleteUser/{id}",[UserController::class,'delete']);
//kategori
Route::post("/addKategori",[KategoriBukuController::class,'add']);
Route::get("/listKategori",[KategoriBukuController::class,'list']);
Route::post("/updateKategori",[KategoriBukuController::class,'update']);
Route::delete("/deleteKategori/{id}",[KategoriBukuController::class,'delete']);
//detail
Route::post("/addDetail",[DetailBukuController::class,'add']);
Route::get("/listDetail",[DetailBukuController::class,'list']);
Route::post("/updateDetail",[DetailBukuController::class,'update']);
Route::delete("/deleteDetail/{id}",[DetailBukuController::class,'delete']);
//peminjaman
Route::post("/addPeminjaman",[PeminjamanController::class,'add']);
Route::get("/listPeminjaman",[PeminjamanController::class,'list']);
Route::post("/updatePeminjaman",[PeminjamanController::class,'update']);
Route::delete("/deletePeminjan/{id}",[PeminjamanController::class,'delete']);
//roles
Route::post("/addRoles",[RoleController::class,'add']);
Route::get("/listRoles",[RoleController::class,'list']);
Route::post("/updateRoles",[RoleController::class,'update']);
Route::delete("/deleteRoles/{id}",[RoleController::class,'delete']);

?>