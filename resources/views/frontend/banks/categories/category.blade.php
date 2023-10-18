@extends('frontend.layouts.app')
@section ('title', $page->title)
@section ('h1', $page->h1)
@section ('meta_description', $page->meta_description)


@section('compress-styles')
    @parent
@endsection

@section('content')

    @include('frontend.includes.breadcrumbs')

    <section class="container main single-page">


        <div class="row">
            <div class="col-lg-9 col-md-12">
                <h1 class="p-h1">{{$page->h1}}</h1>

                @if($bankTopCard != null)
                    @include('frontend.banks.modules.head_fixed_block.pc_and_mob')
                @endif

                @if(is_mobile_device())
                    @include('frontend.banks.modules.menu.mob')
                @else
                    @include('frontend.banks.modules.menu.pc')
                @endif

                <?php /*
                <div class="credit-calc-wrap">
                    <form action="#" id="credit-calc">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="fields-wrap">
                                    <label for="credit-sum">Сумма кредита</label>
                                    <i class="fa fa-question-circle-o i-hint"></i>
                                    <span class="hint">Укажите желаемую сумму кредита</span><br>
                                    <div class="fields-wrap summ-wrap">
                                        <input type="text" value="500 000" id="credit-sum">
                                        <div class="sum-val"><u><i></i></u></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="fields-wrap">
                                    <label>Срок</label>
                                    <i class="fa fa-question-circle-o i-hint"></i>
                                    <span class="hint">Укажите срок, на который вы хотите получить кредит</span><br>
                                    <div id="credit-term" class="new-select">
                                        <b>любой</b>
                                        <div>
                                            <span>любой</span>
                                            <span>1 месяц</span>
                                            <span>3 месяца</span>
                                            <span>6 месяцев</span>
                                            <span>9 месяцев</span>
                                            <span>1 год (12 месяцев)</span>
                                            <span>2 года (24 месяцев)</span>
                                            <span>3 года (36 месяцев)</span>
                                            <span>4 года (48 месяцев)</span>
                                            <span>5 лет (60 месяцев)</span>
                                            <span>6 лет (72 месяцев)</span>
                                            <span>7 лет (84 месяцев)</span>
                                            <span>10 лет (120 месяцев)</span>
                                            <span>15 лет</span>
                                            <span>20 лет</span>
                                            <span>25 лет</span>
                                            <span>30 лет</span>
                                        </div>
                                        <i class="sel"></i>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end row -->
                        <br>



                        <div class="row">
                            <div class="col-md-6">
                                <div class="fields-wrap">
                                    <label>Рассмотрение заявки</label>
                                    <i class="fa fa-question-circle-o i-hint"></i>
                                    <span class="hint">Выберите желаемую скорость рассмотрения заявки в банке</span><br>
                                    <div id="credit-speed" class="new-select">
                                        <b>любое</b>
                                        <div>
                                            <span>любое</span>
                                            <span>день в день</span>
                                            <span>до 3 дней</span>
                                            <span>до 7 дней</span>
                                            <span>до 14 дней</span>
                                        </div>
                                        <i class="sel"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="fields-wrap">
                                    <label>Подтверждение дохода</label>
                                    <i class="fa fa-question-circle-o i-hint"></i>
                                    <span class="hint">Выберите способ подтверждения дохода (например, 2-НДФЛ) или оформление без подтверждения</span><br>
                                    <div id="credit-docs" class="new-select">
                                        <b>не важно</b>
                                        <div>
                                            <span>не важно</span>
                                            <span>2-НДФЛ / 3-НДФЛ / 4-НДФЛ</span>
                                            <span>альтернативные формы</span>
                                            <span>без подтверждения</span>
                                        </div>
                                        <i class="sel"></i>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end row -->
                        <br>



                        <div class="row">
                            <div class="col-md-6">
                                <div class="fields-wrap">
                                    <label>Регистрация в регионе выдачи</label>
                                    <i class="fa fa-question-circle-o i-hint"></i>
                                    <span class="hint">Укажите, требуется ли регистрация в регионе оформления кредита для желаемого предложения</span><br>
                                    <div id="credit-place" class="new-select">
                                        <b>не важно</b>
                                        <div>
                                            <span>не важно</span>
                                            <span>постоянная</span>
                                            <span>временная</span>
                                            <span>не требуется</span>
                                        </div>
                                        <i class="sel"></i>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end row -->

                        <hr>
                        <div class="text-center"><button id="getReuslt">Найти кредиты</button></div>

                        <div class="text-center"><span class="clearCreditResult" style="display:none;">Очистить результаты поиска</span></div>
                        <div class="container-progress" id="progressLoadCredit" style="display:none;">

                        </div>

                    </form>

                </div><!-- end .credit-calc-wrap -->


                <div id="credit-calc-res" style="display:none"></div>

 */ ?>

                <div style="clear:both"></div>
                @if(is_mobile_device())
                    @include('frontend.banks.modules.category_and_product_face.mob')
                @else
                    @include('frontend.banks.modules.category_and_product_face.pc')
                @endif

                <div class="offers-list">
                    <?php /*
                    @if(count($cards) == 1)
                    @foreach($cards as $card)
                        @include('frontend.cards.card.card')
                    @endforeach
                    @endif
 */ ?>
                </div>

                <div class="text-block" id="single_content_wrap">
                    {!! TagsParser::compile(Shortcode::compile($page->content)) !!}
                </div>

                <div class="bordered-rating star-rating light-border">
                    {!! RatingParser::printIRatingByValue($page->average_rating) !!}
                    (<strong>{{$page->average_rating}}</strong> оценок, среднее: <strong>{{round($page->average_rating, 2)}}</strong> из 5)
                </div>

                <div id="compare_in_listing_pages" class="cilp">
                    <div class="cilp_inner"></div>
                </div>

            </div><?php /* end col-md-9 */ ?>
            <div class="col-lg-3 d-lg-block d-xs-none d-none">
                @include('frontend.includes.sidebar.bank')
            </div><?php /* md-3 */ ?>
        </div><?php /*row */ ?>
    </section>

@endsection


@section('additional-scripts')
    <script src="/old_theme/js/modal.js" defer></script>
    <script>
        $('#load_card_for_bank').on('click', function () {
            $.ajax({
                type: "GET",
                dataType: "html",
                url: '/actions/load-cards-for-bank-on-category?item_id='+{{$page->id}},
                success: function (data) {
                    var json = JSON.parse(data);
                    $('.offers-list').html(json.code);
                    update_img_and_bg_full_version();
                }
            });
        });
    </script>
    <?php
        $page->img = $bank->logo
    ?>
    {!! App\Algorithms\Frontend\StructuredData\Product\BankFullProduct::render($cards, $page) !!}
    <script>
        //window.category_id = 5;
    </script>
@endsection
