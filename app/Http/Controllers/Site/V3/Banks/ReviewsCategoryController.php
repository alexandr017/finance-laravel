<?php

namespace App\Http\Controllers\Site\V3\Banks;

use App\Models\Banks\Bank;
use App\Models\Banks\BankCategoryReviewsPage;
use DB;
use App\Algorithms\Frontend\Cards\CardsBoot;

use App\Algorithms\General\Banks\ProductScaleNames;
use App\Algorithms\Frontend\Banks\ProductScaleRender;

use Config;

use App\Algorithms\Frontend\Companies\Reviews\ReviewsCount;
use Auth;
use App\Models\Users\UsersMeta;

class ReviewsCategoryController extends BaseBankController
{
    private $IS_CASH_BACK_CATEGORY = 9;

    public function index($bankAlias)
    {
        $categoryAlias = request()->segment(count(request()->segments()) - 1);

        return $this->render($bankAlias, $categoryAlias, 'reviews');
    }

    public function amp($bankAlias)
    {
        $categoryAlias = request()->segment(count(request()->segments()) - 2);

        return $this->render($bankAlias, $categoryAlias, 'reviews-amp');
    }


    private function render($bankAlias, $categoryAlias, $template)
    {
        $bankAlias = clear_data($bankAlias);
        $categoryAlias = clear_data($categoryAlias);

        $bank = Bank::where(['alias' =>$bankAlias, 'status' => 1])->first();
        if ($bank == null) {
            abort(404);
        }

        $category = DB::table('bank_category_pages')
            ->leftJoin('cards_categories','cards_categories.id','bank_category_pages.category_id')
            ->select('bank_category_pages.*', 'cards_categories.breadcrumb as categoryBreadcrumb')
            ->where(['cards_categories.bank_alias' => $categoryAlias, 'bank_category_pages.bank_id' => $bank->id, 'bank_category_pages.status' => 1])
            ->whereNull('bank_category_pages.deleted_at')
            ->first();
        if ($category == null) {
            abort(404);
        }

        $page = BankCategoryReviewsPage::where(['bank_category_page_id' => $category->id, 'status' => 1])->first();
        if ($page == null) {
            abort(404);
        }




        $breadcrumbs = [];
        $breadcrumbs[] = ['h1' => 'Банки', 'link' => '/banki'];
        $breadcrumbs[] = ['h1' => $bank->breadcrumb ?? $bank->name, 'link' => '/banki/'.$bank->alias];
        $breadcrumbs[] = ['h1' => $category->categoryBreadcrumb ?? $category->h1, 'link' => '/banki/'.$bank->alias.'/'.$categoryAlias];
        $breadcrumbs[] = ['h1' => 'Отзывы'];


        if ($category->category_id != $this->IS_CASH_BACK_CATEGORY) {
            $reviews =  DB::table('bank_reviews')
                ->leftjoin('banks','banks.id','bank_reviews.bank_id')
                ->leftJoin('bank_products','bank_products.id','bank_reviews.product_id')
                ->select('bank_reviews.*', 'banks.name as bankName', 'banks.logo as bankLogo', 'banks.alias as bankAlias','bank_products.product_name')
                ->where(['bank_reviews.status' => 1, 'bank_reviews.bank_id' => $bank->id, 'bank_reviews.bank_category_id' => $category->id])
                ->whereNull('bank_reviews.deleted_at')
                ->orderBy('bank_reviews.id','desk')
                ->get();
        } else {
            $reviewsByCurrentCategory =  DB::table('bank_reviews')
                ->leftjoin('banks','banks.id','bank_reviews.bank_id')
                ->leftJoin('bank_products','bank_products.id','bank_reviews.product_id')
                ->select('bank_reviews.*', 'banks.name as bankName', 'banks.logo as bankLogo', 'banks.alias as bankAlias','bank_products.product_name')
                ->where(['bank_reviews.status' => 1, 'bank_reviews.bank_id' => $bank->id, 'bank_reviews.bank_category_id' => $category->id])
                ->whereNull('bank_reviews.deleted_at')
                ->orderBy('bank_reviews.id','desk')
                ->get();

            $reviewsByProducts =  DB::table('bank_reviews')
                ->leftjoin('banks','banks.id','bank_reviews.bank_id')
                ->leftJoin('bank_products','bank_products.id','bank_reviews.product_id')
                ->select('bank_reviews.*', 'banks.name as bankName', 'banks.logo as bankLogo', 'banks.alias as bankAlias','bank_products.product_name')
                ->where(['bank_reviews.status' => 1, 'bank_reviews.bank_id' => $bank->id, 'bank_products.is_cashback' => 1])
                ->whereNull('bank_reviews.deleted_at')
                ->orderBy('bank_reviews.id','desk')
                ->get();

            $reviews = $reviewsByCurrentCategory->merge($reviewsByProducts);
            //ddd($reviewsByCurrentCategory,$reviewsByProducts);
        }





        $reviewsObj = new ReviewsCount($reviews);
        $complaintAllCount = $reviewsObj->getComplaintAllCount();
        $complaintAnswerCount = $reviewsObj->complaintAnswerCount();
        $countReviews = $reviewsObj->getAllReviewsAndComplaints();
        $reviews = $reviewsObj->getAllHierarchyReviews();
        $reviewsCats =  DB::table('bank_reviews')
            ->leftJoin('bank_products','bank_products.id','bank_reviews.product_id')
            ->select('bank_products.product_name','bank_products.id')
            ->where(['bank_reviews.status' => 1, 'bank_reviews.off_answer' => null, 'bank_reviews.bank_id' => $bank->id, 'bank_reviews.bank_category_id' => $category->id])
            ->where('bank_products.product_name','!=', null)
            ->whereNull('bank_reviews.deleted_at')
            ->groupBy('bank_products.product_name')
            ->get();
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
        $template = 'frontend.banks.info-pages.' . $template;
        
        $editLink = null;
        $categoryId = $category->id;

        return view($template, compact('categoryId','reviewsCats','bankTopCard','page','bank','breadcrumbs','reviews','complaintAllCount', 'complaintAnswerCount',
            'uid','uidName','countReviews', 'editLink'));
    }


}