<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;


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
//Article
Route::get('/', function(){
    return redirect('/article');
});

Route::resource('article', ArticleController::class)->middleware('auth:sanctum');  // + проверка авторизации по наличию токена в сессии
Route::get('article/{article}', [ArticleController::class, 'show'])->middleware('auth:sanctum','stat')->name('article.show');

// Route::group(['prefix'=>'/article', 'middleware'=>'auth'], function(){
//     Route::get('', [ArticleController::class, 'index']);
//     Route::get('/create', [ArticleController::class, 'create']);
//     Route::get('/store', [ArticleController::class, 'store']);
// });

//Comments
Route::group(['prefix'=>'/comment', 'middleware'=>'auth:sanctum'], function(){
    Route::get('', [CommentController::class, 'index']);
    Route::post('/store', [CommentController::class, 'store']);
    Route::get('/edit/{id}', [CommentController::class, 'edit']);
    Route::post('/update/{id}', [CommentController::class, 'update']);
    Route::get('/delete/{id}', [CommentController::class, 'delete']);
    Route::get('/accept/{id}', [CommentController::class, 'accept']);
    Route::get('/reject/{id}', [CommentController::class, 'reject']);
});

// //auth
// Route::get('/auth/create', [AuthController::class, 'create']);
// Route::post('/auth/signUp', [AuthController::class, 'signUp']);
// Route::get('/auth/login', [AuthController::class, 'login'])->name('login');
// Route::post('/auth/signIn', [AuthController::class, 'customLogin']);
// Route::get('/auth/logout', [AuthController::class, 'logout']);
//Auth
Route::get('/create', [AuthController::class, 'create'])->middleware('guest');
Route::post('/registr', [AuthController::class, 'registr']);
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'customLogin']);
Route::get('/logout', [AuthController::class, 'logout']);


Route::get('/galery/{full_image}', [MainController::class, 'show']);

Route::get('/home', [MainController::class, 'index']);

Route::get('/contact', function(){
    $contact = [
        'name' => 'Polytech',
        'adres' => 'B.Semyonovskaya',
        'phone' => '8(496) 674-7809',
        'email' => '@mospolytech.ru',
    ];
    return view('main/contact', ['contact' => $contact]);
});