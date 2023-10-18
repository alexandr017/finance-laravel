<?php

namespace App\Http\Controllers\Admin\Courses;

use App\Http\Controllers\Admin\AdminController;
use App\Repositories\Admin\Courses\CoursesRepository;
use App\Http\Requests\Admin\Course\CourseTagRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CoursesController extends AdminController
{
    private mixed $coursesRepository;

    public function __construct()
    {
        $this->coursesRepository = new CoursesRepository;
    }

    public function index() : View
    {
        $courses = $this->coursesRepository->getAllCoursesForShow();

        $breadcrumbs = [['h1' => 'Курсы']];

        return view('admin.v2.courses.courses.index', compact('courses', 'breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        $schools = [1 => 'test'];

        $breadcrumbs = [
            ['h1' => 'Курсы', 'link' => route('admin.courses.index')],
            ['h1' => 'Создание'],
        ];

        return view('admin.v2.courses.courses.create', compact('breadcrumbs', 'schools'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseTagRequest $request) : RedirectResponse
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) : View
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseTagRequest $request, string $id) : RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) : RedirectResponse
    {
        //
    }
}
