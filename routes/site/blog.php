<?php

use App\Http\Controllers\Site\V3\Blog\IndexBlogController;
use App\Http\Controllers\Site\V3\Blog\CategoryController;
use App\Http\Controllers\Site\V3\Blog\PostController;

use App\Http\Controllers\Site\V3\Actions\ActionsController;

Route::get('/news', [IndexBlogController::class, 'news']);
Route::get('/news/{categoryAlias}', [CategoryController::class, 'news']);
Route::get('/news/{categoryAlias}/page/{pageNumber}', [CategoryController::class, 'news']);
Route::get('/news/{categoryAlias}/{postAlias}.html', [PostController::class, 'news']);
Route::get('/news/{categoryAlias}/{postAlias}.html/amp', [PostController::class, 'news']);


Route::get('/articles', [IndexBlogController::class, 'articles']);
Route::get('/articles/{categoryAlias}', [CategoryController::class, 'articles']);
Route::get('/articles/{categoryAlias}/page/{pageNumber}', [CategoryController::class, 'articles']);
Route::get('/articles/{categoryAlias}/{postAlias}.html', [PostController::class, 'articles']);
Route::get('/articles/{categoryAlias}/{postAlias}.html/amp', [PostController::class, 'articles']);

Route::get('posts/load_more', [ActionsController::class, 'loadPosts']);
