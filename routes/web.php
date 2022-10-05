<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Cms\HomeController;
use App\Http\Controllers\Cms\PostController;
use App\Http\Controllers\Frontend\PostController as AppPostController;
use App\Http\Controllers\Frontend\HomeController as AppHomeController;
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

//Auth::routes();

Route::get('/', [AppHomeController::class, 'index'])->name('app.home');
Route::get('/login', [LoginController::class, 'getLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class,'showRegistrationForm'])->name('register');
Route::get('/blog/{post}', [AppPostController::class, 'show']);

// Admin Routes
Route::prefix("admin")->group(function(){
    Route::get('/', [HomeController::class, 'index'])->name('admin.dashboard');
    Route::get('/home', [HomeController::class, 'index'])->name('admin.home');
    Route::get('/blog', [PostController::class, 'index'])->name('blog.index');
    Route::get('/blog/datatables', [PostController::class, 'getDatatables'])->name('blog.datatable');
    Route::get('/blog/create', [PostController::class, 'create'])->name('blog.create');
    Route::post('/blog/create', [PostController::class, 'store'])->name('blog.save');
    Route::get('/blog/{post}/edit', [PostController::class, 'edit'])->name('blog.edit');
    Route::put('/blog/{post}/edit', [PostController::class, 'update'])->name('blog.update');
    Route::delete('/blog/{post}', [PostController::class, 'destroy'])->name('blog.delete');
    Route::get('/blog/{post}', [PostController::class, 'show'])->name('blog.show');
    Route::put('/blog/{post}', [PostController::class, 'publish'])->name('blog.publish');
});
