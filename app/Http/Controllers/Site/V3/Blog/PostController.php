<?php

namespace App\Http\Controllers\Site\V3\Blog;

use App\Models\Posts\Posts;
use App\Models\Posts\PostsCategories;
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


    private function post(string $categoryAlias, string $postAlias, string $type)
    {
        $categoryAlias = clear_data($categoryAlias);
        $postAlias = clear_data($postAlias);
        $queryType = CategoryController::POSTS_TYPE;
        if ($type == 'articles') {
            $queryType = CategoryController::ARTICLES_TYPE;
        }

        $postCategory = PostsCategories::where(['alias_category' => $type . '/' . $categoryAlias, 'sidebar_menu' => $queryType])->first();

        if ($postCategory == null) {
            abort(404);
        }

        $post = Posts::where(['alias' => $postAlias, 'pcid' => $postCategory->id, 'status' => 1])->first();

        if ($post == null){
            abort(404);
        }

        $post->increment('views');

        if ($post->valid_until != null) {
            $validDate = strtotime($post->valid_until);
            $currentDate = strtotime(date("Y-m-d"));
            if ($currentDate >  $validDate) {
                $post->valid_until = null;
                $post->save();
            }
        }


        $postsComments = DB::table('posts_comments')
            ->leftJoin('users_meta','users_meta.user_id','posts_comments.uid')
            ->select('posts_comments.*','users_meta.last_name', 'users_meta.first_name', 'users_meta.middle_name')
            ->where(['posts_comments.pid' => $post->id,'posts_comments.status' => 1])
            ->orderBy('posts_comments.id', 'desc')
            ->get();

        $related = [];


        if(($post->related != '0') && ($post->related != '')){
            $where = str_replace(',', " or posts.id=", $post->related);

            $related = DB::select("select posts.*, posts_categories.alias_category from posts posts left join posts_categories posts_categories ON posts_categories.id = posts.pcid where posts.id=$where and status = 1");
        }

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


        $uid = Auth::id();
        $uidName = '';
        if($uid != null){
            $userMeta = UsersMeta::where(['user_id'=>$uid])->first();
            if($userMeta == null){
                $uidName = 'Гость';
            } else {
                $uidName = $userMeta->last_name . ' ' . $userMeta->first_name . ' ' . $userMeta->middle_name;
            }
        }

        $author = null;
        if(($post->author_id !=null) &&($post->author_id !=0)){
            $authors = Cache::rememberForever('authors', function(){
                return Authors::all();
            });
            foreach ($authors as $key => $a) {
                if($a->id == $post->author_id) $author = $a;
            }
        }


        $breadcrumbs = [];

        $table_of_contents = $post->table_of_contents;

        $blade = !is_amp_page() ? 'site.v3.templates.blog.post' : 'site.v3.templates.blog.post-amp';
        return view($blade,[
            'postCategory' => $postCategory,
            'post' => $post,
            'breadcrumbs' => $breadcrumbs,
            'postsComments' => $postsComments,
            'uid' => $uid,
            'uidName' => $uidName,
            'related' => $related,
            'author' => $author,
            'editLink' => '/admin/posts/posts/edit/'.$post->id,
            'table_of_contents' => $table_of_contents
        ]);

    }
}