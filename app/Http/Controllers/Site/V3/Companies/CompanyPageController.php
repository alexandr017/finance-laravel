<?php

namespace App\Http\Controllers\Site\V3\Companies;

use App\Http\Controllers\Controller;
use Auth;
use DB;
use App\Models\Companies\CompaniesChildrenPages;
use App\Models\Companies\Companies;
use App\Algorithms\RatingRandom;
use App\Models\Cards\Cards;
use App\Algorithms\Frontend\Cards\OldCardsBoot;
use App\Models\Users\UsersMeta;
use App\Algorithms\Frontend\Companies\Reviews\ReviewsCount;
use App\Models\Posts\Authors;

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
        $amp = false;

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

        if ($page->type_id == 4) {
            $breadcrumb_h1 = ($page->breadcrumb != null) ? $page->breadcrumb : 'Отзывы';
        } else {
            $breadcrumb_h1 = ($page->breadcrumb != null) ? $page->breadcrumb : $page->h1;
        }

        $breadcrumbs = [];
        $cardsCategory = DB::table('cards_categories')->where(['id' => $company->card_category_id])->first();
        if ($cardsCategory != null) {
            $companyBreadcrumb = $cardsCategory->breadcrumb;
            $companyAlias = $cardsCategory->alias;
            if ($companyAlias == '/') {
                $breadcrumbs [] = ['link'=>'/'. $company->alias ,'h1' => ($company->breadcrumb == null) ? $company->h1 : $company->breadcrumb];
                $breadcrumbs [] = ['h1' => $breadcrumb_h1];
            } else {
                $breadcrumbs [] = ['link'=>'/'.$companyAlias,'h1'=>$companyBreadcrumb];
                $breadcrumbs [] = ['link'=>'/'.$companyAlias . '/'. $company->alias , 'h1' => ($company->breadcrumb == null) ? $company->h1 : $company->breadcrumb];
                $breadcrumbs [] = ['h1' => $breadcrumb_h1];
            }

        }


        if($page->type_id != 4){
            $author = Authors::find($company->author_id);
            $blade = ($amp==false) ? 'frontend.companies.children' : 'frontend.companies.children-amp';

            return view($blade, compact('company','breadcrumbs',
                'page','editLink','card','amp', 'cards', 'reviews', 'companiesChildrenPages')); // ! 'cards', 'reviews'

        } else {

            $uid = Auth::id();
            $uidName = '';
            if($uid != null){
                $userMeta = UsersMeta::where(['user_id'=>$uid])->first();
                $uidName = $userMeta == null
                    ? 'Гость'
                    : $userMeta->last_name . ' ' . $userMeta->first_name . ' ' . $userMeta->middle_name;

            }

            $author = Authors::find($company->author_id);

            $blade = ($amp==false) ? 'frontend.companies.reviews' : 'frontend.companies.reviews-amp';
            return view($blade, compact('company','breadcrumbs','reviews', 'complaintAllCount', 'complaintAnswerCount',
                'page','uid','uidName','editLink','countReviews','card','cards','amp', 'companiesChildrenPages'));
        }
    }


}
