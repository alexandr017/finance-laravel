@extends('frontend.layouts.amp')
@section ('title', $page->title)
@section ('h1', $page->h1)
@section ('meta_description', $page->meta_description)

@section('content')
@include('frontend.includes.breadcrumbs')
<article class="container main single-page">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <h1 class="p2-h1">{{$page->h1}}</h1>
        @include('frontend.banks.modules.menu.amp')

        <?php echo AMP::render(Shortcode::compile(System::nofollow($page->content))); ?>
            <div class="reviews-wrap">
                <div class="reviews-wrap comments-add-form">
                    <p>Чтобы перейти к обсуждению и оставить свой отзыв перейдите к <a href="{{preg_replace('/\/amp$/','',Request::url())}}">полной версии страницы</a>.</p>
                    @foreach($reviews as $comment)
                        <div class="comment-item {{RatingParser::getCssClassForBackground($comment->rating)}}"
                             id="comment-{{$comment->id}}">
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
                                    <div class="comment-item @if($child->off_answer != null) off_answer @endif"
                                         id="comment-{{$child->id}}">
                                        <div class="title-line">@if($child->off_answer != null) <i
                                                    class="fa fa-check-square-o"></i> @endif @if($child->author!=null) {{$child->author}} @else {{$child->last_name}} {{$child->first_name}} {{$child->middle_name}} @endif
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
                    @endforeach
                    <br>
                </div>

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

                <div class="bordered-rating star-rating">
                    {!! RatingParser::printImgRatingByValueForAMP($page->average_rating) !!}
                    (<strong>{{count($reviews)}}</strong> оценок, среднее: <strong>{{round($page->average_rating, 2)}}</strong> из 5)
                </div>

            </div>
        </div><?php /* end col-md-9 */ ?>
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
                <a data-id="{{$card->id}}" class="hdl form-btn1" href="{{$company_link}}" target="_blank"><i class="fa fa-lock"></i> Оформить</a>
            </div>
        </div>
    </div>
</div>
@endif
*/ ?>
</article>
@endsection