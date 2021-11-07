<?php

use App\Http\Controllers\BranchOfficeController;
use App\Http\Controllers\BusinessUnitController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ExpenseController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum','verified'])->get('/users',[UserController::class,'index'])->name('users');
Route::middleware(['auth:sanctum','verified'])->post('/users',[UserController::class,'store'])->name('users.store');
Route::middleware(['auth:sanctum','verified'])->patch('/users/{user}',[UserController::class,'update'])->name('users.update');

Route::middleware(['auth:sanctum','verified'])->get('/sucursales',[BranchOfficeController::class,'index'])->name('sucursales');
Route::middleware(['auth:sanctum','verified'])->post('/sucursales',[BranchOfficeController::class,'store'])->name('sucursales.store');
Route::middleware(['auth:sanctum','verified'])->patch('/sucursales/{sucursal}',[BranchOfficeController::class,'update'])->name('sucursales.update');

Route::middleware(['auth:sanctum','verified'])->get('/productos',[ProductController::class,'index'])->name('productos');
Route::middleware(['auth:sanctum','verified'])->post('/productos',[ProductController::class,'store'])->name('productos.store');
Route::middleware(['auth:sanctum','verified'])->patch('/productos/{product}',[ProductController::class,'update'])->name('productos.update');
Route::middleware(['auth:sanctum','verified'])->patch('/productos/delete/{product}',[ProductController::class,'supr'])->name('productos.supr');

Route::middleware(['auth:sanctum','verified'])->get('/clients',[ClientController::class,'index'])->name('clients');
Route::middleware(['auth:sanctum','verified'])->post('/clients',[ClientController::class,'store'])->name('clients.store');
Route::middleware(['auth:sanctum','verified'])->patch('/clients/{client}',[ClientController::class,'update'])->name('clients.update');
Route::middleware(['auth:sanctum','verified'])->patch('/clients/delete/{client}',[ClientController::class,'supr'])->name('clients.supr');

//gastos
Route::middleware(['auth:sanctum','verified'])->get('/pagos',[ExpenseController::class,'index'])->name('pagos');
Route::middleware(['auth:sanctum','verified'])->post('/pagos',[ExpenseController::class,'store'])->name('pagos.store');
Route::middleware(['auth:sanctum','verified'])->patch('/pagos/{expense}',[ExpenseController::class,'update'])->name('pagos.update');
Route::middleware(['auth:sanctum','verified'])->patch('/pagos/delete/{expense}',[ExpenseController::class,'supr'])->name('pagos.supr');

Route::middleware(['auth:sanctum','verified'])->get('/bussinesUnit',[BusinessUnitController::class,'index'])->name('bussinesUnit');
Route::middleware(['auth:sanctum','verified'])->post('/bussinesUnit',[BusinessUnitController::class,'store'])->name('bussinesUnit.store');
Route::middleware(['auth:sanctum','verified'])->patch('/bussinesUnit/{expense}',[BusinessUnitController::class,'update'])->name('bussinesUnit.update');
Route::middleware(['auth:sanctum','verified'])->patch('/bussinesUnit/delete/{expense}',[BusinessUnitController::class,'supr'])->name('bussinesUnit.supr');