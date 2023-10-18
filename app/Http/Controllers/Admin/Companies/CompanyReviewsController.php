<?php

namespace App\Http\Controllers\Admin\Companies;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\Admin\Companies\CompanyReviewRequest;
use App\Repositories\Admin\Companies\CompanyReviewsRepository;
use App\Repositories\Admin\Companies\CompaniesRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CompanyReviewsController extends AdminController
{
    private mixed $companyReviewsRepository;

    private mixed $companiesRepository;

    public function __construct()
    {
        $this->companyReviewsRepository = new CompanyReviewsRepository;

        $this->companiesRepository = new CompaniesRepository;
    }

    /**
     * Display a listing of the resource.
     * @return View
     */
    public function index() : View
    {
        $reviews = $this->companyReviewsRepository->getAllReviewsForShow();

        $breadcrumbs = [['h1' => 'Отзывы']];

        return view('admin.v2.companies.reviews.index', compact('reviews', 'breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     * @return View
     */
    public function create() : View
    {
        $breadcrumbs = [
            ['h1' => 'Отзывы', 'link' => route('admin.company-reviews.index')],
            ['h1' => 'Создание']
        ];

        $schools = $this->companiesRepository->getCompaniesForSelect();

        return view('admin.v2.companies.reviews.create', compact( 'schools', 'breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     * @param CompanyReviewRequest $request
     * @return RedirectResponse
     */
    public function store(CompanyReviewRequest $request) : RedirectResponse
    {
        $errors = $request->getErrors();
        if (count($errors) > 0) {
            return back()->withInput()->with('flash_warning', json_encode($errors));
        }

        $errors = $request->getErrors();
        if (count($errors) > 0) {
            return back()->withInput()->with('flash_warning', json_encode($errors));
        }

        $data = $request->all();
        $data = emptyDataToNull($data);

        $result = $this->companyReviewsRepository->createReview($data);

        if ($result) {
            return redirect()
                ->route('admin.company-reviews.index')
                ->with('flash_success', 'Отзыв создан!');
        } else {
            return redirect()
                ->route('admin.company-reviews.index')
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
        $item = $this->companyReviewsRepository->find($id);

        if ($item == null) {
            abort(404);
        }

        $breadcrumbs = [
            ['h1' => 'Отзывы', 'link' => route('admin.company-reviews.index')],
            ['h1' => 'Редактирование'],
        ];

        return view('admin.v2.companies.reviews.edit', compact('item', 'breadcrumbs'));
    }

    /**
     * Update the specified resource in storage.
     * @param CompanyReviewRequest $request
     * @param string $id
     * @return RedirectResponse
     */
    public function update(CompanyReviewRequest $request, string $id) : RedirectResponse
    {
        $errors = $request->getErrors();
        if (count($errors) > 0) {
            return back()->withInput()->with('flash_warning', json_encode($errors));
        }

        $data = $request->all();
        $data = emptyDataToNull($data);
        $result = $this->companyReviewsRepository->updateReview($id, $data);

        if ($result) {
            return redirect()
                ->route('admin.company-reviews.index')
                ->with('flash_success', 'Отзыв обнавлена!');
        } else {
            return redirect()
                ->route('admin.company-reviews.index')
                ->with('flash_errors', 'Отзыв обновления!');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param string $id
     * @return RedirectResponse
     */
    public function destroy(string $id) : RedirectResponse
    {
        $result = $this->companyReviewsRepository->deleteReview($id);

        if ($result) {
            return redirect()
                ->route('admin.company-reviews.index')
                ->with('flash_success', 'Отзыв удален!');
        } else {
            return redirect()
                ->route('admin.company-reviews.index')
                ->with('flash_errors', 'Ошибка удаления!');
        }
    }
}
