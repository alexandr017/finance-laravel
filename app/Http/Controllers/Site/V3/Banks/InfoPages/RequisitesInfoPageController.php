<?php

namespace App\Http\Controllers\Site\V3\Banks\InfoPages;

use App\Http\Controllers\Site\V3\Banks\BaseBankController;

use App\Models\Banks\BankInfoPage;
use App\Models\Banks\Bank;
use DB;

class RequisitesInfoPageController extends BaseBankController
{
    public function index($bankAlias)
    {
        return $this->render($bankAlias, 'page');
    }

    public function amp($bankAlias)
    {
        return $this->render($bankAlias, 'page-amp');
    }


    private function render($bankAlias, $template)
    {
        $bankAlias = clear_data($bankAlias);

        $bank = Bank::where(['alias' =>$bankAlias, 'status' => 1])->first();

        if ($bank == null) {
            abort(404);
        }

        $page = BankInfoPage::where(['bank_id' =>$bank->id,'type_id' => 5, 'status' => 1])->first();

        if ($page == null) {
            abort(404);
        }

        $breadcrumbs = [];
        $breadcrumbs[] = ['h1' => 'Банки', 'link' => '/banki'];
        $breadcrumbs[] = ['h1' => $bank->breadcrumb ?? $bank->name, 'link' => '/banki/'.$bank->alias];
        $breadcrumbs[] = ['h1' => 'Реквизиты'];


        $template = 'site.v3.templates.banks.info-pages.' . $template;

        $editLink =null;


        $reviews = DB::table('bank_reviews')
            ->select('*')
            ->where(['status' => 1, 'bank_id' => $bank->id])
            ->whereNull('deleted_at')
            ->orderBy('id','desc')
            ->get();


        return view($template, compact('page','bank','breadcrumbs', 'editLink', 'reviews'));
    }
}
