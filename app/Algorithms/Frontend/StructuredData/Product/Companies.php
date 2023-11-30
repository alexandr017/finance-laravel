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
            if ($card->sum_min < $low_price_value) {
                $low_price_value = $card->sum_min;
            }
            if ($card->sum_max > $high_price_value) {
                $high_price_value = $card->sum_max;
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

            $offers_code .= ',"priceRange": "' . $card->sum_min . ' - ' . $card->sum_max . '"';

            $offers_code .= '}
                }';

            if($counter != count($cards)) $offers_code .= ',';
            $counter++;
        }

        return [$high_price_value, $low_price_value, $offers_code];
    }
}