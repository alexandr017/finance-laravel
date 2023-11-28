<?php

use App\Http\Controllers\Site\V3\Actions\ActionsController;
use App\Http\Controllers\Site\V3\Actions\CardsLoaderController;
use App\Http\Controllers\Site\V3\Actions\PageRatingController;
use App\Http\Controllers\Site\V3\PartnerLinksController;

include "site/static-pages.php";

include "site/listings.php";

include "site/mfo.php";

Route::get('actions/load_card_for_company', [ActionsController::class, 'loadCardForCompany'])->name('actions.load_card_for_company');
Route::get('actions/load_cards_for_listings', [CardsLoaderController::class, 'render'])->name('actions.load_cards_for_listings');
Route::get('actions/load_cards_for_hubs', [CardsLoaderController::class, 'getCardForHubs'])->name('actions.load_cards_for_hubs');
Route::post('actions/rating-add', [PageRatingController::class, 'addVote'])->name('actions.rating_add');
Route::post('actions/add-review', [ActionsController::class, 'addReview'])->name('actions.add_review');

Route::get('d/mfo/{alias}', [PartnerLinksController::class, 'mfo']);
Route::get('d/banki/{bankAlias}/{categoryAlias}/{productAlias}', [PartnerLinksController::class, 'banks']);

include "site/banks.php";

include "site/blog.php";

include "sitemap/index-sitemap-xml.php";

include 'parsers.php';

//Route::fallback(function(){
//    return (new App\Http\Controllers\Site\V3\DynamicSiteController())->render();
//});
