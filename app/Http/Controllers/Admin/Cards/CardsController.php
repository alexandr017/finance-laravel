<?php

namespace App\Http\Controllers\Admin\Cards;

use Illuminate\Http\Request;
use App\Models\Cards\CardsCategories;
use App\Models\Companies\Companies;
use App\Models\Cards\Cards;

use App\Models\Cards\Listing;
use App\Models\Cards\CardsChildrenPages;

use App\Models\Cards\CardsChildren;
use App\Models\Cards\ListingCards;

use App\Models\Cards\CardsZaimy;
use App\Models\Cards\CardsZalogi;
use App\Models\Cards\CardsRko;
use App\Models\Cards\CardsDebitsCards;
use App\Models\Cards\CardsCreditsCards;
use App\Models\Cards\CardsCredits;
use App\Models\Cards\Card7;
use App\Models\Cards\Card8;
use App\Models\Cards\Card10;
use App\Models\Cards\Card11;
use App\Models\Cards\Card12;
use App\Models\System;
use Validator;
use Cache;
use Auth;
use Log;
use DB;
use App\Algorithms\General\Banks\ProductScaleNames;
use App\Models\Banks\Bank;


class CardsController extends BaseCardsController
{
    const LISTINGS_RELATION_CHUNK_SIZE = 700;


    public function index()
    {
    	$cards = DB::table('cards')
            ->join('cards_categories', 'cards_categories.id', '=', 'cards.category_id')
            ->select('cards.id','cards.title','cards.status','cards.id', 'cards.company_id', 'cards.link_1', 'cards.link_2', 'cards.link_type', 'cards_categories.breadcrumb as category_h1')
            ->get();

        $hideLinks = DB::table('hide_links')
            ->select('in', 'affiliate_program_id')
            ->get()
            ->pluck('affiliate_program_id', 'in');

        $breadcrumbs = [
            ['h1' => 'Карточки'],
        ];

    	return view('admin.cards.cards.index',[
    		'cards' => $cards,
            'hideLinks' => $hideLinks,
            'breadcrumbs' => $breadcrumbs
    	]);
    }

    public function create()
    {
    	$cardsCategories = CardsCategories::all();
        $cardsCategoriesArr = System::convertToArray($cardsCategories,'breadcrumb',['null' => 'Выберите категорию']);
        $companies = Companies::all();
        $companiesArr = System::convertToArray($companies,'h1',[0 => 'Выберите компанию']);
        $banks = DB::table('banks')->select('id', 'h1')->whereNull('deleted_at')->get();
        $banksArr = System::convertToArray($banks,'h1',[0 => 'Выберите банк']);

        $breadcrumbs = [
            ['h1' => 'Карточки', 'link' => route('admin.cards.cards.index')],
            ['h1' => 'Создание']
        ];

    	return view('admin.cards.cards.create',compact('cardsCategoriesArr','companiesArr','banksArr', 'breadcrumbs'));
    }

