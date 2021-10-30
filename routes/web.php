<?php

use App\Http\Controllers\BranchOfficeController;
use App\Http\Controllers\UserController;
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
    return view('welcome');
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
