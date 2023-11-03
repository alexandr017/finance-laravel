@extends('site.v3.layouts.app')
@section ('title', $page->title)
@section ('h1', $page->h1)
@section ('meta_description', $page->meta_description)
@section('additional-styles')
@endsection
@section('content')

<section class="container main">

    <div class="row">
        <div class="col-lg-9 col-md-12">

                <div class="single-page">
                    <div class="h2 text-center">Лучшие займы</div>
                    <div class="one-offer">
                        <div id="loansSlider">
                            @foreach($loans as $loan)
                                <div class="index-cards-item text-center">
                                    <img loading="lazy" src="{{$loan->logo}}" alt="{{$loan->title}}">
                                    <div>{{$loan->title}}</div>
                                </div>
                            @endforeach
                        </div>
                        <div style="margin: 15px 0 0" class="text-center"><a style="max-width: 170px" class="form-btn1" href="/mfo">Смотреть все</a></div>
                    </div>

                    <div class="h2 text-center">Лучшие кредиты</div>
                    <div class="one-offer">
                        <div id="creditsSlider">
                            @foreach($credits as $credit)
                                <div class="index-cards-item text-center">
                                    <img loading="lazy" src="{{$credit->logo}}" alt="{{$credit->title}}">
                                    <div>{{$credit->title}}</div>
                                </div>
                            @endforeach
                        </div>
                        <div style="margin: 15px 0 0" class="text-center"><a style="max-width: 170px" class="form-btn1" href="/kredity">Смотреть все</a></div>
                    </div>

                    <div class="h2 text-center">Лучшие кредитные карты</div>
                    <div class="one-offer">
                        <div id="creditCardsSlider">
                            @foreach($creditCards as $creditCard)
                                <div class="index-cards-item text-center">
                                    <img loading="lazy" src="{{$creditCard->logo}}" alt="{{$creditCard->title}}">
                                    <div>{{$creditCard->title}}</div>
                                </div>
                            @endforeach
                        </div>
                        <div style="margin: 15px 0 0" class="text-center"><a style="max-width: 170px" class="form-btn1" href="/kreditnye-karty">Смотреть все</a></div>
                    </div>


                    <div class="h2 text-center">Лучшие дебетовые карты</div>
                    <div class="one-offer">
                        <div id="debitCardsSlider">
                            @foreach($debitCards as $debitCard)
                                <div class="index-cards-item text-center">
                                    <img loading="lazy" src="{{$debitCard->logo}}" alt="{{$debitCard->title}}">
                                    <div>{{$debitCard->title}}</div>
                                </div>
                            @endforeach
                        </div>
                        <div style="margin: 15px 0 0" class="text-center"><a style="max-width: 170px" class="form-btn1" href="/debetovye-karty">Смотреть все</a></div>
                    </div>


                    <div class="h2 text-center">Лучшие ипотеки</div>

                    <div class="h2 text-center">Лучшие автокредиты</div>
                    <div class="one-offer">
                        <div id="autoCreditsSlider">
                            @foreach($autoCredits as $credit)
                                <div class="index-cards-item text-center">
                                    <img loading="lazy" src="{{$credit->logo}}" alt="{{$credit->title}}">
                                    <div>{{$credit->title}}</div>
                                </div>
                            @endforeach
                        </div>
                        <div style="margin: 15px 0 0" class="text-center"><a style="max-width: 170px" class="form-btn1" href="/avtokredity">Смотреть все</a></div>
                    </div>

                    <div class="h2 text-center">Лучшие вклады</div>

                    <div class="h2 text-center">Лучшие расчетные счета</div>
                    <div class="one-offer">
                        <div id="rkoSlider">
                            @foreach($rko as $rkoItem)
                                <div class="index-cards-item text-center">
                                    <img loading="lazy" src="{{$rkoItem->logo}}" alt="{{$rkoItem->title}}">
                                    <div>{{$rkoItem->title}}</div>
                                </div>
                            @endforeach
                        </div>
                        <div style="margin: 15px 0 0" class="text-center"><a style="max-width: 170px" class="form-btn1" href="/rko">Смотреть все</a></div>
                    </div>



                    <br>
                    <div class="h2 text-center">Последние новости</div>
                    <div class="news-post-wrap" id="newsSlider">
                        @foreach($posts as $post)
                            <?php $post_h1 = ($post->h1_in_category != null) ? $post->h1_in_category : $post->h1; ?>
                            <div class="news-item" style="position:relative; margin-bottom: 15px; padding-bottom: 45px;">
                                <a href="/{{$post->alias_category}}/{{$post->alias}}.html">
                                    <?php $availability = ($post->availability == null || $post->availability =='no') ? 'unavailable' : 'available'; ?>
                                    <span class="{{$availability}}">
                                    <img loading="lazy" src="{{$post->thumbnail}}" alt="{{$post_h1}}">
                                </span>
                                    <span class="dgeff"><?php echo Shortcode::compile($post_h1); ?></span>
                                </a>
                                <div class="post-info tex-center">
                                    <div class="post-date">{{date('d.m.Y',strtotime($post->date))}}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div style="margin: 15px 0 30px;" class="text-center"><a class="form-btn1" href="/news">Смотреть все</a></div>
                </div>



            <div class="alc">
                {!! TagsParser::compile(Shortcode::compile($page->content)) !!}
            </div>

            <div class="bordered-rating star-rating light-border">
                <div class="post-ratings" data-type="project" data-id="0">
                    (<span class="bold">111</span> оценок, среднее: <span class="bold">333</span> из 5)<br />
                </div>
            </div>
        
        </div><?php /* end col-md-9 */ ?>


        <div class="col-lg-3 d-lg-block d-xs-none d-none">
            @include('site.v3.modules.includes.sidebar')
        </div><?php /* md-3 */ ?>
    </div><?php /*row */ ?>
</section>

@include('site.v3.modules.includes.blocks')


{{--<div class="index-experts-wrap container">--}}
{{--<div class="section-title">Наши эксперты</div>--}}
{{--    <div class="experts">--}}
{{--        @foreach($experts as $expert)--}}
{{--            <div class="experts_item">--}}
{{--                <a href="/about#{{Str::slug($expert->name)}}"><img loading="lazy" class="expert_photo" src="{{$expert->photo}}" alt="{{$expert->name}}"></a>--}}
{{--                <a href="/about#{{Str::slug($expert->name)}}" class="expert_name">{{$expert->name}}</a>--}}
{{--                <div class="clearfix"></div>--}}
{{--            </div>--}}
{{--        @endforeach--}}
{{--    </div>--}}
{{--</div>--}}


@endsection

@section('additional-scripts')
<script async src="/old_theme/js/scripts/index/index.js?v=17"></script>
@endsection
@section('listings-scripts')
{{--<script async src="/old_theme/js/modules/slider/js-slider.js"></script>--}}
{{--<script defer src="/old_theme/js/js-for-sliders.js"></script>--}}
@endsection
