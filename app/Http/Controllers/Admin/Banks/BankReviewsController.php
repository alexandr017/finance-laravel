<?php

namespace App\Http\Controllers\Admin\Banks;

use Illuminate\Http\Request;
use App\Models\Banks\BankReview;
use App\Models\Banks\BankCategoryPage;
use App\Models\Banks\BankProduct;
use App\Repositories\Admin\Banks\BankRepository;
use App\Repositories\Admin\Banks\BankCategoryPageRepository;
use App\Repositories\Admin\Banks\BankReviewRepository;
use App\Repositories\Admin\Banks\BankProductRepository;
use App\Http\Requests\Admin\Banks\BankReviewStoreRequest;
use App\Http\Requests\Admin\Banks\BankReviewUpdateRequest;

class BankReviewsController extends BaseBankController
{
    private $bank_review_repository;

    private $bank_category_repository;

    private $bank_repository;

    private $bank_product_repository;


    public function __construct()
    {
        parent::__construct();

        $this->bank_review_repository = app(BankReviewRepository::class);
        $this->bank_category_repository = app(BankCategoryPageRepository::class);
        $this->bank_repository = app(BankRepository::class);
        $this->bank_product_repository = app(BankProductRepository::class);
    }

    public function all()
    {
        $items = $this->bank_review_repository->getForShowPaginated();

        $breadcrumbs = [
            ['h1' => 'Банки', 'link' => route('admin.banks.banks.index')],
            ['h1' => 'Все Отзывы']
        ];


        return view('admin.banks.reviews.all', compact('items', 'breadcrumbs'));
    }

    ////////////////////////////////////////////////////////////

    public function raw()
    {

        $items = BankReview::whereNull('deleted_at')
            ->paginate(500);

        return view('admin.banks.reviews.raw',compact('items'));
    }

    public function show($id)
    {
        $item = BankReview::find((int) $id);
        $banks = $this->bank_repository->getForSelect();

        $categories = BankCategoryPage::whereNull('deleted_at')
            ->pluck('h1','id')
            ->toArray();

        $products = BankProduct::whereNull('deleted_at')
            ->pluck('h1','id')
            ->toArray();

        $products [0] = 'Не выбрано';


        return view('admin.banks.reviews.show',compact('item','banks','categories','products'));
    }

    public function save($id, Request $r)
    {
        $item = BankReview::find((int) $id);
        $item->bank_id = (int) $r->bank_id;
        $item->bank_category_id = (int) $r->bank_category_id;
        $item->product_id = (int) $r->product_id ?? null;
        $item->save();

        return redirect('/admin/banks/reviews');
    }

    public function delete($id)
    {
        $item = BankReview::find((int) $id);
        $item->delete();
        return redirect('/admin/banks/reviews');
    }

    ////////////////////////////////////////////////////////////

