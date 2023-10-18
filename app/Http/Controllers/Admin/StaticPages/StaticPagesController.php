<?php

namespace App\Http\Controllers\Admin\StaticPages;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\Admin\StaticPages\StaticPageRequest;
use App\Repositories\Admin\StaticPages\StaticPagesRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class StaticPagesController extends AdminController
{
    private mixed $pageRepository;

    public function __construct()
    {
        $this->pageRepository = new StaticPagesRepository;
    }
    /**
     * Display a listing of the resource.
     * @return View
     */
    public function index() : View
    {
        $pages = $this->pageRepository->getAllPagesForShow();

        $breadcrumbs = [['h1' => 'Статические страницы']];

        return view('admin.v2.static-pages.index', compact('pages', 'breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     * @return View
     */
    public function create() : View
    {
        $breadcrumbs = [
            ['h1' => 'Статические страницы', 'link' => route('admin.static-pages.index')],
            ['h1' => 'Создание']
        ];

        return view('admin.v2.static-pages.create', compact( 'breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StaticPageRequest $request) : RedirectResponse
    {
        $errors = $request->getErrors();
        if (count($errors) > 0) {
            return back()->withInput()->with('flash_warning', json_encode($errors));
        }

        $data = $request->all();
        $data = emptyDataToNull($data);
        $result = $this->pageRepository->createPage($data);

        if ($result) {
            return redirect()
                ->route('admin.static-pages.index')
                ->with('flash_success', 'Статическая страница создана!');
        } else {
            return redirect()
                ->route('admin.static-pages.index')
                ->with('flash_errors', 'Ошибка создания!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param string $id
     * @return View
     */
    public function edit(string $id) : View
    {
        $item = $this->pageRepository->find($id);

        if ($item == null) {
            abort(404);
        }

        $breadcrumbs = [
            ['h1' => 'Статические страницы', 'link' => route('admin.static-pages.index')],
            ['h1' => 'Редактирование'],
        ];

        return view('admin.v2.static-pages.edit', compact('item', 'breadcrumbs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StaticPageRequest $request, string $id) : RedirectResponse
    {
        $errors = $request->getErrors();
        if (count($errors) > 0) {
            return back()->withInput()->with('flash_warning', json_encode($errors));
        }

        $data = $request->all();
        $data = emptyDataToNull($data);
        $result = $this->pageRepository->updatePage($id, $data);

        if ($result) {
            return redirect()
                ->route('admin.static-pages.index')
                ->with('flash_success', 'Страница обнавлена!');
        } else {
            return redirect()
                ->route('admin.static-pages.index')
                ->with('flash_errors', 'Ошибка обновления!');
        }
    }


}
