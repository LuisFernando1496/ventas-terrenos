<?php

use App\Http\Controllers\BranchOfficeController;
use App\Http\Controllers\BusinessUnitController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\InvestorController;
use App\Http\Controllers\PayamentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SaleController;
use App\Models\Investor;
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
Route::middleware(['auth:sanctum','verified'])->get('/clients/historyClient/{client}',[ClientController::class,'historyClient'])->name('historyClient');
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
Route::middleware(['auth:sanctum','verified'])->patch('/bussinesUnit/{businessUnit}',[BusinessUnitController::class,'update'])->name('bussinesUnit.update');
Route::middleware(['auth:sanctum','verified'])->patch('/bussinesUnit/delete/{businessUnit}',[BusinessUnitController::class,'supr'])->name('bussinesUnit.supr');

Route::middleware(['auth:sanctum','verified'])->get('/compras',[PurchaseController::class,'index'])->name('purchase');
Route::middleware(['auth:sanctum','verified'])->post('/compras',[PurchaseController::class,'store'])->name('purchase.store');
Route::middleware(['auth:sanctum','verified'])->patch('/compras/{purchase}',[PurchaseController::class,'update'])->name('purchase.update');
Route::middleware(['auth:sanctum','verified'])->delete('/compras/{purchase}',[PurchaseController::class,'destroy'])->name('purchase.delete');
Route::get('/productos-ajax/{id}',[ProductController::class,'ajax']);

Route::middleware(['auth:sanctum','verified'])->get('/projects',[ProjectController::class,'index'])->name('projects');
Route::middleware(['auth:sanctum','verified'])->get('/projects/{project}',[ProjectController::class,'show'])->name('projects.show');
Route::middleware(['auth:sanctum','verified'])->post('/projects',[ProjectController::class,'store'])->name('projects.store');
Route::middleware(['auth:sanctum','verified'])->patch('/projects/progress/{project}',[ProjectController::class,'progress'])->name('projects.progress');
Route::middleware(['auth:sanctum','verified'])->patch('/projects/{project}',[ProjectController::class,'update'])->name('projects.update');
Route::middleware(['auth:sanctum','verified'])->patch('/projects/delete/{project}',[ProjectController::class,'supr'])->name('projects.supr');

Route::middleware(['auth:sanctum','verified'])->get('investments',[InvestorController::class,'index'])->name('investors');
Route::middleware(['auth:sanctum','verified'])->post('investments',[InvestorController::class,'store'])->name('investors.store');
Route::middleware(['auth:sanctum','verified'])->patch('investments/{investor}',[InvestorController::class,'update'])->name('investors.update');
Route::middleware(['auth:sanctum','verified'])->patch('investments/delete/{investor}',[InvestorController::class,'supr'])->name('investors.supr');

Route::middleware(['auth:sanctum','verified'])->get('/sales',[SaleController::class,'index'])->name('sales');
Route::middleware(['auth:sanctum','verified'])->get('/sales/seachByCode', [SaleController::class,'searchByCode']);
Route::middleware(['auth:sanctum','verified'])->get('/sales/search', [SaleController::class,'search']);
Route::middleware(['auth:sanctum','verified'])->post('/sales',[SaleController::class,'store'])->name('sales.store');
Route::middleware(['auth:sanctum','verified'])->post('reprint', [SaleController::class,'reprint'])->name('reprint');
Route::middleware(['auth:sanctum','verified'])->patch('/sales/{sale}',[SaleController::class,'update'])->name('sales.update');
Route::middleware(['auth:sanctum','verified'])->patch('/sales/delete/{sale}',[SaleController::class,'supr'])->name('sales.supr');
Route::middleware(['auth:sanctum','verified'])->get('/sales/history',[SaleController::class,'historySale'])->name('history.sale');

Route::middleware(['auth:sanctum','verified'])->get('/abonos',[PayamentController::class,'index'])->name('payment.index');
Route::middleware(['auth:sanctum','verified'])->post('/abonos',[PayamentController::class,'store'])->name('payment.store');
Route::middleware(['auth:sanctum','verified'])->patch('/abonos/{pay}',[PayamentController::class,'update'])->name('payment.update');
Route::middleware(['auth:sanctum','verified'])->delete('/abonos/{pay}',[PayamentController::class,'destroy'])->name('payment.delete');
Route::middleware(['auth:sanctum','verified'])->get('/abonos/{pago}',[PayamentController::class,'show'])->name('payment.show');
