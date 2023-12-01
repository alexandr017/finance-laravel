<?php

namespace App\Algorithms\General\Cards;
use DB;

class CardCategory
{
    /**
     * @return array
     */
    public static function getCategoriesName()
    {
        $categories = self::getDBCollection()->toArray();;
        return $categories;
    }

    /**
     * @param  int $id
     * @return string
     */
    public static function getCategoryNameByID($id)
    {
        $categories = self::getDBCollection()->toArray();;

        foreach ($categories as $category) {
            if ($category->id == $id) {
                return $categories->breadcrumbs;
            }
        }

        return '';
    }

    private static function getDBCollection()
    {
        return DB::table('cards_categories')->get()->pluck('breadcrumb', 'id');
    }
}