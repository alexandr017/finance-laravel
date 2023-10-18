<?php if(!is_mobile_device()){ ?>
<div class="sidebar">
<aside>

@if($_SERVER['REQUEST_URI'] == '/')
    block for index sidebar
@endif

<?php if(isset($section_type)): ?>

<?php if(($section_type == 2) || ($section_type == 3) || ($section_type == 4)  || ($section_type == -1)  || ($section_type == 14)) : ?>

                <?php
                if(isset($category_id)){
                    if(file_exists(base_path()."/resources/views/frontend/includes/sidebar/search-".$category_id.".blade.php"))
                        include base_path()."/resources/views/frontend/includes/sidebar/search-".$category_id.".blade.php";
                }

                $options = json_decode($options_json); $oi=1; ?>
                @if($options!=null)
                <div class="side-block-dart">
                    <div class="side-title">Опции <i class="fa angle-down"></i></div>
                    <div class="side-box options-list">
                    @foreach($options as $option)
                        <span> <input type="checkbox" value="{{$option->id_title}}" id="check{{$oi}}"> <label for="check{{$oi}}">{{$option->label}}</label></span>
                        <?php $oi++; ?>
                    @endforeach
                        <div class="form-line form-line-mb0">
                                <button class="form-btn1 width-100" id="find_by_options-@if(isset($category_id)){{$category_id}}@endif">Найти</button>
                        </div>
                    </div>
                </div>
                @endif


                <?php $filters = json_decode($filters_json);?>
                @if($filters!=null)
                <?php
                $k = 0;
                $tmp_url = explode('/',$_SERVER['REQUEST_URI']);
                $city_prefix = '';
                $cities = \App\Models\Cities\Cities::select('id','transliteration')->get()->pluck('transliteration','id')->toArray();

                ?>
                @foreach($filters as $filter)
                <div class="side-block-dart">

                    <?php
                    $city_prefix = '';
                    $tmp_arr = explode('=',$filter->group_name);

                    if(isset($category_id)){
                        if($category_id == 4) {
                            $cities = [
                                'moskva',
                                'sankt-peterburg',
                                'novosibirsk',
                                'ekaterinburg',
                                'nizhnij-novgorod',
                                'kazan',
                                'chelyabinsk',
                                'omsk',
                                'samara',
                                'rostov-na-donu',
                                'ufa',
                                'krasnoyarsk',
                                'perm',
                                'voronezh',
                                'volgograd'
                            ];

                            $city_prefix = '';
                            if (($section_type == 14 || $section_type == 3) && $tmp_arr[0] != 'Города') {
                                if (isset($page->transliteration)) {
                                    $city_prefix = '/' . $page->transliteration;
                                } elseif(isset($tmp_url[count($tmp_url) - 1])) {
                                    if(in_array($tmp_url[count($tmp_url) - 1], $cities)) {
                                        $city_prefix = '/' .$tmp_url[count($tmp_url) - 1];
                                    }
                                }
                            }
                        }
                    }

                    if (isset($category_id)){
                        if ($category_id == 1) {
                            if (($section_type == 15 || $section_type == 3 || Request::is('/')) && $tmp_arr[0] != 'Города') {
                                $last_part_in_url = isset($tmp_url[count($tmp_url) - 1])
                                    ? $tmp_url[count($tmp_url) - 1]
                                    : null;
                                if ($last_part_in_url) {
                                    if (in_array($last_part_in_url, $cities)) {
                                        $city_prefix = '/' .$tmp_url[count($tmp_url) - 1];
                                    }
                                }
                            }
                        }
                    }

                    ?>
                    <div class="side-title">@if(isset($tmp_arr[1])) <span class="fa {{$tmp_arr[1]}}"></span> @endif{{$tmp_arr[0]}} <i class="fa @if($k==0) fa-angle-up @else fa-angle-down @endif"></i></div>
                    <div class="side-box links-list @if($k!=0) display_none @endif">
                        @foreach($filter->values as $link)
                            <?php if($link[0]->link == '/city' || $link[0]->link == 'https://finance.ru/city') $city_prefix = '' ?>
                        <a class="sidebar" href="<?= str_replace('https://finance.ru', '', $link[0]->link) ?>{{$city_prefix}}">{{$link[0]->label}}<?php
                            $urlPage = preg_replace('/$\//', '', $link[0]->link);
                            $urlPageArr = explode('/',$urlPage);
                            $urlPage = $urlPageArr[count($urlPageArr)-1];
                            if(isset($countChildListings[$urlPage]))
                                echo " (".$countChildListings[$urlPage].")";
                        ?></a>
                        @endforeach
                    </div>
                </div>
                <?php $k++ ;?>
                @endforeach
                @endif

{{--            @if($section_type == 3 || $section_type == -1)--}}
{{--                @if(isset($category_id) && $category_id == 1)--}}
{{--                <?php $regions = response::getCitiesLoansSidebar(); ?>--}}
{{--                    @foreach($regions as $regionKey => $region)--}}
{{--                    <div class="side-block-dart">--}}
{{--                        <div class="side-title"><span class="fa fa-building-o"></span> Города ({{$regionKey}}) <i class="fa fa-angle-up"></i></div>--}}
{{--                        <div class="side-box links-list display_none">--}}
{{--                            @foreach($region as $link)--}}
{{--                                @if(Request::path() !=  $link->alias)--}}
{{--                                <a class="sidebar" href="/{{$link->alias}}">{{$link->imenitelny}}</a>--}}
{{--                                @endif--}}
{{--                            @endforeach--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    @endforeach--}}
{{--                @endif--}}
{{--            @endif--}}


    @if(($section_type == 2) || ($section_type == 3) || ($section_type == 14))
        @if(strstr($_SERVER['REQUEST_URI'], 'rko/') || $_SERVER['REQUEST_URI'] == '/rko')
            <div class="side-block-dart">
                <div class="side-title">Журнал предпринимателя <i class="fa fa-angle-up"></i></div>
                <div class="side-box links-list">
                    <?php $caregoriesRKO = DB::select("select * from posts_categories where alias_category like 'rko/%'"); ?>
                    @foreach($caregoriesRKO as $link)
                        <a class="sidebar" href="/{{$link->alias_category}}">{{$link->h1}}</a>
                    @endforeach
                </div>
            </div>
        @endif
    @endif



<?php endif; ?>
<?php endif; ?>







    <?php if(isset($section_type)): ?>
<?php if(($section_type == 12) || ($section_type == 11)) : ?>
<?php if(isset($tags) && isset($groups)) : ?>
    <?php $s_counter = 0; ?>
    @foreach($groups as $group)
    <div class="side-block-dart">
        <div class="side-title">{{$group->group_name}} <i class="fa @if(!$s_counter) fa-angle-down @else fa-angle-up @endif"></i></div>
        <div class="side-box links-list @if($s_counter) display_none @endif">
            @foreach($tags as $tag)
                @if($tag->group_id == $group->id)
                    @if($tag->ic_id == 1) <a href="/insurance/osago/{{$tag->alias}}">@if($tag->label != null) {{$tag->label}} @else {{$tag->h1}} @endif</a> @endif
                    @if($tag->ic_id == 2) <a href="/insurance/kasko/{{$tag->alias}}">@if($tag->label != null) {{$tag->label}} @else {{$tag->h1}} @endif</a> @endif
                    @if($tag->ic_id == 3) <a href="/insurance/tourism/{{$tag->alias}}">@if($tag->label != null) {{$tag->label}} @else {{$tag->h1}} @endif</a> @endif
                @endif
            @endforeach
                <?php $s_counter++ ;?>
        </div>
    </div>
    @endforeach
<?php endif; ?>
<?php endif; ?>
<?php endif; ?>



<?php if(isset($section_type)): ?>

@if($section_type == 6)
    @if($card != null && $card != [])
    <div class="side-block">
        <div class="side-title">{{($company->company_name) ? $company->company_name : $company->h1}}</div>
        <div class="side-box">
            <img loading="lazy" src="{{$company->img}}" alt="{{($company->company_name) ? $company->company_name : $company->h1}}" class="side-company">
            <div class="form-line form-line-mb0">
                <?php if($card->status) {
                    $company_link = ($card->link_type == 1) ? $card->link_1 : $card->link_2;
                } else {
                    $company_link = $card->link_2;
                } ?>
                <a href="{{$company_link}}" target="_blank" rel="nofollow" class="form-btn1 width-100">Оформить</a>
            </div>
        </div>
    </div>
    @endif
@endif



<?php endif; ?>



    @if(isset($table_of_contents))
        @if($table_of_contents != null &&  $table_of_contents != '')
            <div class="side-block sidebar_menu_wrap">
            <div class="side-block">
                <div class="side-title">Содержание</div>
                <div class="side-box text-center">
                    <ul class="side_bar_menu_scroll">
                        <?php
                            $table_of_contents_arr = explode("\n", $table_of_contents);
                            foreach($table_of_contents_arr as $menu_item){
                                if (empty($menu_item)) continue;
                                $table_row = explode(':', $menu_item);
                                if (isset($table_row[1])) {
                                    echo '<li><a href="#' . $table_row[1] . '">'. $table_row[0] . '</a></li>';
                                }
                            }
                        ?>
                    </ul>
                </div>
            </div>
            </div>
        @endif

    @else

        @if(isset($section_type))

            @if($section_type == 5 ||  $section_type == 6 ||  $section_type == 8)
                <?php
                    global $sidebar_tags_menu;
                    if(is_array($sidebar_tags_menu)) :
                        if(count($sidebar_tags_menu) > 1) :
                ?>
                <div class="side-block sidebar_menu_wrap">
                <div class="side-block">
                    <div class="side-title">Содержание</div>
                    <div class="side-box text-center">
                        <ul class="side_bar_menu_scroll">
                        @foreach($sidebar_tags_menu as $menu_item)
                            <li><a href="#{{$menu_item['id']}}">{{$menu_item['text']}}</a></li>
                        @endforeach
                        </ul>
                    </div>
                </div>
                </div>
            @endif
        @endif

    @endif



    <?php endif; ?>

    @endif





        <?php if(isset($section_type) && isset($posts_category)): ?>
        <?php $NEWS_CATEGORIES = [8,27,28,21,29,30,35, 36, 37, 38, 39 ,14, 13]; // список новостных категорий ?>
        <?php if(($section_type == 7) && in_array($posts_category->id, $NEWS_CATEGORIES)) : ?>
        <div class="side-block">
            <div class="side-title"><i class="fa fa-folder-open-o"></i> Рубрики новостей</div>
            <div class="side-box options-list">
                <ul class="mb0 rating-mfk">
                    @if($posts_category->id != 8)<li><a rel="nofollow" href="/news/actions">Акции и промокоды</a></li>@endif
                    @if($posts_category->id != 27)<li><a rel="nofollow" href="/news/mfk">Новости МФК и МКК</a></li>@endif
                    @if($posts_category->id != 28)<li><a rel="nofollow" href="/news/banks">Новости банков</a></li>@endif
                    @if($posts_category->id != 21)<li><a rel="nofollow" href="/news/insurance">Новости страхования</a></li>@endif
                    @if($posts_category->id != 29)<li><a rel="nofollow" href="/news/payment-systems">Платежные системы</a></li>@endif
                    @if($posts_category->id != 30)<li><a rel="nofollow" href="/news/research">Исследования</a></li>@endif
                    @if($posts_category->id != 35)<li><a rel="nofollow" href="/news/laws">Новости законодательства</a></li>@endif
                    @if($posts_category->id != 36)<li><a rel="nofollow" href="/news/blog">Блог</a></li>@endif
                    @if($posts_category->id != 37)<li><a rel="nofollow" href="/news/investments">Инвестиции и вклады</a></li>@endif
                    @if($posts_category->id != 38)<li><a rel="nofollow" href="/news/market">Участникам рынка</a></li>@endif
                    @if($posts_category->id != 39)<li><a rel="nofollow" href="/news/interview">Интервью</a></li>@endif
                    @if(Request::url() != 'https://finance.ru/news/translations')<li><a rel="nofollow" href="/news/translations">Трансляции</a></li>@endif
                    @if($posts_category->id != 40)<li><a rel="nofollow" href="/news/webinars">Вебинары</a></li>@endif
                    @if($posts_category->id != 14)<li><a rel="nofollow" href="/news/vzo">Новости #ВЗО</a></li>@endif
                </ul>
            </div>
        </div>
        <?php endif; ?>
        <?php endif; ?>

    @if(isset($category_id))
    @if(($category_id == 1 ||  $category_id == 7))
        @include('frontend.includes.zaimy.calc')
    @endif
    @endif


    @if(Request::url() == 'https://finance.ru/get-rating')
        <div class="side-block listing-menu-s">
            <div class="side-title"><i class="fa fa-question-circle-o"></i>  Работа с личным кабинетом</div>
            <div class="side-box">
                <a href="https://finance.ru/get-rating#faq"><img src="/old_theme/img/get-rating.png" alt="Работа с личным кабинетом"></a>
            </div>
        </div>
    @endif


</aside>
            </div><?php /* sidebar */ ?>
<?php } // end if mobile device ?>