<?php

namespace App\Http\Controllers\Admin\Banks;

use App\Models\Banks\BankProduct;
use App\Models\Banks\BankProductCard;
use App\Models\Banks\BankCategoryPage;
use App\Repositories\Admin\Banks\BankRepository;
use App\Repositories\Admin\Banks\BankProductRepository;
use App\Repositories\Admin\Banks\BankCategoryPageRepository;
use App\Repositories\Admin\Banks\BankProductReviewsPageRepository;
use App\Http\Requests\Admin\Banks\BankProductRequest;
use App\Algorithms\General\Banks\ProductScaleNames;
use DB;
use App\Models\Cards\Cards;
use App\Algorithms\General\Cards\CardCategory;

class BankProductsController extends BaseBankController
{
    private const MIN_AVERAGE_RATING = 4.0;
    private const MAX_AVERAGE_RATING = 5.0;

    private const MIN_NUMBER_OF_VOTES = 15;
    private const MAX_NUMBER_OF_VOTES = 25;


    private $bank_product_repository;
    private $bank_category_page_repository;
    private $bank_repository;


    public function __construct()
    {
        parent::__construct();

        $this->bank_product_repository = app(BankProductRepository::class);
        $this->bank_category_page_repository = app(BankCategoryPageRepository::class);
        $this->bank_repository = app(BankRepository::class);
    }


    public function all()
    {
        $items = $this->bank_product_repository->getForShow();

        $breadcrumbs = [
            ['h1' => 'Банки', 'link' => route('admin.banks.banks.index')],
            ['h1' => 'Все продуктовые страницы']
        ];

        return view('admin.banks.products.all', compact('items', 'breadcrumbs'));
    }

