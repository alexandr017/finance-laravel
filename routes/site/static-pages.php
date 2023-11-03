<?php

use App\Http\Controllers\Site\V3\FrontendController;
use App\Http\Controllers\Site\V3\StaticPagesController;

Route::get('/', [FrontendController::class, 'index']);
Route::get('/amp', [FrontendController::class, 'index_amp']);
Route::get('/about', [StaticPagesController::class, 'about']);
Route::get('/disclaimer', [StaticPagesController::class, 'render']);
Route::get('/rules', [StaticPagesController::class, 'render']);
Route::get('/privacy', [StaticPagesController::class, 'render']);
Route::get('/contacts', [StaticPagesController::class, 'render']);


