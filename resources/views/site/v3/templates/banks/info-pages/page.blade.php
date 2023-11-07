@extends('site.v3.layouts.app')
@section ('title', $page->title)
@section ('h1', $page->h1)
@section ('meta_description', $page->meta_description)

@if(is_null($bank->og_img))
    @section ('og_image', 'https://finance.ru'.$bank->logo)
@else
    @section ('og_image', 'https://finance.ru'.$bank->og_img)
@endif

@section('content')

    @include('site.v3.modules.includes.breadcrumbs')

    <article class="container main single-page children-pages">
        <div class="row">
            <div class="col-lg-9 col-md-12">
                <h1 class="p-h1">{{$page->h1}}</h1>
                <?php /* только горячии линии и личные кабинеты */ ?>
                @if($page->type_id == 1 || $page->type_id == 2)
                    @if($bankTopCard != null)
                        @include('site.v3.modules.banks.head_fixed_block.pc_and_mob')
                    @endif
                @endif
                
                @if(is_mobile_device())
                    @include('site.v3.modules.banks.menu.mob')
                @else
                    @include('site.v3.modules.banks.menu.pc')
                @endif

                <img loading="lazy" src="{{$bank->logo}}" alt="{{$bank->h1}}" class="company-child-logo">

                {!! TagsParser::compile(Shortcode::compile($page->lead)) !!}

                {!! TagsParser::compile(Shortcode::compile($page->content)) !!}


                <?php
                    $realCount = 0; $ratingValue = 0; $ratingValueTmp = 0;
                    foreach ($reviews as  $review) {
                        if($review->rating != null){
                            $ratingValueTmp += $review->rating;
                            $realCount++;
                        }
                    }
                    if($realCount != 0){
                        $ratingValue = round($ratingValueTmp / $realCount,2);
                    } else {
                        $ratingValue = 0;
                    }
                    $page->number_of_votes = $realCount;
                    $page->average_rating = $ratingValue;
                ?>


                <div class="bordered-rating star-rating light-border">
                    {!! RatingParser::printIRatingByValue($page->average_rating) !!}
                    (<strong>{{count($reviews)}}</strong> оценок, среднее: <strong>{{round($page->average_rating, 2)}}</strong> из 5)
                </div>

                </div><?php /* end col-md-9 */ ?>
            <div class="col-lg-3 d-lg-block d-xs-none d-none">
                @include('site.v3.modules.includes.sidebar.bank')
            </div><?php /* md-3 */ ?>
        </div><?php /*row */ ?>

        <?php /*

        @if($card != null && $card != [])
            <div class="fixed-company">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-9">
                            <?php $product_title = ($card->category_id == 1)
                                ? (($bank->company_name) ? $bank->company_name : $bank->h1)
                                : $card->title;
                            ?>
                            <img loading="lazy" width="150" src="{{$card->logo}}" alt="{{$product_title}}">
                            <span class="zaym-name">{{$product_title}}</span>
                        </div>
                        <div class="col-sm-3">
                            <?php if($card->status) {
                                $company_link = ($card->link_type == 1) ? $card->link_1 : $card->link_2;
                            } else {
                                $company_link = $card->link_2;
                            } ?>
                            <a data-id="{{$card->id}}" class="hdl form-btn1" href="{{$company_link}}" target="_blank"> Оформить</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        */ ?>

    </article>

@endsection

@section('additional-scripts')
    <?php /*
    {!! App\Algorithms\Frontend\StructuredData\Product\Companies::render($cards, $company) !!}
    */ ?>

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
        "image": "https://finance.ru/old_theme/img/finance_vzo.png",
        "name": "{{$page->h1}}",
         "description" : "{{$page->meta_description}}",
         "sku": "{{$page->id}}",
         "slogan": "ФинансыРу",
         "url": "https://finance.ru/banki",
         "brand": "ФинансыРу"
        }
    </script>
@endsection