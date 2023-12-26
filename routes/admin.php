<?php

use App\Http\Controllers\Admin\Banks\BankCategoryPagesController;
use App\Http\Controllers\Admin\Banks\BankCategoryReviewsPagesController;
use App\Http\Controllers\Admin\Banks\BankProductsController;
use App\Http\Controllers\Admin\Banks\BankProductsReviewsPagesController;
use App\Http\Controllers\Admin\Banks\BankReviewsController;
use App\Http\Controllers\Admin\Banks\BanksController;
use App\Http\Controllers\Admin\Banks\BanksInfoPagesController;
use App\Http\Controllers\Admin\Cards\CardsCategoriesController;
use App\Http\Controllers\Admin\Cards\CardsController;
use App\Http\Controllers\Admin\Cards\ListingCardsController;
use App\Http\Controllers\Admin\Cards\ListingsController;
use App\Http\Controllers\Admin\Companies\ChildrenPagesController;
use App\Http\Controllers\Admin\Companies\CompaniesController;
use App\Http\Controllers\Admin\Companies\ReviewsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HideLinks\HideLinksController;
use App\Http\Controllers\Admin\Posts\AuthorsController;
use App\Http\Controllers\Admin\Posts\PostsCategoriesController;
use App\Http\Controllers\Admin\Posts\PostsCommentsController;
use App\Http\Controllers\Admin\Posts\PostsController;
use App\Http\Controllers\Admin\Posts\PostTagsController;
use App\Http\Controllers\Admin\Relinking\RelinkingController;
use App\Http\Controllers\Admin\Relinking\RelinkingGroupsController;
use App\Http\Controllers\Admin\StaticPages\StaticPagesController;

