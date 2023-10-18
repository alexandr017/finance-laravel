@extends('frontend.layouts.amp')
@section ('title', $page->title)
@section ('h1', $page->h1)
@section ('meta_description', $page->meta_description)
@section('content')

    @include('frontend.includes.breadcrumbs')

    <section class="container main single-page">
        <div class="row">
            <div class="col-lg-9 col-md-9">
                <h1 class="p-h1">{{$page->h1}}</h1>
                {!! TagsParser::compile(Shortcode::compile($page->lead)) !!}

                @include("frontend.banks.modules.index_banks_list.index_banks_list_amp")

                <h2 class="h2 text-center">Специальные предложения банков</h2>
                @include("frontend.banks.modules.special_offers.special_offers_amp")


                <div id="fix-block">
                    <div class="h2 text-center">Отзывы о банках</div>
                    <div class="reviews-wrap comments-add-form">
                        @foreach($reviews as $comment)
                            <div class="comment-item {{RatingParser::getCssClassForBackground($comment->rating)}}" id="comment-{{$comment->id}}">
                                <div class="title-line">@if($comment->author!=null) {{$comment->author}} @endif
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
                            </div>
                        @endforeach
                    </div>
                </div>



                <?php echo AMP::render(Shortcode::compile(System::nofollow($page->content))); ?>

                <div class="star-rating light-border">
                    {!! RatingParser::printImgRatingByValueForAMP($page->average_rating) !!}
                    (<strong>{{$page->number_of_votes}}</strong> оценок, среднее: <strong>{{round($page->average_rating,2)}}</strong> из 5)
                </div>


            </div><?php /* end col-md-9 */ ?>
        </div><?php /*row */ ?>
    </section>

@endsection