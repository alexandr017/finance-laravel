<?php

namespace App\Http\Controllers\Admin\Banks;

use App\Http\Requests\Admin\Banks\BankInfoPageRequest;
use App\Models\Banks\BankInfoPage;
use App\Repositories\Admin\Banks\BankInfoPageRepository;
use App\Repositories\Admin\Banks\BankRepository;
use DB;
use Illuminate\Http\Request;

class BanksInfoPagesController extends BaseBankController
{
    private const MIN_AVERAGE_RATING = 4.0;
    private const MAX_AVERAGE_RATING = 5.0;

    private const MIN_NUMBER_OF_VOTES = 15;
    private const MAX_NUMBER_OF_VOTES = 25;


    private $bank_info_page_repository;

    private $bank_repository;


    public function __construct()
    {
        parent::__construct();

        $this->bank_info_page_repository = app(BankInfoPageRepository::class);
        $this->bank_repository = app(BankRepository::class);
    }

    public function all()
    {
        $items = $this->bank_info_page_repository->getForShow();

        $breadcrumbs = [
            ['h1' => 'Банки', 'link' => route('admin.banks.banks.index')],
            ['h1' => 'Все инфо-страницы']
        ];

        return view('admin.banks.info-pages.all', compact('items', 'breadcrumbs'));
    }

    ////////////////////////////////////////////////////////////

    public function raw()
    {
        $items = DB::table('bank_info_pages')
            ->whereNull('deleted_at')
            ->get();
        return view('admin.banks.info-pages.raw',compact('items'));
    }

    public function show($id)
    {
        $item = BankInfoPage::find((int) $id);
        $banks = $this->bank_repository->getForSelect();
        return view('admin.banks.info-pages.show',compact('item','banks'));
    }

    public function save($id, Request $r)
    {
        $item = BankInfoPage::find((int) $id);
        $item->bank_id = (int) $r->bank_id;
        $item->save();
        return redirect('/admin/banks/info');
    }


    public function delete($id)
    {
        $item = BankInfoPage::find((int) $id);

        $item->delete();
        return redirect('/admin/banks/info');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($bankID)
    {
        $items = $this->bank_info_page_repository->getForShow($bankID);

        $breadcrumbs = [
            ['h1' => 'Банки', 'link' => route('admin.banks.banks.index')],
            ['h1' => 'Редактирование', 'link' => route('admin.banks.banks.edit', $bankID)],
            ['h1' => 'Информационные страницы']
        ];

        return view('admin.banks.info-pages.index', compact('items','bankID', 'breadcrumbs'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @param int $bankID
     * @return \Illuminate\Http\Response
     */
    public function create($bankID)
    {
        $freeTypePages = $this->bank_info_page_repository->getFreeTypePages($bankID);
        
        $breadcrumbs = [
            ['h1' => 'Банки', 'link' => route('admin.banks.banks.index')],
            ['h1' => 'Редактирование', 'link' => route('admin.banks.banks.edit', $bankID)],
            ['h1' => 'Информационные страницы', 'link' => route('admin.banks.info-pages.index', $bankID)],
            ['h1' => 'Создание']
        ];

        return view('admin.banks.info-pages.create', compact('freeTypePages','bankID', 'breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param int $bankID
     * @param  \App\Http\Requests\admin\Banks\BankInfoPageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store($bankID, BankInfoPageRequest $request)
    {
        $data = $request->all();
        $data['bank_id'] = (int) $bankID;
        $data['average_rating'] = (self::MIN_AVERAGE_RATING + (self::MAX_AVERAGE_RATING - self::MIN_AVERAGE_RATING) * (mt_rand() / mt_getrandmax()));
        $data['number_of_votes'] = rand(self::MIN_NUMBER_OF_VOTES, self::MAX_NUMBER_OF_VOTES);
        $data = empty_str_to_null($data);

        $item = new BankInfoPage($data);

        $result = $item->save();

        adminLog('Инфо-страницы банков', $item->id, 'create');

        if ($result) {
            return redirect()
                ->route('admin.banks.info-pages.index', $bankID)
                ->with('flash_success', 'Инфо-страница банка создана!');
        } else {
            return redirect()
                ->route('admin.banks.info-pages.index', $bankID)
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
        $item = $this->bank_info_page_repository->findOrFail($id);

        $freeTypePages = $this->bank_info_page_repository->getFreeTypePagesWithCurrent($bankID, $item->type_id);

        $breadcrumbs = [
            ['h1' => 'Банки', 'link' => route('admin.banks.banks.index')],
            ['h1' => 'Редактирование', 'link' => route('admin.banks.banks.edit', $bankID)],
            ['h1' => 'Информационные страницы', 'link' => route('admin.banks.info-pages.index', $bankID)],
            ['h1' => 'Редактирование']
        ];

        return view('admin.banks.info-pages.edit', compact('item', 'freeTypePages', 'bankID', 'breadcrumbs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $bankID
     * @param  \App\Http\Requests\admin\Banks\BankInfoPageRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($bankID, BankInfoPageRequest $request, $id)
    {
        $item = $this->bank_info_page_repository->findOrFail($id);

        $data = $request->all();
        $data['bank_id'] = (int) $bankID;
        $data = empty_str_to_null($data);

        $result = $item->update($data);

        adminLog('Инфо-страницы банков', $id, 'update');


        if ($result) {
            return redirect()
                ->route('admin.banks.info-pages.index', $bankID)
                ->with('flash_success', 'Инфо-страница банка обновлена!');
        } else {
            return redirect()
                ->route('admin.banks.info-pages.index', $bankID)
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
        $item = BankInfoPage::findOrFail($id);

        $result = $item->delete();

        adminLog('Инфо-страницы банков', $id, 'delete');

        if ($result) {
            return redirect()
                ->route('admin.banks.info-pages.index', $bankID)
                ->with('flash_success', 'Инфо-страница банка удалена!');
        } else {
            return redirect()
                ->route('admin.banks.info-pages.index', $bankID)
                ->with('flash_errors', 'Ошибка удаления!');
        }
    }
}
