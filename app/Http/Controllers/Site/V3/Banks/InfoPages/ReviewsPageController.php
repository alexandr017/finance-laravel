<?php

namespace App\Http\Controllers\Site\V3\Banks\InfoPages;

use App\Algorithms\Frontend\Cards\CardsBoot;
use App\Http\Controllers\Frontend\Banks\BaseBankController;

use App\Models\Banks\BankInfoPage;
use App\Models\Banks\Bank;
use App\Models\Banks\BankCategoryPage;
use DB;
use App\Algorithms\Frontend\Companies\Reviews\ReviewsCount;
use Auth;
use App\Models\Users\UsersMeta;

class ReviewsPageController extends BaseBankController
{
    public function index($bankAlias)
    {
        return $this->render($bankAlias, 'reviews');
    }

    public function amp($bankAlias)
    {
        return $this->render($bankAlias, 'reviews-amp');
    }


    private function render($bankAlias, $template)
    {
        $bankAlias = clear_data($bankAlias);
        $bank = Bank::where(['alias' =>$bankAlias, 'status' => 1])->first();
        if($bank != null) {
            $bank_categories = BankCategoryPage::select('id','breadcrumb','category_id','h1')->where(['bank_id' =>$bank->id, 'status' => 1])->get();
        }
        if ($bank == null) {
            abort(404);
        }

        $page = BankInfoPage::where(['bank_id' =>$bank->id,'type_id' => 4, 'status' => 1])->first();
        if ($page == null) {
            abort(404);
        }


        $breadcrumbs = [];
        $breadcrumbs[] = ['h1' => 'Банки', 'link' => '/banks'];
        $breadcrumbs[] = ['h1' => $bank->breadcrumb ?? $bank->name, 'link' => '/banks/'.$bank->alias];
        $breadcrumbs[] = ['h1' => 'Отзывы'];
//        $reviews =  DB::table('bank_reviews')
//            ->leftjoin('banks','banks.id','bank_reviews.bank_id')
//            ->leftjoin('bank_category_pages','bank_reviews.bank_category_id','bank_category_pages.id')
//            ->select('bank_reviews.*', 'banks.name as bankName', 'banks.logo as bankLogo', 'banks.alias as bankAlias','bank_category_pages.category_id')
//            ->where(['bank_reviews.status' => 1,  'bank_reviews.bank_id' => $bank->id])
//            // убрал 'bank_reviews.off_answer' => null,
//            ->whereNull('bank_reviews.deleted_at')
//            ->orderBy('bank_reviews.id','desk')
//            ->get();
        $reviewsForGet =  DB::table('bank_reviews')
            ->leftjoin('banks','banks.id','bank_reviews.bank_id')
            ->leftjoin('bank_category_pages','bank_reviews.bank_category_id','bank_category_pages.id')
            ->select('bank_reviews.*', 'banks.name as bankName', 'banks.logo as bankLogo', 'banks.alias as bankAlias','bank_category_pages.category_id')
            ->where(['bank_reviews.status' => 1,  'bank_reviews.bank_id' => $bank->id])
            // убрал 'bank_reviews.off_answer' => null,
            ->whereNull('bank_reviews.deleted_at')
            ->orderBy('bank_reviews.id','desk');
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


        $uid = Auth::id();
        $uidName = '';
        if($uid != null){
            $userMeta = UsersMeta::where(['user_id'=>$uid])->first();
            if($userMeta == null){
                $uidName = 'Гость';
            } else {
                $uidName = $userMeta->last_name . ' ' . $userMeta->first_name . ' ' . $userMeta->middle_name;
            }
        }

        $template = 'frontend.banks.info-pages.' . $template;

        $editLink = null;
        $bankTopCard = DB::table('bank_product_cards')
            ->leftJoin('bank_products','bank_products.id','bank_product_cards.bank_product_id')
            ->leftJoin('banks','banks.id', 'bank_products.bank_id')
            ->leftJoin('bank_category_pages','bank_category_pages.id','bank_products.bank_category_id')
            ->leftJoin('cards','cards.id','bank_product_cards.card_id')
            ->select('cards.id','cards.link_type','cards.link_1','cards.link_2','cards.title')
            ->where(['cards.status' => 1, 'banks.id' => $bank->id])
            ->whereNull('bank_products.deleted_at')
            ->whereNull('bank_category_pages.deleted_at')
            ->orderBy("cards.flow", 'asc')
            ->orderBy("cards.km5", 'desc')
            ->orderBy("cards.id", 'asc')
            ->first();
        return view($template, compact('page','bank','bankTopCard','breadcrumbs','reviews','complaintAllCount', 'complaintAnswerCount',
            'uid','uidName','countReviews', 'editLink','bank_categories','reviewCategories'));
    }
}
