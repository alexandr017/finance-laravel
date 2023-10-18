@if(isset($card->sum_min)) @if($card->sum_min !== null)
<p class="border-left border-right bg-grey">
    <b class="label">Сумма:</b> от {{number_format($card->sum_min, 0, '.', ' ')}} @if(isset($card->sum_max)) @if($card->sum_max != null) до {{number_format($card->sum_max, 0, '.', ' ')}} руб @endif @endif
</p>
@endif @endif
@if(isset($card->term_min)) @if($card->term_min !== null)
<p class="border-left border-right bg-grey">
    <b class="label">Срок:</b> от {{$card->term_min}} @if(isset($card->term_max)) @if($card->sum_max != null) до {{$card->term_max}} дней @endif @endif
</p>
@endif @endif
@if(isset($card->percent)) @if($card->percent !== null)
<p class="border-left border-right bg-grey">
    <b class="label">Ставка в день:</b> {{$card->percent}}%
</p>
@endif @endif
@if(isset($card->age_min)) @if($card->age_min !== null)
<p class="border-left border-right bg-grey">
    <b class="label">Возраст:</b> от {{$card->age_min}} @if(isset($card->age_max)) @if($card->age_max != null) до {{$card->age_max}} лет @endif @endif
</p>
@endif @endif
@if(isset($card->docs)) @if($card->docs !== null)
<p class="border-left border-right bg-grey">
    <b class="label">Документы:</b> {{$card->docs}}
</p>
@endif @endif
@if(isset($card->pay_method)) @if($card->pay_method !== null)
<p class="border-left border-right bg-grey">
    <b class="label">Способ выплаты:</b> {{$card->pay_method}}
</p>
@endif @endif