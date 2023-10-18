<?php

namespace App\Http\Controllers\Admin\Courses;

use App\Http\Controllers\Admin\AdminController;
use App\Repositories\Admin\Courses\CourseTagsRepository;
use App\Http\Requests\Admin\Course\CourseTagRequest;
use App\Repositories\Admin\Employees\EmployeesRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CourseTagsController extends AdminController
{
    private mixed $courseTagRepository;

    public function __construct()
    {
        $this->courseTagRepository = new CourseTagsRepository;
    }
    /**
     * Display a listing of the resource.
     * @return View
     */
    public function index() : View
    {
        $tags = $this->courseTagRepository->getAllTagsForShow();

        $breadcrumbs = [['h1' => 'Теги курсов']];

        return view('admin.v2.courses.tags.index', compact('tags', 'breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     * @return View
     */
    public function create() : View
    {
        $breadcrumbs = [
            ['h1' => 'Теги курсов', 'link' => route('admin.course-tags.index')],
            ['h1' => 'Создание'],
        ];

        return view('admin.v2.courses.tags.create', compact('breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     * @param CourseTagRequest $request
     * @return RedirectResponse
     */
    public function store(CourseTagRequest $request) : RedirectResponse
    {
        $errors = $request->getErrors();
        if (count($errors) > 0) {
            return back()->withInput()->with('flash_warning', json_encode($errors));
        }

        $data = $request->all();
        $data = emptyDataToNull($data);
        $result = $this->courseTagRepository->createTag($data);

        if ($result) {
            return redirect()
                ->route('admin.course-tags.index')
                ->with('flash_success', 'Тег курсов добавлен!');
        } else {
            return redirect()
                ->route('admin.course-tags.index')
                ->with('flash_errors', 'Ошибка добавления!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param string $id
     * @return View
     */
    public function edit(string $id) : View
    {
        $item = $this->courseTagRepository->find($id);

        if ($item == null) {
            abort(404);
        }

        $breadcrumbs = [
            ['h1' => 'Теги курсов', 'link' => route('admin.course-tags.index')],
            ['h1' => 'Редактирование'],
        ];

        return view('admin.v2.courses.tags.edit', compact('item', 'breadcrumbs'));
    }

    /**
     * Update the specified resource in storage.
     * @param CourseTagRequest $request
     * @param string $id
     * @return RedirectResponse
     */
    public function update(CourseTagRequest $request, string $id) : RedirectResponse
    {
        $errors = $request->getErrors();
        if (count($errors) > 0) {
            return back()->withInput()->with('flash_warning', json_encode($errors));
        }

        $data = $request->all();
        $data = emptyDataToNull($data);
        $result = $this->courseTagRepository->updateTag($id, $data);

        if ($result) {
            return redirect()
                ->route('admin.course-tags.index')
                ->with('flash_success', 'Тег курсов обнавлен!');
        } else {
            return redirect()
                ->route('admin.course-tags.index')
                ->with('flash_errors', 'Ошибка обновления!');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param string $id
     * @return RedirectResponse
     */
    public function destroy(string $id) : RedirectResponse
    {
        $result = $this->courseTagRepository->deleteTag($id);
        // todo сделать удаление также и привязанных курсов (то есть из таблицы courses_tags)

        if ($result) {
            return redirect()
                ->route('admin.course-tags.index')
                ->with('flash_success', 'Тек курса удален!');
        } else {
            return redirect()
                ->route('admin.course-tags.index')
                ->with('flash_errors', 'Ошибка удаления!');
        }
    }
}
