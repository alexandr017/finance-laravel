<?php

namespace App\Http\Controllers\Site\V3\Actions\CardFilter;

class CardFilter
{
    public static function getFilteredCardsByCategory($category_id, $cards, $data)
    {
        $class = 'App\Http\Controllers\Frontend\Actions\CardFilter\Classes\FilterForCategory'.$category_id;
        $file_pach = app_path('Http/Controllers/Frontend/Actions/CardFilter/Classes/FilterForCategory'.$category_id.'.php');

        if (file_exists($file_pach)) {

            require_once $file_pach;

            if (class_exists($class)) {
                $cards_obj = new $class;
                $cards = $cards_obj->filter($cards, $data);
            }

        }

        return $cards;
    }

}