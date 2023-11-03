<?php

use App\Http\Controllers\ImportController;


// mfo
Route::get('/import/companies', [ImportController::class, 'companies']);
Route::get('/import/company-children', [ImportController::class, 'companyChildren']);

// banks
Route::get('/import/banks', [ImportController::class, 'banks']);
Route::get('/import/bank-children', [ImportController::class, 'bankChildren']);





Route::get('/import/static-pages', [ImportController::class, 'staticPages']);


// blog
Route::get('/import/blog-categories', [ImportController::class, 'blogCategories']);
Route::get('/import/blog-posts', [ImportController::class, 'blogCategories']);