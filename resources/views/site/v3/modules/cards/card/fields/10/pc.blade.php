<span class="rko-card-btn active line-height-30" data-tab="1">Общие условия</span>
<span class="rko-card-btn line-height-30" data-tab="2">Заемщик</span>
<span class="rko-card-btn line-height-30" data-tab="3">Оформление</span>
<span class="rko-card-btn line-height-30" data-tab="4">Погашение</span>

<div class="rko-card-wrap rko-card-wrap-1" data-tab="1">
    <div class="row">
        <div class="col-md-6">
            @if(isset($card->sum_min)) @if($card->sum_min !== null)
            <div class="lvc fa-rub">
                Сумма:
                <div class="value">от {{number_format($card->sum_min, 0, '.', ' ')}} @if(isset($card->sum_max)) @if($card->sum_max != null) до {{number_format($card->sum_max, 0, '.', ' ')}} ₽ @endif @endif</div>
            </div>
            @endif @endif
            @if(isset($card->term_min)) @if($card->term_min !== null)
            <div class="lvc fa-calendar">
                Срок:
                <div class="value">от {{$card->term_min}} @if(isset($card->term_max)) @if($card->term_max != null) до {{$card->term_max}}  @endif @endif лет</div>
            </div>
            @endif @endif
            @if(isset($card->target)) @if(($card->target!==null))
            <div class="lvc fa-thumb-tack">Цель: <div class="value">{{$card->target}}</div></div>
            @endif @endif
        </div>
        <div class="col-md-6">
            @if(isset($card->an_initial_fee_min)) @if($card->an_initial_fee_min !== null)
            <div class="lvc fa-money">
                Первоначальный взнос:
                <div class="value">от {{$card->an_initial_fee_min}} @if(isset($card->an_initial_fee_max)) @if($card->an_initial_fee_max != null) до {{$card->an_initial_fee_max}} @endif @endif %</div>
            </div>
            @endif @endif
            @if(isset($card->percent_min)) @if($card->percent_min !== null)
            <div class="lvc fa-percent">
                Процентная ставка:
                <div class="value">от {{$card->percent_min}} @if(isset($card->percent_max)) @if($card->percent_max != null) до {{$card->percent_max}} @endif @endif % в год</div>
            </div>
            @endif @endif
            @if(isset($card->procuring)) @if(($card->procuring!==null))
            <div class="lvc fa-building-o">Обеспечение: <div class="value">{{$card->procuring}}</div></div>
            @endif @endif
        </div>
    </div><?php /* end  row */ ?>
</div>

<div class="rko-card-wrap rko-card-wrap-2"  data-tab="2">
    <div class="row">
        <div class="col-md-6">
            @if(isset($card->borrower)) @if(($card->borrower!==null))
            <div class="lvc fa-user-o">Заемщик: <div class="value">{{$card->borrower}}</div></div>
            @endif @endif
            @if(isset($card->experience)) @if(($card->experience!==null))
            <div class="lvc fa-tachometer">Стаж: <div class="value">{{$card->experience}}</div></div>
            @endif @endif
        </div>
        <div class="col-md-6">
            @if(isset($card->age_min)) @if($card->age_min !== null)
            <div class="lvc fa-users">
                Возраст:
                <div class="value">от {{$card->age_min}} @if(isset($card->age_max)) @if($card->age_max != null) до {{$card->age_max}} лет @endif  @else @if($card->age_min == 21) года @else лет @endif  @endif</div>
            </div>
            @endif @endif
            @if(isset($card->income_min)) @if($card->income_min !== null)
            <div class="lvc fa-suitcase">
                Примерный доход:
                <div class="value">от {{$card->income_min}} @if(isset($card->income_max)) @if($card->income_max != null) до {{$card->income_max}} @endif @endif ₽ </div>
            </div>
            @endif @endif
        </div>
    </div>
</div>


<div class="rko-card-wrap rko-card-wrap-3"  data-tab="3">
    @if(isset($card->docs)) @if(($card->docs!==null))
    <div class="lvc fa-id-card-o">Документы: <div class="value">{!! $card->docs !!}</div></div>
    @endif @endif
    @if(isset($card->review_speed)) @if(($card->review_speed!==null))
    <div class="lvc fa-bolt">Скорость рассмотрения заявки: <div class="value">{{$card->review_speed}}</div></div>
    @endif @endif
    @if(isset($card->validity_of_a_positive_decision)) @if(($card->validity_of_a_positive_decision!==null))
    <div class="lvc fa-clock-o">Срок действия положительного решения: <div class="value">{{$card->validity_of_a_positive_decision}}</div></div>
    @endif @endif
    @if(isset($card->additionally_field)) @if(($card->additionally_field!==null))
    <div class="lvc fa-newspaper-o">Дополнительно: <div class="value">{{$card->additionally_field}}</div></div>
    @endif @endif
</div>


<div class="rko-card-wrap rko-card-wrap-4" data-tab="4">
    @if(isset($card->repayment_methods)) @if(($card->repayment_methods!==null))
    <div class="lvc fa-share-square-o">
        Способ выплаты:
        <div class="value mob-block">
            <?php

                echo $card->repayment_methods;
            ?>
        </div>
    </div>
    @endif @endif
    <div class="row">
        <div class="col-md-6">
            @if(isset($card->payments)) @if(($card->payments!==null))
            <div class="lvc fa-calculator">Платежи: <div class="value">{{$card->payments}}</div></div>
            @endif @endif
        </div>
        <div class="col-md-6">
            @if(isset($card->early_repayment)) @if(($card->early_repayment!==null))
            <div class="lvc fa-history">Досрочное погашение: <div class="value">{{$card->early_repayment}}</div></div>
            @endif @endif
        </div>
    </div>
</div>