    public function create_save(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'flow' => 'required',
                'logo' => 'required',
                'link_1' => 'required',
                'km5' => 'required',
                'category_id' => 'required|numeric'
            ],
            [
                'title.required' => '"Заголовок" обязательное поле',
                'flow.required' => '"Поток" обязательное поле',
                'logo.required' => '"Лого URL" обязательное поле',
                'link_1.required' => '"Главный URL для перехода" обязательное поле',
                'km5.required' => '"КМ5" обязательное поле',
                'category_id.required' => '"Категория" обязательное поле',
                'category_id.numeric' => '"Категория" обязательное поле',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $others_fields_template = $this->get_file($request['category_id']);
        if($others_fields_template == null){
            return redirect()->route('admin.cards.cards.index')->withErrors(["Ошибка создания карточки: для категории карточек '$request[category_id]' не задан файловый шаблон дополнительных полей"]);
        }

        $card = new Cards();
        $card->category_id = $request['category_id'];
        $card->title = $request['title'];
        $card->product_title = $request['product_title'] ?? null;
        $card->flow = $request['flow'];

        if ($request['link_type'] == 0) {
            $card->flow = 3;
        }


        //if($request['under_the_button'] == 'on'){
            //$card->under_the_button = 1;
        //}
        $card->logo = $request['logo'];
        $card->link_1 = $request['link_1'];
        $card->link_2 = (empty($request['link_2'])) ? '' :  $request['link_2'];
        $card->link_type = (int) $request['link_type'];
        $card->yandex_event = $request['yandex_event'];
        $card->promo = (int) $request['promo'];
        $card->km5 = $request['km5'];
        $card->card_type = $request['card_type'] ?? null;
        $card->license = $request['license'] ?? null;
        $card->days_off = (empty($request['days_off'])) ? null :  $request['days_off'];
        $card->site_availability = (empty($request['site_availability'])) ? null :  $request['site_availability'];
        $card->label = (int) $request['label'];
        $card->downloads = $request['downloads'];
        $card->link_to_entity = str_replace('https://vsezaimyonline.ru','', $request['link_to_entity']) ?? null;
        $card->link_to_reviews_page = str_replace('https://vsezaimyonline.ru','', $request['link_to_reviews_page']) ?? null;
        $card->support_link = str_replace('https://vsezaimyonline.ru','', $request['support_link']) ?? null;
        $card->account_link = str_replace('https://vsezaimyonline.ru','', $request['account_link']) ?? null;
        $card->company_id = (int) $request['company_id'];
        $card->bank_id = (int) $request['bank_id'];

        if(gettype($request['company_id2'])=='array'){
            $card->company_id2 = implode(',',$request['company_id2']);
        } else {
            $card->company_id2 = null;
        }

        $card->show_in_index = (int) $request['show_in_index'];
        $card->show_in_habs = (int) $request['show_in_habs'];

        if(gettype($request['icons'])=='array'){
            $card->icons = implode(',',$request['icons']);
        } else {
            $card->icons = null;
        }

        $card->scale_1 = (empty($request['scale_1'])) ? null :  $request['scale_1'];
        $card->scale_2 = (empty($request['scale_2'])) ? null :  $request['scale_2'];
        $card->scale_3 = (empty($request['scale_3'])) ? null :  $request['scale_3'];
        $card->scale_4 = (empty($request['scale_4'])) ? null :  $request['scale_4'];
        $card->scale_5 = (empty($request['scale_5'])) ? null :  $request['scale_5'];

        $card->status = (int) $request['status'];
        $card->fake_update_date = date('Y-m-d');
        $card->save();


        adminLog('Карточки', $card->id, 'create');

        $others_fields = $this->actions($request,$card->id);
        if($others_fields == null){
            return redirect()->route('admin.cards.cards.index')->withErrors(["Ошибка создания карточки: дополнительные поля не были сохранены, так как не настроен медот для дополнительных полей данной категории: '$request[category_id]'"]);
        }

        if($request['options'] != null){
            foreach ($request['options'] as $key => $value) {
                DB::insert("insert into cards_filters (card_id, filter) values (?, ?)", [$card->id, $value]);
            }            
        }


        if($request['listings'] != null){

            foreach ($request['listings'] as $key => $value) {

                if($request['category_id'] == 1){
                    if($value == 'cities_zaimy') {
                        $cardsChildrenPages = DB::select("select id,city_id from cards_children_pages where cards_category_id = 1 and city_id <> 0");
                        foreach ($cardsChildrenPages as $v){
                            DB::insert("insert into cards_childrens (card_id, children_id) values (?, ?)", [$card->id, $v->id]);
                        }
                    }
                }


                if($value != 'cities_zaimy')
                    DB::insert("insert into cards_childrens (card_id, children_id) values (?, ?)", [$card->id, $value]);
            }
        }

        return redirect()->route('admin.cards.cards.index')->with('flash_success', 'Карточка успешна добавлена!');
    }

