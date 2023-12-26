<?php global $c; $c = $cards; ?>

@extends('site.v3.layouts.app')
@section ('title', Shortcode::compile($page->title))
@section ('h1', $page->h1)
@section ('meta_description', Shortcode::compile($page->meta_description))

@if(is_null($page->og_img))
@section ('og_image', 'https://finance.ru'.$page->img)
@else
@section ('og_image', 'https://finance.ru'.$page->og_img)
@endif

@section('content')

@include('site.v3.modules.includes.breadcrumbs')


<section class="container main">
    <div>
        <h1 class="p-h1">{{$page->h1}}</h1>
    </div>

    <div class="lpt listing-lead">
        <span class="pup-inner">Обновлено в <span class="lowercase">{{\App\Algorithms\System::getCurrentMonth(false)}}</span> <?= date('Y') ?></span>
        @if($page->cards_category_id != 1)
            <span class="pupcount"> {{Shortcode::compile("[carts_count]")}} шт.</span>
        @endif

        @if(! strstr( $page->lead, '<p>'))
            <p>{!! $page->lead !!}</p>
        @else
            {!! $page->lead !!}
        @endif
        <br class="clearfix">
    </div>


    @if(is_mobile_device())
    @include('site.v3.modules.includes.relink')
    @endif

    <div class="row clearfix">
        <div class="col-lg-9 col-md-12">
            @if(isset($page->category_id))
            @include("site.v3.templates.listings.includes.sorting_fields.".$page->category_id)
            @endif
            <div class="offers-list">
                <?php $i=0; ?>
                @foreach($cards as $card)
                    @if($card->category_id == 1)
                        @include('site.v3.modules.cards.minimal.card')
                    @else
                        @include('site.v3.modules.cards.card.card')
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


            @if(isset($page->category_id))
                @if(file_exists( base_path().'/resources/views/site/v3/modules/listings/includes/total_cards_table/'.$page->category_id.'.blade.php'))
                    @include("site.v3.modules.listings.includes.total_cards_table.$page->category_id")
                @endif
            @endif


            @if(is_mobile_device())
                @if(($page->category_id == 1))
                    <div class="blue-block">
                    @include('site.v3.modules.includes.zaimy.calc')
                    </div>
                @endif
            @endif

            <div class="alc">{!! TagsParser::compile(Shortcode::compile($page->content)) !!}</div>


            @if(isset($category_id))
            @if($category_id == 8)
            @include("site.v3.modules.listings.autocredit.knowledge_base")
            @endif
            @endif


            <div class="bordered-rating star-rating light-border">
                <div class="post-ratings" data-type="listing" data-id="{{$page->id}}">
                    {!! RatingParser::printIRatingByValue($page->average_rating) !!}
                    (<span class="bold">{{$page->number_of_votes}}</span> оценок, среднее: <span class="bold">{{$page->average_rating}}</span> из 5)<br />
                </div>
            </div>


        </div><?php /* end col-md-9 */ ?>
        <div class="col-lg-3 d-lg-block d-xs-none d-none">
            @include('site.v3.modules.includes.sidebar')
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
    window.category_id = {{$page->category_id}};
    window.listing_id = {{$page->id}};
    window.count_on_page = 10;
    window.cards_count = {{count($cards)}};
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
@endsection

@section('structured-data')
    @parent
    @include('site.structured-data.ProductListing', compact('cards', 'page'))
@endsection
