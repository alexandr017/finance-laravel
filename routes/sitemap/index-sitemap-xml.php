<?php

use App\Http\Controllers\SitemapController;

Route::get('sitemap.xml', [SitemapController::class, 'index']);
Route::get('sitemap-listings.xml', [SitemapController::class, 'zaimy']);
Route::get('sitemap-companies.xml', [SitemapController::class, 'zaimy']);
Route::get('sitemap-pages.xml', [SitemapController::class, 'zaimy']);
