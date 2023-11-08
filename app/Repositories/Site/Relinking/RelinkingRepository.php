<?php

namespace App\Repositories\Site\Relinking;

use DB;

class RelinkingRepository
{
    public function getRelinkByCategory(int $categoryID) : array
    {
        return DB::table('relinking')
            ->join('relinking_groups', 'relinking_groups.id', 'relinking.relinking_group_id')
            ->select('relinking_groups.group_name as group_name', 'relinking.title' ,'relinking.link', 'relinking.sort_order')
            ->where(['relinking_groups.category_id' => $categoryID, 'relinking.category_id' => $categoryID])
            ->where('relinking.link','!=', 'https://vsezaimyonline.ru'.$_SERVER['REQUEST_URI'])
            ->orderBy('relinking_groups.sort_order', 'asc')
            ->get()
            ->groupBy('group_name')
            ->map(function ($elements) {
                return $elements->sortBy('sort_order',0);
            })
            ->toArray();
    }
}