<div>
    @if(isset($card->km5))
        <span class="card-mn-label card-mn-open-km-rating"><span class="card-mn-km-img"></span> К5М</span>
        <b>{{@str_replace('.0','',$card->km5)}}</b>
    @endif
</div>
<div>
    <span class="card-mn-label">Сумма</span>
    <b>@if($card->sum_max != null)до {{number_format($card->sum_max, 0, '.', ' ')}}  @else от {{number_format($card->sum_min, 0, '.', ' ')}} @endif руб.</b>
</div>
<div>
    <span class="card-mn-label">Ставка</span>
    <b>от {{$card->percent_min}}%</b>
</div>
<div>
    <span class="card-mn-label">Срок</span>
    <b>@if($card->term_max != null)до {{$card->term_max}} дней @else от {{$card->term_min}} @endif</b>
</div>