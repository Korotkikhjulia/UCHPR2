<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MainController;


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
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/home', [HomeController::class, 'index2'])->name('home2');
Route::get('/Otz', [HomeController::class, 'Otz'])->name('Otz');

Route::middleware(['guest'])->group(function(){
    Route::get('/register', [UserController::class, 'create'])->name('user.create');
    Route::post('/register', [UserController::class, 'store'])->name('user.store');

    Route::get('/login', [UserController::class, 'loginCreate'])->name('login.create');
    Route::post('/login', [UserController::class, 'loginStore'])->name('login.store');
});

Route::middleware(['auth'])->group(function(){
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    
    Route::get('/post/create', [HomeController::class, 'create'])->name('post.create');
    Route::post('/post', [HomeController::class, 'store'])->name('post.store');

    Route::get('/cart', [HomeController::class, 'cartt'])->name('post.cartt');
    Route::post('/cart', [HomeController::class, 'cart'])->name('post.cart');
    Route::post('/cartdel', [HomeController::class, 'cartdel'])->name('cart.del');
    Route::post('/cartbuy', [HomeController::class, 'cartbuy'])->name('cart.buy');
});

Route::middleware(['admin'])->group(function(){
    Route::get('/main', [MainController::class, 'index'])->name('main.index');

    Route::post('/delete', [MainController::class, 'delete'])->name('post.delete');

    Route::post('/redac', [MainController::class, 'redac'])->name('post.red');
    Route::post('/redac2', [MainController::class, 'redac2'])->name('post.red2');
    
    Route::get('/redac2', [MainController::class, 'nposts'])->name('nposts');
    Route::get('/ncat', [MainController::class, 'ncat'])->name('ncat');
    Route::post('/ncatt', [MainController::class, 'ncatt'])->name('ncatt');
    Route::post('/opub', [MainController::class, 'opub'])->name('post.opub');

    Route::post('/ban', [MainController::class, 'ban'])->name('user.ban');
    Route::post('/rasban', [MainController::class, 'rasban'])->name('user.rasban');
});