<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SalesController;
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
//Halaman Home 
Route::get('/', [HomeController::class, 'index' ]);

//Halaman Products dengan prefix kategori
Route:: prefix(prefix: 'category')->group(callback: function (): void {
Route:: get('/food-beverage', [ProductController :: class, 'foodBeverage']);
Route:: get('/beauty-health', [ProductController :: class, 'beautyHealth']);
Route:: get('/home-care', [ProductController :: class, 'homeCare']);
Route:: get('/baby-kid', [ProductController :: class, 'babyKid']);
});

//Halaman User dengan Parameter
Route:: get('/user/{id}/name/{name}', action: [UserController :: class, 'profile' ]);

//Halaman Penjualan
Route:: get('/sales', [SalesController::class, 'index']);