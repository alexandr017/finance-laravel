<?php

namespace App\Repositories\Site\Relinking;

use DB;

class RelinkingRepository
{
    private const BANK_CATEGORIES = [2,4,5,6,8,10,11];

    public function getRelinkByCategory(int $categoryID) : array
    {
        return DB::table('relinking')
            ->join('relinking_groups', 'relinking_groups.id', 'relinking.relinking_group_id')
            ->select('relinking_groups.group_name as group_name', 'relinking.title' ,'relinking.link', 'relinking.sort_order')
            ->where(['relinking_groups.category_id' => $categoryID, 'relinking.category_id' => $categoryID])
            //->where('relinking.link','!=', 'https://vsezaimyonline.ru'.$_SERVER['REQUEST_URI'])
            ->orderBy('relinking_groups.sort_order')
            ->get()
            ->groupBy('group_name')
            ->map(function ($elements) {
                return $elements->sortBy('sort_order', 0);
            })
            ->toArray();
    }

    public function getRelinkForBanks()  : array
    {
        $relinkGroups = DB::table('relinking_groups')
            ->leftJoin('cards_categories', 'cards_categories.id', 'relinking_groups.category_id')
            ->select(['relinking_groups.*', 'cards_categories.breadcrumb', 'cards_categories.id as cards_categories_id'])
            ->whereIn('cards_categories.id', RelinkingRepository::BANK_CATEGORIES)
            ->orderBy('cards_categories.id')
            ->get()
            ->groupBy('breadcrumb')
            ->toArray();

        $relink = DB::table('relinking')
            ->whereIn('category_id', RelinkingRepository::BANK_CATEGORIES)
            ->get();

        foreach ($relinkGroups as $relinkGroup) {
            foreach ($relinkGroup as $group) {
                foreach ($relink as $link) {
                    if ($link->relinking_group_id == $group->id) {
                        $group->items [] = $link;
                    }
                }
            }
        }

        return $relinkGroups;
    }
}