<?php

use App\Http\Controllers\Site\Import\ImportController;

// static pages
Route::get('/import/static-pages', [ImportController::class, 'staticPages']);


// blog
Route::get('/import/blog-categories', [ImportController::class, 'blogCategories']);
Route::get('/import/blog-posts', [ImportController::class, 'blogPosts']);


// mfo
Route::get('/import/companies', [ImportController::class, 'companies']);
Route::get('/import/company-children', [ImportController::class, 'companyChildren']);
Route::get('/import/company-reviews', [ImportController::class, 'reviews']);


// banks
Route::get('/import/banks', [ImportController::class, 'banks']);
Route::get('/import/bank-children', [ImportController::class, 'bankChildren']);
Route::get('/import/bank-categories', [ImportController::class, 'bankCategories']);
Route::get('/import/bank-products', [ImportController::class, 'bankProducts']);
Route::get('/import/bank-reviews', [ImportController::class, 'bankReviews']);


// listings
Route::get('/import/listings', [ImportController::class, 'listings']);

// relink
Route::get('/import/relink', [ImportController::class, 'relink']);


// cards
Route::get('/import/update-cards', [ImportController::class, 'updateCards']);
Route::get('/import/cards-update-level-2', [ImportController::class, 'updateCardsLevel2']);

// links
Route::get('/import/links', [ImportController::class, 'links']);