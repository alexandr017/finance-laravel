<ul class="nav">
    <li class="active" data-tab="card-mn-conditions">Условия и ставки</li>
    <li data-tab="card-mn-docs">Требования и документы</li>
</ul>
@if(Auth::id() == 92879)
    <ul class="nav-js">
        <li class="active" data-tab="card-mn-conditions">Условия и ставки</li>
        <li data-tab="card-mn-docs">Требования и документы</li>
    </ul>
@endif

<div class="card-mn-tab-content">
    <div class="active card-mn-conditions">
        <?php $beta = [
            'https://finance.ru/yandex-money',
            'https://finance.ru/pasport',
            'https://finance.ru/bezrabotnym',
            'https://finance.ru/karta-sberbanka',
            'https://finance.ru/s-otkritoy-prosrochkoi',
            'https://finance.ru/bez-zvonkov',
            'https://finance.ru/bez-karty',
            'https://finance.ru/contact',
            'https://finance.ru/srochnye',
            'https://finance.ru/nadejnie'
        ]; ?>
        @if(in_array(\Request::url(),$beta))
            <table>
                @if(isset($card->sum_min) && $card->sum_min !== null)
                    <tr class="card-mn-row">
                        <td class="card-mn-details">Сумма займа</td>
                        <td class="card-mn-row-value">от {{number_format($card->sum_min, 0, '.', ' ')}} @if(isset($card->sum_max) && $card->sum_max != null) до {{number_format($card->sum_max, 0, '.', ' ')}} руб. @endif</td>
                    </tr>
                @endif
                @if(isset($card->percent) && $card->percent !== null)
                        <tr class="card-mn-row">
                            <td class="card-mn-details">Ставка в день</td>
                            <td class="card-mn-row-value">{{$card->percent}}%</td>
                        </tr>
                @endif
                @if(isset($card->term_min) && $card->term_min !== null)
                        <tr class="card-mn-row">
                            <td class="card-mn-details">Срок</td>
                            <td class="card-mn-row-value">от {{$card->term_min}} @if(isset($card->term_max) && $card->sum_max != null) до {{$card->term_max}}  @endif дней</td>
                        </tr>
                @endif
                    <tr class="card-mn-row">
                        <td class="card-mn-details">Переплата от</td>
                        <td class="card-mn-row-value">
                                <?php
                                $m_min = (isset($card->sum_min)) ? $card->sum_min : 0;
                                $m_term_min = (isset($card->term_min)) ? $card->term_min : 0;
                                $m_percent = (isset($card->percent)) ? $card->percent : 0;
                                $res = $m_min * ($m_percent / 100) * $m_term_min;
                                echo number_format($res, 0, '.', ' ') . ' руб.';
                                ?>
                        </td>
                    </tr>
                @if(isset($card->pay_method) && $card->pay_method !== null)
                        <tr class="card-mn-row">
                            <td class="card-mn-details">Способ выплаты</td>
                            <td class="card-mn-row-value">{!! $card->pay_method !!}</td>
                        </tr>
                @endif
                @if(isset($card->payment_method) && $card->payment_method !== null)
                        <tr class="card-mn-row">
                            <td class="card-mn-details">Способ погашения</td>
                            <td class="card-mn-row-value">{!! $card->payment_method !!}</td>
                        </tr>
                @endif
            </table>
        @else
        @if(isset($card->sum_min) && $card->sum_min !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Сумма займа</span>
                <b class="card-mn-row-value"> от {{number_format($card->sum_min, 0, '.', ' ')}} @if(isset($card->sum_max) && $card->sum_max != null)
                        до {{number_format($card->sum_max, 0, '.', ' ')}} руб. @endif </b>
            </div>
        @endif
        @if(isset($card->percent) && $card->percent !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Ставка в день</span>
                <b class="card-mn-row-value"> {{$card->percent}}% </b>
            </div>
        @endif
        @if(isset($card->term_min) && $card->term_min !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Срок</span>
                <b class="card-mn-row-value"> от {{$card->term_min}} @if(isset($card->term_max) && $card->sum_max != null)
                        до {{$card->term_max}}  @endif дней </b>
            </div>
        @endif
        <div class="card-mn-row">
            <span class="card-mn-details">Переплата от</span>
            <b class="card-mn-row-value">
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
            <div class="card-mn-row">
                <span class="card-mn-details">Способ выплаты</span>
                <span class="card-mn-row-value"><?php $result_val = $card->pay_method; include base_path().'/resources/views/frontend/cards/minimal/_sprite.php'; ?></span>
            </div>
        @endif
        @if(isset($card->payment_method) && $card->payment_method !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Способ погашения</span>
                <span class="card-mn-row-value"><?php $result_val = $card->payment_method; include base_path().'/resources/views/frontend/cards/minimal/_sprite.php'; ?></span>
            </div>
        @endif
        @endif
    </div>
    <div class="card-mn-tab-pane card-mn-docs">
        @if(isset($card->age_min) && $card->age_min !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Возраст</span>
                <b class="card-mn-row-value">от {{$card->age_min}}
                    @if(isset($card->age_max))
                        @if($card->age_max != null)до {{$card->age_max}} лет @endif
                    @else
                        @if($card->age_min == 21) года @else лет @endif
                    @endif
                </b>
            </div>
        @endif
        @if(isset($card->docs) && $card->docs !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Документы</span>
                <b class="card-mn-row-value">{{$card->docs}}</b>
            </div>
        @endif
        @if(isset($card->identification) && $card->identification !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Идентификация</span>
                <b class="card-mn-row-value"> {{$card->identification}} </b>
            </div>
        @endif
        @if(isset($card->review_speed) && $card->review_speed !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Скорость рассмотрения заявки</span>
                <b class="card-mn-row-value">{{$card->review_speed}}</b>
            </div>
        @endif
        @if(isset($card->payout_speed) && $card->payout_speed !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Скорость выплаты</span>
                <b class="card-mn-row-value">{{$card->payout_speed}}</b>
            </div>
        @endif
        @if(isset($card->investors) && $card->investors !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Инвесторам</span>
                <b class="card-mn-row-value">{{$card->investors}}</b>
            </div>
        @endif
    </div>
</div>