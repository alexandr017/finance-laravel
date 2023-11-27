<?php

namespace App\Http\Controllers\Admin\Banks;

use Illuminate\Http\Request;
use App\Models\Banks\BankCategoryPage;
use App\Repositories\Admin\Banks\BankRepository;
use App\Repositories\Admin\Banks\BankCategoryPageRepository;
use App\Repositories\Admin\Banks\BankCategoryReviewsPageRepository;
use App\Http\Requests\Admin\Banks\BankCategoryPageRequest;
use DB;

class BankCategoryPagesController extends BaseBankController
{
    private const MIN_AVERAGE_RATING = 4.0;
    private const MAX_AVERAGE_RATING = 5.0;

    private const MIN_NUMBER_OF_VOTES = 15;
    private const MAX_NUMBER_OF_VOTES = 25;


    private $bank_category_page_repository;

    private $bank_repository;



    public function all()
    {
        $items = $this->bank_category_page_repository->getForShow();

        $breadcrumbs = [
            ['h1' => 'Банки', 'link' => route('admin.banks.banks.index')],
            ['h1' => 'Все категорийные страницы']
        ];


        return view('admin.banks.categories.all', compact('items', 'breadcrumbs'));
    }

    ////////////////////////////////////////////////////////////

    public function raw()
    {
        $items = DB::table('bank_category_pages')
            ->whereNull('deleted_at')
            ->get();
        return view('admin.banks.categories.raw',compact('items'));
    }

    public function show($id)
    {
        $item = BankCategoryPage::find((int) $id);
        $banks = $this->bank_repository->getForSelect();
        $categories = [
          2 => 'РКО',
          4 => 'Кредиты',
          5 => 'Кредитные карты',
          6 => 'Дебетовые карты'
        ];
        return view('admin.banks.categories.show',compact('item','banks','categories'));
    }

    public function save($id, Request $r)
    {
        $item = BankCategoryPage::find((int) $id);
        $item->bank_id = (int) $r->bank_id;
        $item->category_id = (int) $r->category_id;
        $item->save();

        return redirect('/admin/banks/categories');
    }

    ////////////////////////////////////////////////////////////




    public function __construct()
    {
        parent::__construct();

        $this->bank_category_page_repository = app(BankCategoryPageRepository::class);
        $this->bank_repository = app(BankRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($bankID)
    {
        $items = $this->bank_category_page_repository->getForShow($bankID);

        $breadcrumbs = [
            ['h1' => 'Банки', 'link' => route('admin.banks.banks.index')],
            ['h1' => 'Редактирование', 'link' => route('admin.banks.banks.edit', $bankID)],
            ['h1' => 'Категорийные страницы']
        ];

        return view('admin.banks.categories.index', compact('items','bankID', 'breadcrumbs'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @param int $bankID
     * @return \Illuminate\Http\Response
     */
    public function create($bankID)
    {
        $freeCategoryPages = $this->bank_category_page_repository->getFreeTypePages($bankID);

        $breadcrumbs = [
            ['h1' => 'Банки', 'link' => route('admin.banks.banks.index')],
            ['h1' => 'Редактирование', 'link' => route('admin.banks.banks.edit', $bankID)],
            ['h1' => 'Категорийные страницы', 'link' => route('admin.banks.categories.index', $bankID)],
            ['h1' => 'Создание']
        ];

        return view('admin.banks.categories.create', compact('freeCategoryPages','bankID', 'breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param int $bankID
     * @param  \App\Http\Requests\admin\Banks\BankCategoryPageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store($bankID, BankCategoryPageRequest $request)
    {
        $data = $request->all();
        $data['bank_id'] = (int) $bankID;
        $data['average_rating'] = (self::MIN_AVERAGE_RATING + (self::MAX_AVERAGE_RATING - self::MIN_AVERAGE_RATING) * (mt_rand() / mt_getrandmax()));
        $data['number_of_votes'] = rand(self::MIN_NUMBER_OF_VOTES, self::MAX_NUMBER_OF_VOTES);
        $data = empty_str_to_null($data);

        $item = new BankCategoryPage($data);

        $result = $item->save();

        adminLog('Категорийные страницы банков', $item->id, 'create');

        if ($result) {
            return redirect()
                ->route('admin.banks.categories.index', $bankID)
                ->with('flash_success', 'Категорийная страница банка создана!');
        } else {
            return redirect()
                ->route('admin.banks.categories.index', $bankID)
                ->with('flash_errors', 'Ошибка создания!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $bankID
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($bankID, $id)
    {
        $item = $this->bank_category_page_repository->findOrFail($id);

        $reviewsRepository = app(BankCategoryReviewsPageRepository::class);
        $reviewsPage = $reviewsRepository->findByParentPageID($id);

        $freeCategoryPages = $this->bank_category_page_repository->getFreeTypePagesWithCurrent($bankID, $item->category_id);

        $bank = $this->bank_repository->findOrFail($bankID);
        $bankAlias =  $bank->alias;
        $category = DB::table('cards_categories')->where(['id' => $item->category_id])->first(); // !!!!! переписать
        $categoryAlias = $category->bank_alias;

        $breadcrumbs = [
            ['h1' => 'Банки', 'link' => route('admin.banks.banks.index')],
            ['h1' => 'Редактирование', 'link' => route('admin.banks.banks.edit', $bankID)],
            ['h1' => 'Категорийные страницы', 'link' => route('admin.banks.categories.index', $bankID)],
            ['h1' => 'Редактирование']
        ];

        return view('admin.banks.categories.edit', compact('item', 'freeCategoryPages', 'bankID','reviewsPage','bankAlias','categoryAlias', 'breadcrumbs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $bankID
     * @param  \App\Http\Requests\admin\Banks\BankCategoryPageRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($bankID, BankCategoryPageRequest $request, $id)
    {
        $item = $this->bank_category_page_repository->findOrFail($id);

        $data = $request->all();
        $data['bank_id'] = (int) $bankID;
        $data = empty_str_to_null($data);

        $result = $item->update($data);

        adminLog('Категорийные страницы банков', $id, 'update');


        if ($result) {
            return redirect()
                ->route('admin.banks.categories.index', $bankID)
                ->with('flash_success', 'Категорийная страница банка обновлена!');
        } else {
            return redirect()
                ->route('admin.banks.categories.index', $bankID)
                ->with('flash_errors', 'Ошибка редактирования!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $bankID
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($bankID, $id)
    {
        $item = BankCategoryPage::findOrFail($id);

        $result = $item->delete();

        adminLog('Категорийные страницы банков', $id, 'delete');

        if ($result) {
            return redirect()
                ->route('admin.banks.categories.index', $bankID)
                ->with('flash_success', 'Категорийная страница банка удалена!');
        } else {
            return redirect()
                ->route('admin.banks.categories.index', $bankID)
                ->with('flash_errors', 'Ошибка удаления!');
        }
    }
}
