<?php

use App\Http\Controllers\HomeC;
use App\Http\Controllers\LaporanC;
use App\Http\Controllers\LogC;
use App\Http\Controllers\LoginC;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsC;
use App\Http\Controllers\TransactionsC;
use App\Http\Controllers\UsersC;

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


Route::middleware(['auth'])->group(function(){

//LAPORAN
Route::get('laporan', [LaporanC::class, 'index'])->name('laporan.index');
Route::get('/laporan/filter', [LaporanC::class, 'filter'])->name('laporan.filter');
Route::get('/laporan/export', [LaporanC::class, 'export'])->name('laporan.export');

//CRUD PRODUCTS
Route::get('products', [ProductsC::class, 'index'])->name('products.index');
Route::post('products/store', [ProductsC::class, 'store'])->name('products.store');
Route::get('products/create', [ProductsC::class, 'create'])->name('products.create');
Route::delete('products/{id}', [ProductsC::class, 'destroy'])->name('products.destroy');
Route::get('products/edit/{id}', [ProductsC::class, 'edit'])->name('products.edit');
Route::put('products/update/{id}', [ProductsC::class, 'update'])->name('products.update');
Route::get('products/pdf', [ProductsC::class, 'pdf'])->name('products.pdf');

//TRANSACTIONS CRUD
Route::get('transactions', [TransactionsC::class, 'index'])->name('transactions.index');
Route::post('transactions/store', [TransactionsC::class, 'store'])->name('transactions.store');
Route::get('transactions/create', [TransactionsC::class, 'create'])->name('transactions.create');
Route::delete('transactions/{id}', [TransactionsC::class, 'destroy'])->name('transactions.destroy');
Route::get('transactions/edit/{id}', [TransactionsC::class, 'edit'])->name('transactions.edit');
Route::put('transactions/update/{id}', [TransactionsC::class, 'update'])->name('transactions.update');
Route::get('transactions/{id}/struk', [TransactionsC::class, 'generateStruk'])->name('transactions.generateStruk');
// Route::get('/transactions/all', [TransactionsC::class, 'all'])->name('transactions.all');
// Route::get('/pertanggal/{tgl_awal}/{tgl_akhir}', [TransactionsC::class, 'pertanggal'])->name('transactions.pertanggal');

//LOG HISTORY
Route::resource('log', LogC::class);

//LOGOUT
Route::get('logout', [loginC::class, 'logout'])->name('logout');

//USERS
Route::resource('users', UsersC::class);
Route::get('users/changepassword/{id}', [UsersC::class, 'changepassword'])->name('users.changepassword');
Route::put('users/change/{id}', [UsersC::class, 'change'])->name('users.change');

//DASHBOARD
Route::get('/dashboard', [HomeC::class, 'index'])->name('dashboard');
Route::get('/', [HomeC::class, 'index'])->name('dashboard');

Route::get('/error', function () {
    $subtitle = "error";
    return view('error', compact('subtitle'));
});
});

//LOGIN
Route::get('login', [LoginC::class, 'login'])->name('login');
Route::post('login', [LoginC::class, 'login_action'])->name('login.action');
