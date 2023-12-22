<?php
Route::get('banki', 'App\Http\Controllers\Site\V3\Banks\IndexPageBanksController@render')->name('banks.index-page');
Route::get('banki/amp', 'App\Http\Controllers\Site\V3\Banks\IndexPageBanksController@render')->name('banks.index-page.amp');
Route::get('banki/{bankAlias}', 'App\Http\Controllers\Site\V3\Banks\BankController@render')->name('banks.index');
Route::get('banki/{bankAlias}/amp', 'App\Http\Controllers\Site\V3\Banks\BankController@render')->name('banks.index.amp');


Route::get('banki/{bankAlias}/lichnyj-kabinet', 'App\Http\Controllers\Site\V3\Banks\InfoPages\LoginInfoPageController@index')->name('banks.info_pages.login.index');
Route::get('banki/{bankAlias}/lichnyj-kabinet/amp', 'App\Http\Controllers\Site\V3\Banks\InfoPages\LoginInfoPageController@amp')->name('banks.info_pages.login.amp');
Route::get('banki/{bankAlias}/gorjachaja-linija', 'App\Http\Controllers\Site\V3\Banks\InfoPages\HotLineInfoPageController@index')->name('banks.info_pages.hot_line.index');
Route::get('banki/{bankAlias}/gorjachaja-linija/amp', 'App\Http\Controllers\Site\V3\Banks\InfoPages\HotLineInfoPageController@amp')->name('banks.info_pages.hot_line.amp');
Route::get('banki/{bankAlias}/rekvizity', 'App\Http\Controllers\Site\V3\Banks\InfoPages\RequisitesInfoPageController@index')->name('banks.info_pages.requisites.index');
Route::get('banki/{bankAlias}/rekvizity/amp', 'App\Http\Controllers\Site\V3\Banks\InfoPages\RequisitesInfoPageController@amp')->name('banks.info_pages.requisites.amp');
Route::get('banki/{bankAlias}/otzyvy', 'App\Http\Controllers\Site\V3\Banks\InfoPages\ReviewsPageController@index')->name('banks.info_pages.otzyvy.index');
Route::get('banki/{bankAlias}/otzyvy/amp', 'App\Http\Controllers\Site\V3\Banks\InfoPages\ReviewsPageController@amp')->name('banks.info_pages.otzyvy.amp');


Route::get('banki/{bankAlias}/vklady', 'App\Http\Controllers\Site\V3\Banks\CategoryController@index')->name('banks.category.vklady.category');
Route::get('banki/{bankAlias}/vklady/amp', 'App\Http\Controllers\Site\V3\Banks\CategoryController@amp')->name('banks.category.vklady.category.amp');
Route::get('banki/{bankAlias}/vklady/otzyvy', 'App\Http\Controllers\Site\V3\Banks\ReviewsCategoryController@index')->name('banks.category.vklady.otzyvy');
Route::get('banki/{bankAlias}/vklady/otzyvy/amp', 'App\Http\Controllers\Site\V3\Banks\ReviewsCategoryController@amp')->name('banks.category.vklady.otzyvy.amp');
Route::get('banki/{bankAlias}/vklady/{productAlias}', 'App\Http\Controllers\Site\V3\Banks\ProductsController@index')->name('banks.category.vklady.products.index');
Route::get('banki/{bankAlias}/vklady/{productAlias}/amp', 'App\Http\Controllers\Site\V3\Banks\ProductsController@amp')->name('banks.category.vklady.products.amp');
Route::get('banki/{bankAlias}/vklady/{productAlias}/otzyvy', 'App\Http\Controllers\Site\V3\Banks\ReviewsPageController@index')->name('banks.category.vklady.products.otzyvy.index');
Route::get('banki/{bankAlias}/vklady/{productAlias}/otzyvy/amp', 'App\Http\Controllers\Site\V3\Banks\ReviewsPageController@amp')->name('banks.category.vklady.products.otzyvy.amp');


Route::get('banki/{bankAlias}/kredity', 'App\Http\Controllers\Site\V3\Banks\CategoryController@index')->name('banks.category.kredity.category');
Route::get('banki/{bankAlias}/kredity/amp', 'App\Http\Controllers\Site\V3\Banks\CategoryController@amp')->name('banks.category.kredity.category.amp');
Route::get('banki/{bankAlias}/kredity/otzyvy', 'App\Http\Controllers\Site\V3\Banks\ReviewsCategoryController@index')->name('banks.category.kredity.otzyvy');
Route::get('banki/{bankAlias}/kredity/otzyvy/amp', 'App\Http\Controllers\Site\V3\Banks\ReviewsCategoryController@amp')->name('banks.category.kredity.otzyvy.amp');
Route::get('banki/{bankAlias}/kredity/{productAlias}', 'App\Http\Controllers\Site\V3\Banks\ProductsController@index')->name('banks.category.kredity.products.index');
Route::get('banki/{bankAlias}/kredity/{productAlias}/amp', 'App\Http\Controllers\Site\V3\Banks\ProductsController@amp')->name('banks.category.kredity.products.amp');
Route::get('banki/{bankAlias}/kredity/{productAlias}/otzyvy', 'App\Http\Controllers\Site\V3\Banks\ReviewsPageController@index')->name('banks.category.kredity.products.otzyvy.index');
Route::get('banki/{bankAlias}/kredity/{productAlias}/otzyvy/amp', 'App\Http\Controllers\Site\V3\Banks\ReviewsPageController@amp')->name('banks.category.kredity.products.otzyvy.amp');


