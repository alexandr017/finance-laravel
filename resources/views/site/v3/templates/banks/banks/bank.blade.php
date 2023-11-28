@extends('site.v3.layouts.app')
@section ('title', $page->title)
@section ('h1', $page->h1)
@section ('meta_description', $page->meta_description)


@section('compress-styles')
    @parent
    <?php
    include (public_path(). '/old_theme/css/modules/banks/index-banks-list.css');

    include (public_path(). "/old_theme/css/modules/banks/special-offers.css");

    if(is_mobile_device()){
        include (public_path(). "/old_theme/css/modules/banks/mob-menu-on-bank.css");
    }
    ?>
@endsection

@section('content')

    @include('site.v3.modules.includes.breadcrumbs')

    <section class="container main single-page bank-page">
        <div class="row">
            <div class="col-lg-9 col-md-12">
                <h1 class="p-h1">{{$page->h1}}</h1>

                @if(is_mobile_device())
                    @include('site.v3.modules.banks.menu.mob')
                    <?php
                    $bank_categories = [];
                    if($page->show_credits){
                        $bank_categories['kredity'] = ['Кредиты','bank'];
                    }
                    if($page->show_debit_cards){
                        $bank_categories['debetovye-karty'] = ['Дебетовые карты','credit-card-alt'];
                    }
                    if($page->show_auto_credits){
                        $bank_categories['avtokredity'] = ['Автокредиты','automobile'];
                    }
                    if($page->show_credit_cards){
                        $bank_categories['kreditnye-karty'] = ['Кредитные карты','credit-card'];
                    }
                    if($page->show_deposits){
                        $bank_categories['vklady'] = ['Вклады','gift'];
                    }
                    if($page->show_mortgage){
                        $bank_categories['ipoteka'] = ['Ипотеки','life-buoy'];
                    }
                    if($page->show_rko){
                        $bank_categories['rko'] = ['РКО','id-card'];
                    }
                    ?>
                    <div class="bank-cat-block">
                    @foreach($bank_categories as $key => $cat)
                        <?php
                        $bank_cat_name = $cat[0];
                        $bank_cat_logo = $cat[1];
                        ?>
                        <a href="/banki/{{ $page->alias }}/{{$key}}" class="bank-cat"><i class="fa-icon fa-{{$bank_cat_logo}}"></i><span>{{$bank_cat_name}}</span></a>
                    @endforeach
                    </div>
                    @include('site.v3.modules.banks.bank_face.face-mob')
                @else
                    @include('site.v3.modules.banks.menu.pc')
                    @include('site.v3.modules.banks.bank_face.face')
                @endif

                <?php /*
                <div class="bank-product-categories-slider">
                    @if($bank->show_credit_cards)
                    <a href="/banks/{{$bank->alias}}/credit-cards" class="bank-product-categories-slider-item">
                        <i class="fa fa-credit-card"></i>Кредитные карты
                    </a>
                    @endif
                    @if($bank->show_debit_cards)
                    <a href="/banks/{{$bank->alias}}/debit-cards" class="bank-product-categories-slider-item">
                        <i class="fa fa-credit-card-alt"></i>Дебетовые карты
                    </a>
                    @endif
                    @if($bank->show_auto_credits)
                    <a href="/banks/{{$bank->alias}}/autocredit" class="bank-product-categories-slider-item">
                        <i class="fa fa-automobile"></i>Автокредиты
                    </a>
                    @endif
                    @if($bank->show_insurance)
                    <a href="/banks/{{$bank->alias}}/insurance" class="bank-product-categories-slider-item">
                        <i class="fa fa-cubes"></i>Страховки
                    </a>
                    @endif
                    @if($bank->show_deposits)
                    <a href="/banks/{{$bank->alias}}/deposits" class="bank-product-categories-slider-item">
                        <i class="fa fa-gift"></i>Вклады
                    </a>
                    @endif
                    @if($bank->show_credits)
                    <a href="/banks/{{$bank->alias}}/credits" class="bank-product-categories-slider-item">
                        <i class="fa fa-bank"></i>Кредиты
                    </a>
                    @endif
                    @if($bank->show_mortgage)
                    <a href="/banks/{{$bank->alias}}/mortgage" class="bank-product-categories-slider-item">
                        <i class="fa fa-life-buoy"></i>Ипотеки
                    </a>
                    @endif
                    @if($bank->show_refinancing)
                    <a href="/banks/{{$bank->alias}}/refinancing" class="bank-product-categories-slider-item">
                        <i class="fa fa-id-card"></i>Рефинансирование
                    </a>
                    @endif
                    @if($bank->show_rko)
                    <a href="/banks/{{$bank->alias}}/rko" class="bank-product-categories-slider-item">
                        <i class="fa fa-cubes"></i>РКО
                    </a>
                    @endif
                </div>
 */ ?>

                {!! TagsParser::compile(Shortcode::compile($page->content)) !!}


                @if(
                count($cardsCredits) > 0 ||
                count($cardsCreditCards) > 0 ||
                count($cardsDebitCards) > 0 ||
                count($cardsRKO) > 0
                )
                    <h2 class="h2 text-center">Специальные предложения банка</h2>
                    @include("site.v3.modules.banks.special_offers.special_offers")
                @endif


                @if(count($reviews) > 0)
                    <div id="fix-block">
                        <h2 class="h2 text-center">Отзывы о банке «{{$page->name}}»</h2>
                        <div class="reviews">
                            <?php $reviewsForSlider = $reviews->take(7); ?>
                            @foreach($reviewsForSlider as $value)
                                <div class="itm <?php /* {{RatingParser::getCssClassForBackground($value->rating)}} */ ?>">
                                    <div class="iname">{{$value->author}}</div>
                                    {!! App\Algorithms\System::rating($value->rating) !!}
                                    <div class="itext"><p>{!! reviewsShortLenghtRender($value->review) !!}</p></div>
                                </div>
                            @endforeach
                        </div>
                        <div class="text-center"><a class="form-btn1" href="{{Request::url()}}/otzyvy">Все отзывы о банке</a></div>
                    </div>
                @endif



                <div class="bordered-rating star-rating light-border">
                    {!! RatingParser::printIRatingByValue($reviews) !!}
                    (<strong>{{$page->number_of_votes}}</strong> оценок, среднее: <strong>{{round($page->average_rating, 2)}}</strong> из 5)
                </div>

            </div><?php /* end col-md-9 */ ?>
            <div class="col-lg-3 d-lg-block d-xs-none d-none">
                @include('site.v3.modules.banks.sidebar')
            </div><?php /* md-3 */ ?>
        </div><?php /*row */ ?>
    </section>

