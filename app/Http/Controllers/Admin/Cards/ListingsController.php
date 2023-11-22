<?php

namespace App\Http\Controllers\Admin\Cards;

use App\Models\Cards\Listing;
use Illuminate\Http\Request;
use App\Repositories\Admin\Cards\ListingRepository;
use App\Repositories\Admin\Cards\CardsCategoriesRepository;
use App\Repositories\Admin\Cities\CityRepository;
use App\Http\Requests\Admin\Cards\ListingRequest;
use Config;
use DB;
use Cache;

class ListingsController extends BaseCardsController
{
    private const min_average_rating = 4.0;
    private const max_average_rating = 5.0;

    private const min_number_of_votes = 15;
    private const max_number_of_votes = 25;

    private $listing_repository;

    private $cards_categories_repository;

    private $city_repository;


    public function __construct()
    {
        $this->listing_repository = app(ListingRepository::class);
        $this->cards_categories_repository = app(CardsCategoriesRepository::class);
        $this->city_repository = app(CityRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cat_id = (int) $request->category_id ?? null;
        $items = $this->listing_repository->getForShow($cat_id);
        $categories = $this->cards_categories_repository->getForSelect();

        $breadcrumbs = [
//            ['h1' => 'Карточки', 'link' => route('admin.cards.cards.index')],
            ['h1' => 'Категории', 'link' => route('admin.cards.categories.index')],
            ['h1' => 'Список листингов']
        ];

        return view('admin.cards.listings.index', compact('items','categories','breadcrumbs'),['selected_category'=>$cat_id]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function searchById(Request $request)
    {
        $id = (int) $request->id;
        $cat_id = null;
        $items = $this->listing_repository->getForShowById($id);
        $categories = $this->cards_categories_repository->getForSelect();

        $breadcrumbs = [
//            ['h1' => 'Карточки', 'link' => route('admin.cards.cards.index')],
            ['h1' => 'Категории', 'link' => route('admin.cards.categories.index')],
            ['h1' => 'Список листингов']
        ];

        return view('admin.cards.listings.index', compact('items','categories', 'breadcrumbs'),['selected_category'=>$cat_id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->cards_categories_repository->getForSelect();
        $cities = $this->city_repository->getForSelect('with_empty_row');

        $breadcrumbs = [
//            ['h1' => 'Карточки', 'link' => route('admin.cards.cards.index')],
            ['h1' => 'Категории', 'link' => route('admin.cards.categories.index')],
            ['h1' => 'Список листингов', 'link' => route('admin.cards.listings.index')],
            ['h1' => 'Создание']
        ];

        return view('admin.cards.listings.create', compact('categories','cities', 'breadcrumbs'));

    }

    public function store(ListingRequest $request)
    {
        $data = $request->all();

        $data['average_rating'] = (self::min_average_rating + (self::max_average_rating - self::min_average_rating) * (mt_rand() / mt_getrandmax()));
        $data['number_of_votes'] = rand(self::min_number_of_votes, self::max_number_of_votes);
        $data = empty_str_to_null($data);

        $item = new Listing($data);

        $result = $item->save();

        adminLog('Листинги', $item->id, 'create');

        if (Cache::has('listings_for_html_sitemap' . $item->category_id)) {
            Cache::forget('listings_for_html_sitemap' . $item->category_id);
        }

        if ($result) {

//            Url::pushLink($request->input('url'), $item->id, $this->page_type);

            return redirect()
                ->route('admin.cards.listings.index')
                ->with('flash_success', 'Листинг создан!');
        } else {
            return redirect()
                ->route('admin.cards.listings.index')
                ->with('flash_errors', 'Ошибка создания!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = $this->listing_repository->findOrFail($id);

        $categories = $this->cards_categories_repository->getForSelect();
        $cities = $this->city_repository->getForSelect('with_empty_row');

        $breadcrumbs = [
//            ['h1' => 'Карточки', 'link' => route('admin.cards.cards.index')],
            ['h1' => 'Категории', 'link' => route('admin.cards.categories.index')],
            ['h1' => 'Список листингов', 'link' => route('admin.cards.listings.index')],
            ['h1' => 'Редактирование']
        ];

        return view('admin.cards.listings.edit', compact('item','categories', 'cities', 'breadcrumbs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ListingRequest $request, $id)
    {
        $item = $this->listing_repository->findOrFail($id);

        $data = $request->all();
        $data = empty_str_to_null($data);

        $result = $item->update($data);

        adminLog('Листинги', $item->id, 'update');


        if ($result) {

            if (Cache::has('listings_for_html_sitemap' . $item->category_id)) {
                Cache::forget('listings_for_html_sitemap' . $item->category_id);
            }

//            Url::updateLink($request->input('url'), $item->id, $this->page_type);

            return redirect()
                ->route('admin.cards.listings.index')
                ->with('flash_success', 'Листинг обновлен!');
        } else {
            return redirect()
                ->route('admin.cards.listings.index')
                ->with('flash_errors', 'Ошибка редактирования!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Listing::findOrFail($id);

        if (Cache::has('listings_for_html_sitemap' . $item->category_id)) {
            Cache::forget('listings_for_html_sitemap' . $item->category_id);
        }

        // удалять привязки
//        DB::delete("delete from urls where section_id=? and section_type=?", [$id, $this->page_type]);
//        DB::delete("delete from listing_cards where listing_id=?", [$id]);

        $result = $item->delete();
        adminLog('Листинги', $id, 'delete');

        if ($result) {
            return redirect()
                ->route('admin.cards.listings.index')
                ->with('flash_success', 'Листинг удален!');
        } else {
            return redirect()
                ->route('admin.cards.listings.index')
                ->with('flash_errors', 'Ошибка удаления!');
        }
    }
}
