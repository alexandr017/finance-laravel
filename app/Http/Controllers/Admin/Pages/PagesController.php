<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\Admin\Pages\PageRequest;
use App\Repositories\Admin\Pages\PagesRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Throwable;

class PagesController extends AdminController
{
    private mixed $pageRepository;

    public function __construct()
    {
        $this->pageRepository = new PagesRepository;
    }

    /**
     * Display a listing of the resource.
     * @return View
     */
    public function index() : View
    {
        $pages = $this->pageRepository->getAllPagesForShow();

        $breadcrumbs = [['h1' => 'Страницы']];

        return view('admin.v2.pages.index', compact('pages', 'breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     * @return View
     */
    public function create() : View
    {
        $breadcrumbs = [
            ['h1' => 'Страницы', 'link' => route('admin.pages.index')],
            ['h1' => 'Создание']
        ];

        return view('admin.v2.pages.create', compact( 'breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     * @param PageRequest $request
     * @return RedirectResponse
     * @throws Throwable
     */
    public function store(PageRequest $request) : RedirectResponse
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
                ->route('admin.pages.index')
                ->with('flash_success', 'Страница создана!');
        } else {
            return redirect()
                ->route('admin.pages.index')
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
            ['h1' => 'Страницы', 'link' => route('admin.pages.index')],
            ['h1' => 'Редактирование'],
        ];

        return view('admin.v2.pages.edit', compact('item', 'breadcrumbs'));
    }

    /**
     * Update the specified resource in storage.
     * @param PageRequest $request
     * @param string $id
     * @return RedirectResponse
     * @throws Throwable
     */
    public function update(PageRequest $request, string $id) : RedirectResponse
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
                ->route('admin.pages.index')
                ->with('flash_success', 'Страница обнавлена!');
        } else {
            return redirect()
                ->route('admin.pages.index')
                ->with('flash_errors', 'Ошибка обновления!');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param string $id
     * @return RedirectResponse
     * @throws Throwable
     */
    public function destroy(string $id) : RedirectResponse
    {
        $result = $this->pageRepository->deletePage($id);

        if ($result) {
            return redirect()
                ->route('admin.pages.index')
                ->with('flash_success', 'Страница удалена!');
        } else {
            return redirect()
                ->route('admin.pages.index')
                ->with('flash_errors', 'Ошибка удаления!');
        }
    }
}
