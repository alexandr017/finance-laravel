<div class="special-banks-offers-tabs hide-for-mobile">
    <?php $activeElem = 'active-special-offer' ?>
    @if(count($cardsCredits) > 0)
        <div class="special-banks-offers-tabs-item {{$activeElem}}" data-id="1">Кредиты</div>
        <?php $activeElem = ''; ?>
    @endif
    @if(count($cardsCreditCards) > 0)
        <div class="special-banks-offers-tabs-item {{$activeElem}}" data-id="2">Кредитные карты</div>
        <?php $activeElem = ''; ?>
        @endif
    @if(count($cardsDebitCards) > 0)
        <div class="special-banks-offers-tabs-item {{$activeElem}}" data-id="3">Дебетовые карты</div>
        <?php $activeElem = ''; ?>
        @endif
    @if(count($cardsRKO) > 0)
        <div class="special-banks-offers-tabs-item {{$activeElem}}" data-id="4">РКО</div>
        <?php $activeElem = ''; ?>
        @endif
    @if(count($cardsMortgage) > 0)
        <div class="special-banks-offers-tabs-item {{$activeElem}}" data-id="5">Ипотеки</div>
        <?php $activeElem = ''; ?>
    @endif

    @if(count($cardsDeposits) > 0)
        <div class="special-banks-offers-tabs-item {{$activeElem}}" data-id="6">Вклады</div>
        <?php $activeElem = ''; ?>
    @endif
</div>

