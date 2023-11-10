<?php

namespace App\Http\Controllers\Site\V3\Blog;

use App\Models\Posts\PostsCategories;
use App\Models\StaticPages\StaticPage;
use DB;
use App\Models\Posts\Posts;

class CategoryController extends BaseBlogController
{
    public function news(string $categoryAlias, $pageNumber = 1)
    {
        return $this->category( $categoryAlias, $pageNumber,'news');
    }

    public function articles(string $categoryAlias, $pageNumber = 1)
    {
        return $this->category( $categoryAlias, $pageNumber, 'articles');
    }


    private function category(string $categoryAlias, int $pageNumber, string $alias)
    {
        $postGlobalCategory = StaticPage::where(['alias' => $alias])->first();

        if ($postGlobalCategory == null) {
            abort(404);
        }

        $queryType = $this->getTypePagesByAlias($alias);

        $postCategory = PostsCategories::where(['alias_category' => $alias . '/' . $categoryAlias, 'sidebar_menu' => $queryType])->first();

        if ($postCategory == null) {
            abort(404);
        }

        $offset = ($pageNumber == 0) ? 0 : ($pageNumber * 10) - 10;
        if ($pageNumber == 1) {
            $offset = 0;
        }


        $posts = DB::table('posts')
            ->select('posts.*')
            ->where(['posts.pcid' => $postCategory->id, 'posts.status' => 1])
            ->limit(10)
            ->orderBy('posts.valid_until', 'desc')
            ->orderBy('posts.date', 'desc')
            ->offset($offset)
            ->get();


        $postsCount = Posts::where(['posts.pcid' => $postCategory->id, 'status' => 1])->paginate(10);

        if ((count($posts) == 0) && ($pageNumber!=1)) {
            abort(404);
        }

        $pages = $postsCount->lastPage();

        $breadcrumbs = [];
        $breadcrumbs [] = ['link' => '/' . $alias, 'h1' => $postGlobalCategory->breadcrumbs ?? $postGlobalCategory->h1];
        $breadcrumbs [] = ['h1'=> $postCategory->breadcrumbs ?? $postCategory->h1];

        $blogCategories = DB::table('posts_categories')
            ->select('id', 'h1', 'alias_category', 'short_name')
            ->where(['sidebar_menu' => $queryType])
            ->orderBy('sidebar_order', 'asc')
            ->get();

        return view('site.v3.templates.blog.category',[
            'posts' => $posts,
            'postCategory' => $postCategory,
            'breadcrumbs' => $breadcrumbs,
            'page' => $pageNumber,
            'pages' => $pages,
            'editLink' => '/',
            'blogCategories' => $blogCategories
        ]);

    }
}