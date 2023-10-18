<ul class="nav">
    <li class="active"><a href="#" data-tab="beta-card-conditions">Условия и ставки</a></li>
    <li><a href="#" data-tab="beta-card-docs">Требования и документы</a></li>
</ul>
<div class="beta-card-tab-content">
    <div class="active beta-card-conditions">
        @if(isset($card->sum_min) && $card->sum_min !== null)
            <div class="beta-card-gray-row beta-card-row">
                <span class="beta-card-details">Сумма займа</span>
                <b> от {{number_format($card->sum_min, 0, '.', ' ')}} @if(isset($card->sum_max)) @if($card->sum_max != null)
                        до {{number_format($card->sum_max, 0, '.', ' ')}} руб. @endif @endif </b>
            </div>
        @endif
        @if(isset($card->percent) && $card->percent !== null)
            <div class="beta-card-row">
                <span class="beta-card-details">Ставка в день</span>
                <b> {{$card->percent}}% </b>
            </div>
        @endif
        @if(isset($card->term_min) && $card->term_min !== null)
            <div class="beta-card-gray-row beta-card-row">
                <span class="beta-card-details">Срок</span>
                <b> от {{$card->term_min}} @if(isset($card->term_max) && $card->sum_max != null)
                        до {{$card->term_max}}  @endif дней </b>
            </div>
        @endif
        <div class="beta-card-row">
            <span class="beta-card-details">Переплата от</span>
            <b>
                <?php
                $m_min = (isset($card->sum_min)) ? $card->sum_min : 0;
                $m_term_min = (isset($card->term_min)) ? $card->term_min : 0;
                $m_percent = (isset($card->percent)) ? $card->percent : 0;
                $res = $m_min * ($m_percent / 100) * $m_term_min;
                echo number_format($res, 0, '.', ' ') . ' руб.';
                ?>
            </b>
        </div>
        @if(isset($card->pay_method) && $card->pay_method !== null)
            <div class="beta-card-gray-row beta-card-row">
                <span class="beta-card-details">Способ выплаты</span>
                <b class="beta-card-row-value">{!! $card->pay_method !!}</b>
            </div>
        @endif
        @if(isset($card->payment_method) && $card->payment_method !== null)
            <div class="beta-card-row">
                <span class="beta-card-details">Способ погашения</span>
                <b class="beta-card-row-value">{!! $card->payment_method !!}</b>
            </div>
        @endif
    </div>
    <div class="beta-card-tab-pane beta-card-docs">
        @if(isset($card->age_min) && $card->age_min !== null)
            <div class="beta-card-gray-row beta-card-row">
                <span class="beta-card-details">Возраст</span>
                <b>от {{$card->age_min}}
                    @if(isset($card->age_max))
                        @if($card->age_max != null)до {{$card->age_max}} лет @endif
                    @else
                        @if($card->age_min == 21) года @else лет @endif
                    @endif
                </b>
            </div>
        @endif
        @if(isset($card->docs) && $card->docs !== null)
            <div class="beta-card-row">
                <span class="beta-card-details">Документы</span>
                <b>{{$card->docs}}</b>
            </div>
        @endif
        @if(isset($card->identification) && $card->identification !== null)
            <div class="beta-card-gray-row beta-card-row">
                <span class="beta-card-details">Идентификация</span>
                <b> {{$card->identification}} </b>
            </div>
        @endif
        @if(isset($card->review_speed) && $card->review_speed !== null)
            <div class="beta-card-row">
                <span class="beta-card-details">Скорость рассмотрения заявки</span>
                <b>{{$card->review_speed}}</b>
            </div>
        @endif
        @if(isset($card->payout_speed) && $card->payout_speed !== null)
            <div class="beta-card-gray-row beta-card-row">
                <span class="beta-card-details">Скорость выплаты</span>
                <b>{{$card->payout_speed}}</b>
            </div>
        @endif
        @if(isset($card->investors) && $card->investors !== null)
            <div class="beta-card-row">
                <span class="beta-card-details">Инвесторам</span>
                <b>{{$card->investors}}</b>
            </div>
        @endif
    </div>
</div>