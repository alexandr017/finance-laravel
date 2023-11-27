<?php

namespace App\Http\Controllers\Admin\Banks;

use App\Models\Banks\Bank;
use App\Repositories\Admin\Banks\BankRepository;
use App\Repositories\Admin\Posts\PostCategoryRepository;
use App\Http\Requests\Admin\Banks\BankRequest;

class BanksController extends BaseBankController
{
    private const MIN_AVERAGE_RATING = 4.0;
    private const MAX_AVERAGE_RATING = 5.0;

    private const MIN_NUMBER_OF_VOTES = 15;
    private const MAX_NUMBER_OF_VOTES = 25;


    private $bank_repository;

    private $post_category_repository;


    public function __construct()
    {
        parent::__construct();

        $this->bank_repository = app(BankRepository::class);

        $this->post_category_repository = app(PostCategoryRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = $this->bank_repository->getForShow();

        $breadcrumbs = [
            ['h1' => 'Банки']
        ];


        return view('admin.banks.bank.index', compact('items', 'breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $postCategories = $this->post_category_repository->getForSelect('with_empty_row');

        $breadcrumbs = [
            ['h1' => 'Банки', 'link' => route('admin.banks.banks.index')],
            ['h1' => 'Создание']
        ];

        return view('admin.banks.bank.create', compact('postCategories', 'breadcrumbs'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\admin\Banks\BankRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BankRequest $request)
    {
        $data = $request->all();
        $data['average_rating'] = (BanksController::MIN_AVERAGE_RATING + (BanksController::MAX_AVERAGE_RATING - BanksController::MIN_AVERAGE_RATING) * (mt_rand() / mt_getrandmax()));
        $data['number_of_votes'] = rand(BanksController::MIN_NUMBER_OF_VOTES, BanksController::MAX_NUMBER_OF_VOTES);
        $data = empty_str_to_null($data);

        $item = new Bank($data);

        $result = $item->save();

        adminLog('Банки', $item->id, 'create');

        if ($result) {

            return redirect()
                ->route('admin.banks.banks.index')
                ->with('flash_success', 'Банк создан!');
        } else {
            return redirect()
                ->route('admin.banks.banks.index')
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
        $item = $this->bank_repository->findOrFail($id);
        $postCategories = $this->post_category_repository->getForSelect('with_empty_row');

        $breadcrumbs = [
            ['h1' => 'Банки', 'link' => route('admin.banks.banks.index')],
            ['h1' => 'Редактирование']
        ];

        return view('admin.banks.bank.edit', compact('item','postCategories', 'breadcrumbs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\admin\Banks\BankRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BankRequest $request, $id)
    {
        $item = $this->bank_repository->findOrFail($id);

        $data = $request->all();
        $data = empty_str_to_null($data);

        $result = $item->update($data);

        adminLog('Банки', $id, 'update');


        if ($result) {
            return redirect()
                ->route('admin.banks.banks.index')
                ->with('flash_success', 'Банк обновлен!');
        } else {
            return redirect()
                ->route('admin.banks.banks.index')
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
        $item = Bank::findOrFail($id);

        // удалять привязки:
        // удалить филиалы
        // удалить банкоматы АТМ

        $result = $item->delete();


        adminLog('Банки', $id, 'delete');

        if ($result) {
            return redirect()
                ->route('admin.banks.banks.index')
                ->with('flash_success', 'Банк удален!');
        } else {
            return redirect()
                ->route('admin.banks.banks.index')
                ->with('flash_errors', 'Ошибка удаления!');
        }
    }

}
