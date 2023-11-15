<div class="row">
<div class="col-md-6">
    @if(isset($card->sum_min)) @if($card->sum_min !== null)
        <div class="lvc fa-rub">Сумма:
            <div class="value">от {{number_format($card->sum_min, 0, '.', ' ')}} @if(isset($card->sum_max)) @if($card->sum_max != null) до {{number_format($card->sum_max, 0, '.', ' ')}}  @endif @endif ₽</div>
        </div>
    @endif @endif
    @if(isset($card->term_min)) @if($card->term_min !== null)
        <div class="lvc fa-calendar">Срок:
            <div class="value">от {{$card->term_min}} @if(isset($card->term_max)) @if($card->term_max != null) до {{$card->term_max}} дней @endif @endif</div>
        </div>
    @endif @endif
    @if(isset($card->percent_min)) @if($card->percent_min !== null)
        <div class="lvc fa-percent">Процентная ставка:
            <div class="value">
                @if(isset($card->percent_max))
                    @if($card->percent_max != 0)
                        от {{$card->percent_min}} до {{$card->percent_max}}%
                    @else
                        от {{$card->percent_min}}%
                    @endif
                @else
                    от {{$card->percent_min}}%
                @endif
            </div>
        </div>
    @endif @endif
    @if(isset($card->currency)) @if($card->currency !== null)
        <div class="lvc fa-id-card-o">Валюта: <div class="value">{{$card->currency}}</div></div>
    @endif @endif
</div>
<div class="col-md-6">
    @if(isset($card->replanishment) && ($card->replanishment !== null))
        <div class="lvc fa-id-card-o">Пополнение: <div class="value">{{$card->replanishment}}</div></div>
    @endif
    @if(isset($card->auto_prolongation) && ($card->auto_prolongation !== null))
        <div class="lvc fa-id-card-o">Автопролонгация: <div class="value">{{$card->auto_prolongation}}</div></div>
    @endif
    @if(isset($card->partial_withdrawal) && ($card->partial_withdrawal !== null))
        <div class="lvc fa-id-card-o">Частичное снятие: <div class="value">{{$card->partial_withdrawal}}</div></div>
    @endif
    @if(isset($card->early_termination) && ($card->early_termination !== null))
        <div class="lvc fa-id-card-o">Досрочное расторжение: <div class="value">{{$card->early_termination}}</div></div>
    @endif
    @if(isset($card->investment_feature) && ($card->investment_feature !== null))
        <div class="lvc fa-id-card-o">Особенность вклада: <div class="value">{{$card->investment_feature}}</div></div>
    @endif
    @if(isset($card->percents_payment) && ($card->percents_payment !== null))
        <div class="lvc fa-id-card-o">Выплата процентов: <div class="value">{{$card->percents_payment}}</div></div>
    @endif
    @if(isset($card->capitalization) && ($card->capitalization !== null))
        <div class="lvc fa-id-card-o">Капитализация: <div class="value">{{$card->capitalization}}</div></div>
    @endif
    @if(isset($card->open_online) && ($card->open_online !== null))
        <div class="lvc fa-id-card-o">Открытие вклада Online: <div class="value">@if($card->open_online) Есть @else Нет @endif</div></div>
    @endif
    @if(isset($card->special_conditions) && ($card->special_conditions !== null))
        <div class="lvc fa-id-card-o">Особые условия: <div class="value">{{$card->special_conditions}}</div></div>
    @endif
    @if(isset($card->stock) && ($card->stock !== null))
        <div class="lvc fa-id-card-o">Акции: <div class="value">{{$card->stock}}</div></div>
    @endif
</div>
</div>