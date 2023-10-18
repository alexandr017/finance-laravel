<?php

namespace App\Http\Controllers\Admin\ShortCodes;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ShortCodesController extends AdminController
{
    public function index() : View
    {
        $breadcrumbs = [['h1' => 'Шорткоды']];

        return view('admin.v2.short-codes.index', compact('breadcrumbs'));
    }
}
