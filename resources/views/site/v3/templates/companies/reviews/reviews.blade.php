<?php
[$ratingValue, $ratingCount] = \App\Algorithms\Frontend\Banks\BankReviews::getReviewsRating($reviews);

$company->number_of_votes = $ratingCount;
$company->average_rating = $ratingValue;
?>
@extends('site.v3.layouts.app')
@section ('title', $page->title)
@section ('h1', $page->h1)
@section ('meta_description', $page->meta_description)

@section('content')

@include('site.v3.modules.includes.breadcrumbs')

<article class="container main single-page">
    <div class="row">
        <div class="col-lg-9 col-md-12">

            @include('site.v3.modules.companies.company_menu')
            <h1 class="p2-h1">{{$page->h1}}</h1>

            <img loading="lazy" src="{{$company->img}}" alt="{{$company->h1}}" class="company-child-logo">

            <?php echo Shortcode::compile(System::nofollow($page->content)); ?>

            <div class="reviews-wrap comments-add-form">


                <p class="text-center reviews-status-title">Все отзывы и жалобы</p>



                <div class="rating-line micro text-center">
                    <?php $ratingValue = \App\Algorithms\Frontend\Banks\BankReviews::getRatingByReviews($reviews); ?>

                    {!! App\Algorithms\System::rating($ratingValue) !!}
                    <div class="text-rating">
                        @if(!$company->reviews_page)
                            <a rel="nofollow" href="#review"><span>{{$countReviews}}</span> {{System::endWords($countReviews, ['оценка', 'оценки', 'оценок'])}}</a>
                        @else
                            <a rel="nofollow" href="#"><span>{{$countReviews}}</span> {{System::endWords($countReviews, ['оценка', 'оценки', 'оценок'])}}</a>
                        @endif
                    </div>
                    <div class="val-rating">(<span>{{$ratingValue}}</span> из <span>5</span>)</div>
                </div>

                <div class="reviews-status-line">
                    <span class="reviews-status-line-left">Отзывы ({{$countReviews - $complaintAllCount}})</span>
                    <span class="reviews-status-line-right">Жалобы ({{$complaintAllCount}})</span>
                    <div class="reviews-progress-wrap">
                        <div class="reviews-progressbar">
                            <div class="progress progress-bar bg-success progress-bar-striped" style="width: {{99.9 - $complaintAllCount / ($countReviews + 0.000001) * 100 }}%"></div>
                        </div>
                    </div>
                </div>
                <br>


                <div class="sorting-line reviews_items" data-term-id="{{$company->id}}">
                    <ul>
                        <li class="first-item">Сортировать:</li>
                        <li class="sort-item active" data-field="date"><i class="fa fa-arrow-circle-down"></i> <span>по дате</span></li>
                        <li class="sort-item" data-field="rating"><i></i> <span>по оценкам</span></li>
                    </ul>
                </div>

                <div class="reviews-list-wrap">
                    @include('site.v3.modules.companies.reviews_includes.render')
                </div>
                <?php global $reviewsGroups ?>
                @if(($reviewsGroups > 1) && $countReviews>10)
                <div class="text-center"><button id="loadReviews" class="form-btn1" data-groups-count="{{$reviewsGroups}}" data-groups-current="1">Показать ещё <span></span></button><br><br></div>
                @endif

                <div id="AddReviewWrap">
                <div class="title-comments"><i class="fa fa-commenting"></i> Оставить отзыв или жалобу</div>
                <form action="" method="post" id="AddReview">
                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                    <input type="hidden" name="post" id="reviewCompany" value="{{$company->id}}">
                    <input type="hidden" name="parent" id="reviewParent" value="0">
                    <div class="form-line">
                        <label>Рейтинг:</label>
                        <div class="companies-rating">
                            <i data-item="1" data-value="fa fa-star-o" title="Очень плохо" class="fa fa-star-o"></i>
                            <i data-item="2" data-value="fa fa-star-o" title="Плохо" class="fa fa-star-o"></i>
                            <i data-item="3" data-value="fa fa-star-o" title="Средне" class="fa fa-star-o"></i>
                            <i data-item="4" data-value="fa fa-star-o" title="Хорошо" class="fa fa-star-o"></i>
                            <i data-item="5" data-value="fa fa-star-o" title="Отлично" class="fa fa-star-o"></i>
                        </div>
                        <input type="hidden" id="reviewRating" class="width-100" name="reviewRating" value="0">
                    </div>
                    <div class="form-line form-group">
                        <label>Имя:</label>
                        @if($uid != null)
                        <input id="reviewUserName" class="width-100" name="name" required="true" readonly="true" value="{{$uidName}}">
                        <input type="hidden" id="reviewUserId" name="id" value="{{$uid}}">
                        @else
                        <input id="reviewUserName" class="width-100" name="name" required="true">
                        <input type="hidden" id="reviewUserId" name="id" value="null">
                        @endif
                    </div>
                    <div class="form-line form-group">
                        <label>Комментарий:</label>
                        <textarea class="width-100" id="reviewUserComment" name="reviewUserComment" required="true"></textarea>
                    </div>
                    <div class="form-line">
                        <div class="sub-form-line form-group">
                            <label>Плюсы:</label>
                            <textarea class="width-100" id="pros" name="pros"></textarea>
                        </div>
                        <div class="sub-form-line form-group">
                            <label>Минусы:</label>
                            <textarea class="width-100" id="minuses" name="minuses"></textarea>
                        </div>
                    </div>
                    
                    @if(Auth::id()==null)
                    <div class="form-group">
                        <div class="g-recaptcha" data-sitekey="6LdYqz0UAAAAAPKI1karX0-Gr35D7_MVfO8IN2TD"></div>
                    </div>                    
                    @endif
                    
                    <div class="form-line">
                        <button class="width-100 form-btn1"><span class="review-button-name">Отправить отзыв</span> <i class="fa fa-arrow-right"></i></button>
                    </div>
                </form>
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
                        }

                        $goal = ($card->category_id == 1) ? 'zaim-reviews' : 'orgbut';
                        ?>
                        <a data-id="{{$card->id}}" class="hdl form-btn1" href="{{$company_link}}" target="_blank"> Оформить</a>
                    </div>
                </div>
            </div>
        </div>
    @endif


</article>

@endsection

@section('additional-scripts')
    <script src="/old_theme/js/scripts/5Company/reviews.js?id=7" defer></script>
@endsection

@section('structured-data')
    @parent
    @include('site.structured-data.ProductCompany', compact('cards', 'company', 'page'))
@endsection