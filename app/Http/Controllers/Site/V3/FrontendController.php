<?php

namespace App\Http\Controllers\Site\V3;

use App\Http\Controllers\Controller;
use App\Models\Partners\Partners;
use App\Models\Options\Options;
use App\Models\Posts\PostFavoritesReviews;
use App\Models\MediaAboutUs\MediaAboutUs;
use App\Models\Cards\CardsCategories;
use App\Http\Controllers\Frontend\InitController;

use App\Models\HideLinks\HideLinks;
use App\Models\HideLinks\HideLinkTimes;


use App\Models\StaticPages\StaticPage;
use Cache;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Input;


use App\Models\Pages\Pages;
use DB;
use Request;
use App\Models\System as System;
use Auth;
use URL;


use App\Http\Controllers\Frontend\Actions\ZalogiController;


use App\Http\Controllers\Frontend\Yandex\TurboController;

use App\Algorithms\IndexPageCardsLoad;
use App\Models\Expert\Expert;

class FrontendController extends Controller
{
    public function index()
    {
        $page = StaticPage::findByAlias();

        if ($page == null) {
            abort(404);
        }


        $all_products_count = 0;
        $companies_count = DB::select("select count(id) as count from companies where status=1");
        $bank_products_count = DB::select("select count(id) as count from bank_products where status=1");
        $all_products_count += $companies_count[0]->count;
        $all_products_count += $bank_products_count[0]->count;


        $all_reviews_count = 0;
        $companies_reviews_count = DB::select("select count(id) as count from companies_reviews where status=1");
        $banks_reviews_count = DB::select('select count(id) as count from bank_reviews where status=1');
        $all_reviews_count += $companies_reviews_count[0]->count;
        $all_reviews_count += $banks_reviews_count[0]->count;


        $countChildListings = System::getCountChildListings(1);


        $loans = DB::table('cards')
            //->select('id','category_id')
            ->where(['category_id' =>1 ,'status' => 1, 'show_in_index' => 1])
            ->orderBy('flow')
            ->orderBy('km5','desc')
            ->orderBy('promo','desc')
            ->orderBy('id','asc')
            ->limit(3)
            ->get();

        //$cards = CardsBoot::getCardsForListingByIDs($cards);


        $experts = Cache::rememberForever('experts', function(){
            return Expert::all();
        });

        $rko = DB::table('cards')
            ->where(['status' => 1, 'category_id' => 2, 'flow' => 1])
            ->orderBy('flow')
            ->orderBy('km5','desc')
            ->orderBy('id')
            ->limit(3)
            ->get();

        $zalogi = DB::table('cards')
            ->where(['status' => 1, 'category_id' => 3, 'flow' => 1])
            ->orderBy('flow')
            ->orderBy('km5','desc')
            ->orderBy('id')
            ->limit(3)
            ->get();

        $credits = DB::table('cards')
            ->where(['status' => 1, 'category_id' => 4, 'flow' => 1])
            ->orderBy('flow')
            ->orderBy('km5','desc')
            ->orderBy('id')
            ->limit(3)
            ->get();

        $creditCards = DB::table('cards')
            ->where(['status' => 1, 'category_id' => 5, 'flow' => 1])
            ->orderBy('flow')
            ->orderBy('km5','desc')
            ->orderBy('id')
            ->limit(3)
            ->get();

        $debitCards = DB::table('cards')
            ->where(['status' => 1, 'category_id' => 6, 'flow' => 1])
            ->orderBy('flow')
            ->orderBy('km5','desc')
            ->orderBy('id')
            ->limit(3)
            ->get();

        $autoCredits = DB::table('cards')
            ->where(['status' => 1, 'category_id' => 8, 'flow' => 1])
            ->orderBy('flow')
            ->orderBy('km5','desc')
            ->orderBy('id')
            ->limit(3)
            ->get();



        $posts = DB::table('posts')
            ->leftJoin('posts_categories','posts.pcid','posts_categories.id')
            ->select('posts.*',
                'posts_categories.id as category_id',
                'posts_categories.alias_category',
                'posts_categories.h1 as category_h1')
            ->where(['posts.status' => 1])
            ->whereIn('posts.pcid', [8, 27, 28, 21, 29, 30, 14])
            ->limit(10)
            ->orderBy('posts.id', 'desc')
            ->get();

        foreach ($posts as $k => $item) {
            if($posts[$k]->valid_until >= date('Y-m-d')){
                $posts[$k]->availability = 'yes';
                //$available_posts[]=$post;
            }else{
                $posts[$k]->availability = 'no';
                //$unavailable_posts[]=$post;
            }
        }


        $reviewsCompany = DB::table('companies_reviews')
            ->leftJoin('companies', 'companies.id', 'companies_reviews.company_id')
            ->select('companies_reviews.*', 'companies.company_name as companyName', 'companies.alias')
            ->where(['companies_reviews.status' => 1, 'off_answer' => null, 'companies.status' => 1, 'companies.closed' => 0])
            ->where('companies_reviews.rating', '>', 2)
            ->orderBy('companies_reviews.created_at', 'desc')
            ->limit(10)
            ->get();

        $reviewsBank = DB::table('bank_reviews')
            ->leftjoin('banks', 'banks.id', 'bank_reviews.bank_id')
            ->select('bank_reviews.*', 'banks.name as bankName', 'banks.alias as bankAlias')
            ->where(['bank_reviews.status' => 1, 'bank_reviews.off_answer' => null, 'banks.status' => 1])
            ->where('bank_reviews.bank_id', '!=', 0)
            ->where('bank_reviews.rating', '>', 2)
            ->whereNotNull('bank_reviews.bank_id')
            ->whereNull('bank_reviews.deleted_at')
            ->orderBy('bank_reviews.created_at', 'desc')
            ->limit(10)
            ->get();
        $reviews = $reviewsCompany->merge($reviewsBank)->toArray();
        shuffle($reviews);


        return view('site.v3.templates.index',[
            'page' => $page,

            'all_products_count' => $all_products_count,
            'all_reviews_count' => $all_reviews_count,

            'def_load' => true,
            'amp' => false,
            'countChildListings' => $countChildListings,
            'loans' => $loans,

            'reviews' => $reviews,

            'experts' => $experts,
            //
            'autoCredits' => $autoCredits,
            'debitCards' => $debitCards,
            'zalogi' => $zalogi,
            'creditCards' => $creditCards,
            'credits' => $credits,
            'rko' => $rko,

            'posts' => $posts

        ]);
    }

