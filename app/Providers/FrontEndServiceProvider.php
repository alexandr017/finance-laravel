<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Routing\Router;
use Response;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use App\Models\SideBar\SideBar;
use App\Models\Menu\Menu;
use App\Models\Posts\Posts;
use App\Models\Blocks\Blocks;
use App\Models\Blocks\Partners;
use App\Models\Blocks\MediaAboutUs;

use App\Models\Options\Options;


use App\Models\Users\UsersMeta;

use App\Models\SideBar\SidebarRating;


use App\Models\Forms\FormWidgetInstall;
use App\Models\Forms\FormCompanyAdd;
use App\Models\Forms\FormSupport;
use App\Models\Forms\FormAdvertising;

use App\Models\Forms\FormZalogi;
use App\Models\Forms\FormRKO;

use App\Models\Services\KR;

use App\Models\Users\Users;

use App\Models\Project\ProjectRating;

use Cache;
use DB;
use Auth;
use URL;

class FrontEndServiceProvider extends ServiceProvider {

    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function boot()
    {


        Response::macro('getOutSideServices', function(){
//Cache::forget('lighthouse');
            if (Cache::has('lighthouse')) {
                $fignya = Cache::get("lighthouse");
            } else {
                $fignya = [];
                $fignya['rtrg'] = file_get_contents("https://vk.com/rtrg?p=VK-RTRG-14156-fAdAC");
                $fignya['fbevents'] = file_get_contents("https://connect.facebook.net/en_US/fbevents.js");
                $fignya['mail_code'] = file_get_contents("http://top-fwz1.mail.ru/js/code.js");
                $fignya['metrika_watch'] = file_get_contents("https://mc.yandex.ru/metrika/watch.js");
                $fignya['gtagUA6194207836'] = file_get_contents("https://www.googletagmanager.com/gtag/js?id=UA-61942078-36");
                //$fignya['gtagAW951209823'] = file_get_contents("https://www.googletagmanager.com/gtag/js?id=AW-951209823");
                //$fignya['tazeros'] = file_get_contents("https://stats.tazeros.com/v3.js");
                //$fignya['pusher'] = file_get_contents("https://vsezaimyonlineru.push.world/https.embed.js");
                $fignya['pusher'] = '';
                Cache::add('lighthouse', $fignya, 60);
            }

            return $fignya;

        });





        Response::macro('getSidebar', function(){

            $allRows = Cache::rememberForever('sidebar', function(){
                return SideBar::all();
            });

            $keyed = $allRows->mapWithKeys(function ($item) {
                return [$item['id'] =>[
                    'side_key' => $item['attributes']['side_key'],
                    'side_value' =>  $item['side_value']
                ]];
            });

            $SideBar = array();
            foreach ($keyed as $key => $value) {
                $SideBar [$value['side_key']] = $value['side_value'];
            }

            return $SideBar;

        });


        Response::macro('getIdUserCompanies', function(){

            global $idUserCompanies;

            if ($idUserCompanies == null) {

                $userIds = Cache::rememberForever('id_user_companies', function(){
                    return Users::where('company_id', '!=', null)
                        ->select('id', 'company_id')
                        ->get()
                        ->pluck('company_id', 'id')
                        ->toArray();
                });

                $idUserCompanies = $userIds;
            }

            return $idUserCompanies;

        });




        Response::macro('WeHelpWithKR', function(){

            $sidebar = Cache::rememberForever('sidebar', function(){
                return SideBar::all();
            });

            $help_count = 0;

            foreach ($sidebar as $item) {
                if($item->side_key == 'help_count') {
                    $help_count = $item->side_value;
                    break;
                }
            }


            $KR = Cache::rememberForever('kredit_rating', function(){
                return KR::count();
            });


            return (int) $help_count + (int) $KR;


        });


        Response::macro('getProjectRating', function(){

            $rating = ProjectRating::find(1);

            return $rating;

        });





        Response::macro('getMenuIcon', function($menuTitle){

            switch ($menuTitle){
                case 'Займы': return ' <i class="fa fa-ruble"></i> ';
                case 'Кредиты': return ' <i class="fa fa-database"></i> ';
                case 'Кредитные карты': return ' <i class="fa fa-credit-card"></i> ';
                case 'Дебетовые карты': return ' <i class="fa fa-credit-card-alt"></i> ';
                case 'РКО': return ' <i class="fa fa-bank"></i> ';
                case 'Залоги': return ' <i class="fa fa-building"></i> ';
                case 'Полезное': return ' <i class="fa fa-book"></i> ';
                case 'О нас': return ' <i class="fa fa-info-circle"></i> ';
            }

            return '';

        });


        Response::macro('getAdvantagesElements', function($category_id){

            $advantages = [
                1 => [
                    0 => [
                        'text' => 'Актуальная информация об условиях займов',
                        'img' => 'https://finance.ru/old_theme/img/ic10.png'
                    ],
                    1 => [
                        'text' => 'Можно оценить вероятность одобрения',
                        'img' => 'https://finance.ru/old_theme/img/ic9.png'
                    ],
                    2 => [
                        'text' => 'Калькулятор для расчета процентов по займу',
                        'img' => 'https://finance.ru/old_theme/img/ic4.png'
                    ],
                    3 => [
                        'text' => 'Подробные отзывы заемщиков',
                        'img' => 'https://finance.ru/old_theme/img/ic8.png'
                    ],
                    4 => [
                        'text' => 'Только проверенные и лицензированные компании',
                        'img' => 'https://finance.ru/old_theme/img/ic7.png'
                    ],
                ],

                4 => [
                    0 => [
                        'text' => 'Полная информация об условиях кредитов',
                        'img' => 'https://finance.ru/old_theme/img/ic10.png'
                    ],
                    1 => [
                        'text' => 'Сведения о вероятности одобрения заявки',
                        'img' => 'https://finance.ru/old_theme/img/ic9.png'
                    ],
                    2 => [
                        'text' => 'Калькулятор для расчета переплат по кредиту',
                        'img' => 'https://finance.ru/old_theme/img/ic4.png'
                    ],
                    3 => [
                        'text' => 'Предложения от надежных российских банков',
                        'img' => 'https://finance.ru/old_theme/img/ic7.png'
                    ],
                    4 => [
                        'text' => 'Реальные отзывы заемщиков',
                        'img' => 'https://finance.ru/old_theme/img/ic8.png'
                    ],
                ],

                5 => [
                    0 => [
                        'text' => 'Подробная информация об условиях карт',
                        'img' => 'https://finance.ru/old_theme/img/ic10.png'
                    ],
                    1 => [
                        'text' => 'Калькулятор для расчета переплат по карте',
                        'img' => 'https://finance.ru/old_theme/img/ic4.png'
                    ],
                    2 => [
                        'text' => 'Подбор кредитных карт по бонусам за покупки',
                        'img' => 'https://finance.ru/old_theme/img/ic5.png'
                    ],
                    3 => [
                        'text' => 'Можно ознакомиться с отзывами держателей карт',
                        'img' => 'https://finance.ru/old_theme/img/ic8.png'
                    ],
                    4 => [
                        'text' => 'Предложения от надежных российских банков',
                        'img' => 'https://finance.ru/old_theme/img/ic7.png'
                    ],
                ],

                6 => [
                    0 => [
                        'text' => 'Полная информация об условиях каждой карты',
                        'img' => 'https://finance.ru/old_theme/img/ic10.png'
                    ],
                    1 => [
                        'text' => 'Простой подбор карт для разных целей',
                        'img' => 'https://finance.ru/old_theme/img/ic5.png'
                    ],
                    2 => [
                        'text' => 'Информация о бонусах, которые действуют для карт',
                        'img' => 'https://finance.ru/old_theme/img/ic10.png'
                    ],
                    3 => [
                        'text' => 'Можно ознакомиться с отзывами держателей карт',
                        'img' => 'https://finance.ru/old_theme/img/ic8.png'
                    ],
                    4 => [
                        'text' => 'Предложения от надежных российских банков',
                        'img' => 'https://finance.ru/old_theme/img/ic7.png'
                    ],
                ],



                2 => [
                    0 => [
                        'text' => 'Информация о самых выгодных для малого бизнеса тарифах',
                        'img' => 'https://finance.ru/old_theme/img/ic10.png'
                    ],
                    1 => [
                        'text' => 'Онлайн-калькулятор для подбора оптимальных условий счета',
                        'img' => 'https://finance.ru/old_theme/img/ic4.png'
                    ],
                    2 => [
                        'text' => 'Условия дополнительных услуг для предпринимателей',
                        'img' => 'https://finance.ru/old_theme/img/ic11.png'
                    ],
                    3 => [
                        'text' => 'Отзывы людей, которые обслуживаются в банках, представленных нижех',
                        'img' => 'https://finance.ru/old_theme/img/ic8.png'
                    ],
                    4 => [
                        'text' => 'Предложения от надежных банков для бизнеса',
                        'img' => 'https://finance.ru/old_theme/img/ic7.png'
                    ],
                ],

                9 => [
                    0 => [
                        'text' => 'Подробная информация об условиях карт',
                        'img' => 'https://finance.ru/old_theme/img/ic10.png'
                    ],
                    1 => [
                        'text' => 'Калькулятор для расчета переплат по карте',
                        'img' => 'https://finance.ru/old_theme/img/ic4.png'
                    ],
                    2 => [
                        'text' => 'Подбор карт по кэшбеку',
                        'img' => 'https://finance.ru/old_theme/img/ic5.png'
                    ],
                    3 => [
                        'text' => 'Можно ознакомиться с отзывами держателей карт',
                        'img' => 'https://finance.ru/old_theme/img/ic8.png'
                    ],
                    4 => [
                        'text' => 'Предложения от надежных российских банков',
                        'img' => 'https://finance.ru/old_theme/img/ic7.png'
                    ],
                ],

                8 => [
                    0 => [
                        'text' => 'Полная информация об условиях автокредитов',
                        'img' => 'https://finance.ru/old_theme/img/ic10.png'
                    ],
                    1 => [
                        'text' => 'Сведения о вероятности одобрения заявки',
                        'img' => 'https://finance.ru/old_theme/img/ic9.png'
                    ],
                    2 => [
                        'text' => 'Калькулятор для расчета переплат по автокредиту',
                        'img' => 'https://finance.ru/old_theme/img/ic4.png'
                    ],
                    3 => [
                        'text' => 'Предложения от надежных российских банков',
                        'img' => 'https://finance.ru/old_theme/img/ic7.png'
                    ],
                    4 => [
                        'text' => 'Реальные отзывы заемщиков',
                        'img' => 'https://finance.ru/old_theme/img/ic8.png'
                    ],
                ],

            ];

            if(isset($advantages[$category_id])){
                return $advantages[$category_id];
            }

            return null;

        });


        Response::macro('reviewsLenghtRender', function($str)
        {

            if(mb_strlen($str,'UTF-8') > 400){
                $offset = 380;

                if($str[$offset] != ' '){
                    while($str[$offset] != ' '){
                        $offset++;
                    }
                }

                $part1 = substr($str, 0, $offset);
                $part2 = substr($str, $offset);

                $part1 = $part1 . '<span class="three_dots">...</span> <span class="show_the_reviews"><i class="fa fa-angle-down"></i> Показать весь отзыв</span><span class="hidden_area_review">';
                $str = $part1 . $part2 . "</span>";
            }

            return $str;

        });
        Response::macro('reviewsShortLenghtRender', function($str)
        {

            if(mb_strlen($str,'UTF-8') > 200){
                $offset = 170;

                if($str[$offset] != ' '){
                    while($str[$offset] != ' '){
                        $offset++;
                    }
                }

                $part1 = substr($str, 0, $offset);
                $part2 = substr($str, $offset);

                $part1 = $part1 . '<span class="three_dots">...</span> <span class="show_the_reviews"><i class="fa fa-angle-down"></i> Показать весь отзыв</span><span class="hidden_area_review">';
                $str = $part1 . $part2 . "</span>";
            }

            return $str;

        });

        Response::macro('getMainLogo', function(){
            $logoOptions['logo_src'] = DB::table('options')
                ->select('value')
                ->where('key', 'logo_src')
                ->first();
            $logoOptions['logo_title'] = DB::table('options')
                ->select('value')
                ->where('key', 'logo_title')
                ->first();
            $logoOptions = (object)$logoOptions;
            $logoOptions->logo_src = $logoOptions->logo_src->value;
            $logoOptions->logo_title = $logoOptions->logo_title->value;
            return $logoOptions;
        });



        Response::macro('getCitiesLoansSidebar', function()
        {
            $CATEGORY_ID = 1;
            $SECTION_TYPE = 15;

            $pages = DB::table('listings')
                ->leftjoin('cities','cities.id','listings.city_id')
                ->leftjoin('urls','urls.section_id','listings.id')
                ->leftjoin('cities_region','cities_region.id','cities.region_id')
                ->select('cities.imenitelny','cities_region.region', 'urls.url as alias')
                ->where([
                    'listings.category_id' => $CATEGORY_ID,
                    'listings.parent_id' => '-1',
                    'section_type' => $SECTION_TYPE
                ])
                ->get();


            $pages = $pages->sortBy('imenitelny');
            $pages = $pages->values()->all();


            $pagesArr = [];
            foreach ($pages as $key => $value) {
                $pagesArr [$value->region] [] = $value;
            }

            return $pagesArr;

        });






    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function($router)
        {
            require app_path('Http/routes.php');
        });
    }

}
