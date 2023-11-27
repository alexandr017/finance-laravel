@extends('site.v3.layouts.app')
@section ('title', $page->title)
@section ('h1', $page->h1)
@section ('meta_description', $page->meta_description)
@section('additional-styles')
@endsection

@section('content')

    @include('site.v3.modules.includes.index-first-section')

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
                        <div style="margin: 15px 0 0" class="text-center"><a style="max-width: 170px" class="form-btn1"
                                                                             href="/mfo">Смотреть все</a></div>
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
                        <div style="margin: 15px 0 0" class="text-center"><a style="max-width: 170px" class="form-btn1"
                                                                             href="/kredity">Смотреть все</a></div>
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
                        <div style="margin: 15px 0 0" class="text-center"><a style="max-width: 170px" class="form-btn1"
                                                                             href="/kreditnye-karty">Смотреть все</a>
                        </div>
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
                        <div style="margin: 15px 0 0" class="text-center"><a style="max-width: 170px" class="form-btn1"
                                                                             href="/debetovye-karty">Смотреть все</a>
                        </div>
                    </div>


                    <div class="h2 text-center">Лучшие ипотеки</div>
                    <div class="one-offer">
                        <div id="mortgageSlider">
                            @foreach($mortgage as $item)
                                <div class="index-cards-item text-center">
                                    <img loading="lazy" src="{{$item->logo}}" alt="{{$item->title}}">
                                    <div>{{$item->title}}</div>
                                </div>
                            @endforeach
                        </div>
                        <div style="margin: 15px 0 0" class="text-center"><a style="max-width: 170px" class="form-btn1"
                                                                             href="/ipoteka">Смотреть все</a></div>
                    </div>

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
                        <div style="margin: 15px 0 0" class="text-center"><a style="max-width: 170px" class="form-btn1"
                                                                             href="/avtokredity">Смотреть все</a></div>
                    </div>

                    <div class="h2 text-center">Лучшие вклады</div>
                    <div class="one-offer">
                        <div id="depositsSlider">
                            @foreach($deposits as $deposit)
                                <div class="index-cards-item text-center">
                                    <img loading="lazy" src="{{$deposit->logo}}" alt="{{$deposit->title}}">
                                    <div>{{$deposit->title}}</div>
                                </div>
                            @endforeach
                        </div>
                        <div style="margin: 15px 0 0" class="text-center"><a style="max-width: 170px" class="form-btn1"
                                                                             href="/rko">Смотреть все</a></div>
                    </div>


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
                        <div style="margin: 15px 0 0" class="text-center"><a style="max-width: 170px" class="form-btn1"
                                                                             href="/rko">Смотреть все</a></div>
                    </div>

                    <div class="alc">
                        {!! TagsParser::compile(Shortcode::compile($page->content)) !!}
                    </div>

                </div>


                <div class="bordered-rating star-rating light-border">
                    <div class="post-ratings" data-type="project" data-id="0">
                        {!! RatingParser::printIRatingByValue($page->average_rating) !!}
                        (<span class="bold">{{$page->number_of_votes}}</span> оценок, среднее: <span
                                class="bold">{{$page->average_rating}}</span> из 5)<br/>
                    </div>
                </div>

            </div><?php /* end col-md-9 */ ?>


            <div class="col-lg-3 d-lg-block d-xs-none d-none">
                @include('site.v3.modules.includes.sidebar')
            </div><?php /* md-3 */ ?>
        </div><?php /*row */ ?>
    </section>

    <div class="container" id="fix-block">
        <div class="section-title">Новые отзывы о компаниях</div>
        <div class="reviews">
            @foreach($reviews as $value)
                <div class="itm">
                    <div class="iname">{{$value->author}}</div>
                    {!! App\Algorithms\System::rating($value->rating) !!}
                    <div class="itext"><p>{!! reviewsShortLenghtRender($value->review) !!}</p></div>
                </div>
            @endforeach
        </div>
    </div>

@endsection

@section('additional-scripts')
    <script async src="/old_theme/js/scripts/index/index.js"></script>
    <script async src="/old_theme/js/scripts/index/select-pages.js"></script>
@endsection
@section('listings-scripts')
    {{--<script async src="/old_theme/js/modules/slider/js-slider.js"></script>--}}
    {{--<script defer src="/old_theme/js/js-for-sliders.js"></script>--}}
@endsection
