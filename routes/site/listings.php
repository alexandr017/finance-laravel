<?php

use App\Http\Controllers\Site\V3\Listings\ListingController;

Route::get('zaimy', [ListingController::class, 'indexZaimy']);
Route::get('zaimy/{tagAlias}', [ListingController::class, 'zaimy']);

Route::get('kredity', [ListingController::class, 'indexKredity']);
Route::get('kredity/{tagAlias}', [ListingController::class, 'kredity']);

Route::get('kreditnye-karty', [ListingController::class, 'indexKreditnyeKarty']);
Route::get('kreditnye-karty/{tagAlias}', [ListingController::class, 'kreditnyeKarty']);

Route::get('debetovye-karty', [ListingController::class, 'indexDebetovyeKarty']);
Route::get('debetovye-karty/{tagAlias}', [ListingController::class, 'debetovyeKarty']);

Route::get('ipoteki', [ListingController::class, 'indexIpoteki']);
Route::get('ipoteki/{tagAlias}', [ListingController::class, 'ipoteki']);

Route::get('avtokredity', [ListingController::class, 'indexAvtokredity']);
Route::get('avtokredity/{tagAlias}', [ListingController::class, 'avtokredity']);

Route::get('vklady', [ListingController::class, 'indexVklady']);
Route::get('vklady/{tagAlias}', [ListingController::class, 'vklady']);

Route::get('rko', [ListingController::class, 'indexRKO']);
Route::get('rko/{tagAlias}', [ListingController::class, 'RKO']);