    public function index_amp(){

        $title = ''; $h1 = ''; $meta_description = ''; $content = '';

        $cards = DB::table('cards')
            ->leftjoin("cards_1_zaimy", 'cards.id', '=', "cards_1_zaimy.card_id")
            ->leftjoin("companies", 'cards.company_id', '=', "companies.id")
            ->leftjoin("companies_url", 'companies.group_id', '=', "companies_url.id")
            ->select('cards.*', "cards_1_zaimy.*", "cards_1_zaimy.id as idd",'companies.alias as companies_alias', 'companies_url.url as group_url','companies.reviews_page')
            ->where(['cards.category_id'=>1,'cards.show_in_index'=>1,'cards.status'=>1])
            ->orderBy("cards.km5", 'desc')
            ->get();
        if($cards == null) $cards = [];

        $cards = System::reviewsParse($cards);

        $card_category = CardsCategories::find(1);
        if($card_category == null){
            return abort(404);
        }


        $throughReviews = Cache::rememberForever('through_reviews', function(){
            return $allRows = DB::table('companies_reviews')
                ->select('companies_reviews.*')
                ->where(['companies_reviews.status'=>1])
                ->orderBy('companies_reviews.id','desc')
                ->limit(10)
                ->get();
        });


        return view('site.v3.templates.index-amp',[
            'category_id' => 1,
            'title' => $title,
            'h1' => $h1,
            'content' => $content,
            'meta_description' => $meta_description,
            'section_type' => -1,

            'throughReviews' => $throughReviews,

            'cards' => $cards,

        ]);
    }





