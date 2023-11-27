<?php

namespace App\Http\Controllers\Site\V3\Banks\InfoPages;

use App\Http\Controllers\Site\V3\Banks\BaseBankController;
use App\Models\Banks\BankInfoPage;
use App\Models\Banks\BankCategoryPage;
use App\Repositories\Site\Bank\BankInfoPageRepository;
use App\Repositories\Site\Bank\BankRepository;
use DB;
use App\Algorithms\Frontend\Companies\Reviews\ReviewsCount;
use Illuminate\Contracts\View\View;

class ReviewsPageController extends BaseBankController
{
    public function index($bankAlias): View
    {
        return $this->render($bankAlias, 'reviews');
    }

    public function amp($bankAlias): View
    {
        return $this->render($bankAlias, 'reviews-amp');
    }

    private function render($bankAlias, $template): View
    {
        $bankAlias = clear_data($bankAlias);
        $bank = (new BankRepository)->getBankByAlias($bankAlias);
        if($bank != null) {
            $bank_categories = BankCategoryPage::select(['id','breadcrumb','category_id','h1'])->where(['bank_id' =>$bank->id, 'status' => 1])->get();
        }

        if ($bank == null) {
            abort(404);
        }

        $page = (new BankInfoPageRepository)->getBankByAlias($bank->id, 4);
        if ($page == null) {
            abort(404);
        }


        $breadcrumbs = [];
        $breadcrumbs[] = ['h1' => 'Банки', 'link' => '/banki'];
        $breadcrumbs[] = ['h1' => $bank->breadcrumb ?? $bank->name, 'link' => '/banki/'.$bank->alias];
        $breadcrumbs[] = ['h1' => 'Отзывы'];

        $reviewsForGet =  DB::table('bank_reviews')
            ->leftjoin('banks','banks.id','bank_reviews.bank_id')
            ->leftjoin('bank_category_pages','bank_reviews.bank_category_id','bank_category_pages.id')
            ->select('bank_reviews.*', 'banks.name as bankName', 'banks.logo as bankLogo', 'banks.alias as bankAlias','bank_category_pages.category_id')
            ->where(['bank_reviews.status' => 1,  'bank_reviews.bank_id' => $bank->id])
            // убрал 'bank_reviews.off_answer' => null,
            ->whereNull('bank_reviews.deleted_at')
            ->orderBy('bank_reviews.id','desc');
        $reviews = $reviewsForGet->get();
        $reviewCatForGet = $reviewsForGet->groupBy('category_id');
        $reviewCats = $reviewCatForGet->get();
        $reviewCategories = [];
        foreach ($reviewCats as $reviewCat) {
            $reviewCategories[] = $reviewCat->category_id;
        }
        $reviewsObj = new ReviewsCount($reviews);
        $complaintAllCount = $reviewsObj->getComplaintAllCount();
        $complaintAnswerCount = $reviewsObj->complaintAnswerCount();
        $countReviews = $reviewsObj->getAllReviewsAndComplaints();
        $reviews = $reviewsObj->getAllHierarchyReviews();


        $editLink = null;

        $template = 'site.v3.templates.banks.info-pages.' . $template;
        return view($template, compact('page','bank','breadcrumbs','reviews','complaintAllCount', 'complaintAnswerCount',
           'countReviews', 'editLink','bank_categories','reviewCategories'));
    }
}
