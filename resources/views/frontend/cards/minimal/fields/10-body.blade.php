<ul class="nav">
    <li class="active" data-tab="card-mn-conditions">Условия и ставки</li>
    <li data-tab="card-mn-borrower">Заемщик</li>
    <li data-tab="card-mn-docs">Оформление</li>
    <li data-tab="card-mn-repayment">Погашение</li>
</ul>
<div class="card-mn-tab-content">
    <div class="active card-mn-conditions">
        @if(isset($card->target) && $card->target !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Цель</span>
                <b class="card-mn-row-value">{!! $card->target !!}</b>
            </div>
        @endif
        @if(isset($card->sum_min) && $card->sum_min !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Минимальный доход</span>
                <b class="card-mn-row-value"> от {{number_format($card->sum_min, 0, '.', ' ')}} @if(isset($card->sum_max) && $card->sum_max != null)
                        до {{number_format($card->sum_max, 0, '.', ' ')}} руб. @endif </b>
            </div>
        @endif
        @if(isset($card->term_min) && $card->term_min !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Срок</span>
                <b class="card-mn-row-value"> от {{$card->term_min}} @if(isset($card->term_max) && $card->sum_max != null)
                        до {{$card->term_max}}  @endif дней </b>
            </div>
        @endif
        @if(isset($card->percent_min) && $card->percent_min !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Процентная ставка</span>
                <b class="card-mn-row-value"> от {{$card->percent_min}} @if(isset($card->percent_max) && $card->percent_max != null)
                        до {{$card->percent_max}}  @endif дней </b>
            </div>
        @endif
        @if(isset($card->an_initial_fee_min) && $card->an_initial_fee_min !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Первоначальный взнос</span>
                <b class="card-mn-row-value"> от {{$card->an_initial_fee_min}} @if(isset($card->an_initial_fee_max) && $card->an_initial_fee_max != null)
                        до {{$card->an_initial_fee_max}}  @endif % </b>
            </div>
        @endif
        @if(isset($card->procuring) && $card->procuring !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Обеспечение</span>
                <b class="card-mn-row-value">{!! $card->procuring !!}</b>
            </div>
        @endif
    </div>
    <div class="card-mn-tab-pane card-mn-borrower">
        @if(isset($card->age_min) && $card->age_min !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Возраст</span>
                <b class="card-mn-row-value">от {{$card->age_min}} @if(isset($card->age_max)) @if($card->age_max != null)
                        до {{$card->age_max}} лет @endif  @else @if($card->age_min == 21) года @else
                        лет @endif  @endif</b>
            </div>
        @endif
        @if(isset($card->borrower) && $card->borrower !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Заемщик</span>
                <b class="card-mn-row-value">{{$card->borrower}}</b>
            </div>
        @endif
        @if(isset($card->experience) && $card->experience !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Стаж</span>
                <b class="card-mn-row-value">{{$card->experience}}</b>
            </div>
        @endif
        @if(isset($card->income_min) && $card->income_min !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Сумма займа</span>
                <b class="card-mn-row-value"> от {{$card->income_min}} @if(isset($card->income_max) && $card->income_max != null)
                        до {{$card->income_max}} руб. @endif </b>
            </div>
        @endif
    </div>
    <div class="card-mn-tab-pane card-mn-docs">
        @if(isset($card->docs) && $card->docs !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Документы</span>
                <b class="card-mn-row-value">{!! $card->docs !!}</b>
            </div>
        @endif
        @if(isset($card->review_speed) && $card->review_speed !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Скорость рассмотрения заявки</span>
                <b class="card-mn-row-value">{{$card->review_speed}}</b>
            </div>
        @endif
        @if(isset($card->validity_of_a_positive_decision) && $card->validity_of_a_positive_decision !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Срок действия положительного решения</span>
                <b class="card-mn-row-value">{{$card->validity_of_a_positive_decision}}</b>
            </div>
        @endif
        @if(isset($card->additionally_field) && $card->additionally_field !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Дополнительно</span>
                <b class="card-mn-row-value">{!! $card->additionally_field !!}</b>
            </div>
        @endif
    </div>
    <div class="card-mn-tab-pane card-mn-repayment">
        @if(isset($card->repayment_methods) && $card->repayment_methods !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Способ выплаты</span>
                <b class="card-mn-row-value">{{$card->repayment_methods}}</b>
            </div>
        @endif
        @if(isset($card->payments) && $card->payments !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Платежи</span>
                <b class="card-mn-row-value">{{$card->payments}}</b>
            </div>
        @endif
        @if(isset($card->early_repayment) && $card->early_repayment !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Досрочное погашение</span>
                <b class="card-mn-row-value">{{$card->early_repayment}}</b>
            </div>
        @endif
    </div>
</div>
