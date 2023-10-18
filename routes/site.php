<?php


use App\Http\Controllers\Site\V3\Companies\MFOHubController;
use App\Http\Controllers\Site\V3\Companies\CompanyController;
use App\Http\Controllers\Site\V3\Companies\CompanyPageController;
use App\Http\Controllers\Site\V3\FrontendController;
use App\Http\Controllers\Site\V3\StaticPagesController;
use App\Http\Controllers\Site\V3\Actions\ActionsController;
use App\Http\Controllers\Site\V3\Actions\CardsLoaderController;


Route::get('/', [FrontendController::class, 'index']);
Route::get('/about', [StaticPagesController::class, 'about']);

include "site/listings.php";


Route::get('mfo', [MFOHubController::class, 'index']);
Route::get('mfo/{mfoAlias}', [CompanyController::class, 'index']);
Route::get('mfo/{mfoAlias}/lichnyj-kabinet', [CompanyPageController::class, 'lichnyjKabinet']);
Route::get('mfo/{mfoAlias}/gorjachaja-linija', [CompanyPageController::class, 'gorjachajaLinija']);
Route::get('mfo/{mfoAlias}/otzyvy', [CompanyPageController::class, 'otzyvy']);



//Route::post('companies/{company_id}/otzyvy', [CompanyReviewController::class, 'create']);

Route::get('actions/load_card_for_company', [ActionsController::class, 'loadCardForCompany'])->name('actions.load_card_for_company');
Route::get('actions/load_cards_for_listings', [CardsLoaderController::class, 'render'])->name('actions.load_cards_for_listings');
Route::get('actions/load_cards_for_hubs', [ActionsController::class, 'getCardForHubs'])->name('actions.load_cards_for_hubs');



include "site/banks.php";





include "sitemap/index-sitemap-xml.php";


Route::fallback(function(){
    return (new App\Http\Controllers\Site\V3\DynamicSiteController())->render();
});
