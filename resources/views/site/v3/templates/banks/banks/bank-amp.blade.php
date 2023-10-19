@extends('site.v3.layouts.amp')
@section ('title', $page->title)
@section ('h1', $page->h1)
@section ('meta_description', $page->meta_description)

@section('content')

    @include('site.v3.modules.includes.breadcrumbs')

    <section class="container main single-page">


        <div class="row">
            <div class="col-lg-9 col-md-12">
                <h1 class="p-h1">{{$page->h1}}</h1>

                @include('site.v3.modules.banks.menu.amp')

                @include('site.v3.modules.banks.bank_face.face-amp')


                <h2 class="h2 text-center">Общая информация</h2>
                <?php echo \App\Algorithms\AMP::render(Shortcode::compile(System::nofollow($page->content))); ?>

                @if(
                count($cardsCredits) > 0 ||
                count($cardsCreditCards) > 0 ||
                count($cardsDebitCards) > 0 ||
                count($cardsRKO) > 0
                )
                <h2 class="h2 text-center">Специальные предложения банка</h2>
                @include("site.v3.modules.banks.special_offers.special_offers_amp")
                @endif


                @if(count($reviews) > 0)
                <div id="fix-block">
                    <div class="h2 text-center">Отзывы о банке "{{$page->name}}"</div>
                    <div class="reviews-wrap comments-add-form">
                        <?php $reviewsForSlider = $reviews->take(7); ?>
                        @foreach($reviewsForSlider as $comment)
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
                    <div class="text-center"><a class="small-green-btn" href="{{preg_replace('/\/amp\/?$/','',Request::url())}}/otzyvy">Все отзывы о банке</a></div>
                </div>
                    <br>
                @endif

                <div class="border star-rating light-border">
                    {!! RatingParser::printImgRatingByValueForAMP($page->average_rating) !!}
                    (<strong>{{count($reviews)}}</strong> оценок, среднее: <strong>{{round($page->average_rating, 2)}}</strong> из 5)
                </div>

            </div><?php /* end col-md-9 */ ?>
        </div><?php /*row */ ?>
    </section>

@endsection