    /**
     * Display a listing of the resource.
     *
     * @param int $bankID
     * @param int $categoryID
     * @return \Illuminate\Http\Response
     */
    public function index($bankID, $categoryID)
    {
        $items = $this->bank_product_repository->getForShow($bankID, $categoryID);

        $breadcrumbs = [
            ['h1' => 'Банки', 'link' => route('admin.banks.banks.index')],
            ['h1' => 'Редактирование', 'link' => route('admin.banks.banks.edit', $bankID)],
            ['h1' => 'Категорийные страницы', 'link' => route('admin.banks.categories.index', $bankID)],
            ['h1' => 'Редактирование', 'link' => route('admin.banks.categories.edit', [$bankID, $categoryID])],
            ['h1' => 'Продукты']
        ];

        return view('admin.banks.products.index', compact('items','bankID','categoryID', 'breadcrumbs'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @param int $bankID
     * @param int $categoryID
     * @return \Illuminate\Http\Response
     */
    public function create($bankID, $categoryID)
    {
        $cardsList = Cards::all();
        $cardsCategories = CardCategory::getCategoriesName();
        foreach ($cardsList as $k => $card) {
            if (isset($cardsCategories[$card->category_id])) {
                $cardsList[$k]->title .= ' (' . $cardsCategories[$card->category_id] . ')';
                $scalesName = ProductScaleNames::getScalesByCategoryID($cardsCategories[$card->category_id]);
            }
        }
        $cards = $cardsList->pluck('title', 'id');

        $scalesName = [];
        $bankCategoryPage = BankCategoryPage::find($categoryID);
        if ($bankCategoryPage != null) {
            $scalesName = ProductScaleNames::getScalesByCategoryID($bankCategoryPage->category_id);
        }

        $breadcrumbs = [
            ['h1' => 'Банки', 'link' => route('admin.banks.banks.index')],
            ['h1' => 'Редактирование', 'link' => route('admin.banks.banks.edit', $bankID)],
            ['h1' => 'Категорийные страницы', 'link' => route('admin.banks.categories.index', $bankID)],
            ['h1' => 'Редактирование', 'link' => route('admin.banks.categories.edit', [$bankID, $categoryID])],
            ['h1' => 'Продукты', 'link' => route('admin.banks.products.index', [$bankID, $categoryID])],
            ['h1' => 'Создание']
        ];


        return view('admin.banks.products.create', compact('bankID','categoryID','cards', 'scalesName', 'breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param int $bankID
     * @param int $categoryID
     * @param  \App\Http\Requests\admin\Banks\BankProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store($bankID, $categoryID, BankProductRequest $request)
    {
        $data = $request->all();
        $data['bank_id'] = (int) $bankID;
        $data['bank_category_id'] = (int) $categoryID;
        $data['average_rating'] = (self::MIN_AVERAGE_RATING + (self::MAX_AVERAGE_RATING - self::MIN_AVERAGE_RATING) * (mt_rand() / mt_getrandmax()));
        $data['number_of_votes'] = rand(self::MIN_NUMBER_OF_VOTES, self::MAX_NUMBER_OF_VOTES);
        $data = empty_str_to_null($data);

        $item = new BankProduct($data);

        $result = $item->save();

        if (is_array($request['cards'])) {
            foreach ($request['cards'] as $cardID) {
                $cardModel = new BankProductCard([
                    'bank_product_id' => $item->id,
                    'card_id' => $cardID
                ]);
                $cardModel->save();
            }
        }

        adminLog('Продукты банков', $item->id, 'create');


        if ($result) {
            return redirect()
                ->route('admin.banks.products.index', [$bankID, $categoryID])
                ->with('flash_success', 'Продукт банка создан!');
        } else {
            return redirect()
                ->route('admin.banks.products.index', [$bankID, $categoryID])
                ->with('flash_errors', 'Ошибка создания!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $bankID
     * @param int $categoryID
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($bankID, $categoryID,  $id)
    {
        $item = $this->bank_product_repository->findOrFail($id);

        $cardsList = Cards::all();
        $cardsCategories = CardCategory::getCategoriesName();
        foreach ($cardsList as $k => $card) {
            if (isset($cardsCategories[$card->category_id])) {
                $cardsList[$k]->title .= ' (' . $cardsCategories[$card->category_id] . ')';
            }
        }

        $cards = $cardsList->pluck('title', 'id');

        $current_cards = BankProductCard::where(['bank_product_id' => $id])
            ->get()
            ->pluck('card_id')
            ->toArray();
        $reviewsRepository = app(BankProductReviewsPageRepository::class);
        $reviewsPage = $reviewsRepository->findByParentPageID($id);
        $productAlias = $item->alias;
        $bank = $this->bank_repository->findOrFail($bankID);
        $bankAlias =  $bank->alias;

        $get_cat = $this->bank_category_page_repository->findOrFail($categoryID);
        $category = DB::table('cards_categories')->where(['id' => $get_cat->category_id])->first(); // !!!!! переписать
        $categoryAlias = $category->bank_alias;

        $scalesName = [];
        $bankCategoryPage = BankCategoryPage::find($categoryID);
        if ($bankCategoryPage != null) {
            $scalesName = ProductScaleNames::getScalesByCategoryID($bankCategoryPage->category_id);
        }

        $breadcrumbs = [
            ['h1' => 'Банки', 'link' => route('admin.banks.banks.index')],
            ['h1' => 'Редактирование', 'link' => route('admin.banks.banks.edit', $bankID)],
            ['h1' => 'Категорийные страницы', 'link' => route('admin.banks.categories.index', $bankID)],
            ['h1' => 'Редактирование', 'link' => route('admin.banks.categories.edit', [$bankID, $categoryID])],
            ['h1' => 'Продукты', 'link' => route('admin.banks.products.index', [$bankID, $categoryID])],
            ['h1' => 'Редактирование']
        ];

        return view('admin.banks.products.edit', compact('categoryAlias','productAlias','bankAlias','item', 'bankID','categoryID','cards','current_cards','reviewsPage', 'scalesName', 'breadcrumbs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $bankID
     * @param int $categoryID
     * @param  \App\Http\Requests\admin\Banks\BankProductRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($bankID, $categoryID, BankProductRequest $request, $id)
    {
        $item = $this->bank_product_repository->findOrFail($id);


        $data = $request->all();
        $data['bank_id'] = (int) $bankID;
        $data['bank_category_id'] = (int) $categoryID;
        $data = empty_str_to_null($data);

        $result = $item->update($data);

        adminLog('Продукты банков', $id, 'update');

        if (is_array($request['cards'])) {

            DB::delete("delete from bank_product_cards where bank_product_id=?", [$item->id]);

            foreach ($request['cards'] as $cardID) {
                $cardModel = new BankProductCard([
                    'bank_product_id' => $item->id,
                    'card_id' => $cardID
                ]);
                $cardModel->save();
            }
        } elseif ($request['cards'] == null) {
            DB::delete("delete from bank_product_cards where bank_product_id=?", [$item->id]);
        }

        if ($result) {
            return redirect()
                ->route('admin.banks.products.index', [$bankID, $categoryID])
                ->with('flash_success', 'Продукт банка обновлен!');
        } else {
            return redirect()
                ->route('admin.banks.products.index', [$bankID, $categoryID])
                ->with('flash_errors', 'Ошибка редактирования!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $bankID
     * @param int $categoryID
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($bankID, $categoryID, $id)
    {
        $item = BankProduct::findOrFail($id);

        $result = $item->delete();

        adminLog('Продукты банков', $id, 'delete');

        if ($result) {
            DB::delete("delete from bank_product_cards where bank_product_id=?", [$id]);

            return redirect()
                ->route('admin.banks.products.index', [$bankID, $categoryID])
                ->with('flash_success', 'Продукт банка удален!');
        } else {
            return redirect()
                ->route('admin.banks.products..index', [$bankID, $categoryID])
                ->with('flash_errors', 'Ошибка удаления!');
        }
    }
}
