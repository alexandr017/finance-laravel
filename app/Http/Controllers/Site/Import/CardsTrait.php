<?php

namespace App\Http\Controllers\Site\Import;

use Illuminate\Http\Request;
use App\Models\Cards\Cards;
use Cache;

trait CardsTrait
{
    public function updateCards(Request $request)
    {
        $categoryID = (int) clear_data($request['category_id']);
        match($categoryID) {
            1 => $this->updateCategory1(),
            2 => $this->updateCategory2(),
            4 => $this->updateCategory4(),
            5 => $this->updateCategory5(),
            6 => $this->updateCategory6(),
            8 => $this->updateCategory8(),
            10 => $this->updateCategory10(),
            11 => $this->updateCategory11(),
        };
    }

    private function updateCategory1()
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
    }

    private function updateCategory2()
    {
        $cards = Cards::select('id')->where(['category_id' => 2])->get();
        foreach ($cards as $_card) {
            $card = Cards::find($_card->id);
            $card->logo = str_replace('.svg', '.png', $card->logo);


            if (!str_contains($card->account_link, '/banki')) {
                $card->account_link = str_replace('/banks', '/banki', $card->account_link);
                $card->account_link = str_replace('/login', '/lichnyj-kabinet', $card->account_link);

            }
            if (!str_contains($card->support_link, '/banki')) {
                $card->support_link = str_replace('/banks', '/banki', $card->support_link);
                $card->support_link = str_replace('/hotline', '/gorjachaja-linija', $card->support_link);
            }

            if (!str_contains($card->link_to_reviews_page, '/banki')) {
                $card->link_to_reviews_page = str_replace('/banks', '/banki', $card->link_to_reviews_page);
                $card->link_to_reviews_page = str_replace('/reviews', '/otzyvy', $card->link_to_reviews_page);
            }

            if (!str_contains($card->link_to_entity, '/banki')) {
                $card->link_to_entity = str_replace('/banks', '/banki', $card->link_to_entity);
                $tmpArr = explode('/', $card->link_to_entity);
                if (isset($tmpArr[1]) && isset($tmpArr[2]) && isset($tmpArr[3])) {
                    $card->link_to_entity = '/' . $tmpArr[1] . '/' . $tmpArr[2] . '/' . $tmpArr[3];
                }
            }

            $card->save();

            if (Cache::has('card'.$_card->id)) {
                Cache::forget('card'.$_card->id);
            }
        }
    }

    private function updateCategory4()
    {
        $cards = Cards::select('id')->where(['category_id' => 4])->get();
        foreach ($cards as $_card) {
            $card = Cards::find($_card->id);
            $card->logo = str_replace('.svg', '.png', $card->logo);


            if (!str_contains($card->account_link, '/banki')) {
                $card->account_link = str_replace('/banks', '/banki', $card->account_link);
                $card->account_link = str_replace('/login', '/lichnyj-kabinet', $card->account_link);

            }
            if (!str_contains($card->support_link, '/banki')) {
                $card->support_link = str_replace('/banks', '/banki', $card->support_link);
                $card->support_link = str_replace('/hotline', '/gorjachaja-linija', $card->support_link);
            }

            if (!str_contains($card->link_to_reviews_page, '/banki')) {
                $card->link_to_reviews_page = str_replace('/banks', '/banki', $card->link_to_reviews_page);
                $card->link_to_reviews_page = str_replace('/reviews', '/otzyvy', $card->link_to_reviews_page);
            }

            if (!str_contains($card->link_to_entity, '/banki')) {
                $card->link_to_entity = str_replace('/banks', '/banki', $card->link_to_entity);
                $card->link_to_entity = str_replace('/credits', '/kredity', $card->link_to_entity);
                $tmpArr = explode('/', $card->link_to_entity);
                if (isset($tmpArr[1]) && isset($tmpArr[2]) && isset($tmpArr[3])) {
                    $card->link_to_entity = '/' . $tmpArr[1] . '/' . $tmpArr[2] . '/' . $tmpArr[3];
                }
            }

            $card->save();

            if (Cache::has('card'.$_card->id)) {
                Cache::forget('card'.$_card->id);
            }
        }
    }

    private function updateCategory5()
    {
        $cards = Cards::select('id')->where(['category_id' => 5])->get();
        foreach ($cards as $_card) {
            $card = Cards::find($_card->id);
            $card->logo = str_replace('.svg', '.png', $card->logo);


            if (!str_contains($card->account_link, '/banki')) {
                $card->account_link = str_replace('/banks', '/banki', $card->account_link);
                $card->account_link = str_replace('/login', '/lichnyj-kabinet', $card->account_link);

            }
            if (!str_contains($card->support_link, '/banki')) {
                $card->support_link = str_replace('/banks', '/banki', $card->support_link);
                $card->support_link = str_replace('/hotline', '/gorjachaja-linija', $card->support_link);
            }

            if (!str_contains($card->link_to_reviews_page, '/banki')) {
                $card->link_to_reviews_page = str_replace('/banks', '/banki', $card->link_to_reviews_page);
                $card->link_to_reviews_page = str_replace('/reviews', '/otzyvy', $card->link_to_reviews_page);
            }

            if (!str_contains($card->link_to_entity, '/banki')) {
                $card->link_to_entity = str_replace('/banks', '/banki', $card->link_to_entity);
                $card->link_to_entity = str_replace('/credit-cards', '/kreditnye-karty', $card->link_to_entity);
                $tmpArr = explode('/', $card->link_to_entity);
                if (isset($tmpArr[1]) && isset($tmpArr[2]) && isset($tmpArr[3])) {
                    $card->link_to_entity = '/' . $tmpArr[1] . '/' . $tmpArr[2] . '/' . $tmpArr[3];
                }
            }

            $card->save();

            if (Cache::has('card'.$_card->id)) {
                Cache::forget('card'.$_card->id);
            }
        }
    }

    private function updateCategory6()
    {
        $cards = Cards::select('id')->where(['category_id' => 6])->get();
        foreach ($cards as $_card) {
            $card = Cards::find($_card->id);
            $card->logo = str_replace('.svg', '.png', $card->logo);


            if (!str_contains($card->account_link, '/banki')) {
                $card->account_link = str_replace('/banks', '/banki', $card->account_link);
                $card->account_link = str_replace('/login', '/lichnyj-kabinet', $card->account_link);

            }
            if (!str_contains($card->support_link, '/banki')) {
                $card->support_link = str_replace('/banks', '/banki', $card->support_link);
                $card->support_link = str_replace('/hotline', '/gorjachaja-linija', $card->support_link);
            }

            if (!str_contains($card->link_to_reviews_page, '/banki')) {
                $card->link_to_reviews_page = str_replace('/banks', '/banki', $card->link_to_reviews_page);
                $card->link_to_reviews_page = str_replace('/reviews', '/otzyvy', $card->link_to_reviews_page);
            }

            if (!str_contains($card->link_to_entity, '/banki')) {
                $card->link_to_entity = str_replace('/banks', '/banki', $card->link_to_entity);
                $card->link_to_entity = str_replace('/debit-cards', '/debetovye-karty', $card->link_to_entity);
                $tmpArr = explode('/', $card->link_to_entity);
                if (isset($tmpArr[1]) && isset($tmpArr[2]) && isset($tmpArr[3])) {
                    $card->link_to_entity = '/' . $tmpArr[1] . '/' . $tmpArr[2] . '/' . $tmpArr[3];
                }
            }

            $card->save();

            if (Cache::has('card'.$_card->id)) {
                Cache::forget('card'.$_card->id);
            }
        }
    }

    private function updateCategory8()
    {
        $cards = Cards::select('id')->where(['category_id' => 8])->get();
        foreach ($cards as $_card) {
            $card = Cards::find($_card->id);
            $card->logo = str_replace('.svg', '.png', $card->logo);


            if (!str_contains($card->account_link, '/banki')) {
                $card->account_link = str_replace('/banks', '/banki', $card->account_link);
                $card->account_link = str_replace('/login', '/lichnyj-kabinet', $card->account_link);

            }
            if (!str_contains($card->support_link, '/banki')) {
                $card->support_link = str_replace('/banks', '/banki', $card->support_link);
                $card->support_link = str_replace('/hotline', '/gorjachaja-linija', $card->support_link);
            }

            if (!str_contains($card->link_to_reviews_page, '/banki')) {
                $card->link_to_reviews_page = str_replace('/banks', '/banki', $card->link_to_reviews_page);
                $card->link_to_reviews_page = str_replace('/reviews', '/otzyvy', $card->link_to_reviews_page);
            }

            if (!str_contains($card->link_to_entity, '/banki')) {
                $card->link_to_entity = str_replace('/banks', '/banki', $card->link_to_entity);
                $card->link_to_entity = str_replace('/autocredit', '/avtokredity', $card->link_to_entity);
                $tmpArr = explode('/', $card->link_to_entity);
                if (isset($tmpArr[1]) && isset($tmpArr[2]) && isset($tmpArr[3])) {
                    $card->link_to_entity = '/' . $tmpArr[1] . '/' . $tmpArr[2] . '/' . $tmpArr[3];
                }
            }

            $card->save();

            if (Cache::has('card'.$_card->id)) {
                Cache::forget('card'.$_card->id);
            }
        }
    }

    private function updateCategory10()
    {
        $cards = Cards::select('id')->where(['category_id' => 10])->get();
        foreach ($cards as $_card) {
            $card = Cards::find($_card->id);
            $card->logo = str_replace('.svg', '.png', $card->logo);


            if (!str_contains($card->account_link, '/banki')) {
                $card->account_link = str_replace('/banks', '/banki', $card->account_link);
                $card->account_link = str_replace('/login', '/lichnyj-kabinet', $card->account_link);

            }
            if (!str_contains($card->support_link, '/banki')) {
                $card->support_link = str_replace('/banks', '/banki', $card->support_link);
                $card->support_link = str_replace('/hotline', '/gorjachaja-linija', $card->support_link);
            }

            if (!str_contains($card->link_to_reviews_page, '/banki')) {
                $card->link_to_reviews_page = str_replace('/banks', '/banki', $card->link_to_reviews_page);
                $card->link_to_reviews_page = str_replace('/reviews', '/otzyvy', $card->link_to_reviews_page);
            }

            if (!str_contains($card->link_to_entity, '/banki')) {
                $card->link_to_entity = str_replace('/banks', '/banki', $card->link_to_entity);
                $card->link_to_entity = str_replace('/mortgage', '/ipoteki', $card->link_to_entity);
                $tmpArr = explode('/', $card->link_to_entity);
                if (isset($tmpArr[1]) && isset($tmpArr[2]) && isset($tmpArr[3])) {
                    $card->link_to_entity = '/' . $tmpArr[1] . '/' . $tmpArr[2] . '/' . $tmpArr[3];
                }
            }

            $card->save();

            if (Cache::has('card'.$_card->id)) {
                Cache::forget('card'.$_card->id);
            }
        }
    }

    private function updateCategory11()
    {
        $cards = Cards::select('id')->where(['category_id' => 11])->get();
        foreach ($cards as $_card) {
            $card = Cards::find($_card->id);
            $card->logo = str_replace('.svg', '.png', $card->logo);


            if (!str_contains($card->account_link, '/banki')) {
                $card->account_link = str_replace('/banks', '/banki', $card->account_link);
                $card->account_link = str_replace('/login', '/lichnyj-kabinet', $card->account_link);

            }
            if (!str_contains($card->support_link, '/banki')) {
                $card->support_link = str_replace('/banks', '/banki', $card->support_link);
                $card->support_link = str_replace('/hotline', '/gorjachaja-linija', $card->support_link);
            }

            if (!str_contains($card->link_to_reviews_page, '/banki')) {
                $card->link_to_reviews_page = str_replace('/banks', '/banki', $card->link_to_reviews_page);
                $card->link_to_reviews_page = str_replace('/reviews', '/otzyvy', $card->link_to_reviews_page);
            }

            if (!str_contains($card->link_to_entity, '/banki')) {
                $card->link_to_entity = str_replace('/banks', '/banki', $card->link_to_entity);
                $card->link_to_entity = str_replace('/deposits', '/vklady', $card->link_to_entity);
                $tmpArr = explode('/', $card->link_to_entity);
                if (isset($tmpArr[1]) && isset($tmpArr[2]) && isset($tmpArr[3])) {
                    $card->link_to_entity = '/' . $tmpArr[1] . '/' . $tmpArr[2] . '/' . $tmpArr[3];
                }
            }

            $card->save();

            if (Cache::has('card'.$_card->id)) {
                Cache::forget('card'.$_card->id);
            }
        }
    }


}