<?php

namespace App\Http\Controllers\Site\V3;

use App\Models\HideLinks\HideLinks;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;

class PartnerLinksController extends Controller
{
    public function mfo(string $alias) : ?RedirectResponse
    {
        $alias = clear_data($alias);
        $link = 'd/mfo/' . $alias;

        return $this->findLink($link);
    }

    public function banks(string $bankAlias, string $categoryAlias, string $productAlias) : ?RedirectResponse
    {
        $bankAlias = clear_data($bankAlias);
        $categoryAlias = clear_data($categoryAlias);
        $productAlias = clear_data($productAlias);
        $link = "c/banki/$bankAlias/$categoryAlias/$productAlias";

        return $this->findLink($link);
    }

    public function findLink(string $link) : ?RedirectResponse
    {
        $hideLink = HideLinks::where(['in' => $link])->first();

        if($hideLink != null){
            return Redirect::to($hideLink->out, $hideLink->redirect_type);
        }

        abort(404);
    }

}
