<div class="special-banks-offers">
    @if(count($cardsCredits)>0)
    <div class="h4 text-center bank-cat-name">Кредиты</div>
    @endif
    <div class="ltable-wrap">
        @foreach($cardsCredits as $card)
            <div class="amp-bank-block shadow">
                <div class="amp-bank-block-title">
                    <div class="small-img-wrap">
                        <amp-img width="125" height="60" layout="fixed" src="{{$card->logo}}" alt="{{$card->title}}"></amp-img>
                    </div>
                    @if(isset($card->separate_page) && $card->separate_page == 1)
                        <a href="/banks/{{$card->bankAlias}}/credits/{{$card->productAlias}}">{{$card->title}}</a>
                    @else
                        <a href="/banks/{{$card->bankAlias}}/credits">{{$card->title}}</a>
                    @endif
                </div>
                <div><div class="bank-details">Процентная ставка</div>
                    <?php
                    $perc_min = isset($card->percent_min) ? 'от '.$card->percent_min : '';
                    $perc_max = (isset($card->percent_max) && $card->percent_max!= 0) ? 'до '.$card->percent_max : '';
                    ?>
                    {{$perc_min}} {{$perc_max}} %
                </div>
                <div><div class="bank-details">Сумма</div>
                    <?php
                    $sum_min = isset($card->sum_min) ? 'от '.number_format($card->sum_min, 0, '.', ' ') : '';
                    $sum_max = isset($card->sum_max) ? 'до '.number_format($card->sum_max, 0, '.', ' ') : '';
                    ?>
                    {{$sum_min}}  {{$sum_max}} ₽
                </div>
                <div>
                    <div class="bank-details">Срок</div>
                    <?php
                    $term_min = isset($card->term_min) ? 'от '.$card->term_min : '';
                    $term_max = isset($card->term_max) ? 'до '.$card->term_max : '';
                    ?>
                    {{$term_min}} {{$term_max}} мес.
                </div>
                <?php if($card->link_type == 1) $link = $card->link_1; else $link = $card->link_2; ?>
                <a href="{{$link}}" target="_blank" class="form-btn1 {{$card->yandex_event}}">Оформить</a>
            </div>
        @endforeach
    </div>
    @if(count($cardsCreditCards)>0)
    <div class="h4 text-center bank-cat-name">Кредитные карты</div>
    @endif
    <div class="ltable-wrap">
        @foreach($cardsCreditCards as $card)
            <div class="amp-bank-block shadow">
                <div class="amp-bank-block-title">
                    <div class="small-img-wrap">
                        <amp-img width="125" height="60" layout="fixed" src="{{$card->logo}}" alt="{{$card->title}}"></amp-img>
                    </div>
                    @if(isset($card->separate_page) && $card->separate_page == 1)
                        <a href="/banks/{{$card->bankAlias}}/credit-cards/{{$card->productAlias}}">{{$card->title}}</a>
                    @else
                        <a href="/banks/{{$card->bankAlias}}/credit-cards">{{$card->title}}</a>
                    @endif
                </div>
                <div><div class="bank-details">Максимальный лимит</div>
                    {{number_format($card->limit_max, 0, '.', ' ')}} ₽
                </div>
                <div><div class="bank-details">Процентная ставка</div>
                    <?php
                    $perc_min = isset($card->percent_min) ? 'от '.$card->percent_min : '';
                    $perc_max = (isset($card->percent_max) && $card->percent_max!= 0) ? 'до '.$card->percent_max : '';
                    ?>
                    {{$perc_min}} {{$perc_max}} %
                </div>
                <div>
                    <div class="bank-details">Беспроцентный период</div>
                    {{$card->none_percent_period}} дн.
                </div>
                <?php if($card->link_type == 1) $link = $card->link_1; else $link = $card->link_2; ?>
                <a href="{{$link}}" target="_blank" class="form-btn1 {{$card->yandex_event}}">Оформить</a>
            </div>
        @endforeach
    </div>
    @if(count($cardsDebitCards)>0)
    <div class="h4 text-center  bank-cat-name">Дебетовые карты</div>
    @endif
    <div class="ltable-wrap">
        @foreach($cardsDebitCards as $card)
            <div class="amp-bank-block shadow">
                <div class="amp-bank-block-title">
                    <div class="small-img-wrap">
                        <amp-img width="125" height="60" layout="fixed" src="{{$card->logo}}" alt="{{$card->title}}"></amp-img>
                    </div>
                    @if(isset($card->separate_page) && $card->separate_page == 1)
                        <a href="/banks/{{$card->bankAlias}}/debit-cards/{{$card->productAlias}}">{{$card->title}}</a>
                    @else
                        <a href="/banks/{{$card->bankAlias}}/debit-cards">{{$card->title}}</a>
                    @endif
                </div>
                <div><div class="bank-details">Открытие</div>
                    {{number_format($card->opened, 0, '.', ' ')}} ₽
                </div>
                <div><div class="bank-details">Обслуживание</div>
                    {{number_format($card->maintenance, 0, '.', ' ')}} ₽
                </div>
                <div>
                    <div class="bank-details">Возраст</div>
                    от {{$card->age_min}} @if(isset($card->age_max)) @if($card->age_max != null) до {{$card->age_max}} лет @endif  @else @if($card->age_min == 21) года @else лет @endif  @endif
                </div>
                <?php if($card->link_type == 1) $link = $card->link_1; else $link = $card->link_2; ?>
                <a href="{{$link}}" target="_blank" class="form-btn1 {{$card->yandex_event}}">Оформить</a>
            </div>
        @endforeach
    </div>
    @if(count($cardsRKO)>0)
    <div class="h4 text-center  bank-cat-name">РКО</div>
    @endif
    <div class="ltable-wrap">
        @foreach($cardsRKO as $card)
            <div class="amp-bank-block shadow">
                <div class="amp-bank-block-title">
                    <div class="small-img-wrap">
                        <amp-img width="125" height="60" layout="fixed" src="{{$card->logo}}" alt="{{$card->title}}"></amp-img>
                    </div>
                    @if(isset($card->separate_page) && $card->separate_page == 1)
                        <a href="/banks/{{$card->bankAlias}}/rko/{{$card->productAlias}}">{{$card->title}}</a>
                    @else
                        <a href="/banks/{{$card->bankAlias}}/rko">{{$card->title}}</a>
                    @endif
                </div>
                <div><div class="bank-details">Открытие</div>
                    {{number_format($card->opened, 0, '.', ' ')}} ₽
                </div>
                <div><div class="bank-details">Обслуживание</div>
                    {{number_format($card->maintenance, 0, '.', ' ')}} ₽
                </div>
                <div>
                    <div class="bank-details">Скорость открытия</div>
                    {{$card->speed_opened}}
                </div>
                <?php if($card->link_type == 1) $link = $card->link_1; else $link = $card->link_2; ?>
                <a href="{{$link}}" target="_blank" class="form-btn1 {{$card->yandex_event}}">Оформить</a>
            </div>
        @endforeach
    </div>



        @if(count($cardsMortgage)>0)
            <div class="h4 text-center  bank-cat-name">Ипотеки</div>
        @endif
        <div class="ltable-wrap">
            @foreach($cardsMortgage as $card)
                <div class="amp-bank-block shadow">
                    <div class="amp-bank-block-title">
                        <div class="small-img-wrap">
                            <amp-img width="125" height="60" layout="fixed" src="{{$card->logo}}" alt="{{$card->title}}"></amp-img>
                        </div>
                        @if(isset($card->separate_page) && $card->separate_page == 1)
                            <a href="/banks/{{$card->bankAlias}}/credits/{{$card->productAlias}}">{{$card->title}}</a>
                        @else
                            <a href="/banks/{{$card->bankAlias}}/credits">{{$card->title}}</a>
                        @endif
                    </div>
                    <div><div class="bank-details">Процентная ставка</div>
                        <?php
                        $perc_min = isset($card->percent_min) ? 'от '.$card->percent_min : '';
                        $perc_max = (isset($card->percent_max) && $card->percent_max!= 0) ? 'до '.$card->percent_max : '';
                        ?>
                        {{$perc_min}} {{$perc_max}} %
                    </div>
                    <div><div class="bank-details">Сумма</div>
                        <?php
                        $sum_min = isset($card->sum_min) ? 'от '.number_format($card->sum_min, 0, '.', ' ') : '';
                        $sum_max = isset($card->sum_max) ? 'до '.number_format($card->sum_max, 0, '.', ' ') : '';
                        ?>
                        {{$sum_min}}  {{$sum_max}} ₽
                    </div>
                    <div>
                        <div class="bank-details">Срок</div>
                        <?php
                        $term_min = isset($card->term_min) ? 'от '.$card->term_min : '';
                        $term_max = isset($card->term_max) ? 'до '.$card->term_max : '';
                        ?>
                        {{$term_min}} {{$term_max}} мес.
                    </div>
                    <?php if($card->link_type == 1) $link = $card->link_1; else $link = $card->link_2; ?>
                    <a href="{{$link}}" target="_blank" class="form-btn1 {{$card->yandex_event}}">Оформить</a>
                </div>
            @endforeach
        </div>



</div>