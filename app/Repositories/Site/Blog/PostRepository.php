<?php

namespace App\Repositories\Site\Blog;
use DB;

class PostRepository
{
    protected const NEWS_TYPE = 1;
    protected const ARTICLES_TYPE = 2;

    public function getNewsForIndex()
    {
        return $this->getPosts(self::NEWS_TYPE);
    }

    public function getArticlesForIndex()
    {
        return $this->getPosts(self::ARTICLES_TYPE);
    }

    private function getPosts($typeID)
    {
        $blogCategories = DB::table('posts_categories')
            ->select('id')
            ->where(['sidebar_menu' => $typeID])
            ->orderBy('sidebar_order')
            ->get()
            ->pluck('id')
            ->toArray();

        return DB::table('posts')
            ->leftJoin('posts_categories','posts.pcid','posts_categories.id')
            ->select('posts.*',
                'posts_categories.id as category_id',
                'posts_categories.alias_category',
                'posts_categories.h1 as category_h1')
            ->where(['posts.status' => 1])
            ->whereIn('posts.pcid', $blogCategories)
            ->limit(10)
            ->orderBy('posts.id', 'desc')
            ->get();
    }
}