<?php

namespace App\Http\Controllers\Admin\Cards;

use Illuminate\Http\Request;
use App\Models\Cards\CardsCategories;
use App\Algorithms\System;
use Validator;
use Cache;
use Auth;
use Log;
use DB;

use App\Repositories\Admin\Cards\CardsRepository;
use App\Repositories\Admin\Cards\ListingCardsRepository;
use App\Models\Cards\ListingCards;

class CardsCategoriesController extends BaseCardsController
{

    public function index()
    {
        $cardsCategories = CardsCategories::all();

        $breadcrumbs = [
//            ['h1' => 'Карточки', 'link' => route('admin.cards.cards.index')],
            ['h1' => 'Категории']
        ];

        return view('admin.cards.categories.index',[
    		'cardsCategories' => $cardsCategories,
            'breadcrumbs' => $breadcrumbs
    	]);
    }

    public function create()
    {
        $breadcrumbs = [
//            ['h1' => 'Карточки', 'link' => route('admin.cards.cards.index')],
//            ['h1' => 'Категории', 'link' => route('admin.cards.categories.index')],
            ['h1' => 'Создание']
        ];

        return view('admin.cards.categories.create', compact('breadcrumbs'));
    }


	public function create_save(Request $request)
    {
        $cardsCategories = new CardsCategories();

        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'h1' => 'required',
                'alias' => 'required|unique:cards_categories',
                'img' => 'required',
            ],
            [
                'title.required' => '"Title" обязательное поле',
                'h1.required' => '"H1" обязательное поле',
                'alias.required' => '"Постоянная ссылка" обязательное поле',
                'img.required' => '"Изображение" обязательное поле',
                'alias.unique' => 'Категория с такой ссылкой уже существует',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $cardsCategories->title = $request['title'];
        $cardsCategories->h1 = $request['h1'];
        $url = System::stripUrl($request['alias']);
        if($url == '') $url = '/';
        $cardsCategories->alias = $url;
        $cardsCategories->img = $request['img'];
        $cardsCategories->infographic = (empty($request['infographic'])) ? '' :  $request['infographic'];
        $cardsCategories->breadcrumb = (empty($request['breadcrumb'])) ? '' :  $request['breadcrumb'];
        $cardsCategories->text_before = (empty($request['text_before'])) ? '' :  $request['text_before'];
        $cardsCategories->text_after = (empty($request['text_after'])) ? '' :  $request['text_after'];
        $cardsCategories->city = $request['city'];
        $cardsCategories->card_categories = (empty($request['card_categories'])) ? null :  $request['card_categories'];
        $cardsCategories->og_img = (empty($request['og_img'])) ? null :  $request['og_img'];
        $cardsCategories->h2 = (empty($request['h2'])) ? null :  $request['h2'];
        $cardsCategories->meta_description = (empty($request['meta_description'])) ? '' : $request['meta_description'];
        $cardsCategories->icon_for_sidebar = (empty($request['icon_for_sidebar'])) ? '' : $request['icon_for_sidebar'];
        $cardsCategories->icon_for_sidebar = $request['icon_for_sidebar'] ?? null;
        $cardsCategories->links_for_sidebar = $request['links_for_sidebar'] ?? null;
        $cardsCategories->popular_banks = $request['popular_banks'] ?? null;

        $cardsCategories->save();

        $category_id = $cardsCategories->id;

        adminLog('Категория карточек', $cardsCategories->id, 'create');

        Log::info("Администратор c ID ". Auth::id() . " создал новую категорию карточек '$cardsCategories->h1'");

        DB::insert("insert into urls (url, section_id, section_type) values (?, ?, ?)", [$url, $category_id, 2]);

        /*
        if((int)$request['city']==1){
            if($url == '/') $url ='';  else $url = $url .'/'; 
            DB::insert("insert into urls (url, section_id, section_type) values (?, ?, ?)", [$url.'/ciry', $category_id, 9]);
        }
        */

        if(Cache::has('cards_categories')) Cache::forget('cards_categories');

        return redirect()->route('admin.cards.categories.index')
            ->with('flash_success', 'Категория успешна создана!');
      
    }


