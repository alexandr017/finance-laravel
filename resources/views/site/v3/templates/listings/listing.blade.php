<?php global $c; $c = $cards; ?>
@extends('frontend.layouts.app')
@section ('title', Shortcode::compile($page->title,$cards))
@section ('h1', $page->h1)
@section ('meta_description', Shortcode::compile($page->meta_description))

@if(is_null($page->og_img))
@section ('og_image', 'https://finance.ru'.$page->img)
@else
@section ('og_image', 'https://finance.ru'.$page->og_img)
@endif

@section('content')

@include('frontend.includes.breadcrumbs')


<?php #dd($cards); ?>
<section class="container main">
    <div>
        <h1 class="p-h1">{{$page->h1}}</h1>
    </div>

    <div class="lpt">
        <span class="pup-inner">Обновлено в <span class="lowercase">{{\App\Models\System::getCurrentMonth(false)}}</span> <?= date('Y') ?></span>
        @if($page->cards_category_id != 1)
            <span class="pupcount"> {{Shortcode::compile("[carts_count]")}} шт.</span>
        @endif

        @if($page->expert_anchor != null)
        <a href="{{$page->expert_anchor}}" class="verified_by_expert"><i class="fa fa-check-square-o"></i> Проверено экспертом</a>
        @endif

        {!! $page->text_before !!}

        @if(isset($page->lead))
            @if(! strstr( $page->lead, '<p>'))
                <p>{!! $page->lead !!}</p>
            @else
                {!! $page->lead !!}
            @endif
        @endif
        <br class="clearfix">
    </div>




{{--    @if(response::check_mobile())--}}
{{--    @include('frontend.includes.tags')--}}
{{--    @endif--}}



    @if($_SERVER['REQUEST_URI'] == '/rko')
    @include('frontend.includes.rko.calc_ip_ooo')
    @endif

    <div class="row clearfix">
        <div class="col-lg-9 col-md-12">
            @if(($category_id == 4) && ($page->id == 4))
            @include('site.v3.templates.listings.includes.calc.credit')
            @endif

            @if(isset($page->category_id))
            @include("site.v3.templates.listings.includes.sorting_fields.".$page->category_id)
            @else
            @include("site.v3.templates.listings.includes.sorting_fields.".$page->id)
            @endif
            <div class="offers-list">
                <?php $admins = [
                    30154, // Артур
                    1,     // Виталий
                    12467,  // Я
                    92879, // Асмик
                    42101, // Виктор - админ
                    93480, // Никита - админ
                    95750, // Игоооооооорь
                    67835, // София
                ];
                ?>
                <?php $i=0; ?>
                @foreach($cards as $card)
                        @if($card->category_id == 1 || in_array(\Auth::id(), $admins))
                            @include('frontend.cards.minimal.card')
                        @else
                            @include('frontend.cards.card.card')
                        @endif
                    @if(count($cards)>10)
                        @if($i == 8)
                            @include('frontend.cards.card.info3')
                        @endif
                    @else
                        @if(count($cards) > 1 && $i == (count($cards) - 1))
                            @include('frontend.cards.card.info3')
                        @endif
                    @endif

                    <?php $i++; ?>
                    <?php if($i>9) break; ?>
                @endforeach
            </div>

            @if(count($cards)>10)
            <div class="text-center">
                <?php $countPrefix = (count($cards) <=20) ? (count($cards) - 10) : 10 ?>
                <button class="form-btn1" id="load_more">Показать ещё <span>{{$countPrefix}}</span></button>
            </div>
            @endif

            @if(count($others_cards) > 0)
            <div class="other_cards">
                <div class="fdsb listing-h2 text-center">Смотрите также</div>
                <div>
                    @foreach($others_cards as $card)
                    <?php /* $ratingValue = $card */ ?>
                    @include('frontend.cards.card.card')
                    @endforeach
                </div>
            </div>
            @endif