Route::get('banki/{bankAlias}/ipoteki', 'App\Http\Controllers\Site\V3\Banks\CategoryController@index')->name('banks.category.ipoteki.category');
Route::get('banki/{bankAlias}/ipoteki/amp', 'App\Http\Controllers\Site\V3\Banks\CategoryController@amp')->name('banks.category.ipoteki.category.amp');
Route::get('banki/{bankAlias}/ipoteki/otzyvy', 'App\Http\Controllers\Site\V3\Banks\ReviewsCategoryController@index')->name('banks.category.ipoteki.otzyvy');
Route::get('banki/{bankAlias}/ipoteki/otzyvy/amp', 'App\Http\Controllers\Site\V3\Banks\ReviewsCategoryController@amp')->name('banks.category.ipoteki.otzyvy.amp');
Route::get('banki/{bankAlias}/ipoteki/{productAlias}', 'App\Http\Controllers\Site\V3\Banks\ProductsController@index')->name('banks.category.ipoteki.products.index');
Route::get('banki/{bankAlias}/ipoteki/{productAlias}/amp', 'App\Http\Controllers\Site\V3\Banks\ProductsController@amp')->name('banks.category.ipoteki.products.amp');
Route::get('banki/{bankAlias}/ipoteki/{productAlias}/otzyvy', 'App\Http\Controllers\Site\V3\Banks\ReviewsPageController@index')->name('banks.category.ipoteki.products.otzyvy.index');
Route::get('banki/{bankAlias}/ipoteki/{productAlias}/otzyvy/amp', 'App\Http\Controllers\Site\V3\Banks\ReviewsPageController@amp')->name('banks.category.ipoteki.products.otzyvy.amp');


Route::get('banki/{bankAlias}/kreditnye-karty', 'App\Http\Controllers\Site\V3\Banks\CategoryController@index')->name('banks.category.kreditnye-karty.category');
Route::get('banki/{bankAlias}/kreditnye-karty/amp', 'App\Http\Controllers\Site\V3\Banks\CategoryController@amp')->name('banks.category.kreditnye-karty.category.amp');
Route::get('banki/{bankAlias}/kreditnye-karty/otzyvy', 'App\Http\Controllers\Site\V3\Banks\ReviewsCategoryController@index')->name('banks.category.kreditnye-karty.otzyvy');
Route::get('banki/{bankAlias}/kreditnye-karty/otzyvy/amp', 'App\Http\Controllers\Site\V3\Banks\ReviewsCategoryController@amp')->name('banks.category.kreditnye-karty.otzyvy.amp');
Route::get('banki/{bankAlias}/kreditnye-karty/{productAlias}', 'App\Http\Controllers\Site\V3\Banks\ProductsController@index')->name('banks.category.kreditnye-karty.products.index');
Route::get('banki/{bankAlias}/kreditnye-karty/{productAlias}/amp', 'App\Http\Controllers\Site\V3\Banks\ProductsController@amp')->name('banks.category.kreditnye-karty.products.amp');
Route::get('banki/{bankAlias}/kreditnye-karty/{productAlias}/otzyvy', 'App\Http\Controllers\Site\V3\Banks\ReviewsPageController@index')->name('banks.category.kreditnye-karty.products.otzyvy.index');
Route::get('banki/{bankAlias}/kreditnye-karty/{productAlias}/otzyvy/amp', 'App\Http\Controllers\Site\V3\Banks\ReviewsPageController@amp')->name('banks.category.kreditnye-karty.products.otzyvy.amp');


