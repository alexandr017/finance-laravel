<?php global $c; $c = $cards; ?>
@extends('site.v3.layouts.app')
@section ('title', $company->title)
@section ('h1', $company->h1)
@section ('meta_description', $company->meta_description)

@if(is_null($company->og_img))
    @section ('og_image', 'https://finance.ru'.$company->img)
@else
    @section ('og_image', 'https://finance.ru'.$company->og_img)
@endif


@section('content')

@include('site.v3.modules.includes.breadcrumbs')


@if(isset($cards[0]))
<div class="fixed-company">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-md-9">
                <img loading="lazy" width="150" src="{{$cards[0]->logo}}" alt="{{$cards[0]->title}}">
                <span class="zaym-name">{{ ($company->company_name != null) ? $company->company_name : $cards[0]->title}}</span>
            </div>
            <div class="col-sm-4 col-md-3">
                <a data-id="{{$cards[0]->id}}" class="hdl form-btn1" @if($cards[0]->link_type==1) href="{{$cards[0]->link_1}}" @else href="{{$cards[0]->link_2}}" @endif target="_blank">Оформить</a>
            </div>
        </div>
    </div>
</div>
@endif


<article class="container main single-page">
    <h1 class="p2-h1">{{$company->h1}}</h1>
    <div class="row">
        <div class="col-lg-9 col-md-12">
            @include('site.v3.modules.companies.company_menu')

            <?php
            $group_name = 'zaimy';
            $company_includes = 'company_includes';
            ?>

                @if(is_mobile_device())
                    @include("site.v3.modules.companies.company_includes.zaimy.face-mob")
                @else
                    @include("site.v3.modules.companies.company_includes.zaimy.face")
                @endif


            <div class="offers-list">
            @if($group_name == 'default')
            @if(!$company->closed && $company->group_id != 1)
            @if($cards != null)
            @foreach($cards as $card)
            @include('site.v3.modules.cards.card.card')
            @endforeach
            @endif
            @endif
            @endif
            </div>


            @if(!$company->closed)
            @if($company->group_id == 1)
            @if(isset($cards[0]))
            <div id="mfo_calc">
                <div class="row">
                    <div class="col-md-4">
                        <div class="ind-wrap">
                            <label>Сумма</label>
                            <div class="cont">
                                <?php
                                $sum_min = (isset($cards[0]->sum_min)) ? $cards[0]->sum_min : 1;
                                $sum_max = (isset($cards[0]->sum_max)) ? $cards[0]->sum_max : 2;
                                $sum_step_value = ($sum_max - $sum_min) / 4;
                                $sum_step_str = $sum_min .' ';
                                $sum_step_str .= $sum_min+$sum_step_value*1  . ' ';
                                $sum_step_str .= $sum_min+$sum_step_value*2 . ' ';
                                $sum_step_str .= $sum_min+$sum_step_value*3  . ' ';
                                $sum_step_str .= $sum_max  . ' ';

                                ?>
                                <input type="range" min="{{$sum_min}}" max="{{$sum_max}}" value="{{$sum_max/2}}" step="100" list="sum_range" id="sum_range_input" oninput="calc_update(this.value,1)" touchstart="calc_update(this.value,1)">
                                <datalist id="sum_range">
                                    <option value="{{$sum_min}} to {{$sum_max}}">{{$sum_min}}</option>
                                    @for($i=1; $i<=4; $i++)
                                    <?php /* $sum_step_str = $sum_step_str . " ". ($i*$sum_step_value+$sum_min - ($sum_step_value+$sum_min)+$sum_min); */ ?>
                                    <option>{{$i*$sum_step_value+$sum_min}}</option>
                                    @endfor
                                </datalist>
                            </div>

                            <?php
                            $term_min = (isset($cards[0]->term_min)) ? $cards[0]->term_min : 1;
                            $term_max = (isset($cards[0]->term_max)) ? $cards[0]->term_max : 2;
                            $term_step_value = ($term_max - $term_min) / 4;
                            $term_step_str = $term_min.' ';
                            $term_step_str .= (int)($term_min+$term_step_value*1)  . ' ';
                            $term_step_str .= (int)($term_min+$term_step_value*2) . ' ';
                            $term_step_str .= (int)($term_min+$term_step_value*3)  . ' ';
                            $term_step_str .= $term_max  . ' ';
                            ?>
                            <br>
                            <label>Срок</label>
                            <div class="cont2">
                                <input type="range" min="{{$term_min}}" max="{{$term_max}}" value="{{ceil($term_max/2)}}" step="1" list="term_range" id="term_range_input" oninput="calc_update(this.value,2)" touchstart="calc_update(this.value,2)">
                                <datalist id="term_range">
                                    <option value="{{$term_min}} to {{$term_max}}">{{$term_min}}</option>
                                    @for($i=1; $i<7; $i++)
                                    <option>{{$i*$term_step_value+$term_min}}</option>
                                    @endfor
                                </datalist>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="calc-result">
                            <div class="sub-title">Рассчитать займ в {{$cards[0]->title}}</div>
                            <div class="line">Сумма: <span id="sum_field">{{$sum_max/2}} руб</span></div>
                            <div class="line">Срок: <span id="term_field">{{ceil($term_max/2)}} дн.</span></div>
                            <div class="line">Процентная ставка: <span>@if(isset($cards[0]->percent)) {{$cards[0]->percent}}% @else 0% @endif</span></div>
                            <div class="total-line">Переплата <span>{{round(($sum_max/2)*($term_max/2)*$cards[0]->percent/100,2)}} руб.</span></div>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <a class="form-btn1" @if($cards[0]->link_type==1) href="{{$cards[0]->link_1}}" @else href="{{$cards[0]->link_2}}" @endif target="_blank"> Оформить займ</a>

                    </div>

                </div>
                <p class="calc-info">Вышеуказанная форма используется для имитации расчета стоимости займа с ориентировочными значениями.
                        Для уточнения информации нажмите кнопку.
                        Минимальная сумма займа: @if(isset($cards[0]->sum_min)) {{number_format($cards[0]->sum_min, 0, '.', ' ')}} @else 0 @endif рублей, максимальная: @if(isset($cards[0]->sum_max)) {{number_format($cards[0]->sum_max, 0, '.', ' ')}} @else 0 @endif рублей.
                        Процентная ставка в год: @if(isset($cards[0]->percent)) {{$cards[0]->percent * 365}}% @else 0% @endif.
                        Минимальный срок: @if(isset($cards[0]->term_min)) {{$cards[0]->term_min}} @else 0 @endif дней, максимальный: @if(isset($cards[0]->term_max)) {{$cards[0]->term_max}} @else 0 @endif дней.
                        Предложение не является офертой.</p>
            </div>
            <div class="display_none">
                <div class="offerData">
                    <table>
                        <tr>
                            <th>На срок</th>
                            <td>до {{$cards[0]->header_2}} <div class="strong">дней</div></td>
                        </tr>
                        <tr>
                            <th>Сумма</th>
                            <td class="amount">до {{$cards[0]->header_1}} руб.</td>
                        </tr>
                        <tr>
                            <th>Ставка</th>
                            <td>{{$cards[0]->header_3}}% в день</td>
                        </tr>
                        <tr>
                            <th>Переплата</th>
                            <td>
                                <?php
                                $m_min = (isset($cards[0]->sum_min)) ? $cards[0]->sum_min : 0;
                                $m_term_min = (isset($cards[0]->term_min)) ? $cards[0]->term_min : 0;
                                $m_percent = (isset($cards[0]->percent)) ? $cards[0]->percent : 0;
                                $res = $m_min * ($m_percent /100) * $m_term_min;
                                echo number_format($res, 0, '.', ' ') . ' руб.';
                                ?>
                            </td>
                        </tr>
                    </table>
                </div>

            </div>

            <script>
                function calc_update(value, field){
                    percent = @if(isset($cards[0]->percent)) {{$cards[0]->percent}} @else 1 @endif;
                    if(field == 1){
                        sum = value;
                        $('#sum_field').text(new Intl.NumberFormat().format(Number(value).toFixed(0))+' руб');
                        //$('#sum_field').text(sum+' руб');
                        term = $('#term_field').text();
                        term = parseInt(term.replace(' дн.',''));
                    } else {
                        term = value;
                        $('#term_field').text(term+' дн.');
                        sum = $('#sum_field').text();
                        sum = sum.replace(/\s/g, '');
                        sum = parseInt(sum.replace('руб',''));
                    }
                    res = new Intl.NumberFormat().format(Number((sum*term*percent/100).toFixed(0)));
                    res = res.replace(',','.');
                    $('.total-line span').text(res + ' руб');
                }
            </script>
            @endif
            @endif
            @endif


            @if(!empty($icons))
                <div class="companies_icons_wrap">
                    <div class="similars-title bold">Особенности компании</div>
                    <div class="row">

                <?php $prefix_icons = ''; $icons_counter = 1; ?>
                @foreach ($icons as $icon)
                    <?php
                        switch ($icon->category_id){
                            case 1: $prefix_icons = '/images/icons/zaimy'; break;
                            case 4: $prefix_icons = '/images/icons/kredity'; break;
                            case 5: $prefix_icons = '/images/icons/kreditnye-karty'; break;
                            case 6: $prefix_icons = '/images/icons/debetovye-karty'; break;
                        }
                    ?>

                    <div class="col-sm-4 @if($icons_counter >=4  && count($icons) > 3) display_none @endif">
                        <div class="icc-wrap">
                            <img loading="lazy" class="icc-inner-img" src="{{$prefix_icons}}/{{$icon->icon_label}}" alt="{{$icon->icon_name}}">
                            <span class="icc-inner-span">{{$icon->icon_name}}</span>
                        </div>
                    </div>
                    <?php $icons_counter++ ; ?>
                    @endforeach
                    </div>
                    @if(count($icons) > 3)
                        <button id="show_more_companies_icons">Показать все</button>
                    @endif
                </div>
            @endif


            <div class="text-block" id="single_content_wrap">
                {!! TagsParser::compile(Shortcode::compile($company->text_after)) !!}
            </div>



            @if($similar_companies != null)
            <div class="similars">
                <div class="similars-title bold">Похожие организации</div>
                <div class="row">
                    @foreach($similar_companies as $similar)
                    <div class="col-md-4 col-sm-4">
                        <a target="_blank" href="">
                        <img loading="lazy" src="{{$similar->img}}" alt="{{$similar->h1}}"><br>
                        @if($similar->company_name != null)
                            {{$similar->company_name}}
                        @else
                            {{$similar->h1}}
                        @endif
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif


        </div><?php /* end col-md-9 */ ?>
        <div class="col-lg-3 d-lg-block d-xs-none d-none">
            @include('site.v3.modules.includes.sidebar')
        </div><?php /* md-3 */ ?>
    </div><?php /*row */ ?>
