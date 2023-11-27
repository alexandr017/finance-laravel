<?php

namespace App\Http\Controllers\Site\V3\Companies;

use App\Http\Controllers\Controller;
use App\Models\Companies\Companies;
use App\Algorithms\Frontend\Cards\OldCardsBoot;
use DB;
use App\Algorithms\SimilarCompanies;
use App\Algorithms\Frontend\Companies\Reviews\ReviewsCount;
use Illuminate\Contracts\View\View;

class CompanyController extends Controller
{
    public function index($companyAlias) : View
    {
        $company = Companies::where(['alias'=>$companyAlias, 'status'=>1])->first();

        if($company == null || !$company->status){
            abort(404);
        }

        $cards = OldCardsBoot::getCardsForListingByCompanyID($company->id);
        $cards = array_values($cards);


        $reviewsRaw = DB::table('companies_reviews')
            ->select('companies_reviews.*')
            ->where(['companies_reviews.company_id'=> $company->id,'companies_reviews.status' => 1])
            ->orderBy('companies_reviews.id', 'desc')
            ->get();
        $reviewsObj = new ReviewsCount($reviewsRaw);
        $reviews = $reviewsObj->getAllHierarchyReviews();

        $breadcrumbs = [
            ['link'=>'/mfo','h1'=> 'МФО'],
            ['h1' => ($company->breadcrumb == null) ? $company->h1 : $company->breadcrumb]
        ];

        $similar_companies = [];
        if (isset($cards[0])) {
            $similar_companies = SimilarCompanies::getSimilarCards($cards[0]);
        }

        $showContentMenu = true;
        $editLink = null;

        $blade = 'site.v3.templates.companies.company.company';

        return view($blade, compact('company', 'breadcrumbs', 'cards',
            'reviews', 'editLink', 'similar_companies', 'showContentMenu'));

    }

}