<?php

namespace App\Http\Controllers\Site\V3\Actions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cards\Cards;
use App\Models\Cards\CardsChildrenPages;
use App\Models\Cards\СardsСomplaints;
use App\Models\System;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Cache;
use DB;
use Mail;
use App\Models\Companies\Companies;

use App\Repositories\Frontend\Card\CardRepository;
use App\Algorithms\Frontend\Cards\CardsBoot;
use App\Algorithms\Frontend\Cards\CardSorting;
use App\Http\Controllers\Site\V3\Actions\CardFilter\CardFilter;
use Auth;
use App\Repositories\Frontend\Companies\CompaniesCategoryRepository;

class CardsLoaderController extends Controller
{
    public function getCardForHubs(Request $request)
    {
        $res = [];

        $sort_field = clear_data($request['field']);
        $page = (int) clear_data($request['page']);
        $category_id = (int) clear_data($request['category_id']);
        $count_on_page = (int)  clear_data($request['count_on_page']);
        $sort_type = clear_data($request['sort_type']);

        if(($category_id == 0) || ($count_on_page == 0)) return null;


        if ($sort_field == '') {
            $sort_field = 'km5';
        }
        if ($sort_type == '') {
            $sort_type = 'desc';
        }

        $cards = (new CompaniesCategoryRepository)->getSortedCardsForHabPages($category_id, $sort_field, $sort_type);



        if ($sort_field == 'cache_back') {
            foreach ($cards as $key => $value) {
                $cards[$key]->_cache_back = (float) GlobalAlgorithms::getMaxNumberWithPercentFromStr($value->cache_back);
            }
            $sort_field = '_cache_back';
            // сортировка
            //
            $cards = CardSorting::sort($cards, $sort_field, $sort_type);
        }







        // пагинация
        //ddd($cards, 10, $page);
        $cards = paginate($cards, 10, $page);
        //ddd($cards, 10, $page);


        $resultHTML = '';

        foreach($cards as $card){
            //companies/hubs_includes/blocks/card_body
            $view = view('frontend.cards.hubs.pc_and_mob.'.$category_id,['card'=>$card, 'amp' => 0]);
            $resultHTML .= $view->render();//or echo $view->render(); whatever you like
        }

        //ddd($cards);

        if($resultHTML == '') $resultHTML = '<br><br><h4>Извините, по вашим критериям ничего не найдено. Попробуйте изменить условия поиска.</h4><br><br>';

        $res['code'] = $resultHTML;
        $res['count'] = count($cards);

        return $res;
    }



    public function render(Request $request)
    {
        $field = clear_data($request['field']);
        $page = (int) clear_data($request['page']);
        $listing_id = (int) clear_data($request['listing_id']);
        $count_on_page = (int)  clear_data($request['count_on_page']);
        $sort_type = clear_data($request['sort_type']);
        $category_id = clear_data($request['category_id']);


        if (($listing_id == 0) || ($count_on_page == 0)) {
            return;
        }

        $card_repository = app(CardRepository::class);
        $cards = $card_repository->getSortedCards($listing_id, $field, $sort_type);



        if(gettype($request['options']) == 'array'){
            $tmpOptionsArr = $request['options'];
            $optionsArr = [];
            foreach ($tmpOptionsArr as $kt => $vt) {
                if($vt != '') $optionsArr[] = clear_data($vt);
            }


            $optionsStr = implode(',', $optionsArr);
            $sep = count($optionsArr);

            $optionsStr = str_replace(',', " or filter='", $optionsStr);
            $optionsStr = str_replace(' or', "' or", $optionsStr);
            $optionsStr .= "'";

            $optionsDB = DB::select("select * from cards_filters where filter='$optionsStr");


            foreach ($cards as $key => $value) {
                $is_card_count = 0;
                foreach ($optionsDB as $key2 => $value2) {
                    if($value->id == $value2->card_id) $is_card_count++;
                }
                if($is_card_count < $sep) unset($cards[$key]);
            }

        }

        // поиск с форм сайдбара
        $cards = CardFilter::getFilteredCardsByCategory($category_id, $cards, $request);
        $countOnNextPage = count($cards) - 10;
        // если не главная применяем пагинацию
        if ($category_id != 1 || $listing_id != -1) {
            $cards = self::paginate($cards, 10, $page);
            $cards = $cards->items();
        }

        $result = '';


        //$betaCards = [393, 521, 410, 392, 530, 383, 401, 532, 563, 562];

        foreach ($cards as $card) {
            //dd($card->category_id);
                if ($card->category_id == 1) {
                    $view = view('site.v3.modules.cards.minimal.card',['card'=>$card,'amp' => 0]);
                    $result .= $view->render();//or echo $view->render(); whatever you like

                } else {
                    $view = view('site.v3.modules.cards.card.card',['card'=>$card]);
                    $result .= $view->render();//or echo $view->render(); whatever you like
                }

        }

        if ($result == '') {
            $result = '<br><br><h4>Извините, по вашим критериям ничего не найдено. Попробуйте изменить условия поиска.</h4><br><br>';
        }

        return [
            'code' => $result,
            'count' => count($cards),
            'nextPage' => $countOnNextPage
        ];
    }






    private static function paginate($items, $perPage = 15, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }


}
