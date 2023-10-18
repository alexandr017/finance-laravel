<?php

Route::get('sitemap', [ListingController::class, 'zaimy']);
Route::get('sitemap-listings', [ListingController::class, 'zaimy']);
Route::get('sitemap-companies', [ListingController::class, 'zaimy']);
Route::get('sitemap-pages', [ListingController::class, 'zaimy']);