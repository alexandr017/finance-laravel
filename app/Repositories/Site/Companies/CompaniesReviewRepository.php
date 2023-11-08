<?php

namespace App\Repositories\Site\Companies;

use App\Repositories\Repository;
use App\Models\Companies\CompaniesCategories;

use Cache;
use DB;


class CompaniesReviewRepository extends Repository
{
    public function getAvgAndCountReviewsByCompanyID($companyID)
    {

        $globalVariableName = "COMPANY_REVIEW_AVG_AND_COUNT_$companyID";

        global $$globalVariableName;

        if ($$globalVariableName != null) {
            return $$globalVariableName;
        }

        $reviews = Cache::rememberForever('company_reviews_avg'.$companyID, function() use($companyID){
            return DB::select("SELECT avg(rating) as avg_rating, count(rating) as count_rating FROM `companies_reviews` WHERE
                company_id = $companyID AND
                status = 1 AND
                rating is not null AND
                off_answer is null AND
                (parent_id is null OR parent_id = 0)");
        });


        if (isset($reviews[0])) {
            $$globalVariableName = [
                'ratingValue' => round($reviews[0]->avg_rating,2),
                'ratingCount' => $reviews[0]->count_rating
            ];
        } else {
            $$globalVariableName = [
                'ratingValue' => 0,
                'ratingCount' => 0
            ];
        }
        return $$globalVariableName;
    }
}
