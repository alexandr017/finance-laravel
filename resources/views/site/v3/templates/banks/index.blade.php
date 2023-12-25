@extends('site.v3.layouts.app')
@section ('title', $page->title)
@section ('h1', $page->h1)
@section ('meta_description', $page->meta_description)

@section('compress-styles')
@parent
<?php
include (public_path(). '/old_theme/css/modules/banks/index-banks-list.css');
include (public_path(). "/old_theme/css/modules/banks/special-offers.css");
?>
@endsection


@section('content')
    @include('site.v3.modules.includes.breadcrumbs')
    <section class="container main single-page">
        <div class="row">
            <div class="col-lg-9 col-md-12">
                <h1 class="p-h1">{{$page->h1}}</h1>

                <div class="lpt listing-lead">
                    {!! TagsParser::compile(Shortcode::compile($page->lead)) !!}
                </div>

                @if(is_mobile_device())
                <button class="show_all_filtres form-btn1">Подобрать <i class="fa fa-angle-down"></i></button>
                <div class="all_filttres_wrap">
                    @include('site.v3.modules.banks.bank-relink')
                </div>
                <br>
                <br>
                @endif
                @include("site.v3.modules.banks.index_banks_list.index_banks_list")

                <h2 class="h2 text-center">Специальные предложения банков</h2>
                @include("site.v3.modules.banks.special_offers.special_offers")


                <div id="fix-block">
                    <h2 class="h2 text-center">Отзывы о банках</h2>
                    <div class="reviews">
                        @foreach($reviews as $value)
                            <div class="itm {{RatingParser::getCssClassForBackground($value->rating)}}">
                                <div class="iname">{{$value->author}}</div>
                                {!! App\Algorithms\System::rating($value->rating) !!}
                                <div class="text-center" style="font-weight: bold">«{{$value->bankName}}»</div>

                                <div class="itext"><p>{!! reviewsShortLenghtRender($value->review) !!}</p></div>
                                <br>
                                <a href="/banki/{{$value->bankAlias}}/otzyvy">Все отзывы банка</a>
                            </div>
                        @endforeach
                    </div>
                </div>

                {!! TagsParser::compile(Shortcode::compile($page->content)) !!}

                <div class="bordered-rating star-rating light-border">
                    <div class="post-ratings" data-type="bank_index">
                        {!! RatingParser::printIRatingByValue($page->average_rating) !!}
                        (<strong>{{$page->number_of_votes}}</strong> оценок, среднее: <strong>{{round($page->average_rating,2)}}</strong> из 5)<br />
                    </div>
                </div>

            </div><?php /* end col-md-9 */ ?>
            <div class="col-lg-3 d-lg-block d-xs-none d-none">
                @include('site.v3.modules.banks.sidebar')
            </div><?php /* md-3 */ ?>
        </div><?php /*row */ ?>
    </section>

@endsection


@section('additional-scripts')
    <script>
        $(function(){
            var active_special_offer = '#special-banks-offer-tab-'+$('.active-special-offer').data('id');
            $(active_special_offer).css('display','flex');
            $(active_special_offer).css('flex-wrap','wrap');
            $('.special-banks-offers-tabs .special-banks-offers-tabs-item').on('click',function () {
                var hide_offer = '#special-banks-offer-tab-' + $('.active-special-offer').data('id');
                var show_offer = '#special-banks-offer-tab-'+  $(this).data('id');
                $('.active-special-offer').removeClass('active-special-offer');
                $(this).addClass('active-special-offer');
                $(hide_offer).hide();
                $(show_offer).css('display','flex');
                $(show_offer).css('flex-wrap','wrap');
            })
            $('#searchByBanks').keyup(function () {
                searchBank();
            })
            function searchBank(){
                var search_hint = $('#searchByBanks').val();
                if(search_hint.length >= 3 && search_hint.indexOf('бан') == -1){
                    $('.bank-flex-item .company_title').each(function () {
                        if($(this)[0].innerText.toLowerCase().indexOf(search_hint.toLowerCase()) == -1) {
                            $(this).parent().parent().parent().addClass('hide_by_search_hint');
                            $('.pagination').css('display','none');
                        }else{
                            $(this).parent().parent().parent().removeClass('hide_by_search_hint');
                            $('.pagination').css('display','none');
                            $('.banks-page').css('display','block');
                        }
                    })
                } else {
                    $('.banks-page:not(.active_page)').css('display','none');
                    $('.hide_by_search_hint').removeClass('hide_by_search_hint');
                    $('.pagination').css('display','block');
                }
            }
            $('.bvc-read').on('click',function () {
                $(this).next().toggleClass('hidden-line');
                $(this).find('i').toggleClass('fa-angle-down');
                $(this).find('i').toggleClass('fa-angle-up');
            })
            var bank_items = $('.bank-flex-item').length;
            if(bank_items > 10) {
                var pages = bank_items/10;
                var banks_pagination = '';
                for(let i=1;i<=pages+1;i++) {
                    if(i==1) {
                        banks_pagination += '<li class="active page-'+i+'"><a href="#">'+i+'</a></li>'
                    } else {
                        banks_pagination += '<li class="page-'+i+'"><a href="#">'+i+'</a></li>'
                    }
                }
                $('.pagination').html(banks_pagination);
            }
            var active_bank_page = '.banks-page-'+$('.pagination .active a').html();
            $(active_bank_page).addClass('active_page');
            $('.pagination li a').on('click',function (event) {
                event.preventDefault();
                var active_bank_page = '.banks-page-'+$('.pagination .active a').html();
                var add_active_page = '.banks-page-'+$(this).html();
                $(active_bank_page).removeClass('active_page');
                $(add_active_page).addClass('active_page');
                $(active_bank_page).css('display','none');
                $(add_active_page).css('display','block');
                $('.pagination li').removeClass('active');
                $(this).parent().addClass('active');
                $([document.documentElement, document.body]).animate({
                    scrollTop: $(".bank-wrap").offset().top
                }, 2);
            })
        });


        $('.bvc-read-pc').on('click', function(){
            $(this).toggleClass('bvc-read-pc-left');
            //$(this).switchClass( "oldClass", "bvc-read-pc-left", 1000, "easeInOutQuad" );
        });
    </script>
@endsection

@section('structured-data')
    @parent
    @include('site.structured-data.ProductBank', compact('page'))
@endsection