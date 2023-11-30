<?php

namespace App\Http\Controllers\Site\V3\Actions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use DB;
use App\Repositories\Site\Card\CardRepository;
use App\Http\Controllers\Site\V3\Actions\CardFilter\CardFilter;

class CardsLoaderController extends Controller
{
    public function render(Request $request)
    {
        $field = clear_data($request['field']);
        $page = (int) clear_data($request['page']);
        $listing_id = (int) clear_data($request['listing_id']);
        $count_on_page = (int)  clear_data($request['count_on_page']);
        $sort_type = clear_data($request['sort_type']);
        $category_id = clear_data($request['category_id']);


        if (($listing_id == 0) || ($count_on_page == 0)) {
            return '';
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
