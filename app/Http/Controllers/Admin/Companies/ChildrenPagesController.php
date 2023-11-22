<?php

namespace App\Http\Controllers\Admin\Companies;

use App\Http\Controllers\Admin\Companies\BaseCompaniesController;
use App\Models\Companies\CompaniesChildrenPages;
use App\Repositories\Admin\Companies\CompanyChildrenPagesRepository;
use App\Repositories\Admin\Companies\CompaniesRepository;
use App\Repositories\Admin\Cards\CardsCategoriesRepository;
use App\Http\Requests\Admin\Companies\ChildrenPageRequest;

class ChildrenPagesController extends BaseCompaniesController
{
    public function __construct()
    {
        parent::__construct();

        $this->companyChildrenPagesRepository = app(CompanyChildrenPagesRepository::class);
        $this->companyRepository = app(CompaniesRepository::class);
        $this->cardsCategoriesRepository = app(CardsCategoriesRepository::class);
    }
    
    public function index($companyId)
    {
        $company = $this->companyRepository->findById($companyId);
        $childrenPages = $this->companyChildrenPagesRepository->getForShow($companyId);

        $breadcrumbs = [
            ['h1' => 'Компании', 'link' => route('admin.companies.index')],
            ['h1' => 'Редактирование', 'link' => route('admin.companies.edit', $companyId)],
            ['h1' => 'Дочерние страницы']
        ];

        return view('admin.companies.children_pages.index', compact('company', 'childrenPages', 'breadcrumbs'));
    }

    public function create($companyId)
    {
        $company = $this->companyRepository->findById($companyId);
        $childrenPageTypes = $this->companyChildrenPagesRepository->getTypesForSelect($company->id);

        if (!$childrenPageTypes) {
            return redirect()
                ->route('admin.companies.children.index', $company->id)
                ->with('flash_errors', 'Все типы дочерних страниц были созданы для этой компании!');
        }

        $breadcrumbs = [
            ['h1' => 'Компании', 'link' => route('admin.companies.index')],
            ['h1' => 'Редактирование', 'link' => route('admin.companies.edit', $companyId)],
            ['h1' => 'Дочерние страницы', 'link' => route('admin.companies.children.index', $companyId)],
            ['h1' => 'Создание']
        ];

        return view('admin.companies.children_pages.create', compact('company', 'childrenPageTypes', 'breadcrumbs'));
    }

    public function store(ChildrenPageRequest $request)
    {
        $data = $request->all();
        $data = empty_str_to_null($data);

        $childrenPage = new CompaniesChildrenPages($data);
        $result = $childrenPage->save();

        if (!$result) {
            return redirect()
                ->route('admin.companies.children.index', $data['company_id'])
                ->with('flash_errors', 'Ошибка создания!');
        }

        adminLog('Дочерняя страница компании', $childrenPage->id, 'create');

        return redirect()
            ->route('admin.companies.children.index', $data['company_id'])
            ->with('flash_success', 'Дочерняя страница успешно создана!');
    }

    public function edit($id)
    {
        $childrenPage = $this->companyChildrenPagesRepository->getForEdit($id);
        $company = $this->companyRepository->findById($childrenPage->company_id);
        $childrenPageTypes = $this->companyChildrenPagesRepository->getTypesForSelect();

        $breadcrumbs = [
            ['h1' => 'Компании', 'link' => route('admin.companies.index')],
            ['h1' => 'Редактирование', 'link' => route('admin.companies.edit', $company->id)],
            ['h1' => 'Дочерние страницы', 'link' => route('admin.companies.children.index', $company->id)],
            ['h1' => 'Редактирование']
        ];

        return view('admin.companies.children_pages.edit', compact('company', 'childrenPage', 'childrenPageTypes', 'breadcrumbs'));
    }

    public function update(ChildrenPageRequest $request, $id)
    {
        $data = $request->all();
        $data = empty_str_to_null($data);

        $childrenPage = $this->companyChildrenPagesRepository->getForEdit($id);

        $result = $childrenPage->update($data);

        if (!$result) {
            return redirect()
                ->route('admin.companies.children.index', $data['company_id'])
                ->with('flash_errors', 'Ошибка обновления!');
        }

        adminLog('Дочерняя страница компании', $childrenPage->id, 'update');

        return redirect()
            ->route('admin.companies.children.index', $data['company_id'])
            ->with('flash_success', 'Дочерняя страница успешно создана!');
    }

    public function destroy($id)
    {
        $childrenPage = $this->companyChildrenPagesRepository->getForDelete($id);
        $result = $childrenPage->delete();

        if (!$result) {
            return redirect()
                ->route('admin.companies.children.index', $childrenPage->company_id)
                ->with('flash_errors', 'Ошибка удаления!');
        }

        adminLog('Дочерняя страница компании', $childrenPage->id, 'delete');

        return redirect()
            ->route('admin.companies.children.index', $childrenPage->company_id)
            ->with('flash_success', 'Дочерняя страница успешно удалёна!');
    }
}
