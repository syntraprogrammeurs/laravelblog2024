<?php

use App\Http\Controllers\AdminUsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});
Route::group(['prefix'=>'admin','middleware'=>'auth'],function(){
    Route::resource('users', App\Http\Controllers\AdminUsersController::class);
    Route::get('{user}/restore',[AdminUsersController::class, 'restore'])->name('admin.userrestore');
    Route::get('faq', function () {
        return view('admin.faq.index');
    })->name('admin.faq');
});


Auth::routes();

Route::get('/admin', [App\Http\Controllers\BackendController::class, 'index'])->name('home');
