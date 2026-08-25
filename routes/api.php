<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ArtigoApiController;

Route::get('/artigos', [ArtigoApiController::class, 'index']);

Route::get('/artigos/{id}', [ArtigoApiController::class, 'show']);