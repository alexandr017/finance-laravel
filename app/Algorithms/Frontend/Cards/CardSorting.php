<?php

namespace App\Algorithms\Frontend\Cards;

class CardSorting
{
    public static function sort($cards, $sort_field = 'km5', $sort_type = 'desc')
    {
        //ddd($cards);

        usort($cards, function($a,$b) use ($cards, $sort_field, $sort_type) {

            //ddd($cards, $a, $b);

            if (! isset($a->$sort_field)) {
                return 0;
            }

            // если одинаковые сортируемые значения выше та карточка, ID которой меньше
            if ($a->$sort_field == $b->$sort_field) {
                if ($a->id > $b->id) return 1;
                elseif($a->id > $b->id) return -1;
            }

            if ($sort_type === 'desc') {

                if ($a->$sort_field < $b->$sort_field) return 1;
                elseif($a->$sort_field > $b->$sort_field) return -1;
                else return 0;

            } else {

                if ($a->$sort_field < $b->$sort_field) return -1;
                elseif($a->$sort_field > $b->$sort_field) return 1;
                else return 0;

            }


        });

        return $cards;

    }




}