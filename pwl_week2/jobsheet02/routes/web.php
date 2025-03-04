<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\pagecontroller;

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
//  Basic Route
// Route::get('/hello', function() {
//     return 'Hello World';
// });
Route::get('/world', function() {
    return 'World';
});
Route::get('/', function() {
    return 'Selamat Datang';
});
Route::get('/about', function() {
    return 'NIM: 2341760146, Nama: Aldo Febriansyah';
});

// Route dengan Parameters
// Route::get('/user/{name}', function ($name) {
//     return 'Nama saya '.$name;
// });
Route::get('/posts/{post}/comments/{comment}', function ($postId, $commentId) {
    return 'Pos ke-'.$postId." Komentar ke-: ".$commentId;
});
Route::get('/articles/{id}', function ($id) {
    return 'Halaman Artikel dengan ID '.$id;
});

// Optional Parameters
Route::get('user/{name?}', function ($name='John') {
    return 'Nama saya '.$name;
});

Route::get(uri: '/hello', action: [WelcomeController::class, 'hello']);

Route::get('/', [pagecontroller::class, 'index']);
Route::get('/about', [pagecontroller::class, 'about']);
Route::get('/articles/{id}', [pagecontroller::class, 'articles']);