<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtigoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Storage;


/*
|--------------------------------------------------------------------------
| PÁGINA INICIAL
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('artigos.index');
});

Route::get('/imagem-artigo/{path}', function ($path) {

    if (!Storage::disk('public')->exists($path)) {
        abort(404);
    }

    $file = Storage::disk('public')->get($path);
    $type = Storage::disk('public')->mimeType($path);

    return response($file)
        ->header('Content-Type', $type)
        ->header('Access-Control-Allow-Origin', '*')
        ->header('Access-Control-Allow-Methods', 'GET, OPTIONS')
        ->header('Access-Control-Allow-Headers', '*');

})->where('path', '.*');


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

