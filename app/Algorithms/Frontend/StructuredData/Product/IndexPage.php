<?php

namespace App\Algorithms\Frontend\StructuredData\Product;
use App\Models\System;
use DB;


class IndexPage
{
    public static function render($h1, $meta_description)
    {

            $cards = DB::table('cards')
                ->leftjoin("cards_1_zaimy", 'cards.id', '=', "cards_1_zaimy.card_id")
                ->leftjoin("companies", 'cards.company_id', '=', "companies.id")
                ->select( "cards_1_zaimy.*", 'cards.*', "cards_1_zaimy.id as idd")
                ->where(['cards.under_the_button'=>null,'cards.category_id'=>1,'cards.status'=>1])
                ->orderBy("cards.km5", 'desc')
                ->get();
            /*
            $totalCardsCollection = collect()
                ->merge($cards)
                ->merge($underButtonCards)
                ->all();
            */

            //$cards = $totalCardsCollection;

            $cards = System::reviewsParse($cards);






        if (!count($cards)) return;

        $low_price_value = 10000000;
        $high_price_value = 0;


        $number_of_votes = 0;
        $average_rating = 0;

        $offers_code = '';


        $counter = 1;
        foreach ($cards as $card) {



            $average_rating += $card->ratingValue;
            $number_of_votes += $card->ratingCount;


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
       		            "image":
                        {
                            "@type":"ImageObject",
       			            "url":"https://finance.ru'. str_replace('https://finance.ru','',$card->logo). '"
       		            }';


                $offers_code .= ',"priceRange": "' . $card->sum_min . ' - ' . $card->sum_max . '"';


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
   "ratingCount": "'.$number_of_votes.'",
   "ratingValue": "'.round($average_rating/count($cards),1).'"
 },
 "image": "https://finance.ru/old_theme/img/logo_vzo.png",
 "name": "'.$h1.'",
 "description" : "'. \Shortcode::compile($meta_description).'",
 "sku": "1",
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