<?php

use App\Http\Controllers\Site\Import\ImportController;


// relink
Route::get('/import/relink', [ImportController::class, 'relink']);

// mfo
Route::get('/import/companies', [ImportController::class, 'companies']);
Route::get('/import/company-children', [ImportController::class, 'companyChildren']);
Route::get('/import/reviews', [ImportController::class, 'reviews']);

// banks
Route::get('/import/banks', [ImportController::class, 'banks']);
Route::get('/import/bank-children', [ImportController::class, 'bankChildren']);



// listings
Route::get('/import/zaimy', [ImportController::class, 'listings']);
Route::get('/import/kredity', [ImportController::class, 'listings']);
Route::get('/import/kreditnye-karty', [ImportController::class, 'listings']);
Route::get('/import/debetovye-karty', [ImportController::class, 'listings']);
Route::get('/import/ipoteki', [ImportController::class, 'listings']);
Route::get('/import/avtokredity', [ImportController::class, 'listings']);
Route::get('/import/vklady', [ImportController::class, 'listings']);
Route::get('/import/rko', [ImportController::class, 'listings']);




Route::get('/import/static-pages', [ImportController::class, 'staticPages']);


// blog
Route::get('/import/blog-categories', [ImportController::class, 'blogCategories']);
Route::get('/import/blog-posts', [ImportController::class, 'blogPosts']);


// cards
Route::get('/import/set-images-cards', [ImportController::class, 'setImagesCards']);