Route::group(['middleware' => ['auth.admin'] ,'prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::get('/', [DashboardController::class, 'index'])->name('index');

    Route::resource('static-pages', StaticPagesController::class)->except(['show']);

    Route::group(['prefix' => 'cards', 'as' => 'cards.'], function () {
        Route::get('cards', [CardsController::class, 'index'])->name('cards.index');
        Route::get('cards/create', [CardsController::class, 'create'])->name('cards.create');
        Route::post('cards/create_save', [CardsController::class, 'create_save'])->name('cards.create_save');
        Route::get('cards/edit/{id}', [CardsController::class, 'edit'])->name('cards.edit');
        Route::post('cards/edit_save', [CardsController::class, 'edit_save'])->name('cards.edit_save');
        Route::get('cards/destroy/{id}', [CardsController::class, 'destroy'])->name('cards.delete');

//        Route::get('change-status-logs', 'Cards\CardsChangeStatusLogs@index')->name('change-status-logs');
        Route::post('get_fields', [CardsController::class, 'get_fields'])->name('get_fields');

        Route::get('categories', [CardsCategoriesController::class, 'index'])->name('categories.index');
        Route::get('categories/create', [CardsCategoriesController::class ,'create'])->name('categories.create');
        Route::post('categories/create_save', [CardsCategoriesController::class ,'create_save'])->name('categories.create_save');
        Route::get('categories/edit/{id}', [CardsCategoriesController::class ,'edit'])->name('categories.edit');
        Route::post('categories/edit_save', [CardsCategoriesController::class ,'edit_save'])->name('categories.edit_save');
        Route::get('categories/destroy/{id}', [CardsCategoriesController::class ,'destroy'])->name('categories.delete');

        Route::resource('listings', ListingsController::class);
        Route::get('listings/{listingID}/edit/personal-order', [ListingsController::class, 'personalOrder'])->name('cards.personal-order');
        Route::post('listings/{listingID}/edit/personal-order', [ListingsController::class, 'personalOrderUpdate'])->name('cards.personal-order-update');
        Route::post('listing-search-by-id', [ListingsController::class, 'searchById'])->name('listings.search_by_id');
        Route::resource('listing-cards', ListingCardsController::class, ['only' => ['edit','update']]);
    });

    /**************** COMPANIES ****************/

    Route::resource('companies', CompaniesController::class)->except(['show']);
    Route::resource('companies.children', ChildrenPagesController::class)->shallow()->except(['show']);

    Route::group(['prefix' => 'companies', 'as' => 'companies.'], function () {
        Route::resource('reviews', ReviewsController::class)->except(['show']);

        Route::get('{id}/reviews', [ReviewsController::class, 'reviews_by_company'])->name('reviews_by_company');
        Route::group(['prefix' => 'reviews', 'as' => 'reviews.'], function () {
            Route::post('search', [ReviewsController::class, 'search'])->name('search');
            Route::get('change_status/{id}', [ReviewsController::class, 'change_status'])->name('change_status');
        });
    });

    /****************** BANKS ******************/
    Route::group(['prefix' => 'banks', 'as' => 'banks.'], function () {

        Route::resource('banks', BanksController::class);

        Route::resource('{bankID}/info-pages', BanksInfoPagesController::class);
        Route::get('info-pages/all', [BanksInfoPagesController::class, 'all'])->name('info-pages.all');

        Route::resource('{bankID}/categories', BankCategoryPagesController::class);
        Route::get('categories/all', [BankCategoryPagesController::class, 'all'])->name('categories.all');

        Route::resource('{bankID}/categories/{categoryId}/products', BankProductsController::class);
        Route::get('products/all', [BankProductsController::class, 'all'])->name('products.all');

        Route::resource('{bankID}/categories/{categoryId}/reviews', BankReviewsController::class);
        Route::get('reviews/all', [BankReviewsController::class, 'all'])->name('reviews.all');
        Route::get('reviews/load', [BankReviewsController::class, 'load'])->name('reviews.load');

        Route::get('{bankID}/categories/{categoryId}/page-reviews', [BankCategoryReviewsPagesController::class, 'show'])->name('categories.reviews.show');
        Route::post('{bankID}/categories/{categoryId}/page-reviews', [BankCategoryReviewsPagesController::class, 'update'])->name('categories.reviews.update');
        Route::delete('{bankID}/categories/{categoryId}/page-reviews/{id}', [BankCategoryReviewsPagesController::class, 'destroy'])->name('categories.reviews.delete');

        Route::get('{bankID}/categories/{categoryId}/products/{productId}/page-reviews', [BankProductsReviewsPagesController::class, 'show'])->name('products.reviews.show');
        Route::post('{bankID}/categories/{categoryId}/products/{productId}/page-reviews', [BankProductsReviewsPagesController::class, 'update'])->name('products.reviews.update');
        Route::delete('{bankID}/categories/{categoryId}/products/{productId}/page-reviews/{id}', [BankProductsReviewsPagesController::class, 'destroy'])->name('products.reviews.delete');
    });

    /****************** POSTS ******************/
    Route::get('posts/posts', [PostsController::class, 'index'])->name('posts.posts.index');
    Route::get('posts/posts/create', [PostsController::class, 'create'])->name('posts.posts.create');
    Route::post('posts/posts/create_save', [PostsController::class, 'create_save'])->name('posts.posts.create_save');
    Route::get('posts/posts/edit/{id}', [PostsController::class, 'edit'])->name('posts.posts.edit');
    Route::post('posts/posts/edit_save', [PostsController::class, 'edit_save'])->name('posts.posts.edit_save');
    Route::get('posts/posts/destroy/{id}', [PostsController::class, 'destroy'])->name('posts.posts.delete');
    Route::post('posts/posts/search_by_id', [PostsController::class, 'search_by_id'])->name('posts.posts.search_by_id');

    Route::get('posts/categories', [PostsCategoriesController::class, 'index'])->name('posts.categories.index');
    Route::get('posts/categories/create', [PostsCategoriesController::class, 'create'])->name('posts.categories.create');
    Route::post('posts/categories/create_save', [PostsCategoriesController::class, 'create_save'])->name('posts.categories.create_save');
    Route::get('posts/categories/edit/{id}', [PostsCategoriesController::class, 'edit'])->name('posts.categories.edit');
    Route::get('posts/categories/edit/{id}/posts', [PostsController::class, 'posts_by_category'])->name('posts.categories.edit.posts_by_category');
    Route::post('posts/categories/edit_save', [PostsCategoriesController::class, 'edit_save'])->name('posts.categories.edit_save');
    Route::get('posts/categories/destroy/{id}', [PostsCategoriesController::class, 'destroy'])->name('posts.categories.delete');

    Route::group(['prefix' => 'posts', 'as' => 'posts.'], function () {
        Route::resource('tags', PostTagsController::class);

//        Route::resource('posts_users_answers', 'PostsUsersAnswersController');
//        Route::resource('product-overview', 'ProductOverviewController');

        Route::resource('authors', AuthorsController::class)->except(['show']);
//
        Route::resource('comments', PostsCommentsController::class)->except(['show']);
        Route::get('{id}/comments', [PostsCommentsController::class, 'comments_by_post'])->name('comments_by_post');
        Route::group(['prefix' => 'comments', 'as' => 'comments.'], function () {
            Route::get('change_status/{id}', [PostsCommentsController::class, 'change_status'])->name('change_status');
            Route::post('search', [PostsCommentsController::class, 'search'])->name('search');
        });
    });

    Route::resource('relinking', RelinkingController::class);
    Route::resource('relinking_groups', RelinkingGroupsController::class);
    Route::get('get-relinking-groups/{category_id}', [RelinkingController::class, 'getRelinkingGroups']);

    Route::resource('hide_links', HideLinksController::class);
    Route::get('log-viewer/links', [HideLinksController::class, 'logs'])->name('hide_links.logs');
});