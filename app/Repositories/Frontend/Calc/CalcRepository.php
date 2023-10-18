<?php

namespace App\Repositories\Frontend\Calc;

use App\Repositories\Repository;
use App\Models\Calc\Calc as Model;
use DB;

class CalcRepository extends Repository
{

    /**
     * @return mixed
     */
    public function findWithEnableStatusOrFail($id)
    {
        $item = Model::findOrFail($id);

        if (!$item->status) {
            abort(404);
        }

        $item->faq = DB::select("select id,question,answer from calc_faq where id in($item->faq)");

        if (!is_null($item->company_id)) {
            $item->company_id = DB::select("select * from companies where id=?",[$item->company_id]);
        }

        return $item;
    }



}
