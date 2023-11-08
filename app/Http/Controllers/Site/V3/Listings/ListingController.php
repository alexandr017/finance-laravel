<?php

namespace App\Http\Controllers\Site\V3\Listings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Cards\CardsCategories;
use Cache;
use App\Models\Banks\Popular;
use App\Models\Cards\Listing;
use App\Repositories\Site\Card\CardRepository;


class ListingController extends Controller
{

    public function indexZaimy()
    {
        return $this->render(1);
    }

    public function indexKredity()
    {
        return $this->render(4);
    }

    public function indexKreditnyeKarty()
    {
        return $this->render(5);
    }

    public function indexDebetovyeKarty()
    {
        return $this->render(6);
    }

    public function indexIpoteki()
    {
        return $this->render(0);
    }

    public function indexAvtokredity()
    {
        return $this->render(0);
    }

    public function indexVklady()
    {
        return $this->render(0);
    }


    public function zaimy($tagAlias)
    {
        return $this->render(1, $tagAlias);
    }

    public function kredity($tagAlias)
    {
        return $this->render(4, $tagAlias);
    }

    public function kreditnyeKarty($tagAlias)
    {
        return $this->render(5, $tagAlias);
    }

    public function debetovyeKarty($tagAlias)
    {
        return $this->render(6, $tagAlias);
    }

    public function ipoteki($tagAlias)
    {
        return $this->render( 0, $tagAlias);
    }

    public function avtokredity($tagAlias)
    {
        return $this->render( 0, $tagAlias);
    }

    public function vklady($tagAlias)
    {
        return $this->render( 0, $tagAlias);
    }


    private function render($categoryID, $tagAlias = null)
    {
        if ($tagAlias != null) {
            $listing = Listing::where(['alias' => $tagAlias, 'category_id' => $categoryID])->first();
        } else {
            $listing = (object) [
                'id' => 0,
                'category_id' => $categoryID,
                'cards_category_id' => $categoryID,
                'title' => 'Главная раздела',
                'meta_description' => '',
                'breadcrumb' => '',
                'others_cards' => '',
                'og_img' => '',
                'img' => '',
                'expert_anchor' => '',
                'lead' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore repudiandae rerum sint. A accusamus aliquid consequatur consequuntur delectus, deleniti, deserunt fugiat libero minima nam nobis, odit quae quidem sit temporibus?</p>',
                'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore repudiandae rerum sint. A accusamus aliquid consequatur consequuntur delectus, deleniti, deserunt fugiat libero minima nam nobis, odit quae quidem sit temporibus?</p>',
                'city_id' => '',
                'imenitelny' => '',
                'average_rating' => 5,
                'number_of_votes' => 43,
                'h1' => 'Главная раздела',
            ];
        }


        $relinkData = (new (\App\Repositories\Site\Relinking\RelinkingRepository::class))->getRelinkByCategory($categoryID);

        if ($listing == null) {
            abort(404);
        }

        $category_id = $listing->category_id;


        $cards_category = Cache::rememberForever('cards_categories'.$category_id, function() use($category_id){
            return CardsCategories::findOrFail($category_id);
        });

        $filters_json = $cards_category->filters_json;
        $options_json = $cards_category->options_json;
        $popular_offer_json = $cards_category->popular_offer_json;


        $card_repository = app(CardRepository::class);
        if ($listing->id != 0) {
            $cards = $card_repository->getSortedCards($listing->id);
        } else {
            $cards = [];
        }


        $breadcrumbs = [
            ['h1' => $listing->h1]
        ];

        $others_cards = ($listing->others_cards == null) ? [] : Cards::getCardByIds($listing->others_cards);


        $popular_banks = Popular::where(['category_id'=>$category_id])->first();

        $tag_name = '';
        $f_json = str_replace('https://finance.ru','',$filters_json);
        $f_json_arr = json_decode($f_json);


        foreach($f_json_arr as $f_json_arr_tmp){
            foreach($f_json_arr_tmp->values as $link){
                if($_SERVER['REQUEST_URI'] == $link[0]->link) $tag_name = $link[0]->label;
            }
        }


        $blade = (!is_amp_page()) ? 'site.v3.templates.listings.listing' : 'site.v3.templates.listings.listing-amp';

        return view($blade,[
            'category_id' => $category_id,
            'page' => $listing,
            'options_json' => $options_json,
            'popular_offer_json' => $popular_offer_json,
            'breadcrumbs' => $breadcrumbs,
            'cards' => $cards,
            'section_type' => 3,
            'editLink' => '/admin/cards/listings/'.$listing->id.'/edit/',
            'others_cards' => $others_cards,
            'def_load' => true,
            'popular_banks' => $popular_banks,
            'prefixType' => '',
            'tag_name' => $tag_name,
            'relinkData' => $relinkData
        ]);

        return view('');
    }


    private function renderForIndex()
    {

    }



    private function setAlias()
    {
        //$urls = \DB::table('urls')->where(['section_type' => 15])->get();
        $listings = Listing::select('id', 'category_id')->whereNull('deleted_at')->get();

        foreach ($listings as $listing) {

            if (! in_array($listing->category_id ,[1, 4, 5, 6, 8, 10 ,11])) {
                continue;
            }

            $listing = Listing::find($listing->id);
            $alias = \DB::table('urls')->where(['section_type' => 15, 'section_id' => $listing->id])->first()->url;
            if ($listing->category_id == 4) {
                $alias = str_replace('online-credit/', '', $alias);
            }
            if ($listing->category_id == 5) {
                $alias = str_replace('credit-cards/', '', $alias);
            }
            if ($listing->category_id == 6) {
                $alias = str_replace('debit-cards/', '', $alias);
            }
            if ($listing->category_id == 8) {
                $alias = str_replace('autocredit/', '', $alias);
            }
            if ($listing->category_id == 10) {
                $alias = str_replace('mortgage/', '', $alias);
            }
            if ($listing->category_id == 11) {
                $alias = str_replace('deposits/', '', $alias);
            }
            $listing->alias = $alias;
            $listing->save();
        }
        dd('ok');
    }
}