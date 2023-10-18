<?php

namespace App\Http\Controllers\Admin\Employees;

use App\Http\Controllers\Admin\AdminController;
use App\Repositories\Admin\Employees\EmployeesRepository;
use App\Http\Requests\Admin\Employees\EmployeeRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Throwable;

class EmployeesController extends AdminController
{
    private mixed $employeesRepository;

    public function __construct()
    {
        $this->employeesRepository = new EmployeesRepository;
    }

    /**
     * Display a listing of the resource.
     * @return View
     */
    public function index() : View
    {
        $employees = $this->employeesRepository->getAllEmployeesForShow();

        $breadcrumbs = [['h1' => 'Сотрудники']];

        return view('admin.v2.employees.index', compact('employees', 'breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     * @return View
     */
    public function create() : View
    {
        $breadcrumbs = [
            ['h1' => 'Сотрудники', 'link' => route('admin.employees.index')],
            ['h1' => 'Создание'],
        ];

        return view('admin.v2.employees.create', compact('breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     * @param EmployeeRequest $request
     * @return RedirectResponse
     */
    public function store(EmployeeRequest $request) : RedirectResponse
    {
        $errors = $request->getErrors();
        if (count($errors) > 0) {
            return back()->withInput()->with('flash_warning', json_encode($errors));
        }

        $data = $request->all();
        $data = emptyDataToNull($data);
        $result = $this->employeesRepository->createEmployee($data);

        if ($result) {
            return redirect()
                ->route('admin.employees.index')
                ->with('flash_success', 'Сотрудник добавлен!');
        } else {
            return redirect()
                ->route('admin.employees.index')
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
        $item = $this->employeesRepository->find($id);

        if ($item == null) {
            abort(404);
        }

        $breadcrumbs = [
            ['h1' => 'Сотрудники', 'link' => route('admin.employees.index')],
            ['h1' => 'Редактирование'],
        ];

        return view('admin.v2.employees.edit', compact('item', 'breadcrumbs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request, string $id) : RedirectResponse
    {
        $errors = $request->getErrors();
        if (count($errors) > 0) {
            return back()->withInput()->with('flash_warning', json_encode($errors));
        }

        $data = $request->all();
        $data = emptyDataToNull($data);
        $result = $this->employeesRepository->updateEmployee($id, $data);

        if ($result) {
            return redirect()
                ->route('admin.employees.index')
                ->with('flash_success', 'Сотрудник обнавлен!');
        } else {
            return redirect()
                ->route('admin.employees.index')
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
        $result = $this->employeesRepository->deleteEmployee($id);

        if ($result) {
            return redirect()
                ->route('admin.employees.index')
                ->with('flash_success', 'Сотрудник удален!');
        } else {
            return redirect()
                ->route('admin.employees.index')
                ->with('flash_errors', 'Ошибка удаления!');
        }
    }
}
