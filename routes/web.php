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
Route::get('/contact', function(){
    return view('contact');
});
//get = voor formulierweergave op de link
Route::get('contact','App\Http\Controllers\ContactController@create');
//post = is voor submitten van de gegevens op het formulier
Route::post('contact','App\Http\Controllers\ContactController@store');


//routes for all users
Route::group(['prefix'=>'admin','middleware'=>['auth','verified']],function(){
    Route::get('faq', function () {
        return view('admin.faq.index');
    })->name('admin.faq');
});
//routes for only admin users
Route::group(['prefix'=>'admin','middleware'=>['admin','verified']],function(){
    Route::get('admin',[\App\Http\Controllers\BackendController::class,'index']);
    Route::resource('users', App\Http\Controllers\AdminUsersController::class);
    Route::get('{user}/restore',[AdminUsersController::class, 'restore'])->name('admin.userrestore');
    Route::get('usersbc',[AdminUsersController::class,'index2'])->name('users-admin.index2');
});


Auth::routes(['verify'=>true]);

Route::get('/admin', [App\Http\Controllers\BackendController::class, 'index'])->name('home');
