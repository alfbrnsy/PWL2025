<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\UserController;

// use App\Http\Controllers\HomeController;
// use App\Http\Controllers\ProductController;
// use App\Http\Controllers\SalesController;



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

//Route LevelController
Route::get('/', function () {
    return view('welcome');
});

Route::get('/level', [LevelController::class, 'index']);
Route::get('/kategori', [KategoriController::class, 'index']);
Route::get('/user', [UserController::class, 'index']);

//Route UserController
Route::get('/user/tambah', [UserController::class, 'tambah']);
Route::get('/user/tambah_simpan', [UserController::class, 'tambah_simpan']);
Route::get('/user/ubah/{id}', [UserController::class, 'ubah']);
Route::get('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan']);
Route::get('/user/hapus/{id}', [UserController::class, 'hapus']);











































// //Halaman Home
// Route::get('/', [HomeController::class, 'index' ]);


// //Halaman Products dengan prefix kategori
// Route::prefix(prefix: 'category')->group(callback: function (): void {
// Route:: get('/food-beverage', [ProductController :: class, 'foodBeverage']);
// Route:: get('/beauty-health ', [ProductController :: class, 'beautyHealth']);
// Route:: get('/home-care', [ProductController :: class, 'homeCare']);
// Route:: get('/baby-kid', [ProductController :: class, 'babyKid']);
// });

// //Halaman awal dengan parameter
// Route:: get('/user/{id}/name/{name}', action: [UserController :: class, 'profile']);

// //Halaman Penjualan
// Route:: get('/sales', [SalesController::class, 'index']);


// Route::resource('items', ItemController::class);

// //Route JOBSHEET 02
// Route::get('/hello', function () {
//     return 'Hello World';
// });

// Route::get('/world', function () {
//     return 'World';
// });



// Route::get('/about', function () {
//     return 'Nama : Aldo Febriansyah NIM : 2341760146';
// });

// Route::get('/user/{Aldo}', function ($name) {
//     return 'Nama saya ' .$name;
// });

// Route::get('/posts/{post}/comments/{comment}', function 
//     ($postId, $commentId) {
//         return 'Pos ke-'.$postId." Komentar ke-: ".$commentId;
// });

// Route::get('/articles/{article}', function
//     ($articleId) {
//         return 'Halaman Artikel dengan ID '.$articleId;
//     });

// Route::get('/user/{name?}', function ($name=null) {
//     return 'Nama saya Aldo '.$name;
// });


// Route::get('/hello', [WelcomeController::class,'hello']);

// Route::resource('photos', PhotoController::class);

// Route::resource('photos', PhotoController::class)->only([
//     'index', 'show'
// ]);

// Route::resource('photos', PhotoController::class)->except ([
//     'create', 'store', 'update', 'destroy'
// ]);

// Route::get('/greeting', [WelcomeController::class, 
// 'greeting']);