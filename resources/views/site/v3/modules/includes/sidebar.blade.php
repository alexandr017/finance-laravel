@if(!is_mobile_device())
<div class="sidebar">
<aside>

@if($_SERVER['REQUEST_URI'] == '/')
    block for index sidebar
@endif


{{--<?php--}}
{{--if(isset($category_id)){--}}
{{--    if(file_exists(base_path()."/resources/views/frontend/includes/sidebar/search-".$category_id.".blade.php"))--}}
{{--        include base_path()."/resources/views/frontend/includes/sidebar/search-".$category_id.".blade.php";--}}
{{--}--}}

{{--$options = json_decode($options_json); $oi=1; ?>--}}
{{--@if($options!=null)--}}
{{--<div class="side-block-dart">--}}
{{--    <div class="side-title">Опции <i class="fa angle-down"></i></div>--}}
{{--    <div class="side-box options-list">--}}
{{--    @foreach($options as $option)--}}
{{--        <span> <input type="checkbox" value="{{$option->id_title}}" id="check{{$oi}}"> <label for="check{{$oi}}">{{$option->label}}</label></span>--}}
{{--        <?php $oi++; ?>--}}
{{--    @endforeach--}}
{{--        <div class="form-line form-line-mb0">--}}
{{--                <button class="form-btn1 width-100" id="find_by_options-@if(isset($category_id)){{$category_id}}@endif">Найти</button>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--@endif--}}

@include('site.v3.modules.includes.relink')



@if(isset($showSidebarConversionBlock) && $card != null && $card != [])
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
    @if(isset($showContentMenu))
        <?php global $sidebar_tags_menu; ?>
        @if(is_array($sidebar_tags_menu) && count($sidebar_tags_menu) > 1)
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





@include('site.v3.modules.blog.categories')

@if(isset($category_id))
@if(($category_id == 1 || $category_id == 7))
    @include('site.v3.modules.includes.zaimy.calc')
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
@endif