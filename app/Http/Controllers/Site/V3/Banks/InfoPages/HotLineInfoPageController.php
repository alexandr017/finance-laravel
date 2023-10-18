<?php

namespace App\Http\Controllers\Site\V3\Banks\InfoPages;

use App\Http\Controllers\Frontend\Banks\BaseBankController;

use App\Models\Banks\BankInfoPage;
use App\Models\Banks\Bank;
use DB;

class HotLineInfoPageController extends BaseBankController
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

        $page = BankInfoPage::where(['bank_id' =>$bank->id, 'type_id' => 1, 'status' => 1])->first();


        if ($page == null) {
            abort(404);
        }

        $breadcrumbs = [];
        $breadcrumbs[] = ['h1' => 'Банки', 'link' => '/banks'];
        $breadcrumbs[] = ['h1' => $bank->breadcrumb ?? $bank->name, 'link' => '/banks/'.$bank->alias];
        $breadcrumbs[] = ['h1' => 'Служба поддержки'];


        $template = 'frontend.banks.info-pages.' . $template;

        $editLink = null;
        $bankTopCard = DB::table('bank_product_cards')
            ->leftJoin('bank_products','bank_products.id','bank_product_cards.bank_product_id')
            ->leftJoin('banks','banks.id', 'bank_products.bank_id')
            ->leftJoin('bank_category_pages','bank_category_pages.id','bank_products.bank_category_id')
            ->leftJoin('cards','cards.id','bank_product_cards.card_id')
            ->select('cards.id','cards.link_type','cards.link_1','cards.link_2','cards.title')
            ->where(['cards.status' => 1, 'banks.id' => $bank->id])
            ->whereNull('bank_products.deleted_at')
            ->whereNull('bank_category_pages.deleted_at')
            ->orderBy("cards.flow", 'asc')
            ->orderBy("cards.km5", 'desc')
            ->orderBy("cards.id", 'asc')
            ->first();


        $reviews = DB::table('bank_reviews')
            ->select('*')
            ->where(['status' => 1, 'bank_id' => $bank->id])
            ->whereNull('deleted_at')
            ->orderBy('id','desc')
            ->get();

        return view($template, compact('page','bank','breadcrumbs', 'editLink','bankTopCard','reviews'));
    }
}
