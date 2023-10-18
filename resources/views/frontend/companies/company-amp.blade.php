<?php global $c; $c = $cards; ?>
@extends('frontend.layouts.amp')
@section ('title', $company->title)
@section ('h1', $company->h1)
@section ('meta_description', $company->meta_description)

@section('content')

@include('frontend.includes.breadcrumbs')

<article class="container main single-page">
    <div class="row">
        <div class="col-lg-12 col-md-12">

            <nav class="org">
                <ul>
                    <?php
                        $currentUrl = URL::current();
                        $currentUrl = str_replace('/amp', '', $currentUrl);
                    ?>
                    @if($company->support_link!=null)
                    <li><a href="{{$company->support_link}}"><i class="fa fa-life-bouy"></i>Служба поддержки</a></li>
                    <?php $support_link_tmp = 1; ?>
                    @endif
                    @if($company->account_link!=null)
                    <li><a href="{{$company->account_link}}"><i class="fa fa-life-bouy"></i>Личный кабинет</a></li>
                    <?php $account_link_tmp = 1; ?>
                    @endif
                    @if($company->promokody_link!=null)
                    <li><a href="{{$company->promokody_link}}"><i class="fa fa-life-bouy"></i>Промокоды</a></li>
                    <?php $promokody_link_tmp = 1; ?>
                    @endif
                    @if($company->reviews_link!=null)
                    <li><a href="{{$company->reviews_link}}"><i class="fa fa-comments-o"></i>Отзывы</a></li>
                    <?php $promokody_link_tmp = 1; ?>
                    @endif                    
                    @foreach($companiesChildrenPages as $page)
                    @if(($page->type_id == 1) && ($page->status==1) && (!isset($support_link_tmp)))
                    <li><a href="{{$currentUrl}}/gorjachaja-linija"><i class="fa fa-life-bouy"></i>Служба поддержки</a></li>
                    @endif
                    @if(($page->type_id == 2) && ($page->status==1) && (!isset($account_link_tmp)))
                    <li><a href="{{$currentUrl}}/login"><i class="fa fa-user"></i>Личный кабинет</a></li>
                    @endif
                    @if(($page->type_id == 3) && ($page->status==1) && (!isset($promokody_link_tmp)))
                    <li><a href="{{$currentUrl}}/promokody"><i class="fa fa-bookmark"></i>Промокоды</a></li>
                    @endif
                    @if(($page->type_id == 4) && ($page->status==1) && (!isset($reviews_link_tmp)))
                    <li><a href="{{$currentUrl}}/reviews"><i class="fa fa-comments-o"></i>Отзывы</a></li>
                    @endif                    
                    @endforeach
                </ul>
            </nav>

