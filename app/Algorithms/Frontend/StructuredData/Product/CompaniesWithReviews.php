<?php

namespace App\Algorithms\Frontend\StructuredData\Product;

class CompaniesWithReviews
{
    public static function render($cards, $page, $reviews) : string
    {

        if (!count($cards)) return '';

        $offers_code = '';

        $low_price_value = 10000000;
        $high_price_value = 0;

        $counter = 1;
        foreach ($cards as $card) {

            if (!isset($card->category_id)) {
                return '';
            }



            $field_names = self::getFieldsName($card->category_id);
            $field_low_price = $field_names['field_low_price'];
            $field_high_price = $field_names['field_high_price'];
            $field_price_range = $field_names['field_price_range'];


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



        $reviews_code = '';

        if(count($reviews)) {

            $reviews_code = '"review": [ ';

            $counter = 1;
            $last_review = null;

            foreach ($reviews as $review) {



                $last_review = $review->rating;

                if($review->rating != null) {

                    if($counter != 1 && $last_review != null) {
                        $reviews_code .= ',';
                    }

                    $reviews_code .= '
                    {
                    "@type": "Review",
                    "reviewRating": {
                        "@type": "Rating",
                        "ratingValue": "'.$review->rating.'",
                        "bestRating": "5"
                        },
                    "author": "'.$review->author.'",
                    "description": "'.str_replace('"',"'",$review->review).'",
                    "datePublished": "'.$review->created_at.'"
                    }';

                    $counter++;
                }

            }

            $reviews_code .= '],';
        }

        return '<script type="application/ld+json">{
            "@context": "http://schema.org",
 "@type": "Product",
 '.$reviews_code.'
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

    private static function getFieldsName($category_id)
    {
        switch ($category_id) {
            case 1: return ['field_high_price' => 'sum_max',  'field_low_price' => 'sum_min', 'field_price_range' => 1];
            case 2: return ['field_high_price' => 'opened',  'field_low_price' => 'opened', 'field_price_range' => 0];
            case 3: return ['field_high_price' => 'sum_max',  'field_low_price' => 'sum_min', 'field_price_range' => 1];
            case 4: return ['field_high_price' => 'sum_max',  'field_low_price' => 'sum_min', 'field_price_range' => 1];
            case 5: return ['field_high_price' => 'limit_max',  'field_low_price' => 'limit_max', 'field_price_range' => 0];
            case 6: return ['field_high_price' => 'opened',  'field_low_price' => 'opened', 'field_price_range' => 0];
            case 7: return ['field_high_price' => 'sum_max',  'field_low_price' => 'sum_min', 'field_price_range' => 1];
            case 8: return ['field_high_price' => 'sum_max',  'field_low_price' => 'sum_min', 'field_price_range' => 1];
            //case 9: return ['field_high_price' => 'opened',  'field_low_price' => 'opened', 'field_price_range' => 1];
            default: return null;
        }
    }

}