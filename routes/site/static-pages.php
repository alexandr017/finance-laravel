<?php

use App\Http\Controllers\Site\V3\StaticPagesController;

Route::get('/', [StaticPagesController::class, 'index']);
Route::get('/about', [StaticPagesController::class, 'about']);
Route::get('/disclaimer', [StaticPagesController::class, 'render']);
Route::get('/rules', [StaticPagesController::class, 'render']);
Route::get('/privacy', [StaticPagesController::class, 'render']);
Route::get('/contacts', [StaticPagesController::class, 'render']);


