<?php

namespace App\Http\Controllers\Site\V3\Companies;

use App\Http\Controllers\Controller;
use Auth;
use DB;
use App\Models\Companies\CompaniesChildrenPages;
use App\Models\Companies\Companies;
use App\Models\Cards\Cards;
use App\Algorithms\Frontend\Cards\OldCardsBoot;
use App\Models\Users\UsersMeta;
use App\Algorithms\Frontend\Companies\Reviews\ReviewsCount;

class CompanyPageController extends Controller
{
    public function gorjachajaLinija($companyAlias)
    {
        $pageType = 1;
        return $this->render($companyAlias, $pageType);
    }

    public function lichnyjKabinet($companyAlias)
    {
        $pageType = 2;
        return $this->render($companyAlias, $pageType);
    }

    public function otzyvy($companyAlias)
    {
        $pageType = 4;
        return $this->render($companyAlias, $pageType);
    }


    public function render($companyAlias, $pageType)
    {
        $amp = is_amp_page();

        $company = Companies::where(['alias'=> $companyAlias, 'status'=>1])->first();
        if ($company == null) {
            abort(404);
        };


        $page = CompaniesChildrenPages::where(['company_id' => $company->id, 'type_id' => $pageType, 'status' => 1])->first();
        if ($page == null) {
            abort(404);
        };

        $companiesChildrenPages = CompaniesChildrenPages::where(['company_id'=>$company->id])->get();


        $editLink = null;

        $card = Cards::where(['company_id' => $company->id])
            ->select('id','category_id','logo','title','link_1','link_2','link_type','status')
            ->orderBy('km5','desc')
            ->first();

        $cards = OldCardsBoot::getCardsForListingByCompanyID($company->id);
        
        $reviews = DB::table('companies_reviews')
            ->leftJoin('users_meta','users_meta.user_id','companies_reviews.uid')
            ->leftJoin('companies','companies.id','companies_reviews.company_id')
            ->select('companies_reviews.*','users_meta.last_name', 'users_meta.first_name', 'users_meta.middle_name','companies.img')
            ->where(['companies_reviews.company_id'=>$company->id,'companies_reviews.status'=>1])
            ->orderBy('companies_reviews.id', 'desc')
            ->get();

        $reviewsObj = new ReviewsCount($reviews);
        $complaintAllCount = $reviewsObj->getComplaintAllCount();
        $complaintAnswerCount = $reviewsObj->complaintAnswerCount();
        $countReviews = $reviewsObj->getAllReviewsAndComplaints();
        $reviews = $reviewsObj->getAllHierarchyReviews();

        $breadcrumbs = [
            ['link'=>'/mfo','h1'=> 'Все МФО'],
            ['link'=>'/mfo/'. $company->alias, 'h1' => $company->breadcrumb],
            ['h1' => $page->breadcrumb],
        ];

        $showContentMenu = true;


        if($page->type_id != 4){
            $blade = ($amp==false) ? 'site.v3.templates.companies.children.children' : 'site.v3.templates.companies.children.children-amp';

            return view($blade, compact('company','breadcrumbs',
                'page','editLink','card','amp', 'cards', 'reviews', 'companiesChildrenPages', 'showContentMenu'));

        } else {

            $uid = Auth::id();
            $uidName = '';
            if($uid != null){
                $userMeta = UsersMeta::where(['user_id'=>$uid])->first();
                $uidName = $userMeta == null
                    ? 'Гость'
                    : $userMeta->last_name . ' ' . $userMeta->first_name . ' ' . $userMeta->middle_name;

            }

            $blade = ($amp==false) ? 'site.v3.templates.companies.reviews.reviews' : 'site.v3.templates.companies.reviews.reviews-amp';

            return view($blade, compact('company','breadcrumbs','reviews', 'complaintAllCount', 'complaintAnswerCount',
                'page','uid','uidName','editLink','countReviews','card','cards','amp', 'companiesChildrenPages'));
        }
    }


}
