<?php

namespace App\Http\Controllers\Admin\Posts;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\Admin\Posts\PostRequest;
use App\Repositories\Admin\Posts\PostsRepository;
use App\Repositories\Admin\Posts\PostCategoriesRepository;
use App\Repositories\Admin\Employees\EmployeesRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Throwable;

class PostsController extends AdminController
{
    private mixed $postRepository;
    private mixed $postCategoriesRepository;
    private mixed $employeesRepository;

    public function __construct()
    {
        $this->postRepository = new PostsRepository;
        $this->postCategoriesRepository = new PostCategoriesRepository;
        $this->employeesRepository = new EmployeesRepository;
    }

    /**
     * Display a listing of the resource.
     * @return View
     */
    public function index() : View
    {
        $posts = $this->postRepository->getAllPostsForShow();

        $breadcrumbs = [['h1' => 'Записей']];

        return view('admin.v2.posts.posts.index', compact('posts', 'breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     * @return View
     */
    public function create() : View
    {
        $categories = $this->postCategoriesRepository->getCategoriesForSelect();
        $employees = $this->employeesRepository->getEmployeesForSelect();

        $breadcrumbs = [
            ['h1' => 'Записей', 'link' => route('admin.posts.index')],
            ['h1' => 'Создание']
        ];

        return view('admin.v2.posts.posts.create', compact('categories', 'employees', 'breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     * @param PostRequest $request
     * @return RedirectResponse
     * @throws Throwable
     */
    public function store(PostRequest $request) : RedirectResponse
    {
        $errors = $request->getErrors();
        if (count($errors) > 0) {
            return back()->withInput()->with('flash_warning', json_encode($errors));
        }

        $data = $request->all();
        $data = emptyDataToNull($data);
        $result = $this->postRepository->createPost($data);

        if ($result) {
            return redirect()
                ->route('admin.posts.index')
                ->with('flash_success', 'Запись создана!');
        } else {
            return redirect()
                ->route('admin.posts.index')
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
        $item = $this->postRepository->find($id);

        if ($item == null) {
            abort(404);
        }

        $categories = $this->postCategoriesRepository->getCategoriesForSelect();
        $employees = $this->employeesRepository->getEmployeesForSelect();

        $breadcrumbs = [
            ['h1' => 'Записи', 'link' => route('admin.posts.index')],
            ['h1' => 'Редактирование'],
        ];

        return view('admin.v2.posts.posts.edit', compact('item', 'breadcrumbs', 'categories', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     * @param PostRequest $request
     * @param string $id
     * @return RedirectResponse
     * @throws Throwable
     */
    public function update(PostRequest $request, string $id) : RedirectResponse
    {
        $errors = $request->getErrors();
        if (count($errors) > 0) {
            return back()->withInput()->with('flash_warning', json_encode($errors));
        }

        $data = $request->all();
        $data = emptyDataToNull($data);
        $result = $this->postRepository->updatePost($id, $data);

        if ($result) {
            return redirect()
                ->route('admin.posts.index')
                ->with('flash_success', 'Запись обнавлена!');
        } else {
            return redirect()
                ->route('admin.posts.index')
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
        $result = $this->postRepository->deletePost($id);

        if ($result) {
            return redirect()
                ->route('admin.posts.index')
                ->with('flash_success', 'Запись удалена!');
        } else {
            return redirect()
                ->route('admin.posts.index')
                ->with('flash_errors', 'Ошибка удаления!');
        }
    }
}
