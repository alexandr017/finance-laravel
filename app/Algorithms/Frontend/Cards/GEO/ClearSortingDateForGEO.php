<?php

namespace App\Algorithms\Frontend\Cards\GEO;

// В рамках топ-10 нужно включить рандомное перемешивание карточек на гео-листингах.
// С учетом потоков, т.е. на гео будет доп.правило: 1-3 позиции рандомно перемешиваются раз в 3 дня, 4-10 - раз в 2 дня
class ClearSortingDateForGEO
{
    public static function clear($cardID)
    {
        $cards = self::sortOneThree($cards);
        $cards = self::sortFourTen($cards);

        return $cards;
    }

}