    /**
     * Display a listing of the resource.
     *
     * @param int $bankID
     * @param int $categoryID
     * @return \Illuminate\Http\Response
     */
    public function index($bankID, $categoryID)
    {
        $items = $this->bank_review_repository->getForShow($bankID, $categoryID);

        $breadcrumbs = [
            ['h1' => 'Банки', 'link' => route('admin.banks.banks.index')],
            ['h1' => 'Редактирование', 'link' => route('admin.banks.banks.edit', $bankID)],
            ['h1' => 'Категорийные страницы', 'link' => route('admin.banks.categories.index', $bankID)],
            ['h1' => 'Редактирование', 'link' => route('admin.banks.categories.edit', [$bankID, $categoryID])],
            ['h1' => 'Отзывы']
        ];
        
        return view('admin.banks.reviews.index', compact('items','bankID','categoryID','breadcrumbs'));
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
        $banks = $this->bank_repository->getForSelect();

        $categories = $this->bank_category_repository->getForSelect();

        $bankID_ = null; // для того чтобы грузить все продукты,
        $categoryID_ = null; // а не только аквтиной категории банка
        $insertEmptyRow = 'with_empty_row';
        $products = $this->bank_product_repository->getForSelect($bankID_,$categoryID_,$insertEmptyRow);

        $breadcrumbs = [
            ['h1' => 'Банки', 'link' => route('admin.banks.banks.index')],
            ['h1' => 'Редактирование', 'link' => route('admin.banks.banks.edit', $bankID)],
            ['h1' => 'Категорийные страницы', 'link' => route('admin.banks.categories.index', $bankID)],
            ['h1' => 'Редактирование', 'link' => route('admin.banks.categories.edit', [$bankID, $categoryID])],
            ['h1' => 'Отзывы', 'link' => route('admin.banks.reviews.index', [$bankID, $categoryID])],
            ['h1' => 'Создание']
        ];

        return view('admin.banks.reviews.create', compact('bankID','categoryID','banks','categories','products','breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param int $bankID
     * @param int $categoryID
     * @param  \App\Http\Requests\admin\Banks\BankReviewStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store($bankID, $categoryID, BankReviewStoreRequest $request)
    {
        $data = $request->all();

        $data['review'] = preg_replace('/(?:"([^>]*)")(?!>)/', '«$1»', $data['review']);
        $data['review'] = preg_replace("/(?:'([^>]*)')(?!>)/", '«$1»', $data['review']);

        $data['rating'] = (float) $data['rating'];

        $data['pros'] = preg_replace('/(?:"([^>]*)")(?!>)/', '«$1»', $data['pros']);
        $data['pros'] = preg_replace("/(?:'([^>]*)')(?!>)/", '«$1»', $data['pros']);

        $data['minuses'] = preg_replace('/(?:"([^>]*)")(?!>)/', '«$1»', $data['minuses']);
        $data['minuses'] = preg_replace("/(?:'([^>]*)')(?!>)/", '«$1»', $data['minuses']);

        $data = empty_str_to_null($data);

        $item = new BankReview($data);

        $result = $item->save();

        adminLog('Отзывы банков', $item->id, 'create');

        if ($result) {
            return redirect()
                ->route('admin.banks.reviews.index', [$bankID, $categoryID])
                ->with('flash_success', 'Отзыв банка создан!');
        } else {
            return redirect()
                ->route('admin.banks.reviews.index', [$bankID, $categoryID])
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
        $item = $this->bank_review_repository->findOrFail($id);

        $banks = $this->bank_repository->getForSelect();

        $categories = $this->bank_category_repository->getForSelect();

        $bankID_ = null; // для того чтобы грузить все продукты,
        $categoryID_ = null; // а не только аквтиной категории банка
        $insertEmptyRow = 'with_empty_row';
        $products = $this->bank_product_repository->getForSelect($bankID_,$categoryID_,$insertEmptyRow);

        $breadcrumbs = [
            ['h1' => 'Банки', 'link' => route('admin.banks.banks.index')],
            ['h1' => 'Редактирование', 'link' => route('admin.banks.banks.edit', $bankID)],
            ['h1' => 'Категорийные страницы', 'link' => route('admin.banks.categories.index', $bankID)],
            ['h1' => 'Редактирование', 'link' => route('admin.banks.categories.edit', [$bankID, $categoryID])],
            ['h1' => 'Отзывы', 'link' => route('admin.banks.reviews.index', [$bankID, $categoryID])],
            ['h1' => 'Редактирование']
        ];


        return view('admin.banks.reviews.edit', compact('item', 'banks','categories','products','bankID', 'categoryID', 'breadcrumbs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $bankID
     * @param int $categoryID
     * @param  \App\Http\Requests\admin\Banks\BankReviewUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($bankID, $categoryID, BankReviewUpdateRequest $request, $id)
    {
        $item = $this->bank_review_repository->findOrFail($id);

        $data = $request->all();

        $data['review'] = preg_replace('/(?:"([^>]*)")(?!>)/', '«$1»', $data['review']);
        $data['review'] = preg_replace("/(?:'([^>]*)')(?!>)/", '«$1»', $data['review']);

        $data['rating'] = (float) $data['rating'];

        $data['pros'] = preg_replace('/(?:"([^>]*)")(?!>)/', '«$1»', $data['pros']);
        $data['pros'] = preg_replace("/(?:'([^>]*)')(?!>)/", '«$1»', $data['pros']);

        $data['minuses'] = preg_replace('/(?:"([^>]*)")(?!>)/', '«$1»', $data['minuses']);
        $data['minuses'] = preg_replace("/(?:'([^>]*)')(?!>)/", '«$1»', $data['minuses']);

        $data = empty_str_to_null($data);

        $result = $item->update($data);

        adminLog('Отзывы банков', $id, 'update');

        if ($result) {
            return redirect()
                ->route('admin.banks.reviews.index', [$bankID, $categoryID])
                ->with('flash_success', 'Отзыв банка обновлен!');
        } else {
            return redirect()
                ->route('admin.banks.reviews.index', [$bankID, $categoryID])
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
        $item = BankReview::findOrFail($id);

        $result = $item->delete();

        adminLog('Отзывы банков', $id, 'delete');

        if ($result) {
            return redirect()
                ->route('admin.banks.reviews.all', [$bankID, $categoryID])
                ->with('flash_success', 'Отзыв банка удален!');
        } else {
            return redirect()
                ->route('admin.banks.reviews.all', [$bankID, $categoryID])
                ->with('flash_errors', 'Ошибка удаления!');
        }
    }

    public function load(Request $request)
    {
        $bankId = (int) clear_data($request['bank_id']);
        $bankCategoryId = (int) clear_data($request['bank_category_id']);

        $products = $this->bank_product_repository->getForSelectReviews($bankId, $bankCategoryId);

        return $products;
    }
}
