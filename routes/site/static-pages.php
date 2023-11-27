<?php

use App\Http\Controllers\Site\V3\StaticPages\StaticPagesController;

Route::get('/', [StaticPagesController::class, 'index']);
Route::get('/about', [StaticPagesController::class, 'render']);
Route::get('/disclaimer', [StaticPagesController::class, 'render']);
Route::get('/rules', [StaticPagesController::class, 'render']);
Route::get('/privacy', [StaticPagesController::class, 'render']);
Route::get('/contacts', [StaticPagesController::class, 'render']);

Route::get('mfo', [StaticPagesController::class, 'mfo']);
//Route::get('mfo/amp', [MFOHubController::class, 'index']);


