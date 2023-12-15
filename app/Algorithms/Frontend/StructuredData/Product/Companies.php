<?php

namespace App\Algorithms\Frontend\StructuredData\Product;

class Companies
{
    public static function render($cards) : array
    {
        $low_price_value = 10000000;
        $high_price_value = 0;
        $offers_code = '';
        $counter = 1;
        foreach ($cards as $card) {

            switch ($card->category_id) {
                case 11:
                case 10:
                case 7:
                case 8:
                case 3:
                case 4:
                case 1: $field_high_price = 'sum_max';  $field_low_price = 'sum_min'; break;
                case 6:
                case 2: $field_high_price = 'opened';  $field_low_price = 'opened'; break;
                case 5: $field_high_price = 'limit_max';  $field_low_price = 'limit_max'; break;
                default: ['', '', ''];
            }


            if ($card->$field_low_price < $low_price_value) {
                $low_price_value = $card->$field_low_price;
            }
            if ($card->$field_high_price > $high_price_value) {
                $high_price_value = $card->$field_high_price;
            }

            $link = ($card->link_type == 1) ? $card->link_1 : $card->link_2;

            $offers_code .= '
                {
                    "@type": "Offer",
                    "url": "'.$link.'",
                    "offeredBy":{
                        "@type":"BankOrCreditUnion",
       		            "name":"'.$card->title.'",
       		            "address": "todo address",
       		            "image":
                        {
                            "@type":"ImageObject",
       			            "url":"https://finance.ru'. str_replace('https://finance.ru','',$card->logo). '"
       		            }';

            $offers_code .= ',"priceRange": "' . $card->$field_low_price . ' - ' . $card->$field_high_price . '"';

            $offers_code .= '}
                }';

            if($counter != count($cards)) $offers_code .= ',';
            $counter++;
        }

        return [$high_price_value, $low_price_value, $offers_code];
    }
}