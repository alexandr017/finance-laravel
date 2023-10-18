<?php

namespace App\Algorithms\Frontend\StructuredData\Product;

use App\Models\Companies\CompaniesUrl;

class CompanyChildenPages
{
    public static function render($cards, $page)
    {

        if (!count($cards)) return;


        $low_price_value = 10000000;
        $high_price_value = 0;


        $offers_code = '';

        if (!isset($cards[0]->category_id)) {
            return;
        }


        $counter = 1;
        foreach ($cards as $card) {

            switch ($card->category_id) {
                case 1: $field_high_price = 'sum_max';  $field_low_price = 'sum_min'; $field_price_range = 1; break;
                case 2: $field_high_price = 'opened';  $field_low_price = 'opened'; $field_price_range = 0; break;
                case 3: $field_high_price = 'sum_max';  $field_low_price = 'sum_min'; $field_price_range = 1; break;
                case 4: $field_high_price = 'sum_max';  $field_low_price = 'sum_min'; $field_price_range = 1; break;
                case 5: $field_high_price = 'limit_max';  $field_low_price = 'limit_max'; $field_price_range = 0; break;
                case 6: $field_high_price = 'opened';  $field_low_price = 'opened'; $field_price_range = 0; break;
                case 7: $field_high_price = 'sum_max';  $field_low_price = 'sum_min'; $field_price_range = 1; break;
                case 8: $field_high_price = 'sum_max';  $field_low_price = 'sum_min'; $field_price_range = 1; break;
                //case 9: $field_high_price = 'opened';  $field_low_price = 'opened'; $field_price_range = 1; break;
                default: return;
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
       		            "image":
                        {
                            "@type":"ImageObject",
       			            "url":"https://finance.ru'. str_replace('https://finance.ru','',$card->logo). '"
       		            }';

            if($field_price_range) {
                $offers_code .= ',"priceRange": "' . $card->$field_low_price . ' - ' . $card->$field_high_price . '"';
            }


            $offers_code .= '       }
                }';

            if($counter != count($cards)) $offers_code .= ',';

            $counter++;

        } // end foreach


        return '<script type="application/ld+json">{
            "@context": "http://schema.org",
 "@type": "Product",
 "aggregateRating": {
 "@type": "AggregateRating",
   "bestRating": "5",
   "ratingCount": "'.$page->number_of_votes.'",
   "ratingValue": "'.$page->average_rating.'"
 },
 "image": "https://finance.ru'.$page->img.'",
 "name": "'.$page->h1.'",
 "description" : "'. \Shortcode::compile($page->meta_description).'",
 "sku": "'.$page->id.'",
 "offers": {
            "@type": "AggregateOffer",
   "highPrice": "'.$high_price_value.'",
   "lowPrice": "'.$low_price_value.'",
   "offerCount": "'.count($cards).'",
   "priceCurrency": "Rub",

   "offers": [
     '.$offers_code.'
   ]
 }
}</script>';


    }
}