<?php /*
                <nav class="org">
                    <amp-carousel
                            width="450"
                            height="48"
                            layout="responsive"
                            type="slides"
                            role="region"
                            aria-label="Basic carousel"
                    >
                        <?php
                        $currentUrl = URL::current();
                        $currentUrl = str_replace('/amp', '', $currentUrl);
                        ?>
                        @if($company->support_link!=null)
                            <a href="{{$company->support_link}}"><i class="fa fa-life-bouy"></i>Служба поддержки</a>
                            <?php $support_link_tmp = 1; ?>
                        @endif
                        @if($company->account_link!=null)
                            <a href="{{$company->account_link}}"><i class="fa fa-life-bouy"></i>Личный кабинет</a>
                            <?php $account_link_tmp = 1; ?>
                        @endif
                        @if($company->promokody_link!=null)
                            <a href="{{$company->promokody_link}}"><i class="fa fa-life-bouy"></i>Промокоды</a>
                            <?php $promokody_link_tmp = 1; ?>
                        @endif
                        @if($company->reviews_link!=null)
                            <a href="{{$company->reviews_link}}"><i class="fa fa-comments-o"></i>Отзывы</a>
                            <?php $promokody_link_tmp = 1; ?>
                        @endif
                        @foreach($companiesChildrenPages as $page)
                            @if(($page->type_id == 1) && ($page->status==1) && (!isset($support_link_tmp)))
                                <a href="{{$currentUrl}}/gorjachaja-linija"><i class="fa fa-life-bouy"></i>Служба поддержки</a>
                            @endif
                            @if(($page->type_id == 2) && ($page->status==1) && (!isset($account_link_tmp)))
                                <a href="{{$currentUrl}}/login"><i class="fa fa-user"></i>Личный кабинет</a>
                            @endif
                            @if(($page->type_id == 3) && ($page->status==1) && (!isset($promokody_link_tmp)))
                                <a href="{{$currentUrl}}/promokody"><i class="fa fa-bookmark"></i>Промокоды</a>
                            @endif
                            @if(($page->type_id == 4) && ($page->status==1) && (!isset($reviews_link_tmp)))
                                <a href="{{$currentUrl}}/reviews"><i class="fa fa-comments-o"></i>Отзывы</a>
                            @endif
                        @endforeach
                    </amp-carousel>
                </nav>
*/ ?>

            <div class="row">
                <div class="col-md-4 text-center">
                    <link itemprop="mainEntityOfPage" href="{{URL::Current()}}" />
                    <span itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                        <meta itemprop="url" content="{{$company->img}}">
                        <meta itemprop="width" content="250">
                        <meta itemprop="height" content="120">
                    </span>
                    <meta itemprop="headline" content="{{$company->h1}}">
                    <meta itemprop="author" content="#ВЗО" />
                    <meta itemprop="datePublished" content="2017-07-06" />
                    <meta itemprop="dateModified" content="{{date('Y')}}" />
                    <div class="top-credit-cards">
                        <span  @if($company->closed) class="closed-company" @endif>
                            <amp-img  width="250" height="120" layout="fixed" src="{{$company->img}}" alt="{{$company->h1}}" class="alignleft no-margin"></amp-img>
                            <meta itemprop="width" content="250">
                            <meta itemprop="height" content="120">
                        </span>
                    </div>
                </div>
                <div class="col-md-8">
                    <h1 class="h1">{{$company->h1}}</h1>
                    <span class="s-pupdate">Обновлено в {{System::getCurrentMonth(false)}} {{date('Y')}}</span>
                    <?php $ratingValue = \App\Algorithms\Frontend\Banks\BankReviews::getRatingByReviews($reviews); ?>
                    @if(isset($cards[0]))
                        <div class="rating-line micro">
                            {!! RatingParser::printImgRatingByValueForAMP($ratingValue) !!}
                            <div class="text-rating">
                                <a rel="nofollow" href="{{$cards[0]->link_to_reviews_page}}">{{count($reviews)}} {{System::endWords(count($reviews), ['отзыв', 'отзыва', 'отзывов'])}}</a>
                            </div>
                            <div class="val-rating">({{$ratingValue}} из 5)</div>
                        </div>
                    @endif

                        <p>{!! str_replace(['<p>','</p>'], '', Shortcode::compile(System::nofollow($company->text_before))) !!}</p>
            </div>

            <div class="offers-list">
            @if($cards != null)
            @foreach($cards as $card)
            @include('frontend.cards.card.card-amp')
            @endforeach
            @endif
            </div>

            <div class="text-block" id="single_content_wrap">
                <?php $company->text_after = Shortcode::compile(System::nofollow($company->text_after)); ?>
                {!!  AMP::render($company->text_after) !!}
            </div>

                <?php /*
            @if(isset($cards[0]))
                <div class="old-fixed-company">
                    <a data-id="{{$cards[0]->id}}"  @if($cards[0]->link_type==1) href="{{$cards[0]->link_1}}" @else href="{{$cards[0]->link_2}}" @endif target="_blank" class="company_link"><i class="fa fa-lock"></i> Оформить</a>
                </div>
            @endif
                */ ?>

            @if($similar_companies != null)
                <div class="similars">
                    <div class="similars-title text-center h2">Похожие организации</div>
                        @foreach($similar_companies as $similar)
                        <a class="shadow" target="_blank" href="@if($group->url!='/')/{{$group->url}}@endif/{{$similar->alias}}">
                            <amp-img width="250" height="120" layout="fixed" src="{{$similar->img}}" alt="{{$similar->h1}}"></amp-img><br>
                            @if($similar->company_name != null)
                                <b>{{$similar->company_name}}</b>
                            @else
                                <b>{{$similar->h1}}</b>
                            @endif
                        </a>
                    @endforeach
                </div>
            @endif




            @if(!$company->reviews_page)
                <h2 id="reviews" class="text-center">Отзывы</h2>
                <div class="reviews-wrap comments-add-form">
                    <?php $reviewsGroups = 1; $i = 0;  ?>
                    @foreach($reviews as $comment)
                        <div class="comment-item {{RatingParser::getCssClassForBackground($comment->rating)}} rev-group-{{$reviewsGroups}} " id="comment-{{$comment->id}}">
                            <div class="title-line">@if($comment->author!=null) {{$comment->author}} @else {{$comment->last_name}} {{$comment->first_name}} {{$comment->middle_name}} @endif
                                <div class="rating-line rev">
                                    @if($comment->rating!=null)
                                        {!! RatingParser::printImgRatingByValueForAMP($comment->rating) !!}
                                    @endif
                                </div>
                            </div>
                            <div class="text-rew">
                                {!!$comment->review!!}
                            </div>
                            @if(($comment->pros!=null) || ($comment->minuses!=null))
                                <div class="pros_minuses_wrap">
                                    <div class="pros">{!! $comment->pros !!}</div>
                                    <div class="minuses">{!! $comment->minuses !!}</div>
                                </div>
                            @endif
                            @if(isset($comment->child))
                                @foreach($comment->child as $child)
                                    <div class="comment-item @if($child->off_answer != null) off_answer @endif" id="comment-{{$child->id}}">
                                        <div class="title-line">@if($child->off_answer != null) <i class="fa fa-check-square-o"></i> @endif @if($child->author!=null) {{$child->author}} @else {{$child->last_name}} {{$child->first_name}} {{$child->middle_name}} @endif
                                            @if($comment->rating!=null)
                                                @if($child->off_answer == null)
                                                    <div class="rating-line rev">

                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="text-rew">
                                            {!!$child->review!!}
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                        </div>
                        <?php $i++; if($i % 10 == 0) $reviewsGroups++; ?>
                    @endforeach

                    <br>
                    <br>

                </div>
            @endif



        </div><?php /* end col-md-12 */ ?>

    </div><?php /*row */ ?>
</article>

@endsection