<?php

use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\PostController;
use App\Livewire\Counter;
use App\Models\User;
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

Route::get('/', [FrontendController::class,'index'])->name('frontend.home');
Route::get('post/{post:slug}', [PostController::class,'post'])->name('frontend.post');
Route::get('category/{category:slug}', [CategoryController::class,'category'])->name('category.category');

Route::get('/contact', function(){
    return view('contact');
});

//get = voor formulierweergave op de link
Route::get('contact','App\Http\Controllers\ContactController@create');
//post = is voor submitten van de gegevens op het formulier
Route::post('contact','App\Http\Controllers\ContactController@store');

Route::get('/counter', Counter::class);



//routes for all users
Route::group(['prefix'=>'admin','middleware'=>['auth','verified']],function(){
    Route::get('faq', function () {
        return view('admin.faq.index');
    })->name('admin.faq');
    //posts
    Route::resource('posts',PostController::class,['except'=>['show']]);
    Route::get('posts/{post:slug}',[PostController::class,'show'])->name('posts.show');
    Route::get('posts/{posts}/restore', [PostController::class,'restore'])->name('postrestore');
    //post comments
    Route::resource('comments',PostCommentController::class);
    //categories
    Route::resource('categories', CategoryController::class);
    Route::get('categories/{categories}/restore',[CategoryController::class, 'restore'])->name('categoryrestore');
    Route::get('authors/{author:name}',[PostController::class,'indexByAuthor'])->name('authors');

});
//routes for only admin users
Route::group(['prefix'=>'admin','middleware'=>['admin','verified']],function(){
    Route::get('/dashboard',[\App\Http\Controllers\BackendController::class,'index'])->name('admin.index');
    Route::resource('users', App\Http\Controllers\AdminUsersController::class);
    Route::get('{user}/restore',[AdminUsersController::class, 'restore'])->name('admin.userrestore');
    Route::get('usersbc',[AdminUsersController::class,'index2'])->name('users-admin.index2');
});


Auth::routes(['verify'=>true]);

Route::get('/admin', [App\Http\Controllers\BackendController::class, 'index'])->name('home');
