<?php

namespace App\Http\Controllers\Site\V3\Banks\InfoPages;

use App\Http\Controllers\Site\V3\Banks\BaseBankController;

use App\Models\Banks\BankInfoPage;
use App\Models\Banks\Bank;
use DB;
use Auth;
use App\Models\Posts\Posts;
use Request;

class NewsController extends BaseBankController
{
    public function index($bankAlias)
    {
        $url = Request::path();
        $url = preg_replace('/\/$/', '', $url);
        if(strstr($url,'/page')){
            $urlArr = explode('/', $url);
            $page = $urlArr[count($urlArr)-1];
            return $this->render($bankAlias, 'news',$page);
        }
        return $this->render($bankAlias, 'news');
    }

    public function amp($bankAlias)
    {
        $url = Request::path();
        $url = preg_replace('/\/$/', '', $url);
        if(strstr($url,'/amp/page')){
            $url = str_replace('/amp', '', $url);
            $urlArr = explode('/', $url);
            $page = $urlArr[count($urlArr)-1];
            return $this->render($bankAlias, 'news-amp',$page);
        }
        return $this->render($bankAlias, 'news-amp');
    }


    private function render($bankAlias, $template,$number_page = 1)
    {
        $bankAlias = clear_data($bankAlias);

        $bank = Bank::where(['alias' =>$bankAlias, 'status' => 1])->first();

        if ($bank == null) {
            abort(404);
        }

        $page = BankInfoPage::where(['bank_id' =>$bank->id,'type_id' => 6, 'status' => 1])->first();

        if ($page == null) {
            abort(404);
        }


        $breadcrumbs = [];
        $breadcrumbs[] = ['h1' => 'Банки', 'link' => '/banki'];
        $breadcrumbs[] = ['h1' => $bank->breadcrumb ?? $bank->name, 'link' => '/banki/'.$bank->alias];
        $breadcrumbs[] = ['h1' => 'Новости'];

        $offset = ($number_page == 0) ? 0 : ($number_page*10)-10;
        $news = DB::table('posts')
            ->leftJoin('posts_categories', 'posts.pcid','posts_categories.id')
            ->select('posts.*', 'posts_categories.alias_category as alias_category')
            ->whereIn('posts.pcid',[13,28])
            ->where(['bank_id' => $bank->id, 'status' => 1])
            ->limit(10)
            ->orderBy('posts.date','desc')
            ->offset($offset)
            ->get();

        if (count($news) == 0) {
            abort(404);
        }


        $available_posts = [];
        $unavailable_posts = [];
        foreach ($news as $post){
            if($post->valid_until >= date('Y-m-d')){
                $post->availability = 'yes';
                $available_posts[]=$post;
            }else{
                $post->availability = 'no';
                $unavailable_posts[]=$post;
            }
        }
        $news = array_merge($available_posts,$unavailable_posts);


        $postsCount = DB::table('posts')
            //->leftjoin('urls', 'urls.section_id', 'posts.id')
            ->leftJoin('posts_categories', 'posts.pcid','posts_categories.id')
            ->select('posts.*', 'posts_categories.alias_category as alias_category')
            ->whereIn('posts.pcid',[13,28])
            ->where(['bank_id' => $bank->id, 'status' => 1])
            ->orderBy('posts.date','desc')
            ->paginate(10);
        $pages = $postsCount->lastPage();



        $pageAlias = 'banki/'.$bank->alias.'/'.$template;
        $template = 'site.v3.templates.banks.info-pages.' . $template;

        $editLink = null;
        return view($template, compact('number_page','page','bank','breadcrumbs','news', 'editLink','pages','postsCount','pageAlias'));
    }
}
