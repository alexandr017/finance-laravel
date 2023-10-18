<?php

use App\Http\Controllers\Site\V3\Listings\ListingController;

Route::get('zaimy', [ListingController::class, 'indexZaimy']);
Route::get('zaimy/{tagAlias}', [ListingController::class, 'zaimy']);
Route::get('kredity', [ListingController::class, 'indexKredity']);
Route::get('kredity/{tagAlias}', [ListingController::class, 'kredity']);
Route::get('kreditnye-karty/index', [ListingController::class, 'indexKreditnyeKarty']);
Route::get('kreditnye-karty/{tagAlias}', [ListingController::class, 'kreditnyeKarty']);
Route::get('debetovye-karty/index', [ListingController::class, 'indexDebetovyeKarty']);
Route::get('debetovye-karty/{tagAlias}', [ListingController::class, 'debetovyeKarty']);
Route::get('ipoteki/index', [ListingController::class, 'indexIpoteki']);
Route::get('ipoteki/{tagAlias}', [ListingController::class, 'ipoteki']);
Route::get('avtokredity/index', [ListingController::class, 'indexAvtokredity']);
Route::get('avtokredity/{tagAlias}', [ListingController::class, 'avtokredity']);
Route::get('vklady/index', [ListingController::class, 'indexVklady']);
Route::get('vklady/{tagAlias}', [ListingController::class, 'vklady']);
