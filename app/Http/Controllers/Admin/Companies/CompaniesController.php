<?php

namespace App\Http\Controllers\Admin\Companies;

use App\Http\Controllers\Admin\AdminController;
use App\Algorithms\System;
use App\Models\Companies\Companies;
use App\Http\Requests\Admin\Companies\CompanyRequest;
use App\Repositories\Admin\Companies\CompaniesRepository;
use App\Repositories\Admin\Companies\CompanyChildrenPagesRepository;
use App\Repositories\Admin\Companies\CompanyReviewRepository;
use App\Repositories\Admin\Cards\CardsCategoriesRepository;
use App\Repositories\Admin\Cities\CitiesRegionRepository;
use App\Repositories\Admin\Companies\CompaniesIconsRepository;

class CompaniesController extends AdminController
{
    public function __construct()
    {
        parent::__construct();

        $this->companyRepository = app(CompaniesRepository::class);
        $this->companyChildrenPagesRepository = app(CompanyChildrenPagesRepository::class);
        $this->cardsCategoriesRepository = app(CardsCategoriesRepository::class);
        $this->citiesRegionRepository = app(CitiesRegionRepository::class);
        $this->companiesIconsRepository = app(CompaniesIconsRepository::class);
        $this->companyReviewRepository = app(CompanyReviewRepository::class);
    }
    
    public function index()
    {
        $companies = $this->companyRepository->getForShow();

        $breadcrumbs = [
            ['h1' => 'Компании']
        ];

        return view('admin.companies.companies.index', compact('companies', 'breadcrumbs'));
    }

    public function create()
    {
        $cardCategories = $this->cardsCategoriesRepository->getForSelect();
        $companies = $this->companyRepository->getForSelect();
        $regions = $this->citiesRegionRepository->getForSelect();
        $icons = $this->companiesIconsRepository->getForSelect();

        $breadcrumbs = [
            ['h1' => 'Компании', 'link' => route('admin.companies.index')],
            ['h1' => 'Создание']
        ];

        return view('admin.companies.companies.create', compact('companies','regions', 'cardCategories', 'breadcrumbs', 'icons'));
    }

    public function store(CompanyRequest $request)
    {
        $data = $request->all();
        $data = empty_str_to_null($data);

        $data['alias'] = System::stripUrl($data['alias']);
        $data['icons'] = implode(',', $data['icons'] ?? []);
        $data['regions'] = implode(',', $data['regions'] ?? []);
//        $data['similars'] = implode(',', $data['similars'] ?? []);

        $company = new Companies($data);
        $result = $company->save();

        if (!$result) {
            return redirect()
                ->route('admin.companies.index')
                ->with('flash_errors', 'Ошибка создания!');
        }

        adminLog('Компании и инфо-страницы', $company->id, 'create');

        return redirect()
            ->route('admin.companies.index')
            ->with('flash_success', 'Cтраница компании успешно создана!');

    }

    public function edit($id)
    {
        $company = $this->companyRepository->getForEdit($id);

        $cardCategories = $this->cardsCategoriesRepository->getForSelect();
        $companies = $this->companyRepository->getForSelect();
        $regions = $this->citiesRegionRepository->getForSelect();
        $icons = $this->companiesIconsRepository->getForSelect();

        $breadcrumbs = [
            ['h1' => 'Компании', 'link' => route('admin.companies.index')],
            ['h1' => 'Редактирование']
        ];

        return view('admin.companies.companies.edit', compact('company', 'companies', 'regions', 'cardCategories', 'breadcrumbs', 'icons'));
    }


    public function update(CompanyRequest $request, $id)
    {
        $data = $request->all();
        $data = empty_str_to_null($data);

        $data['alias'] = System::stripUrl($data['alias']);
        $data['icons'] = implode(',', $data['icons'] ?? []);
        $data['regions'] = implode(',', $data['regions'] ?? []);
//        $data['similars'] = implode(',', $data['similars'] ?? []);

        $company = $this->companyRepository->getForEdit($id);

        $result = $company->update($data);

        if (!$result) {
            return redirect()
                ->route('admin.companies.index')
                ->with('flash_errors', 'Ошибка обновления!');
        }

        adminLog('Компании и инфо-страницы', $company->id, 'update');

        return redirect()
            ->route('admin.companies.index')
            ->with('flash_success', 'Cтраница компании успешно обновлена!');
    }

    public function destroy($id)
    {
        $company = $this->companyRepository->getForDelete($id);

        $companyChildren = $this->companyChildrenPagesRepository->getForShow($company->id);

        foreach ($companyChildren as $companyChild) {
            $companyChild->delete();
        }

        $this->companyReviewRepository->deleteByCompany($company->id);

        $result = $company->delete();

        if (!$result) {
            return redirect()
                ->route('admin.companies.index')
                ->with('flash_errors', 'Ошибка удаления!');
        }

        adminLog('Компании и инфо-страницы', $id, 'delete');

        return redirect()
            ->route('admin.companies.index')
            ->with('flash_success', 'Cтраница компании успешно удалена!');
    }
}