@endsection


@section('additional-scripts')
    @parent
    <script src="/old_theme/js/modal.js" defer></script>
    <?php /*
    <style>

        .bank-product-categories-slider{
            margin: 60px 0;
        }
        .bank-product-categories-slider-item{
            color: #292929;
        }

        .bank-product-categories-slider-item:hover i.fa{
            text-decoration: none;
        }

        .bank-product-categories-slider i.fa{
            display: block;
            margin-bottom: 30px;
            font-size: 2rem;
            color: #a5ca38;
        }
    </style>
    */ ?>

    <script>

        $(function(){
            /*
            $('.post-slider').slick({
                dots: false,
                infinite: true,
                speed: 300,
                slidesToShow: 3,
                slidesToScroll: 1,
                responsive: [
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
            */


            /*
        $('.bank-product-categories-slider').slick({
            dots: false,
            infinite: false,
            speed: 300,
            infinite: true,
            slidesToShow: 4,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
        */

/*
            $('.reviews').slick({
                dots: false,
                infinite: false,
                speed: 300,
                infinite: true,
                slidesToShow: 3,
                slidesToScroll: 1,
                responsive: [
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
            */

            /* special offers */
            var active_special_offer = '#special-banks-offer-tab-'+$('.active-special-offer').data('id');
            $(active_special_offer).css('display','flex');
            $(active_special_offer).css('flex-wrap','wrap');
            $('.special-banks-offers-tabs div').on('click',function () {
                var hide_offer = '#special-banks-offer-tab-'+$('.active-special-offer').data('id');
                var show_offer = '#special-banks-offer-tab-'+$(this).data('id');
                $('.active-special-offer').removeClass('active-special-offer');
                $(this).addClass('active-special-offer');
                $(hide_offer).hide();
                $(show_offer).css('display','flex');;
                $(show_offer).css('flex-wrap','wrap');;
            })
            /* special offers */
        });
    </script>

    <script type="application/ld+json">{
         "@context": "http://schema.org",
         "@type": "Product",
         "aggregateRating": {
         "@type": "AggregateRating",
           "bestRating": "5",
           "ratingCount": "{{$page->number_of_votes}}",
           "ratingValue": "{{$page->average_rating}}"
         },
         <?php /*
         "review": {
         "@type": "Review",
         "name": "{{$page->h1}}" ,
         "author": "{{$author->name}}"
         },
         */ ?>
        "image": "https://finance.ru/old_theme/img/logo_vzo.png",
        "name": "{{$page->h1}}",
         "description" : "{{$page->meta_description}}",
         "sku": "{{$page->id}}",
         "slogan": "ФинансыРу",
         "url": "https://finance.ru/banks",
         "brand": "ВсеЗаймыОнлайн"
        }
    </script>
@endsection