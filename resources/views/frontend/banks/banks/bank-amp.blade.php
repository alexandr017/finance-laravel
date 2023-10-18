@extends('frontend.layouts.amp')
@section ('title', $page->title)
@section ('h1', $page->h1)
@section ('meta_description', $page->meta_description)

@section('content')

    @include('frontend.includes.breadcrumbs')

    <section class="container main single-page">


        <div class="row">
            <div class="col-lg-9 col-md-12">
                <h1 class="p-h1">{{$page->h1}}</h1>

                @include('frontend.banks.modules.menu.amp')

                @include('frontend.banks.modules.bank_face.face-amp')

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


                <h2 class="h2 text-center">Общая информация</h2>
                <?php echo AMP::render(Shortcode::compile(System::nofollow($page->content))); ?>

                @if(
                count($cardsCredits) > 0 ||
                count($cardsCreditCards) > 0 ||
                count($cardsDebitCards) > 0 ||
                count($cardsRKO) > 0
                )
                <h2 class="h2 text-center">Специальные предложения банка</h2>
                @include("frontend.banks.modules.special_offers.special_offers_amp")
                @endif


                @if(count($news) > 0)
                <h2 class="h2 text-center">Последние новости банка</h2>
                <div class="post-on-bank border">
                    <div class="post-slider">
                        @foreach($news as $post)
                            <?php $post = (object)$post; ?>
                            <?php $post_h1 = ($post->h1_in_category != null) ? $post->h1_in_category : $post->h1; ?>
                            <div class="post-item text-center shadow">
                                <amp-img width="250" height="120" layout="fixed" src="{{$post->thumbnail}}" alt="{{$post_h1}}"></amp-img>
                                <a href="/{{$post->categoryAlias}}/{{$post->alias}}.html"><?php echo Shortcode::compile($post_h1); ?></a>
                            </div>
                        @endforeach
                    </div>
                    <br>
                    <div class="text-center"><a class="small-green-btn" href="{{preg_replace('/\/amp\/?$/','',Request::url())}}/news">Все новости банка</a></div>
                    <br>
                </div>
                @endif


                <?php /*
                <div class="base-news-wrap">
                    <h2 class="h2 text-center">База знаний банка</h2>
                    @foreach($newsBase as $post)
                    <?php $post = (object)$post; ?>
                    <?php $post_h1 = ($post->h1_in_category != null) ? $post->h1_in_category : $post->h1; ?>
                    <div class="base-news-item">
                        <a class="base-news-item-link" href="/{{$post->categoryAlias}}/{{$post->alias}}.html"><?php echo Shortcode::compile($post_h1); ?></a>
                        <p>{{$post->short_content}}</p>
                        <hr>
                    </div>
                    @endforeach
                    <div class="text-center" style="margin-top: 15px">
                        <a href="/" class="base-news-item-all-post-link form-btn1">Все записи</a>
                    </div>
                </div>

                <style>
                    .base-news-wrap{background: #f6f6f6; padding: 15px}
                    .base-news-item{}
                    .base-news-item-link{color: #292929; font-weight: bold}
                    .base-news-item-all-post-link{}
                </style>

                */ ?>

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
                    <div class="text-center"><a class="small-green-btn" href="{{preg_replace('/\/amp\/?$/','',Request::url())}}/reviews">Все отзывы о банке</a></div>
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