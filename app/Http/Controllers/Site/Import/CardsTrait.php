<?php

namespace App\Http\Controllers\Site\Import;

use App\Models\Cards\Cards;
use Cache;

trait CardsTrait
{
    public function updateCards()
    {
        $cards = Cards::select('id')->where(['category_id' => 1])->get();
        foreach ($cards as $_card) {
            $card = Cards::find($_card->id);
            $card->logo = str_replace('.svg', '.png', $card->logo);

            if (!str_contains($card->account_link, '/mfo')) {
                $card->account_link = '/mfo' . $card->account_link;
                $card->account_link = str_replace('/login', '/lichnyj-kabinet', $card->account_link);

            }
            if (!str_contains($card->support_link, '/mfo')) {
                $card->support_link = '/mfo' . $card->support_link;
            }

            if (!str_contains($card->link_to_reviews_page, '/mfo')) {
                $card->link_to_reviews_page = '/mfo' . $card->link_to_reviews_page;
                $card->link_to_reviews_page = str_replace('/reviews', '/otzyvy', $card->link_to_reviews_page);
            }

            if (!str_contains($card->link_to_entity, '/mfo')) {
                $card->link_to_entity = '/mfo' . $card->link_to_entity;
            }

            $card->save();

            if (Cache::has('card'.$_card->id)) {
                Cache::forget('card'.$_card->id);
            }
        }






        $cards = Cards::select('id')->where(['category_id' => 2])->get();
        foreach ($cards as $_card) {
            $card = Cards::find($_card->id);
            $card->logo = str_replace('.svg', '.png', $card->logo);

//            $card->account_link = '/mfo' . $card->account_link;
//            $card->account_link = str_replace('/login', '/lichnyj-kabinet', $card->account_link);
//
//            $card->support_link = '/mfo' . $card->support_link;
//
//            $card->link_to_reviews_page = '/mfo' . $card->link_to_reviews_page;
//            $card->link_to_reviews_page = str_replace('/reviews', '/otzyvy', $card->link_to_reviews_page);
//
//            $card->link_to_entity = '/mfo' . $card->link_to_entity;

            $card->save();

            if (Cache::has('card'.$_card->id)) {
                Cache::forget('card'.$_card->id);
            }
        }


        $cards = Cards::select('id')->where(['category_id' => 4])->get();
        foreach ($cards as $_card) {
            $card = Cards::find($_card->id);
            $card->logo = str_replace('.svg', '.png', $card->logo);

//            $card->account_link = '/mfo' . $card->account_link;
//            $card->account_link = str_replace('/login', '/lichnyj-kabinet', $card->account_link);
//
//            $card->support_link = '/mfo' . $card->support_link;
//
//            $card->link_to_reviews_page = '/mfo' . $card->link_to_reviews_page;
//            $card->link_to_reviews_page = str_replace('/reviews', '/otzyvy', $card->link_to_reviews_page);
//
//            $card->link_to_entity = '/mfo' . $card->link_to_entity;

            $card->save();

            if (Cache::has('card'.$_card->id)) {
                Cache::forget('card'.$_card->id);
            }
        }


        $cards = Cards::select('id')->where(['category_id' => 10])->get();
        foreach ($cards as $_card) {
            $card = Cards::find($_card->id);
            $card->logo = str_replace('.svg', '.png', $card->logo);

//            $card->account_link = '/mfo' . $card->account_link;
//            $card->account_link = str_replace('/login', '/lichnyj-kabinet', $card->account_link);
//
//            $card->support_link = '/mfo' . $card->support_link;
//
//            $card->link_to_reviews_page = '/mfo' . $card->link_to_reviews_page;
//            $card->link_to_reviews_page = str_replace('/reviews', '/otzyvy', $card->link_to_reviews_page);
//
//            $card->link_to_entity = '/mfo' . $card->link_to_entity;

            $card->save();

            if (Cache::has('card'.$_card->id)) {
                Cache::forget('card'.$_card->id);
            }
        }




        $cards = Cards::select('id')->where(['category_id' => 11])->get();
        foreach ($cards as $_card) {
            $card = Cards::find($_card->id);
            $card->logo = str_replace('.svg', '.png', $card->logo);

//            $card->account_link = '/mfo' . $card->account_link;
//            $card->account_link = str_replace('/login', '/lichnyj-kabinet', $card->account_link);
//
//            $card->support_link = '/mfo' . $card->support_link;
//
//            $card->link_to_reviews_page = '/mfo' . $card->link_to_reviews_page;
//            $card->link_to_reviews_page = str_replace('/reviews', '/otzyvy', $card->link_to_reviews_page);
//
//            $card->link_to_entity = '/mfo' . $card->link_to_entity;

            $card->save();

            if (Cache::has('card'.$_card->id)) {
                Cache::forget('card'.$_card->id);
            }
        }



    }


}