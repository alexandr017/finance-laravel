<?php

namespace App\Http\Controllers\Site\V3;

use App\Http\Controllers\Controller;

class DynamicSiteController extends Controller
{
    public function render()
    {
        $currentPath = \Request::path();
        $resource = \DB::table('urls')->where(['url' => $currentPath])->first();
        $page = \Request::get('page') ?? 1;

        if ($resource != null) {
            $class = $this->getClassName($resource->section_type);
            if ($class == null) {
                abort(404);
            }
            return (new $class())->render($resource->section_id, paginatePage: (int)$page);

        } else {
            $currentPath = preg_replace('/\/$/', '', $currentPath);

            if (str_contains($currentPath, '/amp/page')) {
                $currentPath = str_replace('/amp', '', $currentPath);
                $currentPathArr = explode('/', $currentPath);
                $page = $currentPathArr[count($currentPathArr) - 1];
                $currentPath = str_replace('/page/' . $page, '', $currentPath);
                $resource = \DB::table('urls')->where(['url' => $currentPath])->first();

                if ($resource != null) {
                    $class = $this->getClassName($resource->section_type);
                    if ($class == null) {
                        abort(404);
                    }
                    return (new $class())->render($resource->section_id, true, $page);
                }
            } elseif (str_contains($currentPath, '/amp')) {

                if (substr_count($currentPath, '/amp') > 1 || str_contains($currentPath, '/amp/')) {
                    abort(404);
                }

                $currentPath = str_replace('/amp', '', $currentPath);
                $resource = \DB::table('urls')->where(['url' => $currentPath])->first();

                if ($resource != null) {
                    $class = $this->getClassName($resource->section_type);
                    if ($class == null) {
                        abort(404);
                    }
                    return (new $class())->render($resource->section_id, false);
                }


            } elseif (str_contains($currentPath, '/page')) {
                $currentPathArr = explode('/', $currentPath);
                $page = $currentPathArr[count($currentPathArr) - 1];
                $currentPath = str_replace('/page/' . $page, '', $currentPath);
                $resource = \DB::table('urls')->where(['url' => $currentPath])->first();
                if ($resource != null) {
                    $class = $this->getClassName($resource->section_type);
                    if ($class == null) {
                        abort(404);
                    }
                    return (new $class())->render($resource->section_id, false, $page);
                }
            }
        }

        abort(404);
    }

    private function getClassName(int $sectionType) : string|null
    {
        return match($sectionType) {
            1 => '\App\Http\Controllers\Site\V3\DynamicPages\PagesController',
            2 => '\App\Http\Controllers\Site\V3\DynamicPages\PostCategoriesController',
            3 => '\App\Http\Controllers\Site\V3\DynamicPages\PostsController',
            4 => '\App\Http\Controllers\Site\V3\DynamicPages\EmployeeController',
            5 => '\App\Http\Controllers\Site\V3\DynamicPages\CompanyController',
            6 => '\App\Http\Controllers\Site\V3\DynamicPages\ListingController',
            default => null
        };
    }

}
