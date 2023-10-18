<?php
namespace App\Shortcodes\Reviews;
use App\Shortcodes\BaseShortcode;
use DB;
use App\Repositories\Frontend\Companies\CompaniesReviewRepository;

class ReviewsCount extends BaseShortcode{

    public function register($shortcode, $content, $compiler, $name, $viewData = false)
    {

      	$id = (int) $shortcode->id;
      	$company_id = (int) $shortcode->company_id;

      	$bank_id = (int) $shortcode->bank_id;
      	$bank_category_id = (int) $shortcode->bank_category_id;
      	$bank_product_id = (int) $shortcode->bank_product_id;

      	if ($id == null &&  $company_id == null &&  $bank_id == null &&  $bank_category_id == null && $bank_product_id == null) {
            return 0;
        }

      	if ($id != 0) {
            $rating = (new CompaniesReviewRepository)->getAvgAndCountReviewsByCompanyID($id);
            return $rating['ratingCount'];
        }

        if ($company_id != 0) {
            $rating = (new CompaniesReviewRepository)->getAvgAndCountReviewsByCompanyID($company_id);;
            return $rating['ratingCount'];
        }


        // банковские (по банку / категории / продукту)
        if ($bank_id != null) {

            $reviews = DB::table('bank_reviews')
                ->select('*')
                ->where(['status' => 1, 'bank_id' => $bank_id])
                ->whereNull('deleted_at')
                ->orderBy('id','desc')
                ->get();

            return (count($reviews));

        }

        if ($bank_category_id != null) {

            $is_cashback = (bool) $shortcode->is_cashback;

            if ($is_cashback == false) {

                $reviews = DB::table('bank_reviews')
                    ->select('*')
                    ->where(['status' => 1, 'bank_category_id' => $bank_category_id])
                    ->whereNull('deleted_at')
                    ->orderBy('id','desc')
                    ->get();

            } else {

                $category = DB::table('bank_category_pages')
                    ->where(['id' => $bank_category_id])
                    ->first();

                if ($category == null) {
                    return 0;
                }

                $reviewsByCurrentCategory =  DB::table('bank_reviews')
                    ->leftjoin('banks','banks.id','bank_reviews.bank_id')
                    ->leftJoin('bank_products','bank_products.id','bank_reviews.product_id')
                    ->select('bank_reviews.*', 'banks.name as bankName', 'banks.logo as bankLogo', 'banks.alias as bankAlias','bank_products.product_name')
                    ->where(['bank_reviews.status' => 1, 'bank_reviews.bank_id' => $category->bank_id, 'bank_reviews.bank_category_id' => $bank_category_id])
                    ->whereNull('bank_reviews.deleted_at')
                    ->orderBy('bank_reviews.id','desk')
                    ->get();

                $reviewsByProducts =  DB::table('bank_reviews')
                    ->leftjoin('banks','banks.id','bank_reviews.bank_id')
                    ->leftJoin('bank_products','bank_products.id','bank_reviews.product_id')
                    ->select('bank_reviews.*', 'banks.name as bankName', 'banks.logo as bankLogo', 'banks.alias as bankAlias','bank_products.product_name')
                    ->where(['bank_reviews.status' => 1, 'bank_reviews.bank_id' => $category->bank_id, 'bank_products.is_cashback' => 1])
                    ->whereNull('bank_reviews.deleted_at')
                    ->orderBy('bank_reviews.id','desk')
                    ->get();

                $reviews = $reviewsByCurrentCategory->merge($reviewsByProducts);
            }

            return (count($reviews));

        }

        if ($bank_product_id != null) {

            $reviews = DB::table('bank_reviews')
                ->select('*')
                ->where(['status' => 1, 'product_id' => $bank_product_id])
                ->whereNull('deleted_at')
                ->orderBy('id','desc')
                ->get();

            return (count($reviews));
        }


    }


}