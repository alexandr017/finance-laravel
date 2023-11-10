<?php

namespace App\Http\Controllers\Site\V3\Blog;

use App\Http\Controllers\Controller;

class BaseBlogController extends Controller
{
    protected const NEWS_TYPE = 1;
    protected const ARTICLES_TYPE = 2;

    protected function getTypePagesByAlias(string $type) : int
    {
        if ($type == 'articles') {
            return BaseBlogController::ARTICLES_TYPE;
        }
        
        return  BaseBlogController::NEWS_TYPE;
    }
}