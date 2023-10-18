<ul class="nav">
    <li class="active" data-tab="card-mn-conditions">Условия и ставки</li>
</ul>
<div class="card-mn-tab-content">
    <div class="active card-mn-conditions">
        @if(isset($card->sum_min) && $card->sum_min !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Сумма</span>
                <b class="card-mn-row-value"> от {{number_format($card->sum_min, 0, '.', ' ')}} @if(isset($card->sum_max) && $card->sum_max != null)
                        до {{number_format($card->sum_max, 0, '.', ' ')}} руб. @endif </b>
            </div>
        @endif
        @if(isset($card->percent_min) && $card->percent_min !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Процентная ставка</span>
                <b class="card-mn-row-value"> от {{$card->percent_min}} @if(isset($card->percent_max) && $card->percent_max != null)
                        до {{$card->percent_max}}  @endif </b>
            </div>
        @endif
        @if(isset($card->term_min) && $card->term_min !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Срок</span>
                <b class="card-mn-row-value"> от {{$card->term_min}} @if(isset($card->term_max) && $card->term_max != null)
                        до {{$card->term_max}}  @endif дней </b>
            </div>
        @endif
        @if(isset($card->term) && $card->term !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Срок вклада</span>
                <b class="card-mn-row-value"> {{$card->term}} дней </b>
            </div>
        @endif
        @if(isset($card->currency) && $card->currency !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Валюта</span>
                <b class="card-mn-row-value">{{$card->currency}}</b>
            </div>
        @endif
        @if(isset($card->replanishment) && $card->replanishment !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Пополнение</span>
                <b class="card-mn-row-value">{{$card->replanishment}}</b>
            </div>
        @endif
        @if(isset($card->auto_prolongation) && $card->auto_prolongation !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Автопролонгация</span>
                <b class="card-mn-row-value"> {{$card->auto_prolongation}} </b>
            </div>
        @endif
        @if(isset($card->partial_withdrawal) && $card->partial_withdrawal !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Частичное снятие</span>
                <b class="card-mn-row-value"> {{$card->partial_withdrawal}} </b>
            </div>
        @endif
        @if(isset($card->early_termination) && $card->early_termination !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Досрочное расторжение</span>
                <b class="card-mn-row-value">{{$card->early_termination}} </b>
            </div>
        @endif
        @if(isset($card->investment_feature) && $card->investment_feature !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Особенность вклада</span>
                <b class="card-mn-row-value"> {{$card->investment_feature}} </b>
            </div>
        @endif
        @if(isset($card->percents_payment) && $card->percents_payment !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Выплата процентов</span>
                <b class="card-mn-row-value"> {{$card->percents_payment}} </b>
            </div>
        @endif
        @if(isset($card->capitalization) && $card->capitalization !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Капитализация</span>
                <b class="card-mn-row-value"> {{$card->capitalization}} </b>
            </div>
        @endif
        @if(isset($card->open_online) && $card->open_online !== null)
            <?php $open_online = $card->open_online == 0 ? 'Нет':'Есть'; ?>
            <div class="card-mn-row">
                <span class="card-mn-details">Открытие вклада Online</span>
                <b class="card-mn-row-value"> {{$open_online}} </b>
            </div>
        @endif
        @if(isset($card->special_conditions) && $card->special_conditions !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Особые условия</span>
                <b class="card-mn-row-value">{{$card->special_conditions}} </b>
            </div>
        @endif
        @if(isset($card->stock) && $card->stock !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Акции</span>
                <b class="card-mn-row-value">{{$card->stock}} </b>
            </div>
        @endif
    </div>
</div>