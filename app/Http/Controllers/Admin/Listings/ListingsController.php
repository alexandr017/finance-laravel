<?php

namespace App\Http\Controllers\Admin\Listings;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\Admin\Listings\ListingRequest;
use App\Repositories\Admin\Listings\ListingsRepository;
use App\Repositories\Admin\Employees\EmployeesRepository;
use App\Repositories\Admin\Courses\CoursesRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Throwable;

class ListingsController extends AdminController
{
    private mixed $listingRepository;

    private mixed $employeesRepository;

    private mixed $coursesRepository;

    public function __construct()
    {
        $this->listingRepository = new ListingsRepository;
        $this->employeesRepository = new EmployeesRepository;
        $this->coursesRepository = new CoursesRepository;
    }

    /**
     * Display a listing of the resource.
     * @return View
     */
    public function index() : View
    {
        $listings = $this->listingRepository->getAllListingsForShow();

        $breadcrumbs = [['h1' => 'Листинги']];

        return view('admin.v2.listings.index', compact('listings', 'breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     * @return View
     */
    public function create() : View
    {
        $breadcrumbs = [
            ['h1' => 'Листинги', 'link' => route('admin.listings.index')],
            ['h1' => 'Создание']
        ];

        $employees = $this->employeesRepository->getEmployeesForSelect();

        return view('admin.v2.listings.create', compact( 'breadcrumbs', 'employees'));
    }

    /**
     * Store a newly created resource in storage.
     * @param ListingRequest $request
     * @return RedirectResponse
     * @throws Throwable
     */
    public function store(ListingRequest $request) : RedirectResponse
    {
        $errors = $request->getErrors();
        if (count($errors) > 0) {
            return back()->withInput()->with('flash_warning', json_encode($errors));
        }

        $data = $request->all();
        $data = emptyDataToNull($data);
        $result = $this->listingRepository->createListing($data);

        if ($result) {
            return redirect()
                ->route('admin.listings.index')
                ->with('flash_success', 'Листинг создан!');
        } else {
            return redirect()
                ->route('admin.listings.index')
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
        $item = $this->listingRepository->find($id);

        if ($item == null) {
            abort(404);
        }

        $employees = $this->employeesRepository->getEmployeesForSelect();

        $breadcrumbs = [
            ['h1' => 'Листиинги', 'link' => route('admin.listings.index')],
            ['h1' => 'Редактирование'],
        ];

        return view('admin.v2.listings.edit', compact('item', 'employees', 'breadcrumbs'));
    }

    /**
     * Update the specified resource in storage.
     * @param ListingRequest $request
     * @param string $id
     * @return RedirectResponse
     * @throws Throwable
     */
    public function update(ListingRequest $request, string $id) : RedirectResponse
    {
        $errors = $request->getErrors();
        if (count($errors) > 0) {
            return back()->withInput()->with('flash_warning', json_encode($errors));
        }

        $data = $request->all();
        $data = emptyDataToNull($data);
        $result = $this->listingRepository->updateListing($id, $data);

        if ($result) {
            return redirect()
                ->route('admin.listings.index')
                ->with('flash_success', 'Листинг обнавлен!');
        } else {
            return redirect()
                ->route('admin.listings.index')
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
        $result = $this->listingRepository->deleteListing($id);

        if ($result) {
            return redirect()
                ->route('admin.listings.index')
                ->with('flash_success', 'Листинг удалена!');
        } else {
            return redirect()
                ->route('admin.listings.index')
                ->with('flash_errors', 'Ошибка удаления!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return View
     */
    public function coursesList(int $id) : View
    {
        $courses = $this->coursesRepository->getAllCoursesForShow();
        $currentCourses = []; // todo

        $breadcrumbs = [
            ['h1' => 'Листиинги', 'link' => route('admin.listings.index')],
            ['h1' => 'Редактирование'],
        ];

        return view('admin.v2.listings.courses', compact('courses', 'currentCourses', 'breadcrumbs'));
    }

    public function coursesListUpdate(int $id) : RedirectResponse
    {
        // todo
        return redirect()
            ->route('admin.listings.index')
            ->with('flash_success', 'Курсы перепривязаны к листингу!');
    }
}
