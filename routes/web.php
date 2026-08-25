<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtigoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;


/*
|--------------------------------------------------------------------------
| PÁGINA INICIAL
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('artigos.index');
});


/*
|--------------------------------------------------------------------------
| LOGIN
|--------------------------------------------------------------------------
*/

Route::get('/login', [
    AuthController::class,
    'showLogin'
])->name('login');


Route::post('/login', [
    AuthController::class,
    'login'
])->name('login.submit');


Route::post('/logout', [
    AuthController::class,
    'logout'
])->name('logout');


/*
|--------------------------------------------------------------------------
| ÁREA LOGADA
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | ARTIGOS
    |--------------------------------------------------------------------------
    */

    Route::post('/artigos/upload-image', [
        ArtigoController::class,
        'uploadImage'
    ])->name('artigos.uploadImage');

    Route::resource(
        'artigos',
        ArtigoController::class
    );


    /*
    |--------------------------------------------------------------------------
    | USUÁRIOS - SOMENTE ADMIN MASTER
    |--------------------------------------------------------------------------
    */

    Route::middleware('master')->group(function () {

        Route::resource(
            'usuarios',
            UserController::class
        );

    });

});