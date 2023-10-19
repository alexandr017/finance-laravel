<?php

namespace App\Http\Controllers\Site\V3\Actions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Algorithms\Frontend\Companies\Reviews\ReviewsCount;

class ReviewsController extends Controller
{
    public function sorting(Request $request)
    {
        $company_id = (int) clear_data($request['company_id']);
        $sort_type = clear_data($request['sort_type']);
        $sort_field = clear_data($request['sort_field']);

        $s_field = ($sort_field == 'date') ? 'id' : 'rating';

        $reviews = DB::table('companies_reviews')
            ->leftJoin('users_meta','users_meta.user_id','companies_reviews.uid')
            ->select('companies_reviews.*','users_meta.last_name', 'users_meta.first_name', 'users_meta.middle_name')
            ->where(['companies_reviews.company_id' => $company_id,'companies_reviews.status' => 1])
            ->orderBy("companies_reviews.$s_field", $sort_type)
            ->get();


        $reviewsObj = new ReviewsCount($reviews);
        $reviews = $reviewsObj->getAllHierarchyReviews();


        return view('site.v3.modules.companies.reviews_includes.render', compact('reviews'))->render();
    }


}
