<?php

use Illuminate\Support\Facades\Route;

include __DIR__.'/adminmart.php';
include __DIR__.'/user_admin.php';
include __DIR__.'/user_santri.php';
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

Route::redirect('/','/login/santri');

Route::view('login/santri','auth.login_santri');
Route::view('login/admin','auth.login_admin');

Route::post('/login/santri/proc', 'Auth\LoginController@santriLogin')->name('login-santri');
Route::post('/login/admin/proc', 'Auth\LoginController@adminLogin')->name('login-admin');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
