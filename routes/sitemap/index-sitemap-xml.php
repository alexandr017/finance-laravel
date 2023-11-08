<?php

use App\Http\Controllers\SitemapController;

Route::get('main-sitemap.xsl', [SitemapController::class, 'style']);

Route::get('sitemap.xml', [SitemapController::class, 'index']);
Route::get('static-pages.xml', [SitemapController::class, 'staticPages']);
Route::get('mfo.xml', [SitemapController::class, 'mfo']);
Route::get('banks.xml', [SitemapController::class, 'banks']);
Route::get('blog.xml', [SitemapController::class, 'blog']);
Route::get('listings.xml', [SitemapController::class, 'listings']);