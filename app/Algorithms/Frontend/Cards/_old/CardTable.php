<?php

namespace App\Algorithms\Frontend\Cards;

class CardTable
{
    public static function getNameById($id)
    {
        switch ($id) {
            case 1: return 'cards_1_zaimy';
            case 2: return 'cards_2_rko';
            case 3: return 'cards_3_zalogi';
            case 4: return 'cards_4_credits';
            case 5: return 'cards_5_credit_cards';
            case 6: return 'cards_6_debit_cards';
            case 7: return 'cards_7';
            case 8: return 'cards_8';

            default: return null;
        }
    }
}