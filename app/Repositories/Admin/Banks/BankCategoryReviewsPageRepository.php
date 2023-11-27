<?php

namespace App\Repositories\Admin\Banks;

use App\Repositories\Repository;
use App\Models\Banks\BankCategoryReviewsPage as Model;

class BankCategoryReviewsPageRepository extends Repository
{

    public function findByParentPageID($pageID)
    {
        return Model::where(['bank_category_page_id' => $pageID])
            ->whereNull('deleted_at')
            ->first();
    }

    public function findOrFail($id)
    {
        return Model::findOrFail($id);
    }

}
