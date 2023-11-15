<?php

namespace App\Http\Controllers\Site\V3\Blog;

use App\Models\Posts\Posts;
use App\Models\Posts\PostsCategories;
use App\Models\StaticPages\StaticPage;
use DB;
use Auth;
use App\Models\Users\UsersMeta;
use Cache;
use App\Models\Posts\Authors;

class PostController extends BaseBlogController
{
    public function news(string $categoryAlias, string $postCategory)
    {
        return $this->post( $categoryAlias, $postCategory, 'news');
    }

    public function articles(string $categoryAlias, string $postCategory)
    {
        return $this->post( $categoryAlias, $postCategory, 'articles');
    }

    private function post(string $categoryAlias, string $postAlias, string $alias)
    {
        $postGlobalCategory = StaticPage::where(['alias' => $alias])->first();

        if ($postGlobalCategory == null) {
            abort(404);
        }

        $queryType = $this->getTypePagesByAlias($alias);

        $postCategory = PostsCategories::where(['alias_category' => $alias . '/' . $categoryAlias, 'sidebar_menu' => $queryType])->first();

        if ($postCategory == null) {
            abort(404);
        }

        $post = Posts::where(['alias' => $postAlias, 'pcid' => $postCategory->id, 'status' => 1])->first();

        if ($post == null){
            abort(404);
        }

        $post->increment('views');

        $postsComments = $this->getComments($post->id);

        $relatedPosts = $this->getRelatedPosts($post->related);

        $breadcrumbs = [];
        $breadcrumbs [] = ['link' => '/' . $alias, 'h1' => $postGlobalCategory->breadcrumbs ?? $postGlobalCategory->h1];
        $breadcrumbs [] = ['link' => '/' . $postCategory->alias_category, 'h1'=> $postCategory->breadcrumbs ?? $postCategory->h1];
        $breadcrumbs [] = ['h1'=> $post->breadcrumbs ?? $post->h1];

        $table_of_contents = $post->table_of_contents;
        $showContentMenu = true;

        $editLink = '/';

        $blade = !is_amp_page() ? 'site.v3.templates.blog.post' : 'site.v3.templates.blog.post-amp';
        return view($blade, compact('post', 'postCategory', 'breadcrumbs',
            'postsComments', 'relatedPosts', 'editLink', 'table_of_contents', 'showContentMenu'));
    }

    private function getComments(int $postID)
    {
        $postsComments = DB::table('posts_comments')
            ->select('posts_comments.*')
            ->where(['posts_comments.pid' => $postID,'posts_comments.status' => 1])
            ->orderBy('posts_comments.id', 'desc')
            ->get();

        $i = 0;

        while($i<=count($postsComments)-1){
            foreach ($postsComments as $key => $value) {
                if(!isset($postsComments[$i])) continue;
                if($value->id == $postsComments[$i]->parent){
                    $postsComments[$key]->child [] = $postsComments[$i];
                    unset($postsComments[$i]);
                    $i = 0;
                }
            }
            $i++;
        }

        return $postsComments;
    }

    private function getRelatedPosts($related)
    {
        $relatedArr = explode(',', $related);
        return DB::table('posts')
            ->select('posts.*', 'posts_categories.alias_category')
            ->leftJoin('posts_categories', 'posts_categories.id', 'posts.pcid')
            ->whereIn('posts.id', $relatedArr)
            ->where(['posts.status' => 1])
            ->get();
    }
}