    public function edit($id)
    {
    	$cardsCategories = CardsCategories::find($id);
    	if($cardsCategories == null){
            // logs !!!!!
            return redirect()->route('admin.cards.categories.index')
                ->withErrors(['Попытка отредактировать категорию карточек с несуществующей ID = '.$id]);
        }

        $breadcrumbs = [
//            ['h1' => 'Карточки', 'link' => route('admin.cards.cards.index')],
//            ['h1' => 'Категории', 'link' => route('admin.cards.categories.index')],
            ['h1' => 'Редактирование']
        ];

        return view('admin.cards.categories.edit', [
            'cardsCategories' => $cardsCategories,
            'breadcrumbs' => $breadcrumbs
        ]);
    }


    public function edit_save(Request $request)
    {
    	$cardsCategories = CardsCategories::find($request["id"]);

        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'h1' => 'required',
                'alias' => 'required',
                'img' => 'required',
            ],
            [
                'title.required' => '"Title" обязательное поле',
                'h1.required' => '"H1" обязательное поле',
                'alias.required' => '"Постоянная ссылка" обязательное поле',
                'img.required' => '"Изображение" обязательное поле',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $cardsCategories->title = $request['title'];
        $cardsCategories->h1 = $request['h1'];
        $old_url = $cardsCategories->alias;
        $url = System::stripUrl($request['alias']);
        if($url == '') $url = '/';
        $cardsCategories->alias = $url;
        $cardsCategories->img = $request['img'];
        $cardsCategories->infographic = (empty($request['infographic'])) ? '' :  $request['infographic'];
        $cardsCategories->breadcrumb = (empty($request['breadcrumb'])) ? '' :  $request['breadcrumb'];
        $cardsCategories->meta_description = (empty($request['meta_description'])) ? '' : $request['meta_description'];
        $cardsCategories->text_before = (empty($request['text_before'])) ? '' :  $request['text_before'];
        $cardsCategories->text_after = (empty($request['text_after'])) ? '' :  $request['text_after'];
        $cardsCategories->h2 = (empty($request['h2'])) ? null :  $request['h2'];

        $cardsCategories->card_categories = (empty($request['card_categories'])) ? null :  $request['card_categories'];
        $cardsCategories->og_img = (empty($request['og_img'])) ? null :  $request['og_img'];
        $cardsCategories->city = $request['city'];
        $cardsCategories->icon_for_sidebar = $request['icon_for_sidebar'] ?? null;
        $cardsCategories->links_for_sidebar = $request['links_for_sidebar'] ?? null;
        $cardsCategories->popular_banks = $request['popular_banks'] ?? null;
        
        $cardsCategories->save();

        adminLog('Категория карточек', $cardsCategories->id, 'update');

        Log::info("Администратор c ID ". Auth::id() . " изменил категорию карточек '$cardsCategories->h1'");

        if(Cache::has('cards_categories')) Cache::forget('cards_categories');
        if(Cache::has('cards_categories'.$cardsCategories->id)) Cache::forget('cards_categories'.$cardsCategories->id);

        //DB::update("update urls set url=? where section_id=? and section_type=?",[$url,$request['id'],2]);
        // менять url дочерних листингов , а также в странах оргнизциях и сами организация

        /*
        if($old_city != $request['city']){
            if((int)$request['city']==0){
                DB::delete("delete from urls where section_type=9 and section_id=?",[$cardsCategories->id]);
            } else {
                if($url == '/') $url =''; else $url = $url .'/'; 
                DB::insert("insert into urls (url, section_id, section_type) values (?, ?, ?)", [$url.'city', $cardsCategories->id, 9]);
                //dd($url);
            }
        } elseif(($old_url != $url) && ((int)$old_city == 1)){
            if($url == '/') $url ='';
            DB::update("update urls set url=? where section_id=? and section_type=?",[$url.'city',$cardsCategories->id,9]);
        }
        */

        return redirect()->route('admin.cards.categories.index')->with('flash_success', 'Категория успешна обновлена!');
    }


    public function destroy($id)
    {
        $cardsCategories = CardsCategories::find($id);
        DB::delete("delete from cards_categories where id=?",[$id]);
        DB::delete("delete from urls where section_id=? and section_type=?",[$id,2]);
        adminLog('Категория карточек', $id, 'delete');
        Log::alert("Администратор c ID ". Auth::id() . " удалил категорию карточек '$cardsCategories->h1'");
        // может стоит сделать удаление карточек и страниц-фильтров
        return redirect()->back()->with('flash_success', 'Категория успешно удалёна!');  
    }





