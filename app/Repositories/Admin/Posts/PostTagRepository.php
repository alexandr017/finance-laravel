<?php

namespace App\Repositories\Admin\Posts;

use App\Repositories\Repository;
use App\Models\Posts\PostsTag as Model;
use DB;

class PostTagRepository extends Repository
{
    /**
     * @return mixed
     */
    public function getForShow()
    {
        return DB::table('posts_tags')
            ->leftJoin('posts_categories', 'posts_tags.category_id', 'posts_categories.id')
            ->select('posts_tags.*', 'posts_categories.h1 as postCategoryName')
            ->get();
    }

    /**
     * @param $addEmptyRow string
     * @return array
     */
    public function getForSelect($addEmptyRow = 'no_empty_row')
    {
        $items = Model::select('id','tag')
            ->pluck('tag','id')
            ->toArray();

        if ($addEmptyRow == 'with_empty_row') {
            $items = [0 => 'Тег не выбран'] + $items;
        }

        return $items;
    }

    public function getForSelectWithCategoryName()
    {
        return DB::table('posts_tags')
            ->leftJoin('posts_categories', 'posts_tags.category_id', 'posts_categories.id')
            ->select('posts_tags.id', DB::raw('CONCAT(posts_tags.tag," (",posts_categories.h1, ")") as tag'))
            ->pluck('tag','id')
            ->toArray();
    }

    public function getForSelectWithCategoryNameByCategoryId($categoryId)
    {
        return DB::table('posts_tags')
            ->leftJoin('posts_categories', 'posts_tags.category_id', 'posts_categories.id')
            ->select('posts_tags.id', DB::raw('CONCAT(posts_tags.tag," (",posts_categories.h1, ")") as tag'))
            ->where(['posts_categories.id' => $categoryId])
            ->pluck('tag','id')
            ->toArray();
    }

    public function getForSelectByCategories()
    {
        $items = Model::select('id','tag', 'category_id')
            ->where(function ($query) {
                $query->where('parent_id', null)
                    ->orWhere('parent_id', 0);
            })
            ->get()
            ->groupBy('category_id')
            ->map(fn($tags) => $tags->pluck('tag','id'))
            ->toArray();

        $items = [0 => 'Тег не выбран'] + $items;

        return $items;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getForEdit($id)
    {
        return Model::find($id);
    }

}
