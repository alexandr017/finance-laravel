<div>
    @if(isset($card->km5))
        <span class="card-mn-label card-mn-open-km-rating"><span class="card-mn-km-img"></span> К5М</span>
        <b>{{@str_replace('.0','',$card->km5)}}</b>
    @endif
</div>
<div>
    <span class="card-mn-label">Сумма</span>
    <b>до {{number_format($card->sum_max, 0, '.', ' ')}} руб.</b>
</div>
<div>
    <span class="card-mn-label">Ставка</span>
    <b>{{$card->percent}}%</b>
</div>
<div>
    <span class="card-mn-label">Срок</span>
    <b>до {{$card->term_max}} дн.</b>
</div>