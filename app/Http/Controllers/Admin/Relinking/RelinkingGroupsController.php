<?php

namespace App\Http\Controllers\Admin\Relinking;

use App\Http\Controllers\Admin\AdminController;
use App\Models\Cards\CardsCategories;
use App\Algorithms\System;
use App\Models\Relinking\RelinkingGroup;
use App\Repositories\Admin\Relinking\RelinkingGroupRepository;
use App\Http\Requests\Admin\Relinking\RelinkingGroupRequest;

class RelinkingGroupsController extends AdminController
{

    private $relinkingRepository;

    public function __construct()
    {
        parent::__construct();

        $this->relinkingGroupRepository = app(RelinkingGroupRepository::class);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = $this->relinkingGroupRepository->getForShow();

        $breadcrumbs = [
            ['h1' => 'Список групп перелинковки'],
        ];

        return view('admin.relinking_groups.index', compact('items','breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cardsCategories = CardsCategories::all();
        $cardsCategoriesArr = System::convertToArray($cardsCategories,'breadcrumb',['null' => 'Выберите категорию']);
        $relinkingGroupsArr = ((RelinkingGroup::select('group_name','id','category_id')->get())->groupBy('category_id'));

        $breadcrumbs = [
            ['h1' => 'Список групп перелинковки', 'link' => route('admin.relinking_groups.index')],
            ['h1' => 'Создание']
        ];

        return view('admin.relinking_groups.create',compact('cardsCategoriesArr','relinkingGroupsArr','breadcrumbs'));
    }

    public function store(RelinkingGroupRequest $request)
    {
        $data = $request->all();
        $data = empty_str_to_null($data);
        $item = new RelinkingGroup($data);

        $result = $item->save();
        adminLog('Группа перелинковка', $item->id, 'create');

        if ($result) {
            return redirect()
                ->route('admin.relinking_groups.index')
                ->with('flash_success', 'Группа перелинковка создан!');
        } else {
            return redirect()
                ->route('admin.relinking_groups.index')
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
        $item = $this->relinkingGroupRepository->findOrFail($id);
        $cardsCategories = CardsCategories::all();
        $cardsCategoriesArr = System::convertToArray($cardsCategories,'breadcrumb',['null' => 'Выберите категорию']);
        $relinkingGroupsArr = ((RelinkingGroup::select('group_name','id','category_id')->get())->groupBy('category_id'));

        $breadcrumbs = [
            ['h1' => 'Список групп перелинковки', 'link' => route('admin.relinking_groups.index')],
            ['h1' => 'Редактирование']
        ];

        return view('admin.relinking_groups.edit', compact('item','cardsCategoriesArr','relinkingGroupsArr','breadcrumbs'));
    }


    public function update(RelinkingGroupRequest $request, $id)
    {
        $item = $this->relinkingGroupRepository->findOrFail($id);

        $data = $request->all();
        $data = empty_str_to_null($data);

        $result = $item->update($data);
        adminLog('Группа перелинковка', $item->id, 'update');

        if ($result) {
            return redirect()
                ->route('admin.relinking_groups.index')
                ->with('flash_success', 'Группа перелинковка обновлен!');
        } else {
            return redirect()
                ->route('admin.relinking_groups.index')
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
        $item = $this->relinkingGroupRepository->findOrFail($id);
        $result = $item->delete();
        adminLog('Перелинковка', $item->id, 'delete');

        if ($result) {
            return redirect()
                ->route('admin.relinking.index')
                ->with('flash_success', 'Перелинковка удалена!');
        } else {
            return redirect()
                ->route('admin.relinking.index')
                ->with('flash_errors', 'Ошибка удаления!');
        }
    }

    public function getRelinkingGroups($category_id){
        $relinkingGroups = ((RelinkingGroup::where(['category_id'=>$category_id])->select('group_name','id')->get())->toArray());
        return $relinkingGroups;
    }
}
