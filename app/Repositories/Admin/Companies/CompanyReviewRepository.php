<?php

namespace App\Repositories\Admin\Companies;

use App\Repositories\Repository;
use App\Models\Companies\CompaniesReviews;

class CompanyReviewRepository extends Repository
{
    const COMMENTS_PER_PAGE = 500;

    public function getForShow($companyId = null)
    {
        return CompaniesReviews::orderBy('id','desc')
            ->when($companyId, function ($query) use ($companyId) {
                $query->where('company_id', $companyId);
            })
            ->paginate(self::COMMENTS_PER_PAGE);
    }

    public function getForSearch($search)
    {
        return CompaniesReviews::where('review', 'like', '%' . $search . '%')
            ->orWhere('pros', 'like', '%' . $search . '%')
            ->orWhere('minuses', 'like', '%' . $search . '%')
            ->orWhere('answer', 'like', '%' . $search . '%')
            ->paginate(self::COMMENTS_PER_PAGE);
    }

    public function getForEdit($id)
    {
        return CompaniesReviews::findOrFail($id);
    }

    public function getForDelete($id)
    {
        return CompaniesReviews::findOrFail($id);
    }
    
    public function deleteByCompany($company_id)
    {
        return CompaniesReviews::where('company_id', $company_id)->delete();
    }
}
