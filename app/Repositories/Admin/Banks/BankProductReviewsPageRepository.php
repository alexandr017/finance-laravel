<?php

namespace App\Repositories\Admin\Banks;

use App\Repositories\Repository;
use App\Models\Banks\BankProductReviewsPage as Model;

class BankProductReviewsPageRepository extends Repository
{

    public function findByParentPageID($pageID)
    {
        return Model::where(['bank_product_id' => $pageID])
            ->whereNull('deleted_at')
            ->first();
    }

    public function findOrFail($id)
    {
        return Model::findOrFail($id);
    }

}