Route::get('banki/{bankAlias}/debetovye-karty', 'App\Http\Controllers\Site\V3\Banks\CategoryController@index')->name('banks.category.debetovye-karty.category');
Route::get('banki/{bankAlias}/debetovye-karty/amp', 'App\Http\Controllers\Site\V3\Banks\CategoryController@amp')->name('banks.category.debetovye-karty.category.amp');
Route::get('banki/{bankAlias}/debetovye-karty/otzyvy', 'App\Http\Controllers\Site\V3\Banks\ReviewsCategoryController@index')->name('banks.category.debetovye-karty.otzyvy');
Route::get('banki/{bankAlias}/debetovye-karty/otzyvy/amp', 'App\Http\Controllers\Site\V3\Banks\ReviewsCategoryController@amp')->name('banks.category.debetovye-karty.otzyvy.amp');
Route::get('banki/{bankAlias}/debetovye-karty/{productAlias}', 'App\Http\Controllers\Site\V3\Banks\ProductsController@index')->name('banks.category.debetovye-karty.products.index');
Route::get('banki/{bankAlias}/debetovye-karty/{productAlias}/amp', 'App\Http\Controllers\Site\V3\Banks\ProductsController@amp')->name('banks.category.debetovye-karty.products.amp');
Route::get('banki/{bankAlias}/debetovye-karty/{productAlias}/otzyvy', 'App\Http\Controllers\Site\V3\Banks\ReviewsPageController@index')->name('banks.category.debetovye-karty.products.otzyvy.index');
Route::get('banki/{bankAlias}/debetovye-karty/{productAlias}/otzyvy/amp', 'App\Http\Controllers\Site\V3\Banks\ReviewsPageController@amp')->name('banks.category.debetovye-karty.products.otzyvy.amp');




Route::get('banki/{bankAlias}/avtokredity', 'App\Http\Controllers\Site\V3\Banks\CategoryController@index')->name('banks.category.avtokredity.category');
Route::get('banki/{bankAlias}/avtokredity/amp', 'App\Http\Controllers\Site\V3\Banks\CategoryController@amp')->name('banks.category.avtokredity.category.amp');
Route::get('banki/{bankAlias}/avtokredity/otzyvy', 'App\Http\Controllers\Site\V3\Banks\ReviewsCategoryController@index')->name('banks.category.avtokredity.otzyvy');
Route::get('banki/{bankAlias}/avtokredity/otzyvy/amp', 'App\Http\Controllers\Site\V3\Banks\ReviewsCategoryController@amp')->name('banks.category.avtokredity.otzyvy.amp');
Route::get('banki/{bankAlias}/avtokredity/{productAlias}', 'App\Http\Controllers\Site\V3\Banks\ProductsController@index')->name('banks.category.avtokredity.products.index');
Route::get('banki/{bankAlias}/avtokredity/{productAlias}/amp', 'App\Http\Controllers\Site\V3\Banks\ProductsController@amp')->name('banks.category.avtokredity.products.amp');
Route::get('banki/{bankAlias}/avtokredity/{productAlias}/otzyvy', 'App\Http\Controllers\Site\V3\Banks\ReviewsPageController@index')->name('banks.category.avtokredity.products.otzyvy.index');
Route::get('banki/{bankAlias}/avtokredity/{productAlias}/otzyvy/amp', 'App\Http\Controllers\Site\V3\Banks\ReviewsPageController@amp')->name('banks.category.avtokredity.products.otzyvy.amp');


Route::get('banki/{bankAlias}/rko', 'App\Http\Controllers\Site\V3\Banks\CategoryController@index')->name('banks.category.rko.category');
Route::get('banki/{bankAlias}/rko/amp', 'App\Http\Controllers\Site\V3\Banks\CategoryController@amp')->name('banks.category.rko.category.amp');
Route::get('banki/{bankAlias}/rko/otzyvy', 'App\Http\Controllers\Site\V3\Banks\ReviewsCategoryController@index')->name('banks.category.rko.otzyvy');
Route::get('banki/{bankAlias}/rko/otzyvy/amp', 'App\Http\Controllers\Site\V3\Banks\ReviewsCategoryController@amp')->name('banks.category.rko.otzyvy.amp');
Route::get('banki/{bankAlias}/rko/{productAlias}', 'App\Http\Controllers\Site\V3\Banks\ProductsController@index')->name('banks.category.rko.products.index');
Route::get('banki/{bankAlias}/rko/{productAlias}/amp', 'App\Http\Controllers\Site\V3\Banks\ProductsController@amp')->name('banks.category.rko.products.amp');
Route::get('banki/{bankAlias}/rko/{productAlias}/otzyvy', 'App\Http\Controllers\Site\V3\Banks\ReviewsPageController@index')->name('banks.category.rko.products.otzyvy.index');
Route::get('banki/{bankAlias}/rko/{productAlias}/otzyvy/amp', 'App\Http\Controllers\Site\V3\Banks\ReviewsPageController@amp')->name('banks.category.rko.products.otzyvy.amp');


Route::post('actions/banks/add-review', 'App\Http\Controllers\Site\V3\Actions\BankReviewActionsController@addReview')->name('actions.banks.add_review');
Route::get('actions/load-cards-for-bank-on-category', 'App\Http\Controllers\Site\V3\Actions\BankLoadProductActionController@loadCardsForCategory')->name('actions.banks.load_cards_for_category');
Route::get('actions/load-cards-for-bank-on-product', 'App\Http\Controllers\Site\V3\Actions\BankLoadProductActionController@loadCardsForProduct')->name('actions.banks.load_cards_for_product');
