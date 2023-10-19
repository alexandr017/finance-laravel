<?php

use App\Http\Controllers\Site\V3\Companies\MFOHubController;
use App\Http\Controllers\Site\V3\Companies\CompanyController;
use App\Http\Controllers\Site\V3\Companies\CompanyPageController;
use App\Http\Controllers\Site\V3\Actions\ReviewsController;

Route::get('mfo', [MFOHubController::class, 'index']);
Route::get('mfo/amp', [MFOHubController::class, 'index']);
Route::get('mfo/{mfoAlias}', [CompanyController::class, 'index']);
Route::get('mfo/{mfoAlias}/amp', [CompanyController::class, 'index']);
Route::get('mfo/{mfoAlias}/lichnyj-kabinet', [CompanyPageController::class, 'lichnyjKabinet']);
Route::get('mfo/{mfoAlias}/lichnyj-kabinet/amp', [CompanyPageController::class, 'lichnyjKabinet']);
Route::get('mfo/{mfoAlias}/gorjachaja-linija', [CompanyPageController::class, 'gorjachajaLinija']);
Route::get('mfo/{mfoAlias}/gorjachaja-linija/amp', [CompanyPageController::class, 'gorjachajaLinija']);
Route::get('mfo/{mfoAlias}/otzyvy', [CompanyPageController::class, 'otzyvy']);
Route::get('mfo/{mfoAlias}/otzyvy/amp', [CompanyPageController::class, 'otzyvy']);

Route::get('actions/load_sorted_reviews', [ReviewsController::class, 'sorting']);