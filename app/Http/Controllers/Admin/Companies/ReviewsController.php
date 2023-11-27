<?php

namespace App\Http\Controllers\Admin\Companies;

use App\Http\Controllers\Admin\Companies\BaseCompaniesController;
use Illuminate\Http\Request;
use App\Models\Companies\CompaniesReviews;
use Cache;
use App\Repositories\Admin\Companies\CompaniesRepository;
use App\Repositories\Admin\Companies\CompanyReviewRepository;
use App\Http\Requests\Admin\Companies\ReviewRequest;

class ReviewsController extends BaseCompaniesController
{
    public function __construct()
    {
        parent::__construct();
        $this->companyReviewRepository = app(CompanyReviewRepository::class);
        $this->companyRepository = app(CompaniesRepository::class);
    }

    public function index()
    {
        $reviews = $this->companyReviewRepository->getForShow();

        $breadcrumbs = [
            ['h1' => 'Компании', 'link' => route('admin.companies.index')],
            ['h1' => 'Отзывы']
        ];

    	return view('admin.companies.reviews.index', compact('reviews', 'breadcrumbs'));
    }

    public function reviews_by_company($id)
    {
        $reviews = $this->companyReviewRepository->getForShow($id);

        $breadcrumbs = [
            ['h1' => 'Компании', 'link' => route('admin.companies.index')],
            ['h1' => 'Редактирование', 'link' => route('admin.companies.edit', $id)],
            ['h1' => 'Отзывы по компании']
        ];

        return view('admin.companies.reviews.index', compact('reviews', 'breadcrumbs'));
    }

    public function search(Request $request)
    {
        $search = clear_data($request['search']);

        $reviews = $this->companyReviewRepository->getForSearch($search);

        $breadcrumbs = [
            ['h1' => 'Компании', 'link' => route('admin.companies.index')],
            ['h1' => 'Отзывы', 'link' => route('admin.companies.reviews.index')],
            ['h1' => 'Поиск по отзывам']
        ];

        return view('admin.companies.reviews.index', compact('search', 'reviews', 'breadcrumbs'));
    }


    public function create()
    {
        $companiesArr = $this->companyRepository->getForSelect();

        $breadcrumbs = [
            ['h1' => 'Компании', 'link' => route('admin.companies.index')],
            ['h1' => 'Отзывы', 'link' => route('admin.companies.reviews.index')],
            ['h1' => 'Создание']
        ];

    	return view('admin.companies.reviews.create', compact('companiesArr', 'breadcrumbs'));
    }

    public function store(ReviewRequest $request)
    {
        $data = $request->all();
        $data = empty_str_to_null($data);

        foreach (['review', 'pros', 'minuses'] as $textField) {
            $data[$textField] = preg_replace('/(?:"([^>]*)")(?!>)/', '«$1»', $data[$textField]);
            $data[$textField] = preg_replace('/(?:"([^>]*)")(?!>)/', '«$1»', $data[$textField]);
        }

        $review = new CompaniesReviews($data);
        $result = $review->save();

        if (!$result) {
            return redirect()
                ->route('admin.companies.reviews.index')
                ->with('flash_errors', 'Ошибка создания!');
        }

        adminLog('Отзывы компаний', $review->id, 'create');

        if(Cache::has('through_reviews')) Cache::forget('through_reviews');
        if(Cache::has('company_reviews'.$review->company_id)) Cache::forget('company_reviews'.$review->company_id);
        if(Cache::has('company_reviews_avg'.$review->company_id)) Cache::forget('company_reviews_avg'.$review->company_id);

        return redirect()
            ->route('admin.companies.reviews.index')
            ->with('flash_success', 'Отзыв успешно создан!');
    }

    public function edit($id)
    {
        $review = $this->companyReviewRepository->getForEdit($id);
        $companiesArr = $this->companyRepository->getForSelect();

        $breadcrumbs = [
            ['h1' => 'Компании', 'link' => route('admin.companies.index')],
            ['h1' => 'Отзывы', 'link' => route('admin.companies.reviews.index')],
            ['h1' => 'Редактирование']
        ];

        return view('admin.companies.reviews.edit', compact('review', 'companiesArr', 'breadcrumbs'));
    }

    public function update(ReviewRequest $request, $id)
    {
        $data = $request->all();
        $data = empty_str_to_null($data);

        foreach (['review', 'pros', 'minuses'] as $textField) {
            $data[$textField] = preg_replace('/(?:"([^>]*)")(?!>)/', '«$1»', $data[$textField]);
            $data[$textField] = preg_replace('/(?:"([^>]*)")(?!>)/', '«$1»', $data[$textField]);
        }

        $review = $this->companyReviewRepository->getForEdit($id);
        $result = $review->update($data);

        if (!$result) {
            return redirect()
                ->route('admin.companies.reviews.index')
                ->with('flash_errors', 'Ошибка обновления!');
        }

        if(Cache::has('through_reviews')) Cache::forget('through_reviews');
        if(Cache::has('company_reviews'.$review->company_id)) Cache::forget('company_reviews'.$review->company_id);
        if(Cache::has('company_reviews_avg'.$review->company_id)) Cache::forget('company_reviews_avg'.$review->company_id);

        adminLog('Отзывы компаний', $review->id, 'update');

        return redirect()
            ->route('admin.companies.reviews.index')
            ->with('flash_success', 'Отзыв успешно обновлен!');
    }

    public function destroy($id)
    {
        $review = $this->companyReviewRepository->getForDelete($id);
        $result = $review->delete();

        if (!$result) {
            return redirect()
                ->route('admin.companies.reviews.index')
                ->with('flash_errors', 'Ошибка удаления!');
        }

        if(Cache::has('company_reviews'.$review->company_id)) Cache::forget('company_reviews'.$review->company_id);
        if(Cache::has('company_reviews_avg'.$review->company_id)) Cache::forget('company_reviews_avg'.$review->company_id);
        if(Cache::has('through_reviews')) Cache::forget('through_reviews');

        adminLog('Отзывы компаний', $id, 'delete');

        return redirect()
            ->route('admin.companies.reviews.index')
            ->with('flash_success', 'Отзыв успешно удалён!');
    }


    public function change_status($id)
    {
        $review = $this->companyReviewRepository->getForEdit($id);
        $review->status = ($review->status == 1) ? 0 : 1;
        $review->save();

        if(Cache::has('company_reviews_avg'.$review->company_id)) Cache::forget('company_reviews_avg'.$review->company_id);

        adminLog('Отзывы компаний', $review->id, 'update');

        return redirect()
            ->route('admin.companies.reviews.index')
            ->with('flash_success', 'Статус успешно изменен!');
    }
}