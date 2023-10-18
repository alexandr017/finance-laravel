<?php

namespace App\Http\Controllers\Admin\IndexPage;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Contracts\View\View;

class IndexPageController extends AdminController
{
    public function index() : View
    {
        return view('admin.v2.index.index');
    }

    public function demo() : View
    {
        return view('admin.v2.demo');
    }
}