    public function dynamic_routes($url,$url2=null,$url3=null,$url4=null,$url5=null,$number_page=1){

        $url = URL::current();

        $resUrl = Request::path();
        $init = new InitController();
        $obj = $this->getUrlType($resUrl);


        if($obj != null){

            if(isset($_GET['yandex_feed'])){
                if(($obj->section_type == 7) || ($obj->section_type == 8)  || ($obj->section_type == 3) || ($obj->section_type == 2)){
                    $yandex_feed = new TurboController();
                    return $yandex_feed->init();
                }

            }

            switch ($obj->section_type) {
                case 1: // служебные страницы
                    return $init->getPage($obj->section_id);
 
                case 2: // категории карточек (листинги)
                    return $init->getParentListig($obj->section_id);
                    break;

                case 3: // категории карточек (Дочерние литинги)
                    return $init->getChildrenListig($obj->section_id);
                    break;                    

                case 4: // категории компаний
                    return $init->getCompaniesCategories($obj->section_id);
                    break;

                case 5: // компании
                    return $init->getCompany($obj->section_id);
                    break;

                case 6: // дочерняя страница компании
                    return $init->getCompanyChildrenPage($obj->section_id);
                    
                case 7: // рубрика записей
                    return $init->getPosts($obj->section_id,1);
                    break;

                case 8: // запись
                    return $init->getPost($obj->section_id);
                    break;
            
                case 9: // Страница списка городов
                    return $init->getPageCity($obj->section_id);
                    break;

                case 10: // Страница новостей и акций компаний
                    return $init->getCompanyNews($obj->section_id);
                    break;

                case 11: // Категория страховок
                    return $init->getInsuranceCategory($obj->section_id);
                    break;

                case 12: // Дочерняя страница страховок
                    return $init->getInsuranceChildPage($obj->section_id);
                    break;

                case 13: // Калькуляторы
                    return $init->getCalcPage($obj->section_id);
                    break;

                case 14: // Листинги карточек 2го уровня
                    return $init->getParentListingLevel2($obj->section_id);
                    break;

                case 15: // Листинги карточек 2го уровня
                    return $init->newListings($obj->section_id);
                    break;

                default:
                    return abort(404);
                    break;
            }

        } else {
            $url = Request::path();
            $url = preg_replace('/\/$/', '', $url);

            if(strstr($url,'/amp/page')){
                $url = str_replace('/amp', '', $url);
                $urlArr = explode('/', $url);
                $page = $urlArr[count($urlArr)-1];
                $action = str_replace('/page/'.$page, '', $url);
                $obj = $this->getUrlType($action);
                if($obj!=null){
                    switch ($obj->section_type) {
                        case '7': return $init->getPosts($obj->section_id,$page,true);
                        
                        default: break;
                    }
                }
            } elseif(strstr($url,'/amp')){

                if(substr_count($url, '/amp') > 1){
                    return abort(404);
                }
                if(strstr($url,'/amp/')){
                    return abort(404);
                }

                $url = str_replace('/amp', '', $url);
                $obj = $this->getUrlType($url);
                //ddd($obj);
                if($obj!=null){
                        switch ($obj->section_type) {
                        case '2': return $init->getParentListig($obj->section_id,true);
                        case '3': return $init->getChildrenListig($obj->section_id,true);
                        case '4': return $init->getCompaniesCategories($obj->section_id,true);
                        case '5': return $init->getCompany($obj->section_id,true);
                        case '6': return $init->getCompanyChildrenPage($obj->section_id,true);
                        case '7': return $init->getPosts($obj->section_id,1,true);
                        case '8': return $init->getPost($obj->section_id,true);
                        case '10': return $init->getCompanyNews($obj->section_id,true);
                        case '13': return $init->getCalcPage($obj->section_id,true);
                        case '14': return $init->getParentListingLevel2($obj->section_id,true);
                        case '15': return $init->newListings($obj->section_id,true);

                        default: break;
                    }
                }


            } elseif(strstr($url,'/page')){
                $urlArr = explode('/', $url);
                $page = $urlArr[count($urlArr)-1];
                $action = str_replace('/page/'.$page, '', $url);
                $obj = $this->getUrlType($action);
                if($obj!=null){
                    switch ($obj->section_type) {
                        case '7': return $init->getPosts($obj->section_id,$page);
                        
                        default: break;
                    }
                }
            }


            $hideLink = HideLinks::where(['in'=>$resUrl])->first();

            if($hideLink != null){

                $hideLink = hideLinks::find($hideLink->id);
                $hideLink->increment('clicks');
                if(Cache::has('hide_links')) Cache::forget('hide_links');
                $hideLinkTime = new HideLinkTimes();
                $hideLinkTime->hlid = $hideLink->id;
                $hideLinkTime->save();

                //ddd(\Request::server('HTTP_REFERER'));
                if (\Request::server('HTTP_REFERER') != 'https://finance.ru/loans' &&
                    \Request::url() != 'https://finance.ru/loans'
                ) {
                    //ddd('обычная', $hideLink->straight);
                    return redirect($hideLink->straight, $hideLink->redirect_type);
                }


                // добавление адреса страницы с которой был клик
                // и доменного имени с которого пришел клиент
                if (strstr($hideLink->out, 'vsezaimyonline.click')) {
                    $prevLink = URL::previous();
                    $vzoReferrer = str_replace('https://finance.ru/', '' , $prevLink);
                    $vzoReferrer = str_replace('/', '+' , $vzoReferrer);
                    $hideLink->out = (strstr($hideLink->out, '?'))
                        ? $hideLink->out . '&page=' . $vzoReferrer
                        : $hideLink->out . '?page=' . $vzoReferrer;

                    global $REDEFINED_REFERRER_DOMAIN;
                    if ($REDEFINED_REFERRER_DOMAIN!= null) {
                        $hideLink->out = $hideLink->out . '&ref=' . clear_data($REDEFINED_REFERRER_DOMAIN);
                    } elseif (isset($_COOKIE['REFERRER_DOMAIN'])) {
                        $hideLink->out = $hideLink->out . '&ref=' . clear_data($_COOKIE['REFERRER_DOMAIN']);
                    }

                    //

                    //ddd('на поддомен click', $hideLink->out);
                    return redirect($hideLink->out, $hideLink->redirect_type);

                    //ddd(URL::previous(), $vzoReferrer,$hideLink->out);
                }

                //ddd('обычная 2', $hideLink->out);
                return redirect($hideLink->out, $hideLink->redirect_type);
            }

            return abort(404);
        }


    }


    public function getUrlType($url)
    {
        $obj = DB::select("select * from urls where url=?",[$url]);
        if(!isset($obj[0])) return null; else return $obj[0];
    }


    public function base_ajax_load()
    {
        $codeCards = IndexPageCardsLoad::getBaseCards();
        return $codeCards;
    }



    private static function paginate($items, $perPage = 15, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }


}
