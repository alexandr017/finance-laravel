<?php if(isset($section_type)): ?>
<?php if(($section_type == 2) || ($section_type == 3)  || ($section_type == -1)) : ?>


                <button class="show_all_filtres form-btn1">Подобрать <i class="fa fa-angle-down"></i></button>

                <div class="all_filttres_wrap">
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
                                <div class="side-title">@if(isset($tmp_arr[1])) <span class="fa {{$tmp_arr[1]}}"></span> @endif{{$tmp_arr[0]}} <i class="fa @if($k!=0) fa-angle-up @else fa-angle-down @endif"></i></div>
                                <div class="side-box links-list @if($k!=0) display_none @endif">
                                    @foreach($filter->values as $link)
                                        <?php if($link[0]->link == '/city' || $link[0]->link == 'https://finance.ru/city') $city_prefix = '' ?>
                                        <a class="sidebar" href="<?= str_replace('https://finance.ru', '', $link[0]->link) ?>{{$city_prefix}}">{{$link[0]->label}}
                                            <?php
                                            $urlPage = preg_replace('/$\//', '', $link[0]->link);
                                            $urlPageArr = explode('/',$urlPage);
                                            $urlPage = $urlPageArr[count($urlPageArr)-1];
                                            if(isset($countChildListings[$urlPage]))
                                                echo " (".$countChildListings[$urlPage].")";
                                            ?>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                            <?php $k++ ;?>
                        @endforeach
                    @endif

                    @if($section_type == 3 || $section_type == -1)
                        @if($category_id == 1)
                            <?php $regions = response::getCitiesLoansSidebar(); ?>
                            @foreach($regions as $regionKey => $region)
                                <div class="side-block-dart">
                                    <div class="side-title"><span class="fa fa-building-o"></span> Города ({{$regionKey}}) <i class="fa fa-angle-up"></i></div>
                                    <div class="side-box links-list display_none">
                                        @foreach($region as $link)
                                            @if(Request::path() !=  $link->alias)
                                                <a class="sidebar" href="/{{$link->alias}}">{{$link->imenitelny}}</a>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    @endif

                    @if($section_type == 3)
                        @if($category_id == 3)
                            <?php if(file_exists(base_path()."/resources/views/frontend/cards/zalogi_types/sidebar.blade.php"))
                                include base_path()."/resources/views/frontend/cards/zalogi_types/sidebar.blade.php";
                            ?>
                        @endif
                    @endif

                    @if(isset($category_id))
                        @if($category_id == 2)
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

                </div>




<br><br>
<?php endif; ?>
<?php endif; ?>