    public function edit($id){

//        if (\Auth::id() == 12467 || \Auth::id() == 122935 || \Auth::id() == '128767' || \Auth::id() == '133366' || \Auth::id() == '30154') {
//            return $this->edit_12467($id);
//        }

        $card = Cards::find($id);
        if($card == null){
            return redirect()->route('admin.cards.cards.index')->withErrors(['Попытка отредактировать карточку с несуществующим ID = '.$id]);
        }
        $cardsCategories = CardsCategories::all();
        $cardsCategoriesArr = System::convertToArray($cardsCategories,'breadcrumb',['null' => 'Выберите категорию']);
        $companies = Companies::all();
        $companiesArr = System::convertToArray($companies,'h1',[0 => 'Выберите компанию']);

        $banks = DB::table('banks')->select('id', 'h1')->whereNull('deleted_at')->get();
        $banksArr = System::convertToArray($banks,'h1',[0 => 'Выберите банк']);

        $others_fields_template = $this->get_file($card->category_id);
        if($others_fields_template == null){
            return redirect()->route('admin.cards.cards.index')->withErrors(["Ошибка редактирования карточки: для категории карточек '$card->category_id' не задан файловый шаблон дополнительных полей"]);
        }

        $card_filters = DB::select("select * from cards_filters where card_id=?",[$id]);

        $others_fields_template = $this->parse_fields($others_fields_template,$card);

        $cardCategories = CardsCategories::find($card->category_id);
        $optionsJson = $cardCategories->options_json;

        $options = '';
        if($optionsJson != ''){
            $optionsArr = json_decode($optionsJson);
            foreach ($optionsArr as $key => $value) {
                $bool = false;
                foreach ($card_filters as $key2 => $value2) {
                    if($value->id_title == $value2->filter){
                        $bool = true;
                    }
                }
                if(!$bool){
                    $options = $options . "<div class=\"checkbox\"><label><input name=\"options[]\" value=\"$value->id_title\" type=\"checkbox\"> $value->label</label></div>\n";
                } else {
                    $options = $options . "<div class=\"checkbox\"><label><input checked=\"checked\" name=\"options[]\" value=\"$value->id_title\" type=\"checkbox\"> $value->label</label></div>\n";

                }
            }
        }

        $others_fields_template = str_replace('{options}', $options, $others_fields_template);

        $selected_categories_listings = DB::table('cards_childrens')
            ->select('children_id')
            ->where('card_id', '=', $id)
            ->pluck('children_id')->toArray();
        $categories_listings = CardsChildrenPages::where(['cards_category_id'=>$card->category_id])->get();

        $tmpArr = System::convertToArray($categories_listings,'number_in_exel');
        sort($tmpArr);

        $countCheckCities = 0;
        $countCities = 0;


        if ($card->category_id == 1) {
            foreach ($categories_listings as $key2 => $value2) {
                if ($value2->city_id != 0) {
                    unset($categories_listings[$key2]);
                    $countCities++; // все города
                    foreach ($selected_categories_listings as $value3) {
                        if ($value3 == $value2->id) $countCheckCities++; // прикпрепленные города
                    }
                }
            }
        }


        $categories_listings_res = [];
        foreach ($tmpArr as $key => $value) {
            foreach ($categories_listings as $key2 => $value2) {
                if($value == $value2->number_in_exel){
                    $categories_listings_res[$value2->id] = $value2->number_in_exel. '. ' . $value2->h1;
                }
            }
        }



        $view = 'admin.cards.cards.edit';
        if (\Auth::id() == 12467) {
            $view = 'admin.cards.cards.edit_12467';
        }

        $breadcrumbs = [
            ['h1' => 'Карточки', 'link' => route('admin.cards.cards.index')],
            ['h1' => 'Редактирование']
        ];

        return view($view,[
            'card' => $card,
            'cardsCategoriesArr' => $cardsCategoriesArr,
            'companiesArr' => $companiesArr,
            'others_fields_template' => $others_fields_template,
            'categories_listings' => $categories_listings_res,
            'selected_categories_listings' => $selected_categories_listings,
            'countCities' => $countCities,
            'countCheckCities' => $countCheckCities,
            'banksArr' => $banksArr,
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    private function edit_12467($id)
    {
        $card = Cards::find($id);

        if ($card == null) {
            abort(404);
        }

        $cardsCategoriesArr = CardsCategories::select('id', 'h1')->pluck('h1', 'id')->toArray();

        $companiesArr = Companies::select('id', 'h1')->pluck('h1', 'id')->toArray();
        $companiesArr[0] = 'Выберите компанию';


        $banksArr = Bank::select('id', 'h1')->pluck('h1', 'id')->toArray();
        $banksArr[0] = 'Выберите банк';

        $others_fields_template = $this->get_file($card->category_id);
        if ($others_fields_template == null) {
            abort(404);
        }

        $card_filters = DB::select("select * from cards_filters where card_id=?",[$id]);

        $others_fields_template = $this->parse_fields($others_fields_template,$card);

        $cardCategories = CardsCategories::find($card->category_id);
        $optionsJson = $cardCategories->options_json;

        $options = '';
        if($optionsJson != ''){
            $optionsArr = json_decode($optionsJson);
            foreach ($optionsArr as $value) {
                $bool = false;
                foreach ($card_filters as $value2) {
                    if($value->id_title == $value2->filter){
                        $bool = true;
                    }
                }
                if(!$bool){
                    $options = $options . "<div class=\"checkbox\"><label><input name=\"options[]\" value=\"$value->id_title\" type=\"checkbox\"> $value->label</label></div>\n";
                } else {
                    $options = $options . "<div class=\"checkbox\"><label><input checked=\"checked\" name=\"options[]\" value=\"$value->id_title\" type=\"checkbox\"> $value->label</label></div>\n";
                }
            }
        }
        $others_fields_template = str_replace('{options}', $options, $others_fields_template);

        $relink = DB::table('relinking')
            ->join('relinking_groups', 'relinking_groups.id', 'relinking.relinking_group_id')
            ->select([
                'relinking_groups.group_name as group_name',
                'relinking.title' ,
                'relinking.link',
                'relinking.sort_order',
                'relinking.listing_id',
                'relinking.listing_type'
            ])
            ->where([
                'relinking_groups.category_id' => $card->category_id,
                'relinking.category_id' => $card->category_id
            ])
            ->orderBy('relinking_groups.sort_order', 'desc')
            ->get();

        $listingsInRelink = $relink->where('listing_type', Listing::MORPH_TYPE)
            ->pluck('listing_id')
            ->toArray();

        $listingsWithoutRelink = Listing::select('listings.id', 'listings.h1', 'urls.url')
            ->leftJoin('urls', 'listings.id', 'urls.section_id')
            ->where('urls.section_type', Listing::URL_SECTION_TYPE)
            ->where('listings.category_id', $card->category_id)
            ->where('listings.city_id', 0)
            ->whereNotIn('listings.id', $listingsInRelink)
            ->get()
            ->map(function ($listing) {
                $listing->link = $listing->url;
                $listing->title = $listing->h1;
                return $listing;
            });

        $listingsOldInRelink = $relink->where('listing_type', CardsChildrenPages::MORPH_TYPE)
            ->pluck('listing_id')
            ->toArray();

        $listingsOldWithoutRelink = CardsChildrenPages::select('cards_children_pages.id', 'cards_children_pages.h1', 'urls.url')
            ->leftJoin('urls', 'cards_children_pages.id', 'urls.section_id')
            ->where('urls.section_type', CardsChildrenPages::URL_SECTION_TYPE)
            ->where('cards_children_pages.cards_category_id', $card->category_id)
            ->where('cards_children_pages.city_id', 0)
            ->whereNotIn('cards_children_pages.id', $listingsOldInRelink)
            ->get()
            ->map(function ($listing) {
                $listing->link = $listing->url;
                $listing->title = $listing->h1;
                return $listing;
            });

        $relink = $relink->groupBy('group_name')
            ->map(function ($elements) {
                return $elements->sortByDesc('sort_order');
            });

        $relink->put('Листинги без перелинковки', $listingsWithoutRelink->merge($listingsOldWithoutRelink));

        $selectedOldListings = DB::table('cards_childrens')
            ->select('children_id')
            ->where('card_id', '=', $card->id)
            ->pluck('children_id')
            ->toArray();

        $selectedNewListings = DB::table('listing_cards')
            ->select('listing_id')
            ->where('card_id', '=', $card->id)
            ->pluck('listing_id')
            ->toArray();

        $listingsOld = DB::table('cards_children_pages')
            ->leftJoin('urls', 'urls.section_id', 'cards_children_pages.id')
            ->select('cards_children_pages.h1', 'urls.url')
            ->whereIn('cards_children_pages.id', $selectedOldListings)
            ->where(['urls.section_type' => 3])
            ->get()
            ->pluck('h1', 'url')
            ->toArray();

        $listings = DB::table('listings')
            ->leftJoin('urls', 'urls.section_id', 'listings.id')
            ->select('listings.h1', 'urls.url')
            ->whereIn('listings.id', $selectedNewListings)
            ->where(['urls.section_type' => 15])
            ->get()
            ->pluck('h1', 'url')
            ->toArray();

        $listings = array_merge($listings, $listingsOld);

        $regions = DB::table('cities')
            ->leftJoin('cities_region', 'cities_region.id', 'cities.region_id')
            ->select('cities.id', 'cities.imenitelny', 'cities.transliteration', 'cities_region.id as cities_region_id', 'cities_region.region')
            ->get()
            ->groupBy('region');

        return view('admin.cards.cards.edit_12467',[
            'card' => $card,
            'cardsCategoriesArr' => $cardsCategoriesArr,
            'companiesArr' => $companiesArr,
            'others_fields_template' => $others_fields_template,
            'banksArr' => $banksArr,
            'listings' => $listings,
            'relink' => $relink,
            'regions' => $regions,
        ]);
    }

    public function edit_save(Request $request)
    {
        if (\Auth::id() == 12467 || \Auth::id() == 122935 || \Auth::id() == '128767' || \Auth::id() == '133366' || \Auth::id() == '30154') {
            return $this->edit_save_test($request);
        }

        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'flow' => 'required',
                'logo' => 'required',
                'link_1' => 'required',
                'km5' => 'required',
            ],
            [
                'title.required' => '"Заголовок" обязательное поле',
                'flow.required' => '"Поток" обязательное поле',
                'logo.required' => '"Лого URL" обязательное поле',
                'link_1.required' => '"Главный URL для перехода" обязательное поле',
                'km5.required' => '"КМ5" обязательное поле',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $others_fields_template = $this->get_file($request['category_id']);
        if($others_fields_template == null){
            return redirect()->route('admin.cards.cards.index')->withErrors(["Ошибка редактирования карточки: для категории карточек '$request[category_id]' не задан файловый шаблон дополнительных полей"]);
        }



        $card = Cards::find($request['id']);
        $card->category_id = $request['category_id'];

        $card->title = $request['title'];
        $card->product_title = $request['product_title'] ?? null;
        $card->flow = $request['flow'];
        if ($request['link_type'] == 0) {
            $card->flow = 3;
        }
        $card->logo = $request['logo'];
        $card->link_1 = $request['link_1'];
        $card->link_2 = (empty($request['link_2'])) ? '' :  $request['link_2'];
        $card->link_type = (int) $request['link_type'];
        $card->yandex_event = (empty($request['yandex_event'])) ? '' :  $request['yandex_event'];
        $card->promo = (int) $request['promo'];
        $card->km5 = $request['km5'];
        $card->card_type = $request['card_type'] ?? null;
        $card->license = $request['license'] ?? null;
        $card->days_off = (empty($request['days_off'])) ? null :  $request['days_off'];
        $card->site_availability = (empty($request['site_availability'])) ? null :  $request['site_availability'];
        $card->label = (int) $request['label'];
        $card->downloads = (empty($request['downloads'])) ? '' :  $request['downloads'];
        $card->link_to_entity = str_replace('https://vsezaimyonline.ru','', $request['link_to_entity']) ?? null;
        $card->link_to_reviews_page = str_replace('https://vsezaimyonline.ru','', $request['link_to_reviews_page']) ?? null;
        $card->support_link = str_replace('https://vsezaimyonline.ru','', $request['support_link']) ?? null;
        $card->account_link = str_replace('https://vsezaimyonline.ru','', $request['account_link']) ?? null;
        $card->company_id = (int) $request['company_id'];
        $card->bank_id = (int) $request['bank_id'];
        if(gettype($request['company_id2'])=='array'){
            $card->company_id2 = implode(',',$request['company_id2']);
        } else {
            $card->company_id2 = null;
        }

        $card->show_in_index = (int) $request['show_in_index'];
        $card->show_in_habs = (int) $request['show_in_habs'];

        if(gettype($request['icons'])=='array'){
            $card->icons = implode(',',$request['icons']);
        } else {
            $card->icons = null;
        }

        $card->scale_1 = (empty($request['scale_1'])) ? null :  $request['scale_1'];
        $card->scale_2 = (empty($request['scale_2'])) ? null :  $request['scale_2'];
        $card->scale_3 = (empty($request['scale_3'])) ? null :  $request['scale_3'];
        $card->scale_4 = (empty($request['scale_4'])) ? null :  $request['scale_4'];
        $card->scale_5 = (empty($request['scale_5'])) ? null :  $request['scale_5'];

        $cardStatusChanged = $card->status != (int) $request['status'];

        $card->status = (int) $request['status'];
        $card->fake_update_date = date('Y-m-d');

        $card->save();

        if ($cardStatusChanged) {
            DB::insert('insert into change_card_status_logs (card_id, user_id, set_status) values (?, ?, ?)', [$card->id, Auth::id(), $card->status]);
        }

        adminLog('Карточки', $card->id, 'update');
        
        $others_fields = $this->actions($request,$request['id'],'edit');

        if($others_fields == null){
            return redirect()->route('admin.cards.cards.index')->withErrors(["Ошибка изменения карточки: дополнительные поля не были изменены, так как не настроен медот для дополнительных полей данной категории: '$request[category_id]'"]);
        }

        DB::delete("delete from cards_filters where card_id=?",[$request['id']]);
        if($request['options'] != null){
            foreach ($request['options'] as $key => $value) {
                DB::insert("insert into cards_filters (card_id, filter) values (?, ?)", [$request['id'], $value]);
            }            
        }

        DB::delete("delete from cards_childrens where card_id=?",[$request['id']]);
        if($request['listings'] != null){
            foreach ($request['listings'] as $key => $value) {

                if($request['category_id'] == 1){
                    if($value == 'cities_zaimy') {
                        $cardsChildrenPages = DB::select("select id,city_id from cards_children_pages where cards_category_id = 1 and city_id <> 0");
                        foreach ($cardsChildrenPages as $v){
                            //dd($cardsChildrenPages);
                            DB::insert("insert into cards_childrens (card_id, children_id) values (?, ?)", [$card->id, $v->id]);
                        }
                    }
                }

                if($value != 'cities_zaimy')
                    DB::insert("insert into cards_childrens (card_id, children_id) values (?, ?)", [$card->id, $value]);
            }

        }

        if(Cache::has('card'.$card->id)) Cache::forget('card'.$card->id);

        return redirect()->route('admin.cards.cards.index')->with('flash_success', 'Карточка успешна обновлена!');
    }

    public function edit_save_test(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'flow' => 'required',
                'logo' => 'required',
                'link_1' => 'required',
                'km5' => 'required',
            ],
            [
                'title.required' => '"Заголовок" обязательное поле',
                'flow.required' => '"Поток" обязательное поле',
                'logo.required' => '"Лого URL" обязательное поле',
                'link_1.required' => '"Главный URL для перехода" обязательное поле',
                'km5.required' => '"КМ5" обязательное поле',
            ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $others_fields_template = $this->get_file($request['category_id']);
        if($others_fields_template == null){
            return redirect()->route('admin.cards.cards.index')->withErrors(["Ошибка редактирования карточки: для категории карточек '$request[category_id]' не задан файловый шаблон дополнительных полей"]);
        }



        $card = Cards::find($request['id']);
        $card->category_id = $request['category_id'];

        $card->title = $request['title'];
        $card->product_title = $request['product_title'] ?? null;
        $card->flow = $request['flow'];
        if ($request['link_type'] == 0) {
            $card->flow = 3;
        }
        $card->logo = $request['logo'];
        $card->link_1 = $request['link_1'];
        $card->link_2 = (empty($request['link_2'])) ? '' :  $request['link_2'];
        $card->link_type = (int) $request['link_type'];
        $card->yandex_event = (empty($request['yandex_event'])) ? '' :  $request['yandex_event'];
        $card->promo = (int) $request['promo'];
        $card->km5 = $request['km5'];
        $card->card_type = $request['card_type'] ?? null;
        $card->license = $request['license'] ?? null;
        $card->days_off = (empty($request['days_off'])) ? null :  $request['days_off'];
        $card->site_availability = (empty($request['site_availability'])) ? null :  $request['site_availability'];
        $card->label = (int) $request['label'];
        $card->downloads = (empty($request['downloads'])) ? '' :  $request['downloads'];
        $card->link_to_entity = str_replace('https://vsezaimyonline.ru','', $request['link_to_entity']) ?? null;
        $card->link_to_reviews_page = str_replace('https://vsezaimyonline.ru','', $request['link_to_reviews_page']) ?? null;
        $card->support_link = str_replace('https://vsezaimyonline.ru','', $request['support_link']) ?? null;
        $card->account_link = str_replace('https://vsezaimyonline.ru','', $request['account_link']) ?? null;
        $card->company_id = (int) $request['company_id'];
        $card->bank_id = (int) $request['bank_id'];
        if(gettype($request['company_id2'])=='array'){
            $card->company_id2 = implode(',',$request['company_id2']);
        } else {
            $card->company_id2 = null;
        }

        $card->show_in_index = (int) $request['show_in_index'];
        $card->show_in_habs = (int) $request['show_in_habs'];

        if(gettype($request['icons'])=='array'){
            $card->icons = implode(',',$request['icons']);
        } else {
            $card->icons = null;
        }

        $card->scale_1 = (empty($request['scale_1'])) ? null :  $request['scale_1'];
        $card->scale_2 = (empty($request['scale_2'])) ? null :  $request['scale_2'];
        $card->scale_3 = (empty($request['scale_3'])) ? null :  $request['scale_3'];
        $card->scale_4 = (empty($request['scale_4'])) ? null :  $request['scale_4'];
        $card->scale_5 = (empty($request['scale_5'])) ? null :  $request['scale_5'];

        $cardStatusChanged = $card->status != (int) $request['status'];

        $card->status = (int) $request['status'];
        $card->fake_update_date = date('Y-m-d');

        $card->save();

        if ($cardStatusChanged) {
            DB::insert('insert into change_card_status_logs (card_id, user_id, set_status) values (?, ?, ?)', [$card->id, Auth::id(), $card->status]);
        }

        adminLog('Карточки', $card->id, 'update');

        $others_fields = $this->actions($request,$request['id'],'edit');

        if($others_fields == null){
            return redirect()->route('admin.cards.cards.index')->withErrors(["Ошибка изменения карточки: дополнительные поля не были изменены, так как не настроен медот для дополнительных полей данной категории: '$request[category_id]'"]);
        }

        DB::delete("delete from cards_filters where card_id=?",[$request['id']]);
        if($request['options'] != null){
            foreach ($request['options'] as $key => $value) {
                DB::insert("insert into cards_filters (card_id, filter) values (?, ?)", [$request['id'], $value]);
            }
        }


        $listings = $request['listings'] ?? [];
        $listingsCity = $request['listings_city'] ?? [];

        $this->updateCardListingsRelations($card->id, $listings, $listingsCity);


        if(Cache::has('card'.$card->id)) Cache::forget('card'.$card->id);

        return redirect()->route('admin.cards.cards.index')->with('flash_success', 'Карточка успешна обновлена!');
    }

    public function destroy($id){

        dd('Удаление карточки временно не работает');
        $card = Cards::find($id);
        switch ($card->category_id) {
            case '1': DB::delete('delete from cards_1_zaimy where card_id=?',[$id]); break;
            case '2': DB::delete('delete from cards_2_rko where card_id=?',[$id]);break;
            case '3': DB::delete('delete from cards_3_zalogi where card_id=?',[$id]);break;
            case '4': DB::delete('delete from cards_4_credits where card_id=?',[$id]);break;
            case '5': DB::delete('delete from cards_5_credit_cards where card_id=?',[$id]);break;
            case '6': DB::delete('delete from cards_6_debit_cards where card_id=?',[$id]);break;
            case '7': DB::delete('delete from cards_7 where card_id=?',[$id]);break;
            case '8': DB::delete('delete from cards_8 where card_id=?',[$id]);break;
            //case '9': DB::delete('delete from cards_9 where card_id=?',[$id]);
            case '10': DB::delete('delete from cards_10 where card_id=?',[$id]);break;
            case '11': DB::delete('delete from cards_11 where card_id=?',[$id]);break;
        }
        DB::delete('delete from cards where id=?',[$id]);
        DB::delete('delete from cards_childrens where card_id=?',[$id]);
        DB::delete("delete from bank_product_cards where card_id=?",[$id]);

        adminLog('Карточки', $id, 'delete');
        if(Cache::has('card'.$card->id)) Cache::forget('card'.$card->id);

        return redirect()->back()->with('flash_success', 'Карточка успешна удалёна!'); 
    }




    /*****************************************************************/
    /*********************** others methods **************************/
    /*****************************************************************/

    /* ajax  */
    public function get_fields(Request $request){
        $fields = '';
        $options = '';


        $fields = $this->get_file($request['id']);
        if($fields == null) return array('fields'=>'<p class="alert alert-warning">Не задан шаблон дополнительных полей карточки для данной категории</p>','listings'=>'');

        $cardCategories = CardsCategories::find($request['id']);

        $optionsJson = $cardCategories->options_json;
        if($optionsJson != ''){
            $optionsArr = json_decode($optionsJson);
            foreach ($optionsArr as $key => $value) {
                $options = $options . "<div class=\"checkbox\"><label><input name=\"options[]\" value=\"$value->id_title\" type=\"checkbox\"> $value->label</label></div>\n";
            }
        }
        $fields = str_replace('{options}', $options, $fields);

        $fields = str_replace('{informer_scale}', '<option value="400" selected="selected">400</option><option value="600">600</option><option value="1000">1000</option>', $fields);

        $fields = str_replace('{poor_ch}', '<option value="1" selected="selected">Да</option><option value="0">Нет</option>',$fields);

        $fields = str_replace('{type_of_acquiring}', '<option selected value="0">Торговый</option><option value="1">Интернет</option><option value="2">Мобильный</option>',$fields);

        if($request['id'] == 11) {
            $fields = str_replace('{open_online}', '<option value="0" selected="selected">Нет</option><option value="1">Есть</option>',$fields);

        }

        if($request['id'] == 1 || $request['id'] == 7){

            $all_icon_after_name_arr = [
                "1" => "Без процентов",
                "2" => "С плохой КИ",
                "3" => "Круглосуточно",
                "4" => "С продлением",
                "5" => "Моментальные",
                "6" => "Погашение по частям",
                "7" => "Микрофинансовая компания",
                "8" => "Микрокредитная компания",

            ];
        } else {

            $all_icon_after_name_arr = [
                "1" => "МИР",
                "2" => "Visa",
                "3" => "MasterCard",
                "4" => "Apple Pay",
                "5" => "Samsung Pay",
                "6" => "Android Pay",
                "7" => "American Express",
                "8" => "PayPass",
                "9" => "GooglePay",
                "10" => "PayWave",
            ];
        }

        if($request['id'] == 8) {
            $all_icon_after_name_arr = [
                "1" => "Аннуитетные платежи",
                "2" => "Дифференцированные платежи",
                "3" => "По паспорту",
                "4" => "Без первоначального взноса",
                "5" => "Досрочное погашение"
            ];
        }

        if($request['id'] == 4) {
            $all_icon_after_name_arr = [
                "1" => "Наличными",
                "2" => "По паспорту",
                "3" => "Без залога",
                "4" => "Без поручителей",
                "5" => "Под залог автомобиля",
                "6" => "Под залог недвижимости",
                "7" => "Под поручительство",
                "8" => "Аннуитетные платежи",
                "9" => "Дифференцированные платежи",
            ];
        }

        if($request['id'] == 2) {
            $all_icon_after_name_arr = [
                "1" => "Зарплатный проект",
                "2" => "Корпоративные карты",
                "3" => "Торговый эквайринг",
                "4" => "Интернет-эквайринг",
                "5" => "Валютный контроль",
                "6" => "Интернет-бухгалтерия",
                "7" => "Гарантии",
                "8" => "Регистрация бизнеса",
                "9" => "Рекомендовано для ИП",
                "10" => "Рекомендовано для ООО",
            ];
        }


        $icon_after_name = '';
        foreach ($all_icon_after_name_arr as $key => $value) {
                $icon_after_name .= "<div class=\"checkbox width-33\"><label><input name=\"icon_after_name[]\" value=\"$key\" type=\"checkbox\" > $value</label></div>";
        }
        $fields = str_replace('{icon_after_name}', $icon_after_name, $fields);


        $fields = preg_replace('/{[\w]{1,}}/', '', $fields);

        $res ['fields'] = $fields;

        $cardsChildrenPages = CardsChildrenPages::where(['cards_category_id'=>$request['id']])->get();

        $res ['listings'] = '';

        if($request['id'] == 1){
            foreach ($cardsChildrenPages as $key => $value){
                if($value->city_id != 0) unset($cardsChildrenPages[$key]);
            }
            $res ['listings'] .=   "<div class=\"checkbox width-50\"><label><input name=\"listings[]\" value=\"cities_zaimy\" type=\"checkbox\"> ВСЕ ГОРОДА</label></div>";

        }


        $tmpArr = System::convertToArray($cardsChildrenPages,'number_in_exel');
        sort($tmpArr);

        $cardsChildrenPagesArr = [];
        foreach ($tmpArr as $key => $value) {
            foreach ($cardsChildrenPages as $key2 => $value2) {
                if($value == $value2->number_in_exel){
                    $cardsChildrenPagesArr[$value2->id] = $value2->number_in_exel. '. ' . $value2->h1;
                }
            }
        }


        foreach ($cardsChildrenPagesArr as $key => $value) {
            $res ['listings'] .=   "<div class=\"checkbox width-50\"><label><input name=\"listings[]\" value=\"$key\" type=\"checkbox\"> $value</label></div>";
        }

        $scaleNames = ProductScaleNames::getScalesByCategoryID($request['id']);
        $res['scales'] = $scaleNames;
        return $res;
    }



    public function get_file($id){
        $path = str_replace('/app', '', app_path()) . '/resources/views/admin/cards/cards/fields/';
            switch ($id) {
                case '1': return file_get_contents($path.'zaimy.blade.php');
                case '2': return file_get_contents($path.'rko.blade.php');
                case '3': return file_get_contents($path.'zalogi.blade.php');
                case '4': return file_get_contents($path.'credits.blade.php');
                case '5': return file_get_contents($path.'credit-cards.blade.php');
                case '6': return file_get_contents($path.'debit-cards.blade.php');
                case '7': return file_get_contents($path.'zaimy-dolgosrochnye.blade.php');
                case '8': return file_get_contents($path.'auto-credits.blade.php');
                case '10': return file_get_contents($path.'ipoteki.blade.php');
                case '11': return file_get_contents($path.'vkladi.blade.php');
                case '12': return file_get_contents($path.'ekvajring.blade.php');
                default: return null;
            }

        return null;
    }


    public function actions($request,$card_id, $action = 'create'){
        switch ($request['category_id']) {
            case '1': return CardsZaimy::go($request,$card_id,$action);
            case '2': return CardsRKO::go($request,$card_id,$action);
            case '3': return CardsZalogi::go($request,$card_id,$action);
            case '4': return CardsCredits::go($request,$card_id,$action);
            case '5': return CardsCreditsCards::go($request,$card_id,$action);
            case '6': return CardsDebitsCards::go($request,$card_id,$action);
            case '7': return Card7::go($request,$card_id,$action);
            case '8': return Card8::go($request,$card_id,$action);
            case '10': return Card10::go($request,$card_id,$action);
            case '11': return Card11::go($request,$card_id,$action);
            case '12': return Card12::go($request,$card_id,$action);

            default:
                return null;
        }  
    }

    public function parse_fields($code,$card){
        switch ($card->category_id) {
            case '1': return CardsZaimy::parse_fields($code,$card);
            case '2': return CardsRKO::parse_fields($code,$card);
            case '3': return CardsZalogi::parse_fields($code,$card);
            case '4': return CardsCredits::parse_fields($code,$card);
            case '5': return CardsCreditsCards::parse_fields($code,$card);
            case '6': return CardsDebitsCards::parse_fields($code,$card);
            case '7': return Card7::parse_fields($code,$card);
            case '8': return Card8::parse_fields($code,$card);
            case '10': return Card10::parse_fields($code,$card);
            case '11': return Card11::parse_fields($code,$card);
            case '12': return Card12::parse_fields($code,$card);

            default: return null;
        }  
        return null;
    }

    private function updateCardListingsRelations(int $cardId, array $allListings, array $listingsCity)
    {
        if (!$cardId) return;

        foreach ($allListings as $listing) {
            foreach ($listingsCity as $listingCity) {
                $allListings[] = $listing . '/' . $listingCity;
            }
        }

        $allListings = array_merge($allListings, $listingsCity);

        // отвязка листингов
        ListingCards::where('card_id', $cardId)->delete();
        CardsChildren::where('card_id', $cardId)->delete();

        // привязка листингов
        foreach (array_chunk($allListings, self::LISTINGS_RELATION_CHUNK_SIZE) as $listings) {
            $listingsUrls = DB::table('urls')
                ->where(function ($query) {
                    $query->where('section_type', self::NEW_LISTING_URL_SECTION_TYPE)
                        ->orWhere('section_type', self::OLD_LISTING_URL_SECTION_TYPE);
                })
                ->whereIn('url', $listings)
                ->get();

            $listingsCards = $listingsUrls->where('section_type', self::NEW_LISTING_URL_SECTION_TYPE)
                ->map(function ($listingsUrl) use ($cardId) {
                    return ['listing_id' => $listingsUrl->section_id, 'card_id' => $cardId];
                })
                ->toArray();

            ListingCards::insert($listingsCards);
//            $new = $new->merge($listingsCards);

            $cardsChildren = $listingsUrls->where('section_type', self::OLD_LISTING_URL_SECTION_TYPE)
                ->map(function ($listingsUrl) use ($cardId) {
                    return ['children_id' => $listingsUrl->section_id, 'card_id' => $cardId];
                })
                ->toArray();

//            $old = $old->merge($listingsCards);
            CardsChildren::insert($cardsChildren);
        }
    }

    private function checkListingsRelations(int $cardId, array $allListings, array $listingsCity)
    {
        foreach ($allListings as $listing) {
            foreach ($listingsCity as $listingCity) {
                $allListings[] = $listing . '/' . $listingCity;
            }
        }

        $allListings = array_merge($allListings, $listingsCity);

        $listingsUrls = DB::table('urls')
            ->where(function ($query) {
                $query->where('section_type', self::NEW_LISTING_URL_SECTION_TYPE)
                    ->orWhere('section_type', self::OLD_LISTING_URL_SECTION_TYPE);
            })
            ->whereIn('url', $allListings)
            ->get();

        $cards = DB::table('cards')
            ->where('category_id', 1)
            ->pluck('id')
            ->toArray();

        $selectedOldListings = DB::table('cards_childrens')
            ->select('children_id')
            ->whereIn('card_id', $cards)
            ->groupBy('children_id')
            ->pluck('children_id')
            ->toArray();

        $selectedNewListings = DB::table('listing_cards')
            ->select('listing_id')
            ->whereIn('card_id', $cards)
            ->groupBy('listing_id')
            ->pluck('listing_id')
            ->toArray();


        $listingsOld = DB::table('cards_children_pages')
            ->leftJoin('urls', 'urls.section_id', 'cards_children_pages.id')
            ->select('cards_children_pages.h1', 'urls.url', 'cards_children_pages.id')
            ->whereIn('cards_children_pages.id', $selectedOldListings)
            ->where('cards_children_pages.cards_category_id', 1)
            ->where('cards_children_pages.city_id', '<=', 0)
            ->where(['urls.section_type' => 3])
            ->get()
            ->mapWithKeys(function ($listing) {
                $listing->table_type = 'old';
                return [$listing->url => $listing];
            });

        $listings = DB::table('listings')
            ->leftJoin('urls', 'urls.section_id', 'listings.id')
            ->select('listings.h1', 'urls.url')
            ->whereIn('listings.id', $selectedNewListings)
            ->where('listings.category_id', 1)
            ->where('listings.city_id', '<=', 0)
            ->where(['urls.section_type' => 15])
            ->get()
            ->mapWithKeys(function ($listing) {
                $listing->table_type = 'new';
                return [$listing->url => $listing];
            });

        $listings = $listings->merge($listingsOld);


        $notExistsListings = $listings->whereNotIn('url', $listingsUrls->pluck('url')->toArray());

        dd($notExistsListings);
        echo json_encode($notExistsListings);

        dd('this');

    }
}
