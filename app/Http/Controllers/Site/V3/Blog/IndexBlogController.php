<?php

namespace App\Http\Controllers\Site\V3\Blog;

use DB;
use App\Models\Posts\PostsComments;
use App\Models\StaticPages\StaticPage;

class IndexBlogController extends BaseBlogController
{
    private const INDEX_POSTS_PAGE_ID = 5;
    private const INDEX_ARTICLES_PAGE_ID = 6;

    public function news()
    {
        return $this->render('news');
    }

    public function articles()
    {
        return $this->render('articles');
    }

    private function render(string $type)
    {
        $queryType = IndexBlogController::POSTS_TYPE;
        $pageID = IndexBlogController::INDEX_POSTS_PAGE_ID;
        if ($type == 'articles') {
            $queryType = IndexBlogController::ARTICLES_TYPE;
            $pageID = IndexBlogController::INDEX_ARTICLES_PAGE_ID;
        }

        $blogCategories = DB::table('posts_categories')
            ->select('id', 'h1', 'alias_category')
            ->where(['sidebar_menu' => $queryType])
            ->get();


        $postsCategory = StaticPage::find($pageID);

        if ($postsCategory == null) {
            abort(404);
        }


        $posts = [];
        foreach ($blogCategories as $category) {
            $row = DB::table('posts')
                ->leftJoin('posts_categories','posts.pcid','posts_categories.id')
                ->select('posts.*',
                    'posts_categories.id as category_id',
                    'posts_categories.alias_category',
                    'posts_categories.h1 as category_h1')
                ->where(['posts.pcid' => $category->id,'posts.status' => 1])
                ->limit(6)
                ->orderBy('posts.date', 'desc')
                ->get();

            foreach ($row as $k => $item) {
                $row[$k]->comments_count = PostsComments::where(['pid' => $item->id, 'status' => 1])
                    ->select(DB::raw('select count(id) as comments_count'))
                    ->count();
                if($row[$k]->valid_until >= date('Y-m-d')){
                    $row[$k]->availability = 'yes';
                }else{
                    $row[$k]->availability = 'no';
                }
            }

            $posts [] = $row;

        }


        $breadcrumbs = [];
        $breadcrumbs [] =  ['h1'=>$postsCategory->breadcrumb];

        return view('site.v3.templates.blog.index',[
            'postsCategory' => $postsCategory,
            'blogCategories' => $blogCategories,
            'posts' => $posts,
            'breadcrumbs' => $breadcrumbs,
            'section_type' => 7,
            'editLink' => '/'
        ]);

    }
}