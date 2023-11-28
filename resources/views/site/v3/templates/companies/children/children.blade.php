@extends('site.v3.layouts.app')
@section ('title', $page->title)
@section ('h1', $page->h1)
@section ('meta_description', $page->meta_description)

@if(is_null($company->og_img))
    @section ('og_image', 'https://finance.ru'.$company->img)
@else
    @section ('og_image', 'https://finance.ru'.$company->og_img)
@endif

@section('content')

@include('site.v3.modules.includes.breadcrumbs')

<article class="container main single-page children-pages">
    <div class="row">
        <div class="col-lg-9 col-md-12">
            @include('site.v3.modules.companies.company_menu')
            <h1 class="p-h1">{{$page->h1}}</h1>

            <img loading="lazy" src="{{$company->img}}" alt="{{$company->h1}}" class="company-child-logo">
            {!! TagsParser::compile(Shortcode::compile($page->content)) !!}

            <div class="bordered-rating star-rating light-border">
                <div class="post-ratings" data-type="listing_children_page" data-id="{{$page->id}}">
                    {!! RatingParser::printIRatingByValue($page->average_rating) !!}
                    (<strong>{{$page->number_of_votes}}</strong> оценок, среднее: <strong>{{$page->average_rating}}</strong> из 5)<br />
                </div>
            </div>


        </div><?php /* end col-md-9 */ ?>
        <div class="col-lg-3 d-lg-block d-xs-none d-none">
            @include('site.v3.modules.includes.sidebar')
        </div><?php /* md-3 */ ?>
    </div><?php /*row */ ?>

    @if($card != null && $card != [])
        <div class="fixed-company">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-md-9">
                        <?php $product_title = ($card->category_id == 1)
                            ? (($company->company_name) ? $company->company_name : $company->h1)
                            : $card->title;
                        ?>
                        <img loading="lazy" width="150" src="{{$card->logo}}" alt="{{$product_title}}">
                        <span class="zaym-name">{{$product_title}}</span>
                    </div>
                    <div class="col-sm-4 col-md-3">
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

</article>

@endsection

@section('additional-scripts')
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
    $company->number_of_votes = $realCount;
    $company->average_rating = $ratingValue;
    $company->title = $page->title;
    $company->h1 = $page->h1;
    $company->meta_description = $page->meta_description;
    ?>
    {!! App\Algorithms\Frontend\StructuredData\Product\Companies::render($cards, $company) !!}
@endsection