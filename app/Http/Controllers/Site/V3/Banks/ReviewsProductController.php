<?php

namespace App\Http\Controllers\Site\V3\Banks;

use App\Models\Banks\Bank;
use App\Models\Banks\BankProductReviewsPage;
use DB;
use App\Algorithms\Frontend\Cards\CardsBoot;

use App\Algorithms\General\Banks\ProductScaleNames;
use App\Algorithms\Frontend\Banks\ProductScaleRender;

use Config;

use App\Algorithms\Frontend\Companies\Reviews\ReviewsCount;
use Auth;
use App\Models\Users\UsersMeta;

class ReviewsProductController extends BaseBankController
{
    public function index($bankAlias, $productAlias)
    {
        $categoryAlias = request()->segment(count(request()->segments()) - 2);

        return $this->render($bankAlias, $categoryAlias, $productAlias, 'reviews');
    }

    public function amp($bankAlias, $productAlias)
    {
        $categoryAlias = request()->segment(count(request()->segments()) - 3);

        return $this->render($bankAlias, $categoryAlias, $productAlias, 'reviews-amp');
    }


    private function render($bankAlias, $categoryAlias, $productAlias, $template)
    {
        $bankAlias = clear_data($bankAlias);
        $categoryAlias = clear_data($categoryAlias);
        $productAlias = clear_data($productAlias);


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


        $product = DB::table('bank_products')
            ->where(['status' => 1, 'alias' => $productAlias, 'bank_category_id' => $category->id])
            ->whereNull('deleted_at')
            ->first();


        if ($product == null) {
            abort(404);
        }


        $page = BankProductReviewsPage::where(['bank_product_id' => $product->id, 'status' => 1])->first();

        if ($page == null) {
            abort(404);
        }

        $breadcrumbs = [];
        $breadcrumbs[] = ['h1' => 'Банки', 'link' => '/banks'];
        $breadcrumbs[] = ['h1' => $bank->breadcrumb ?? $bank->name, 'link' => '/banks/'.$bank->alias];
        $breadcrumbs[] = ['h1' => $category->categoryBreadcrumb ?? $category->h1, 'link' => '/banks/'.$bank->alias.'/'.$categoryAlias];
        $breadcrumbs[] = ['h1' => $product->breadcrumb ?? $product->h1, 'link' => '/banks/'.$bank->alias.'/'.$categoryAlias.'/'.$product->alias];
        $breadcrumbs[] = ['h1' => 'Отзывы'];



        $reviews =  DB::table('bank_reviews')
            ->leftjoin('banks','banks.id','bank_reviews.bank_id')
            ->select('bank_reviews.*', 'banks.name as bankName', 'banks.logo as bankLogo', 'banks.alias as bankAlias')
            ->where(['bank_reviews.status' => 1,  'bank_id' => $bank->id, 'bank_category_id' => $category->id, 'product_id' => $product->id])
            // 'bank_reviews.off_answer' => null,
            ->whereNull('bank_reviews.deleted_at')
            ->orderBy('bank_reviews.id','desk')
            ->get();

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
        return view($template, compact('categoryId','bankTopCard','page','bank','breadcrumbs','reviews','complaintAllCount', 'complaintAnswerCount',
            'uid','uidName','countReviews', 'editLink'));
    }


}