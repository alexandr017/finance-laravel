<?php

namespace App\Algorithms\Frontend\Cards;

class CardTable
{
    public static function getNameById($id) : ?string
    {
        return match ($id) {
            1 => 'cards_1_zaimy',
            2 => 'cards_2_rko',
            3 => 'cards_3_zalogi',
            4 => 'cards_4_credits',
            5 => 'cards_5_credit_cards',
            6 => 'cards_6_debit_cards',
            7 => 'cards_7',
            8 => 'cards_8',
            10 => 'cards_10',
            11 => 'cards_11',
            default => null,
        };
    }
}