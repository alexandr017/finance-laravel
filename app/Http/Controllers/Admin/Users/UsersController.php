<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\Admin\Users\UserRequest;
use App\Repositories\Admin\Users\UsersRepository;
use App\Repositories\Admin\Employees\EmployeesRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Throwable;

class UsersController extends AdminController
{
    private mixed $usersRepository;
    private mixed $employeesRepository;

    public function __construct()
    {
        $this->usersRepository = new UsersRepository;
        $this->employeesRepository = new EmployeesRepository;
    }

    /**
     * Display a listing of the resource.
     * @return View
     */
    public function index() : View
    {
        $users = $this->usersRepository->getAllUsersForShow();

        $breadcrumbs = [['h1' => 'Пользователи']];

        return view('admin.v2.users.index', compact('users', 'breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     * @return View
     */
    public function create() : View
    {
        $breadcrumbs = [
            ['h1' => 'Пользователи', 'link' => route('admin.users.index')],
            ['h1' => 'Создание']
        ];

        $roles = $this->usersRepository->getRolesForSelect();

        $employees = array_merge([0 => 'Не выбран'], $this->employeesRepository->getEmployeesForSelect());

        return view('admin.v2.users.create', compact( 'breadcrumbs', 'roles', 'employees'));
    }

    /**
     * Store a newly created resource in storage.
     * @param UserRequest $request
     * @return RedirectResponse
     * @throws Throwable
     */
    public function store(UserRequest $request) : RedirectResponse
    {
        $errors = $request->getErrors();
        if (count($errors) > 0) {
            return back()->withInput()->with('flash_warning', json_encode($errors));
        }

        $data = $request->all();
        $data = emptyDataToNull($data);
        $result = $this->usersRepository->createUser($data);

        if ($result) {
            return redirect()
                ->route('admin.users.index')
                ->with('flash_success', 'Пользователь создан!');
        } else {
            return redirect()
                ->route('admin.users.index')
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
        $item = $this->usersRepository->find($id);

        if ($item == null) {
            abort(404);
        }

        $roles = $this->usersRepository->getRolesForSelect();

        $employees = array_merge([0 => 'Не выбран'], $this->employeesRepository->getEmployeesForSelect());

        $breadcrumbs = [
            ['h1' => 'Пользователи', 'link' => route('admin.users.index')],
            ['h1' => 'Редактирование'],
        ];

        return view('admin.v2.users.edit', compact('item', 'roles', 'employees', 'breadcrumbs'));
    }

    /**
     * Update the specified resource in storage.
     * @param UserRequest $request
     * @param string $id
     * @return RedirectResponse
     * @throws Throwable
     */
    public function update(UserRequest $request, string $id) : RedirectResponse
    {
        $errors = $request->getErrors();
        if (count($errors) > 0) {
            return back()->withInput()->with('flash_warning', json_encode($errors));
        }

        $data = $request->all();
        $data = emptyDataToNull($data);
        $result = $this->usersRepository->updateUser($id, $data);

        if ($result) {
            return redirect()
                ->route('admin.users.index')
                ->with('flash_success', 'Пользователь обнавлен!');
        } else {
            return redirect()
                ->route('admin.users.index')
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
        $result = $this->usersRepository->deleteUser($id);

        if ($result) {
            return redirect()
                ->route('admin.users.index')
                ->with('flash_success', 'Пользователь удалена!');
        } else {
            return redirect()
                ->route('admin.users.index')
                ->with('flash_errors', 'Ошибка удаления!');
        }
    }
}
