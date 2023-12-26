<?php

namespace App\Http\Controllers\Admin\Relinking;

use App\Http\Controllers\Admin\AdminController;
use App\Models\Cards\CardsCategories;
use App\Algorithms\System;
use App\Models\Relinking\Relinking;
use App\Models\Relinking\RelinkingGroup;
use App\Repositories\Admin\Cards\ListingRepository;
use App\Repositories\Admin\Relinking\RelinkingRepository;
use App\Http\Requests\Admin\Relinking\RelinkingRequest;
use Illuminate\Validation\ValidationException;

class RelinkingController extends AdminController
{

    private $relinkingRepository;
    private $listingRepository;

    public function __construct()
    {
        parent::__construct();

        $this->relinkingRepository = app(RelinkingRepository::class);
        $this->listingRepository = app(ListingRepository::class);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        if (\Auth::id() == '128767') {
//            $this->matchListingsToRelinks();
//        }

        $cardsCategories = CardsCategories::all();
        $cardsCategoriesArr = System::convertToArray($cardsCategories,'breadcrumb',['null' => 'Выберите категорию']);
        $relinkingGroupsArr = (RelinkingGroup::all())->toArray();
        $items = $this->relinkingRepository->getForShow();

        $breadcrumbs = [
            ['h1' => 'Список перелинковки'],
        ];

        return view('admin.relinking.index', compact('items','cardsCategoriesArr','relinkingGroupsArr','breadcrumbs'));
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
            ['h1' => 'Список перелинковки', 'link' => route('admin.relinking.index')],
            ['h1' => 'Создание']
        ];

        return view('admin.relinking.create',compact('cardsCategoriesArr','relinkingGroupsArr','breadcrumbs'));
    }

    public function store(RelinkingRequest $request)
    {
        $data = $request->all();
        $data = empty_str_to_null($data);

        $listing = $this->listingRepository->findByLink($data['link'], $data['category_id']);

        if (!$listing) {
            throw ValidationException::withMessages(['link' => 'По данной ссылке листинг не был найден']);
        }

        $data['listing_id'] = $listing->id;

        $item = new Relinking($data);

        $result = $item->save();
        adminLog('Перелинковка', $item->id, 'create');

        if ($result) {
            return redirect()
                ->route('admin.relinking.index')
                ->with('flash_success', 'Перелинковка создан!');
        } else {
            return redirect()
                ->route('admin.relinking.index')
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
        $item = $this->relinkingRepository->findOrFail($id);
        $cardsCategories = CardsCategories::all();
        $cardsCategoriesArr = System::convertToArray($cardsCategories,'breadcrumb',['null' => 'Выберите категорию']);
        $relinkingGroupsArr = ((RelinkingGroup::select('group_name','id','category_id')->get())->groupBy('category_id'));

        $breadcrumbs = [
            ['h1' => 'Список перелинковки', 'link' => route('admin.relinking.index')],
            ['h1' => 'Редактирование']
        ];

        return view('admin.relinking.edit', compact('item','cardsCategoriesArr','relinkingGroupsArr','breadcrumbs'));
    }


    public function update(RelinkingRequest $request, $id)
    {
        $item = $this->relinkingRepository->findOrFail($id);

        $data = $request->all();
        $data = empty_str_to_null($data);

        $listing = $this->listingRepository->findByLink($data['link'], $data['category_id']);

        if (!$listing) {
            throw ValidationException::withMessages(['link' => 'По данной ссылке листинг не был найден']);
        }

        $data['listing_id'] = $listing->id;

        $result = $item->update($data);
        adminLog('Перелинковка', $item->id, 'update');

        if ($result) {
            return redirect()
                ->route('admin.relinking.index')
                ->with('flash_success', 'Перелинковка обновлен!');
        } else {
            return redirect()
                ->route('admin.relinking.index')
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
        $item = $this->relinkingRepository->findOrFail($id);
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

    private function matchListingsToRelinks()
    {
        Relinking::where('listing_id', null)
            ->chunk(500, function ($relinks) {
                foreach ($relinks as $relink) {
                    $listing = $this->listingRepository->findByLink($relink->link, $relink->category_id);

                    if (!$listing) {
                        dump($relink);
                        continue;
                    };

                    $relink->update([
                        'listing_id' => $listing->id
                    ]);
                }
            });

    }
}
