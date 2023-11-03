<?php


use App\Http\Controllers\Site\V3\Actions\ActionsController;
use App\Http\Controllers\Site\V3\Actions\CardsLoaderController;


include "site/static-pages.php";

include "site/listings.php";

include "site/mfo.php";


//Route::post('companies/{company_id}/otzyvy', [CompanyReviewController::class, 'create']);

Route::get('actions/load_card_for_company', [ActionsController::class, 'loadCardForCompany'])->name('actions.load_card_for_company');
Route::get('actions/load_cards_for_listings', [CardsLoaderController::class, 'render'])->name('actions.load_cards_for_listings');
Route::get('actions/load_cards_for_hubs', [CardsLoaderController::class, 'getCardForHubs'])->name('actions.load_cards_for_hubs');


include "site/banks.php";


include "site/blog.php";




include "sitemap/index-sitemap-xml.php";


//Route::fallback(function(){
//    return (new App\Http\Controllers\Site\V3\DynamicSiteController())->render();
//});
