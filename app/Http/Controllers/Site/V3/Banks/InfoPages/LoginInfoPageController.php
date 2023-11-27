<?php

namespace App\Http\Controllers\Site\V3\Banks\InfoPages;

use App\Http\Controllers\Site\V3\Banks\BaseBankController;

use App\Models\Banks\BankInfoPage;
use App\Repositories\Site\Bank\BankInfoPageRepository;
use App\Repositories\Site\Bank\BankRepository;
use DB;
use Illuminate\Contracts\View\View;

class LoginInfoPageController extends BaseBankController
{
    public function index($bankAlias) : View
{
    return $this->render($bankAlias, 'page');
}

    public function amp($bankAlias) : View
    {
        return $this->render($bankAlias, 'page-amp');
    }

    private function render($bankAlias, $template) : View
    {
        $bankAlias = clear_data($bankAlias);
        $bank = (new BankRepository)->getBankByAlias($bankAlias);
        if ($bank == null) {
            abort(404);
        }

        $page = (new BankInfoPageRepository)->getBankByAlias($bank->id, 2);
        if ($page == null) {
            abort(404);
        }

        $breadcrumbs = [];
        $breadcrumbs[] = ['h1' => 'Банки', 'link' => '/banki'];
        $breadcrumbs[] = ['h1' => $bank->breadcrumb ?? $bank->name, 'link' => '/banki/'.$bank->alias];
        $breadcrumbs[] = ['h1' => 'Личный кабинет'];

        $editLink = null;

        $reviews = DB::table('bank_reviews')
            ->select('*')
            ->where(['status' => 1, 'bank_id' => $bank->id])
            ->whereNull('deleted_at')
            ->orderBy('id','desc')
            ->get();

        $template = 'site.v3.templates.banks.info-pages.' . $template;
        return view($template, compact('page','bank','breadcrumbs', 'editLink','reviews'));
    }
}
