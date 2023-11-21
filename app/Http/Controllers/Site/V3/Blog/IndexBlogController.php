<?php

namespace App\Http\Controllers\Site\V3\Blog;

use DB;
use App\Models\StaticPages\StaticPage;

class IndexBlogController extends BaseBlogController
{
    public function news()
    {
        return $this->render('news');
    }

    public function articles()
    {
        return $this->render('articles');
    }

    private function render(string $alias)
    {
        $postsCategory = StaticPage::where(['alias' => $alias])->first();

        if ($postsCategory == null) {
            abort(404);
        }

        $queryType = $this->getTypePagesByAlias($alias);

        $blogCategories = DB::table('posts_categories')
            ->select('id', 'h1', 'alias_category', 'short_name')
            ->where(['sidebar_menu' => $queryType])
            ->orderBy('sidebar_order', 'asc')
            ->get();

        $posts = [];
        foreach ($blogCategories as $category) {

            $row = DB::table('posts')
                ->leftJoin('posts_categories','posts.pcid','posts_categories.id')
                ->select('posts.*',
                    'posts_categories.id as category_id',
                    'posts_categories.alias_category',
                    'posts_categories.h1 as category_h1')
                ->where(['posts.pcid' => $category->id,'posts.status' => 1])
                ->limit(6)
                ->orderBy('posts.date', 'desc')
                ->get();

            $posts [] = $row;
        }


        $breadcrumbs = [];
        $breadcrumbs [] =  ['h1' => $postsCategory->breadcrumb ?? $postsCategory->h1];

        return view('site.v3.templates.blog.index',[
            'postsCategory' => $postsCategory,
            'blogCategories' => $blogCategories,
            'posts' => $posts,
            'breadcrumbs' => $breadcrumbs,
            'editLink' => '/'
        ]);

    }
}