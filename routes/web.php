<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtigoController;

Route::get('/', function () {
    return redirect()->route('artigos.index');
});

Route::resource('artigos', ArtigoController::class);