<div class="special-banks-offers">
    <div id="special-banks-offer-tab-1" class="special-banks-offers-tab">
        @foreach($cardsCredits as $card)
            <div class="companies-flex-item">
            <div class="showed-line">
                <div class="showed-wrapper" data-label="Банк">
                    <div class="small-img-wrap">
                        <img loading="lazy" src="{{$card->logo}}" alt="{{$card->title}}">
                    </div>
                    @if(isset($card->separate_page) && $card->separate_page == 1)
                        <a class="company_title" href="/banki/{{$card->bankAlias}}/kredity/{{$card->productAlias}}">{{$card->title}}</a>
                    @else
                        <a class="company_title" href="/banki/{{$card->bankAlias}}/kredity">{{$card->title}}</a>
                    @endif
                </div>
                <div class="showed-wrapper" data-label="Процентная ставка">
                    <?php
                    $perc_min = isset($card->percent_min) ? 'от '.$card->percent_min : '';
                    $perc_max = (isset($card->percent_max) && $card->percent_max!= 0) ? 'до '.$card->percent_max : '';
                    ?>
                    <span class="mt-offer">{{$perc_min}} {{$perc_max}} %</span>
                </div>
                <div class="showed-wrapper" data-label="Сумма">
                    <?php
                    $sum_min = isset($card->sum_min) ? 'от '.number_format($card->sum_min, 0, '.', ' ') : '';
                    $sum_max = isset($card->sum_max) ? 'до '.number_format($card->sum_max, 0, '.', ' ') : '';
                    ?>
                    <span class="mt-offer">{{$sum_min}} {{$sum_max}} ₽</span>
                </div>
                <div class="showed-wrapper" data-label="Срок">
                    <?php
                    $term_min = isset($card->term_min) ? 'от '.$card->term_min : '';
                    $term_max = isset($card->term_max) ? 'до '.$card->term_max : '';
                    ?>
                    <span class="mt-offer">{{$term_min}} {{$term_max}} месяцев</span>
                </div>
                <div class="showed-wrapper">
                    <br>
                    <?php $link = ($card->link_type == 1) ? $card->link_1 : $card->link_2; ?>
                    <?php $onClick = ""; ?>
                    <span class="mt-offer">
                    <a data-id="{{$card->id}}" href="{{$link}}" target="_blank" class="hdl form-btn1 no-print {{$card->yandex_event}}" onclick="{{$onClick}} return true;">  Оформить</a>
                    </span>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div id="special-banks-offer-tab-2" class="special-banks-offers-tab">
        @foreach($cardsCreditCards as $card)
        <div class="companies-flex-item">
            <div class="showed-line">
                <div class="showed-wrapper" data-label="Банк">
                    <div class="small-img-wrap">
                        <img loading="lazy" src="{{$card->logo}}" alt="{{$card->title}}">
                    </div>
                    @if(isset($card->separate_page) && $card->separate_page == 1)
                        <a class="company_title" href="/banki/{{$card->bankAlias}}/kreditnye-karty/{{$card->productAlias}}">{{$card->title}}</a>
                    @else
                        <a class="company_title" href="/banki/{{$card->bankAlias}}/kreditnye-karty">{{$card->title}}</a>
                    @endif
                </div>
                <div class="showed-wrapper" data-label="Максимальный лимит">
                    <span class="mt-offer">{{number_format($card->limit_max, 0, '.', ' ')}} ₽</span>
                </div>
                <div class="showed-wrapper" data-label="Процентная ставка">
                    <?php
                        $perc_min = isset($card->percent_min) ? 'от '.$card->percent_min : '';
                        $perc_max = isset($card->percent_max) ? 'до '.$card->percent_max : '';
                    ?>
                    <span class="mt-offer">{{$perc_min}} {{$perc_max}} %</span>
                </div>
                <div class="showed-wrapper" data-label="Беспроцентный период">
                    <span class="mt-offer">{{$card->none_percent_period}} дн.</span>
                </div>
                <div class="showed-wrapper">
                    <br>
                    <?php $link = ($card->link_type == 1) ? $card->link_1 : $card->link_2; ?>
                    <?php $onClick = ""; ?>
                    <span class="mt-offer">
                    <a data-id="{{$card->id}}" href="{{$link}}" target="_blank" class="hdl form-btn1 no-print {{$card->yandex_event}}" onclick="{{$onClick}} return true;">  Оформить</a>
                    </span>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div id="special-banks-offer-tab-3" class="special-banks-offers-tab">
        @foreach($cardsDebitCards as $card)
        <div class="companies-flex-item">
            <div class="showed-line">
                <div class="showed-wrapper" data-label="Банк">
                    <div class="small-img-wrap">
                        <img loading="lazy" src="{{$card->logo}}" alt="{{$card->title}}">
                    </div>
                    @if(isset($card->separate_page) && $card->separate_page == 1)
                        <a class="company_title" href="/banki/{{$card->bankAlias}}/debetovye-karty/{{$card->productAlias}}">{{$card->title}}</a>
                    @else
                        <a class="company_title" href="/banki/{{$card->bankAlias}}/debetovye-karty">{{$card->title}}</a>
                    @endif
                </div>
                <div class="showed-wrapper" data-label="Открытие">
                    <span class="mt-offer">{{number_format($card->opened, 0, '.', ' ')}} ₽</span>
                </div>
                <div class="showed-wrapper" data-label="Обслуживание">
                    <span class="mt-offer">{{number_format($card->maintenance, 0, '.', ' ')}} ₽</span>
                </div>
                <div class="showed-wrapper" data-label="Возраст">
                    <span class="mt-offer">
                    от {{$card->age_min}} @if(isset($card->age_max)) @if($card->age_max != null) до {{$card->age_max}} лет @endif  @else @if($card->age_min == 21) года @else лет @endif  @endif
                    </span>
                </div>
                <div class="showed-wrapper">
                    <br>
                    <?php $link = ($card->link_type == 1) ? $card->link_1 : $card->link_2; ?>
                    <?php $onClick = ""; ?>
                        <span class="mt-offer">
                    <a data-id="250" href="{{$link}}" target="_blank" class="hdl form-btn1 credit-hub" onclick="{{$onClick}} return true;"> Оформить</a>
                        </span>
                </div>
            </div>
        </div>
        @endforeach
    </div>


    <div id="special-banks-offer-tab-4" class="special-banks-offers-tab">
        @foreach($cardsRKO as $card)
        <div class="companies-flex-item">
            <div class="showed-line">
                <div class="showed-wrapper" data-label="Банк">
                    <div class="small-img-wrap">
                        <img loading="lazy" src="{{$card->logo}}" alt="{{$card->title}}">
                    </div>
                    @if(isset($card->separate_page) && $card->separate_page == 1)
                        <a class="company_title" href="/banki/{{$card->bankAlias}}/rko/{{$card->productAlias}}">{{$card->title}}</a>
                    @else
                        <a class="company_title" href="/banki/{{$card->bankAlias}}/rko">{{$card->title}}</a>
                    @endif
                </div>
                <div class="showed-wrapper" data-label="Открытие">
                    <span class="mt-offer">{{number_format($card->opened, 0, '.', ' ')}} ₽</span>
                </div>
                <div class="showed-wrapper" data-label="Обслуживание">
                    <span class="mt-offer">{{number_format($card->maintenance, 0, '.', ' ')}} ₽</span>
                </div>
                <div class="showed-wrapper" data-label="Скорость открытия">
                    <span class="mt-offer">{{$card->speed_opened}} </span>
                </div>
                <div class="showed-wrapper">
                    <br>
                    <?php $link = ($card->link_type == 1) ? $card->link_1 : $card->link_2; ?>
                    <?php $onClick = ""; ?>
                        <span class="mt-offer">
                    <a data-id="250" href="{{$link}}" target="_blank" class="hdl form-btn1 credit-hub" onclick="{{$onClick}} return true;"> Оформить</a>
                        </span>
                </div>
            </div>
        </div>
        @endforeach
    </div>


    <div id="special-banks-offer-tab-5" class="special-banks-offers-tab">
        @foreach($cardsMortgage as $card)
            <div class="companies-flex-item">
                <div class="showed-line">
                    <div class="showed-wrapper" data-label="Банк">
                        <div class="small-img-wrap">
                            <img loading="lazy" src="{{$card->logo}}" alt="{{$card->title}}">
                        </div>
                        @if(isset($card->separate_page) && $card->separate_page == 1)
                            <a class="company_title" href="/banki/{{$card->bankAlias}}/ipoteka/{{$card->productAlias}}">{{$card->title}}</a>
                        @else
                            <a class="company_title" href="/banki/{{$card->bankAlias}}/ipoteka">{{$card->title}}</a>
                        @endif
                    </div>
                    <div class="showed-wrapper" data-label="Процентная ставка">
                        <?php
                        $perc_min = isset($card->percent_min) ? 'от '.$card->percent_min : '';
                        $perc_max = (isset($card->percent_max) && $card->percent_max!= 0) ? 'до '.$card->percent_max : '';
                        ?>
                        <span class="mt-offer">{{$perc_min}} {{$perc_max}} %</span>
                    </div>
                    <div class="showed-wrapper" data-label="Сумма">
                        <?php
                        $sum_min = isset($card->sum_min) ? 'от '.number_format($card->sum_min, 0, '.', ' ') : '';
                        $sum_max = isset($card->sum_max) ? 'до '.number_format($card->sum_max, 0, '.', ' ') : '';
                        ?>
                        <span class="mt-offer">{{$sum_min}} {{$sum_max}} ₽</span>
                    </div>
                    <div class="showed-wrapper" data-label="Срок">
                        <?php
                        $term_min = isset($card->term_min) ? 'от '.$card->term_min : '';
                        $term_max = isset($card->term_max) ? 'до '.$card->term_max : '';
                        ?>
                        <span class="mt-offer">{{$term_min}} {{$term_max}} месяцев</span>
                    </div>
                    <div class="showed-wrapper">
                        <br>
                        <?php $link = ($card->link_type == 1) ? $card->link_1 : $card->link_2; ?>
                        <?php $onClick = ""; ?>
                        <span class="mt-offer">
                    <a data-id="{{$card->id}}" href="{{$link}}" target="_blank" class="hdl form-btn1 no-print {{$card->yandex_event}}" onclick="{{$onClick}} return true;">  Оформить</a>
                    </span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>


    <div id="special-banks-offer-tab-6" class="special-banks-offers-tab">
        @foreach($cardsDeposits as $card)
            <div class="companies-flex-item">
                <div class="showed-line">
                    <div class="showed-wrapper" data-label="Банк">
                        <div class="small-img-wrap">
                            <img loading="lazy" src="{{$card->logo}}" alt="{{$card->title}}">
                        </div>
                        @if(isset($card->separate_page) && $card->separate_page == 1)
                            <a class="company_title" href="/banki/{{$card->bankAlias}}/vklady/{{$card->productAlias}}">{{$card->title}}</a>
                        @else
                            <a class="company_title" href="/banki/{{$card->bankAlias}}/vklady">{{$card->title}}</a>
                        @endif
                    </div>
                    <div class="showed-wrapper" data-label="Процентная ставка">
                            <?php
                            $perc_min = isset($card->percent_min) ? 'от '.$card->percent_min : '';
                            $perc_max = (isset($card->percent_max) && $card->percent_max!= 0) ? 'до '.$card->percent_max : '';
                            ?>
                        <span class="mt-offer">{{$perc_min}} {{$perc_max}} %</span>
                    </div>
                    <div class="showed-wrapper" data-label="Сумма">
                            <?php
                            $sum_min = isset($card->sum_min) ? 'от '.number_format($card->sum_min, 0, '.', ' ') : '';
                            $sum_max = isset($card->sum_max) ? 'до '.number_format($card->sum_max, 0, '.', ' ') : '';
                            ?>
                        <span class="mt-offer">{{$sum_min}} {{$sum_max}} ₽</span>
                    </div>
                    <div class="showed-wrapper" data-label="Срок">
                            <?php
                            $term_min = isset($card->term_min) ? 'от '.$card->term_min : '';
                            $term_max = isset($card->term_max) ? 'до '.$card->term_max : '';
                            ?>
                        <span class="mt-offer">{{$term_min}} {{$term_max}} месяцев</span>
                    </div>
                    <div class="showed-wrapper">
                        <br>
                            <?php $link = ($card->link_type == 1) ? $card->link_1 : $card->link_2; ?>
                            <?php $onClick = ""; ?>
                        <span class="mt-offer">
                    <a data-id="{{$card->id}}" href="{{$link}}" target="_blank" class="hdl form-btn1 no-print {{$card->yandex_event}}" onclick="{{$onClick}} return true;">  Оформить</a>
                    </span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>
@section('additional-scripts')
    @parent
@endsection