<?php

namespace App\Algorithms\Frontend\StructuredData\Product;

class Listings
{
    public static function render($cards, $page) : string
    {

        if (!count($cards)) return '';


        $low_price_value = 10000000;
        $high_price_value = 0;


        $offers_code = '';

        //$switch_id = (isset($page->cards_category_id)) ? $page->cards_category_id : $page->id;

        if (isset($page->cards_category_id)) {
            $switch_id = $page->cards_category_id;
        } elseif (isset($page->category_id)) {
            $switch_id = $page->category_id;
        } else {
            $switch_id = $page->id;
        }


        // у кэшбэка не используем поля макс и мин
        if ($switch_id == 9) {
            return self::renderNoPrams($page);
        }

        switch ($switch_id) {
            case 3:
            case 4:
            case 7:
            case 8:
            case 10:
            case 1: $field_high_price = 'sum_max';  $field_low_price = 'sum_min'; $field_price_range = 1; break;
            case 6:
            case 2: $field_high_price = 'opened';  $field_low_price = 'opened'; $field_price_range = 0; break;
            case 5: $field_high_price = 'limit_max';  $field_low_price = 'limit_max'; $field_price_range = 0; break;
            default: return '';
        }

        $counter = 1;
        foreach ($cards as $k => $card) {
            if ($card->$field_low_price == '') {
                unset($cards[$k]);
                continue;
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


    public static function renderNoPrams($page) : string
    {
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
 "sku": "'.$page->id.'"
}</script>';
    }

}