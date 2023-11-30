<?php
[$ratingValue, $ratingCount] = \App\Algorithms\Frontend\Banks\BankReviews::getReviewsRating($reviews);

$page->average_rating = $ratingValue;
$page->number_of_votes = $ratingCount;
$page->img = 'https://finance.ru' . str_replace('https://finance.ru','',$bank->logo) . $bank->logo;
?>
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

                @if(is_mobile_device())
                    @include('site.v3.modules.banks.menu.mob')
                @else
                    @include('site.v3.modules.banks.menu.pc')
                @endif

                <img loading="lazy" src="{{$bank->logo}}" alt="{{$bank->h1}}" class="company-child-logo">

                {!! TagsParser::compile(Shortcode::compile($page->lead)) !!}

                {!! TagsParser::compile(Shortcode::compile($page->content)) !!}

                <div class="bordered-rating star-rating light-border">
                    {!! RatingParser::printIRatingByValue($page->average_rating) !!}
                    (<strong>{{count($reviews)}}</strong> оценок, среднее: <strong>{{round($page->average_rating, 2)}}</strong> из 5)
                </div>

            </div><?php /* end col-md-9 */ ?>
            <div class="col-lg-3 d-lg-block d-xs-none d-none">
                @include('site.v3.modules.banks.sidebar')
            </div><?php /* md-3 */ ?>
        </div><?php /*row */ ?>

    </article>

@endsection

@section('structured-data')
    @parent
    @include('site.structured-data.ProductBank', compact('page'))
@endsection