{{--            @if( ! response::check_mobile())--}}
{{--            @if($cca != null)--}}
{{--            <div class="list_vntages_wrap">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-sm-4">--}}
{{--                        <div class="lvw-inner">--}}
{{--                            <div class="lvw-head-wrap @if(strstr(Request::url(),'debit-cards')) lvw-head-wrap-6 @endif">--}}
{{--                                <img loading="lazy" src="{{$cca->adv1_img}}" alt="">--}}
{{--                                <span>{!! $cca->adv1_title !!}</span>--}}
{{--                            </div>--}}
{{--                            {!! $cca->adv1_text !!}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-sm-4">--}}
{{--                        <div class="lvw-inner">--}}
{{--                            <div class="lvw-head-wrap @if(strstr(Request::url(),'debit-cards')) lvw-head-wrap-6 @endif">--}}
{{--                                <img loading="lazy" src="{{$cca->adv2_img}}" alt="">--}}
{{--                                <span>{!! $cca->adv2_title !!}</span>--}}
{{--                            </div>--}}
{{--                            {!! $cca->adv2_text !!}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-sm-4">--}}
{{--                        <div class="lvw-inner">--}}
{{--                            <div class="lvw-head-wrap @if(strstr(Request::url(),'debit-cards')) lvw-head-wrap-6 @endif">--}}
{{--                                <img loading="lazy" src="{{$cca->adv3_img}}" alt="">--}}
{{--                                <span>{!! $cca->adv3_title !!}</span>--}}
{{--                            </div>--}}
{{--                            {!! $cca->adv3_text !!}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            @endif--}}
{{--            @endif--}}

{{--            @if(response::check_mobile())--}}
{{--            @if($page->menu != null)--}}
{{--            <div class="listing-menu">--}}
{{--                <div class="fdsb text-center">Вам будет полезно</div>--}}
{{--                {!! $page->menu !!}--}}
{{--            </div>--}}
{{--            @endif--}}
{{--            @endif--}}

            @if(isset($category_id))
            @if(file_exists( base_path().'/resources/views/frontend/listings/includes/total_cards_table/'.$category_id.'.blade.php'))
            @include("frontend.listings.includes.total_cards_table.$category_id")
            @endif
            @endif


{{--            @if(is_mobile_device())--}}
{{--            <div class="blue-block">--}}
{{--                @if(($category_id == 1 ||  $category_id == 7))--}}
{{--                @if(isset($category_id))--}}
{{--                @include('frontend.includes.zaimy.calc')--}}
{{--                @endif--}}
{{--                @endif--}}
{{--            </div>--}}
{{--            @endif--}}



            @if($popular_banks != null)
            <div class="popular_banks">
                <h2 class="listing-h2 text-center">{{$popular_banks->h2}}</h2>
                <?php $popular_banks_json = json_decode($popular_banks->json); ?>
                @if($popular_banks_json != null)
                <div id="popular_banks_slider">
                    @foreach($popular_banks_json as $json_item)
                    <div><a href="{{$json_item->href}}" target="_blank"><img loading="lazy" src="{{$json_item->logo}}" alt="{{$json_item->title}}"><br><span>{{$json_item->title}}</span></a></div>
                    @endforeach
                </div>
                @endif
            </div>
            @endif


            <div class="alc">{!! TagsParser::compile(Shortcode::compile($page->content)) !!}</div>


            @if(isset($zalogi_types))
            @if(count($zalogi_types) > 0)
            <div class="zalogi_types-wrap">
                <ul>
                    @foreach($zalogi_types as $zalogi_key => $zalogi_value)
                    <li><a href="/zalogi/{{$zalogi_key}}">{{$zalogi_value}}</a></li>
                    @endforeach
                </ul>
            </div>
            @endif @endif


            @if(isset($category_id))
            @if($category_id == 8)
            @include("frontend.listings.autocredit.knowledge_base")
            @endif
            @endif


{{--            <div class="bordered-rating star-rating light-border">--}}
{{--                <div class="post-ratings" data-type="new_listing" data-id="{{$prefixType}}{{$page->id}}">--}}
{{--                    {!! RatingParser::printIRatingByValue($page->average_rating) !!}--}}
{{--                    (<span class="bold">{{$page->number_of_votes}}</span> оценок, среднее: <span class="bold">{{$page->average_rating}}</span> из 5)<br />--}}
{{--                </div>--}}
{{--            </div>--}}



            <div id="compare_in_listing_pages" class="cilp">
                <div class="cilp_inner"></div>
            </div>



        </div><?php /* end col-md-9 */ ?>
        <div class="col-lg-3 d-lg-block d-xs-none d-none">
            @include('frontend.includes.sidebar')
        </div><?php /* md-3 */ ?>
    </div><?php /*row */ ?>
</section>

@endsection

@section('listings-scripts')
<script>
    document.addEventListener("DOMContentLoaded", others_onload);
    function others_onload(){
        dynamicallyLoadScript('/old_theme/js/scripts/2_3_listings/listings.js?v=22');
        dynamicallyLoadScript('/old_theme/js/modal.js');

    }
</script>

<script>
    window.number_page = 1;
    window.listing_id = @if($section_type==2)-@endif{{$page->id}};
    window.category_id = @if($section_type==2) {{$page->id}} @else {{$page->category_id}}  @endif;
    window.count_on_page = 10;
    window.cards_count = {{count($cards)}};
    window.section_type = 15;
    window.field = 'km5';
    window.sort_type = 'desc';
    window.sidebar_listings = {};
    if(document.body.clientWidth > 768){
        $(window).scroll(function() {
            if($(this).scrollTop() != 0) {
                $('header').addClass('fixed');
                $('header').css('border-bottom','1px solid #ddd');
            } else {
                $('header').css('border-bottom','0');
                $('header').removeClass('fixed');
            }
        });
    }

    $(function() {
        @if(!is_mobile_device())
        $(document).on('click', '.rko-card-btn', function() {
            $(this).parent().find('.rko-card-btn').removeClass('active');
            $(this).addClass('active');
            var id = $(this).attr('data-tab');
            console.log(id);
            $(this).parent().find('.rko-card-wrap').hide();
            $(this).parent().find('.rko-card-wrap-'+id).show();
        });
        @else
        $(document).on('click', '.rko-card-btn', function() {
            $(this).toggleClass('active');
            $(this).find('i').toggleClass('fa-angle-down').toggleClass('fa-angle-up');
            $(this).next().toggleClass('active');
        });
        @endif
    });
</script>

<?php //@if(!isset($GLOBALS['issetStructuredFAQ'])) ?>
    {!! App\Algorithms\Frontend\StructuredData\Product\Listings::render($cards, $page) !!}

@endsection
