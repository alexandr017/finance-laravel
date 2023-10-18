<?php

namespace App\Http\Controllers\Site\V3\Companies;

use App\Http\Controllers\Controller;
use App\Models\Companies\Companies;
use App\Algorithms\Frontend\Cards\OldCardsBoot;
use DB;
use Auth;
use App\Models\Companies\CompaniesChildrenPages;
use App\Models\Users\UsersMeta;
use App\Algorithms\SimilarCompanies;
use App\Algorithms\Frontend\Companies\Reviews\ReviewsCount;
use App\Models\Posts\Authors;

class CompanyController extends Controller
{
    public function index($companyAlias)
    {
        $company = Companies::where(['alias'=>$companyAlias, 'status'=>1])->first();

        if($company == null || !$company->status){
            abort(404);
        }

        $cards = OldCardsBoot::getCardsForListingByCompanyID($company->id);
        $cards = array_values($cards);



        $reviews = DB::table('companies_reviews')
            ->leftJoin('users_meta','users_meta.user_id','companies_reviews.uid')
            ->select('companies_reviews.*','users_meta.last_name', 'users_meta.first_name', 'users_meta.middle_name')
            ->where(['companies_reviews.company_id'=>$company->id,'companies_reviews.status'=>1])
            ->orderBy('companies_reviews.id', 'desc')
            ->get();

        $reviewsObj = new ReviewsCount($reviews);
        $complaintAllCount = $reviewsObj->getComplaintAllCount();
        $complaintAnswerCount = $reviewsObj->complaintAnswerCount();
        $countReviews = $reviewsObj->getAllReviewsAndComplaints();
        $reviews = $reviewsObj->getAllHierarchyReviews();


        $companiesChildrenPages = CompaniesChildrenPages::where(['company_id'=>$company->id])->get();

        $breadcrumbsGroup = 'mfo';
        $breadcrumbs = [];
        $breadcrumbsArr = explode("\n",$breadcrumbsGroup);
        $urlPath = '';

        $breadcrumbs [] = ['h1' => ($company->breadcrumb == null) ? $company->h1 : $company->breadcrumb];


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


        $similar_companies = SimilarCompanies::getSimilarCompanies($company);



        $icons = [];


        $blade = (!is_amp_page()) ? 'frontend.companies.company' : 'frontend.companies.company-amp';

        return view($blade,[
            'companiesChildrenPages' => $companiesChildrenPages,
            'company' => $company,
            'breadcrumbs' => $breadcrumbs,
            'cards' => $cards,
            'reviews' => $reviews,
            'countReviews' => $countReviews,
            'complaintAllCount' => $complaintAllCount,
            'complaintAnswerCount' => $complaintAnswerCount,
            'section_type' => 5,
            'uid' => $uid,
            'uidName' => $uidName,
            'editLink' => null,
            'similar_companies' => $similar_companies,
            'amp' => is_amp_page(),
            'icons' => $icons
        ]);
    }

}