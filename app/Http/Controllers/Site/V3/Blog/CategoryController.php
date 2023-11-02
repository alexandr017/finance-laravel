<?php

namespace App\Http\Controllers\Site\V3\Blog;

use App\Models\Posts\PostsCategories;
use DB;
use App\Models\Posts\Posts;

class CategoryController extends BaseBlogController
{
    public function news(string $categoryAlias, $pageNumber = 1)
    {
        return $this->category( $categoryAlias, $pageNumber,'news');
    }

    public function articles(string $categoryAlias, $pageNumber = 1)
    {
        return $this->category( $categoryAlias, $pageNumber, 'articles');
    }


    private function category(string $categoryAlias, int $pageNumber, string $type)
    {
        $categoryAlias = clear_data($categoryAlias);
        $queryType = CategoryController::POSTS_TYPE;
        if ($type == 'articles') {
            $queryType = CategoryController::ARTICLES_TYPE;
        }

        $postCategory = PostsCategories::where(['alias_category' => $type . '/' . $categoryAlias, 'sidebar_menu' => $queryType])->first();

        if ($postCategory == null) {
            abort(404);
        }

        $offset = ($pageNumber == 0) ? 0 : ($pageNumber * 10) - 10;
        if ($pageNumber == 1) {
            $offset = 0;
        }



        $posts = DB::table('posts')
            ->select('posts.*')
            ->where(['posts.pcid'=>$postCategory->id,'posts.status'=>1])
            ->limit(10)
            ->orderBy('posts.valid_until', 'desc')
            ->orderBy('posts.date', 'desc')
            ->offset($offset)
            ->get();



        $available_posts = [];
        $unavailable_posts = [];
        foreach ($posts as $post){
            if($post->valid_until >= date('Y-m-d')){
                $post->availability = 'yes';
                $available_posts[]=$post;
            }else{
                $post->availability = 'no';
                $unavailable_posts[]=$post;
            }
        }
        $posts = array_merge($available_posts,$unavailable_posts);


        $postsCount = Posts::where(['posts.pcid' => $postCategory->id, 'status' => 1])->paginate(10);


        if ((count($posts) == 0) && ($pageNumber!=1)) {
            abort(404);
        }


        $pages = $postsCount->lastPage();

        $breadcrumbs = [];
        if ($postCategory->id == 23) {
            $breadcrumbs [] = ['link' => '/rko', 'h1' => 'РКО'];
            $breadcrumbs [] = ['h1'=>$postCategory->h1];
        } else {
            $breadcrumbs [] =  ['h1'=>$postCategory->h1];
        }
        //$breadcrumbs = BreadcrumbsRender::get($postsCategory->breadcrumbs, $postsCategory->h1);

        $blogCategories = DB::table('posts_categories')
            ->select('id', 'h1', 'alias_category')
            ->where(['sidebar_menu' => $queryType])
            ->get();

        return view('site.v3.templates.blog.category',[
            'posts' => $posts,
            'postCategory' => $postCategory,
            'breadcrumbs' => $breadcrumbs,
            'page' => $pageNumber,
            'pages' => $pages,
            'editLink' => '/admin/posts/categories/edit/'.$postCategory->id,
            'blogCategories' => $blogCategories
        ]);

    }
}