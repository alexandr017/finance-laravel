<ul class="nav">
    <li class="active" data-tab="card-mn-conditions">Условия и ставки</li>
    <li data-tab="card-mn-docs">Требования и документы</li>
</ul>
<div class="card-mn-tab-content">
    <div class="active card-mn-conditions">
        @if(isset($card->zalog_type) && $card->zalog_type !== null)
        <div class="card-mn-row">
            <span class="card-mn-details">Виды залога</span>
            <b class="card-mn-row-value">{{$card->zalog_type}}</b>
        </div>
        @endif
        @if(isset($card->sum_min) && $card->sum_min !== null)
        <div class="card-mn-row">
            <span class="card-mn-details">Сумма займа</span>
            <b class="card-mn-row-value"> от {{number_format($card->sum_min, 0, '.', ' ')}} @if(isset($card->sum_max) && $card->sum_max != null)
                    до {{number_format($card->sum_max, 0, '.', ' ')}} ₽ @endif </b>
        </div>
        @endif
        @if(isset($card->percent_min) && $card->percent_min !== null)
        <div class="card-mn-row">
            <span class="card-mn-details">Ставка в месяц</span>
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
        @if(isset($card->work_time) && $card->work_time !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">График работы</span>
                <b class="card-mn-row-value">{{$card->work_time}}</b>
            </div>
        @endif
        @if(isset($card->repayment) && $card->repayment !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Выкуп</span>
                <b class="card-mn-row-value">{{$card->repayment}}</b>
            </div>
        @endif
    </div>
    <div class="card-mn-tab-pane card-mn-docs">
        @if(isset($card->year) && $card->year !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Начало работы</span>
                <b class="card-mn-row-value">{{$card->year}}</b>
            </div>
        @endif
        @if(isset($card->licency) && $card->licency !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Лицензия</span>
                <b class="card-mn-row-value">{{$card->licency}}</b>
            </div>
        @endif
        @if(isset($card->docs) && $card->docs !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Документы</span>
                <b class="card-mn-row-value">{{$card->docs}}</b>
            </div>
        @endif
        @if(isset($card->work_time) && $card->work_time !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">График работы</span>
                <b class="card-mn-row-value">{{$card->work_time}}</b>
            </div>
        @endif
        @if(isset($card->repayment) && $card->repayment !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Выкуп</span>
                <b class="card-mn-row-value">{{$card->repayment}}</b>
            </div>
        @endif
        @if(isset($card->investors) && $card->investors !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Инвесторам</span>
                <b class="card-mn-row-value">{{$card->investors}}</b>
            </div>
        @endif
        @if(isset($card->additional_field) && $card->additional_field !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Дополнительно</span>
                <b class="card-mn-row-value">{{$card->additional_field}}</b>
            </div>
        @endif
    </div>
</div>
