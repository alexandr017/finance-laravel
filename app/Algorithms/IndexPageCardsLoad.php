<?php

namespace App\Algorithms;

use App\Models\System;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use DB;

use Algorithms\Frontend\Cards\CardTable;
use App\Algorithms\Frontend\Cards\CardsBoot;
use App\Algorithms\Frontend\Cards\CardSorting;

use App\Repositories\Frontend\Card\CardRepository;
use Auth;

class IndexPageCardsLoad {


    public static function getBaseCards()
    {


        $card_repository = app(CardRepository::class);

        $flow1_IDs = $card_repository->getListEnableCardsFromIndexPage(1);
        $flow2_IDs = $card_repository->getListEnableCardsFromIndexPage(2);
        $flow3_IDs = $card_repository->getListEnableCardsFromIndexPage(3);

        $cards1 = CardsBoot::getCardsForListingByIDs($flow1_IDs);
        $cards2 = CardsBoot::getCardsForListingByIDs($flow2_IDs);
        $cards3 = CardsBoot::getCardsForListingByIDs($flow3_IDs);

        // сортировка по к5м
        $cards1 = CardSorting::sort($cards1, 'km5', 'desc');
        $cards2 = CardSorting::sort($cards2, 'km5', 'desc');
        $cards3 = CardSorting::sort($cards3, 'km5', 'desc');


        $cards = array_merge($cards1, array_merge($cards2, $cards3));

/*
        $cards = DB::table('cards')
            ->leftjoin("cards_1_zaimy", 'cards.id', '=', "cards_1_zaimy.card_id")
            ->leftjoin("companies", 'cards.company_id', '=', "companies.id")
            ->leftjoin("companies_url", 'companies.group_id', '=', "companies_url.id")
            ->select('cards.*', "cards_1_zaimy.*", "cards_1_zaimy.id as idd",'companies.alias as companies_alias', 'companies_url.url as group_url','companies.reviews_page')
            ->where(['cards.category_id'=>1,'cards.show_in_index'=>1,'cards.status'=>1])
            //->limit(8)
            ->orderBy("cards.km5", 'desc')
            ->get();
        if($cards == null) $cards = [];

        $cards = System::reviewsParse($cards);
        */

        $result = '';
        $section_type = 1;
        $amp = false;

        $i = 0;
        foreach($cards as $card){
            if ($_SERVER['HTTP_REFERER'] == 'https://finance.ru/loans') {
                $view = view('frontend.cards.card.card_beta', compact('card', 'section_type', 'amp', 'cards', 'i'));
            } else {
                $view = view('frontend.cards.card.card', compact('card', 'section_type', 'amp', 'cards', 'i'));
            }
//            $view = view('frontend.cards.card.card', compact('card','section_type','amp','cards','i'));
            $result .= $view->render();
            $i++;
            if ($i > 9) break;
        }

        if($result == '') $result = '<br><br><h4>Извините, по вашим критериям ничего не найдено. Попробуйте изменить условия поиска.</h4><br><br>';

        return $result;

    }


    // метод скорее всего не надо
    public static function getOthersCards($pageNumber)
    {

        //$pageNumber --;
        // брать подкнопочные (отсортированные)
        // брать оставшиеся (отсортированные)
        // объединять
        // для параметра страница отдавать тот или иной десяток карточек

        /*
        $underButtonCards = DB::table('cards')
            ->leftjoin("cards_1_zaimy", 'cards.id', '=', "cards_1_zaimy.card_id")
            ->leftjoin("companies", 'cards.company_id', '=', "companies.id")
            ->leftjoin("companies_url", 'companies.group_id', '=', "companies_url.id")
            ->select('cards.*', "cards_1_zaimy.*", "cards_1_zaimy.id as idd",'companies.alias as companies_alias', 'companies_url.url as group_url','companies.reviews_page')
            ->where(['cards.category_id'=>1,'cards.under_the_button'=>1,'cards.status'=>1,'cards.hide_in_index'=>0])
            ->orderBy("cards.km5", 'desc')
            ->get();
        */

        $othersCards = DB::table('cards')
            ->leftjoin("cards_1_zaimy", 'cards.id', '=', "cards_1_zaimy.card_id")
            ->leftjoin("companies", 'cards.company_id', '=', "companies.id")
            ->leftjoin("companies_url", 'companies.group_id', '=', "companies_url.id")
            ->select('cards.*', "cards_1_zaimy.*", "cards_1_zaimy.id as idd",'companies.alias as companies_alias', 'companies_url.url as group_url','companies.reviews_page')
            ->where(['cards.category_id'=>1,'cards.under_the_button'=>null,'cards.show_in_index'=>1,'cards.status'=>1])
            ->orderBy("cards.km5", 'desc')
            ->get();

        $totalCardsCollection = collect()
            //ы->merge($underButtonCards)
            ->merge($othersCards)
            ->all();


        $cards = self::paginate($totalCardsCollection, 10, $pageNumber);

        $result = [];
        $section_type = 1;
        $amp = false;
        $code = '';

        foreach($cards as $card){
            $view = view('frontend.cards.card.card', compact('card','section_type','amp'));
            $code .= $view->render();
        }

        if($code == '')
            $result['code'] = '<br><br><h4>Извините, по вашим критериям ничего не найдено. Попробуйте изменить условия поиска.</h4><br><br>';
        else
            $result['code'] = $code;

        return $result;


    }

    // метод скорее всего не надо
    public static function getUnderButtonsCards()
    {

        $cards = DB::table('cards')
            ->leftjoin("cards_1_zaimy", 'cards.id', '=', "cards_1_zaimy.card_id")
            ->leftjoin("companies", 'cards.company_id', '=', "companies.id")
            ->leftjoin("companies_url", 'companies.group_id', '=', "companies_url.id")
            ->select('cards.*', "cards_1_zaimy.*", "cards_1_zaimy.id as idd",'companies.alias as companies_alias', 'companies_url.url as group_url','companies.reviews_page')
            ->where(['cards.category_id'=>1,'cards.under_the_button'=>1,'cards.status'=>1,'cards.hide_in_index'=>0])
            //->limit(8)
            ->orderBy("cards.km5", 'desc')
            ->get();
        if($cards == null) $cards = [];

        $cards = System::reviewsParse($cards);

        $result = '';
        $section_type = 1;
        $amp = false;

        foreach($cards as $card){
            $view = view('frontend.cards.card.card', compact('card','section_type','amp'));
            $result .= $view->render();
        }

        if($result == '') $result = '<br><br><h4>Извините, по вашим критериям ничего не найдено. Попробуйте изменить условия поиска.</h4><br><br>';

        return $result;
    }



    private static function paginate($items, $perPage = 15, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

}



