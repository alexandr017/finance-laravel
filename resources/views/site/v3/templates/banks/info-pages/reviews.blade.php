@extends('site.v3.layouts.app')
@section ('title', $page->title)
@section ('h1', $page->h1)
@section ('meta_description', $page->meta_description)

@section('content')

@include('site.v3.modules.includes.breadcrumbs')

<article class="container main single-page">
    <div class="row">
        <div class="col-lg-9 col-md-12">
            <h1 class="p2-h1">{{$page->h1}}</h1>
            @if($bankTopCard != null)
                @include('site.v3.modules.banks.head_fixed_block.pc_and_mob')
            @endif

            @if(is_mobile_device())
                @include('site.v3.modules.banks.menu.mob')
            @else
                @include('site.v3.modules.banks.menu.pc')
            @endif

            <?php echo Shortcode::compile(System::nofollow($page->content)); ?>
            <div class="reviews-wrap comments-add-form">

                <p class="text-center reviews-status-title">Все отзывы и жалобы</p>

                <div class="rating-line micro text-center">
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
                        $page->number_of_votes = $realCount;
                        $page->average_rating = $ratingValue;
                    } else {
                        $ratingValue = 0;
                    }
                    ?>


                    {!! App\Models\System::rating($ratingValue) !!}
                    <div class="val-rating">{{$countReviews}} {{System::endWords($countReviews, ['оценка', 'оценки', 'оценок'])}} ({{$ratingValue}} из 5)</div>
                </div>
                <?php /*
                <div class="diagrams-pie-wrap">
                    <div class="diagram-pie-wrap">
                        <div class="diagram-pie">{{$complaintAllCount / ($countReviews + 0.000001) * 100 }}%</div><br>
                        <span class="pie-color-1">Отзывы: {{$countReviews - $complaintAllCount}}</span>
                        <span class="pie-color-2">Жалобы: {{$complaintAllCount}}</span>
                    </div>
                    <div class="diagram-pie-wrap">
                        <div class="diagram-pie">
                            @if($complaintAllCount == 0)
                                100%
                            @else
                                {{99.9 - ($complaintAnswerCount / $complaintAllCount * 100) }}%
                            @endif
                        </div><br>
                        <span class="pie-color-1">Решено: {{$complaintAnswerCount}}</span>
                        <span class="pie-color-2">Рассматривается: {{$complaintAllCount - $complaintAnswerCount}}</span>
                    </div>
                </div> */ ?>

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


                <?php /*
                <div class="sorting-line reviews_items" data-term-id="{{$bank->id}}">
                    <ul>
                        <li class="first-item">Сортировать:</li>
                        <li class="sort-item active" data-field="date"><i class="fa fa-arrow-circle-down"></i> <span>по дате</span></li>
                        <li class="sort-item" data-field="rating"><i></i> <span>по оценкам</span></li>
                    </ul>
                </div>
                */?>
                <div style="margin: 10px 30px">
                @if($page->bank_category_page_id == null && isset($bank_categories))
                    <div class="new-select width-100" id="bank-review-cat-select" style="margin-bottom: 5px;">
                    <b class="active-element">Все отзывы банка</b>
                    <div class="icon-right bottom" style="display: none;"></div>
                    <div class="hidden-elements" style="display: none;">
                    <span class="line" data-val="0">Все отзывы банка</span>
                    @foreach($bank_categories as $bank_category)
                        @if($bank_category->category_id !== 9)
                        <?php
                        switch ($bank_category->category_id) {
                            case 2: $cat_name = 'РКО'; break;
                            case 4: $cat_name = 'Кредиты'; break;
                            case 5: $cat_name = 'Кредитные карты'; break;
                            case 6: $cat_name = 'Дебетовые карты'; break;
                            case 8: $cat_name = 'Автокредиты'; break;
                            default: $cat_name = 'Категория не определена';
                        }
                        ?>
                        @if(in_array($bank_category->category_id,$reviewCategories))
                            <span class="line" data-val="{{$bank_category->category_id}}">{{$cat_name}}</span>
                        @endif
                        @endif
                    @endforeach

                    </div>
                    <i></i>
                </div>
                @endif
                @if(isset($reviewsCats))
                    <div class="new-select width-100" id="bank-review-pr-select">
                        <b class="active-element">Все отзывы категории</b>
                        <div class="icon-right bottom" style="display: none;"></div>
                        <div class="hidden-elements" style="display: none;">
                            <span class="line" data-val="0">Все продукты</span>
                            @foreach($reviewsCats as $reviewsCat)
                                <span class="line" data-val="{{$reviewsCat->id}}">{{$reviewsCat->product_name}}</span>
                            @endforeach
                        </div>
                        <i></i>
                    </div>
                @endif
                </div>
            <?php $reviewsGroups = 1; $i = 0;?>
                <div class="reviews-list-wrap">
                    @foreach($reviews as $comment)
                    <div data-product="{{$comment->product_id}}" @if(isset($comment->category_id)) data-category="{{$comment->category_id}}" @endif class="comment-item rev-group-{{$reviewsGroups}} @if($reviewsGroups > 1) {{'display_none'}} @endif" id="comment-{{$comment->id}}">
                        <div class="title-line {{RatingParser::getCssClassForBackground($comment->rating)}}">
                            <span class="title-review-name @if($comment->rating <= 2 && isset($comment->complain_result)) hidden-review-name @endif"><?php if($comment->author!=null) echo trim($comment->author); else echo trim($comment->last_name . ' ' . $comment->first_name . ' ' . $comment->middle_name); ?></span>
                            @if($comment->rating!=null)
                            <div class="rating-line rev">{!! App\Models\System::rating($comment->rating) !!}</div>
                            @endif
{{--                            @if($comment->rating <= 2)--}}
{{--                            @if(isset($comment->complain_result))--}}
{{--                            <span class="label_of_complain_success">Решено</span>--}}
{{--                            @else--}}
{{--                            <span class="label_of_complain_warning">Рассматривается</span>--}}
{{--                            @endif--}}
{{--                            @endif--}}
                        </div>
                        <div class="text-rew @if($comment->rating <= 2 && isset($comment->complain_result)) hidden-review-body @endif">
                            {!!$comment->review!!}
                        </div>
                        <div class="pros_minuses_wrap @if($comment->rating <= 2 && isset($comment->complain_result)) hidden-review-body @endif">
                            @if((ltrim($comment->pros, ' ')!=null))
                            <div class="pros">{!! $comment->pros !!}</div>
                            @endif
                            @if(ltrim($comment->minuses,' ')!=null)
                            <div class="minuses">{!! $comment->minuses !!}</div>
                            @endif
                            <div class="clearfix"></div>
                        </div>
                        @if(isset($comment->child))
                        @foreach($comment->child as $child)
                        <div class="comment-item @if($child->off_answer != null) off_answer @endif @if($comment->rating <= 2 && isset($comment->complain_result)) hidden-review-body @endif" id="comment-{{$child->id}}">
                            <div class="title-line">@if($child->off_answer != null) <i class="fa fa-check-square-o"></i> @endif @if(isset($child->first_name) && $child->first_name!=null) {{$child->last_name}} {{$child->first_name}} {{$child->middle_name}} @if($child->off_answer != null) - официальный представитель компании  @endif @else {{$child->author}} @endif
                                @if($comment->rating!=null)
                                @if($child->off_answer == null)
                                <div class="rating-line rev"></div>
                                @endif
                                @endif
                            </div>
                            <div class="text-rew">
                                {!!$child->review!!}
                            </div>
                        </div>
                        @endforeach
                        @endif
                        <?php /*
                        <button class="filter-review">Кредиты</button>
*/ ?>


                        <div class="reply @if($comment->rating <= 2 && isset($comment->complain_result)) hidden-review-body @endif" data-id="{{$comment->id}}">
                            <a rel="nofollow" class="review-reply-link" href="#">Ответить</a>
                        </div>
                    </div>
                    <?php $i++; if($i % 10 == 0) $reviewsGroups++; ?>
                    @endforeach
                </div><?php /* end reviews wrap */ ?>
                @if(($reviewsGroups > 1) && $countReviews>10)
                <div class="text-center"><button id="loadReviews" class="form-btn1" data-groups-count="{{$reviewsGroups}}" data-groups-current="1">Показать ещё <span></span></button><br><br></div>
                @endif

                <div id="AddReviewWrap">
                    <div class="title-comments"><i class="fa fa-commenting"></i> Оставить отзыв или жалобу</div>
                    <form action="" method="post" id="AddReview">
                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                        <input type="hidden" name="post" id="reviewCompany" value="{{$bank->id}}">
                        <input type="hidden" name="parent" id="reviewParent" value="0">
                        @if(isset($categoryId))
                        <input type="hidden" name="bankCatPageId" id="bank-category-page-id" value="{{$categoryId}}">
                        @endif
                        <input type="hidden" name="productId" id="product_id" value="{{$page->bank_product_id}}">
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
                        @if(isset($bank_categories))
                        <div class="form-line form-group">
                            <label>Категория банка:</label>
                            <select  id="bank-category-id" required="true" class="width-100 new-select">
                            <option value="">Выберите категорию</option>
                            @foreach($bank_categories as $cat)
                                <option value="{{$cat->id}}">{{$cat->h1}}</option>
                            @endforeach
                            </select>
                        </div>
                        @endif
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

            <div class="bordered-rating star-rating">
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
                    }

                    $goal = ($card->category_id == 1) ? 'zaim-reviews' : 'orgbut';
                    ?>
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
<script src="/old_theme/js/scripts/5Company/reviews.js?id=7" defer></script>
<?php
/*
$bank->number_of_votes = $realCount;
$bank->average_rating = $ratingValue;
?>
{!! App\Algorithms\Frontend\StructuredData\Product\CompaniesWithReviews::render($cards, $bank, $reviews) !!}
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
    "image": "https://finance.ru/old_theme/img/logo_vzo.png",
    "name": "{{$page->h1}}",
         "description" : "{{$page->meta_description}}",
         "sku": "{{$page->id}}",
         "slogan": "ВсеЗаймыОнлайн",
         "url": "https://finance.ru/banks",
         "brand": "ВсеЗаймыОнлайн"
        }
</script>
@endsection