    public function filter_edit($id)
    {
        $cardsCategories = CardsCategories::find($id);
        if($cardsCategories == null){
            return redirect()
                ->route('admin.cards.categories.index')
                ->withErrors(['Попытка отредактировать категорию карточек с несуществующей ID = '.$id]);
        }
        if($cardsCategories->filters_json  == null){
            $filters_json = [];
        } else {
            $filters_json = json_decode($cardsCategories->filters_json);
        }

        $breadcrumbs = [
            ['h1' => 'Карточки', 'link' => route('admin.cards.cards.index')],
            ['h1' => 'Категории', 'link' => route('admin.cards.categories.index')],
            ['h1' => 'Редактирование', 'link' => route('admin.cards.categories.edit', $id)],
            ['h1' => 'Фильтры']
        ];

        return view('admin.cards.categories.filters',[
            'id' => $cardsCategories->id,
            'filters' => $filters_json,
            'breadcrumbs' => $breadcrumbs
            ]);
    }

    public function filter_save(Request $request)
    {
        $cardsCategories = CardsCategories::find($request['id']);
        $cardsCategories->filters_json = $request['filters_json'];
        $cardsCategories->save();

        Log::info("Администратор c ID ". Auth::id() . " изменил фильтры для категории карточек '$cardsCategories->h1'");

        if(Cache::has('cards_categories')) Cache::forget('cards_categories');
        if(Cache::has('cards_categories'.$cardsCategories->id)) Cache::forget('cards_categories'.$cardsCategories->id);

        return redirect()
            ->route('admin.cards.categories.index')
            ->with('flash_success', 'Фильтры успешно обновлены!');
    }


    public function options_edit($id)
    {
        $cardsCategories = CardsCategories::find($id);
        if($cardsCategories == null){
            return redirect()
                ->route('admin.cards.categories.index')
                ->withErrors(['Попытка отредактировать категорию карточек с несуществующей ID = '.$id]);
        }
        if($cardsCategories->options_json  == null){
            $options_json = [];
        } else {
            $options_json = json_decode($cardsCategories->options_json);
        }

        $breadcrumbs = [
            ['h1' => 'Карточки', 'link' => route('admin.cards.cards.index')],
            ['h1' => 'Категории', 'link' => route('admin.cards.categories.index')],
            ['h1' => 'Редактирование', 'link' => route('admin.cards.categories.edit', $id)],
            ['h1' => 'Опции']
        ];

        return view('admin.cards.categories.options',[
            'id' => $cardsCategories->id,
            'options' => $options_json,
            'breadcrumbs' => $breadcrumbs
            ]);
    }


    public function options_save(Request $request){
        $cardsCategories = CardsCategories::find($request['id']);
        $cardsCategories->options_json = $request['options_json'];
        $cardsCategories->save();

        Log::info("Администратор c ID ". Auth::id() . " изменил опции для категории карточек '$cardsCategories->h1'");

        if(Cache::has('cards_categories')) Cache::forget('cards_categories');
        if(Cache::has('cards_categories'.$cardsCategories->id)) Cache::forget('cards_categories'.$cardsCategories->id);

        return redirect()
            ->route('admin.cards.categories.index')
            ->with('flash_success', 'Опции успешно обновлены!');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $category_id
     * @param  CardsRepository  $card_repository
     * @param  BookmakerListingCardsRepository  $listing_card_repository
     * @return \Illuminate\Http\Response
     */
    public function index_listings(
        $category_id,
        CardsRepository $cards_repository,
        ListingCardsRepository $listing_cards_repository
    )
    {
        $cards = $cards_repository->getForCheckboxByCategories($category_id);
        $selected_cards = $listing_cards_repository->getForCheckboxes('-'.$category_id);

        $breadcrumbs = [
            ['h1' => 'Карточки', 'link' => route('admin.cards.cards.index')],
            ['h1' => 'Категории', 'link' => route('admin.cards.categories.index')],
            ['h1' => 'Редактирование', 'link' => route('admin.cards.categories.edit', $category_id)],
            ['h1' => 'Простановка листингов']
        ];

        return view('backend.cards.listings.categories',compact('category_id', 'cards','selected_cards','breadcrumbs'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $category_id
     * @return \Illuminate\Http\Response
     */
    public function index_listings_save($category_id, Request $request)
    {
        ListingCards::where(['listing_id' => '-'.$category_id])->delete();

        if ($request['listings'] != null) {

            foreach ($request['listings'] as $card_id) {

                $data = [
                    'card_id' => $card_id,
                    'listing_id' => '-'.$category_id
                ];

                $item = new ListingCards($data);

                $item->save();

            }
        }

        return redirect()
            ->back()
            ->with('flash_success', 'Привязка карточек к главной странице категории обновлена!');
    }
}