</article>

@endsection

@section('additional-styles')
    <style>
        @if(isset($sum_step_str)) .cont:after {content: '{{$sum_step_str}}';} @endif
        @if(isset($term_step_str)) .cont2:after {content: '{{$term_step_str}}';}  @endif
    </style>
@endsection



@section('additional-scripts')
<script src="/old_theme/js/modal.js" defer></script>
<script src="/old_theme/js/scripts/5Company/company.js?id=5" defer></script>
@if(!$company->reviews_page)
<script src="/old_theme/js/scripts/5Company/reviews.js?id=6" defer></script>
@endif
<script>
    window.company_id = {{$company->id}}
</script>

<script type="application/ld+json">
{
    "@context": "http://schema.org/",
    "@id": "{{Request::url()}}",
    "datePublished": ">{{ str_replace(' ','T',$company->updated_at).'+04:00'}}",
    "dateModified": ">{{ str_replace(' ','T',$company->created_at).'+04:00'}}",
    "headline": "{{$company->h1}}",
    "author":{
        "@type": "Person",
        "name": "Анатолий Гарин"
    },
    "mainEntityOfPage":{
        "@type": "WebPage",
        "@id": "{{Request::url()}}"
    },
    "publisher":{
        "@type": "Organization",
        "name": "Анатолий Гарин",
        "logo":{
            "@type":"ImageObject",
            "url":"https://finance.ru/old_theme/img/logo_vzo.png"
        }
    },
    "image":{
        "@type": "ImageObject",
        "url": "{{$company->img}}",
        "width":"250",
        "height":"120"
    }
}
</script>

<?php
global $realReviewsCount;
global $ratingReviewsValue;
$company->number_of_votes = $realReviewsCount;
$company->average_rating = $ratingReviewsValue;
?>

@if($company->reviews_page)
    {!! App\Algorithms\Frontend\StructuredData\Product\Companies::render($cards, $company) !!}
@else
    {!! App\Algorithms\Frontend\StructuredData\Product\CompaniesWithReviews::render($cards, $company, $reviews) !!}
@endif


@endsection