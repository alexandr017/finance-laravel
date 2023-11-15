<div>
    @if(isset($card->km5))
        <span class="card-mn-label card-mn-open-km-rating"><span class="card-mn-km-img"></span> К5М</span>
        <b>{{@str_replace('.0','',$card->km5)}}</b>
    @endif
</div>
<div>
    <span class="card-mn-label">Максимальный лимит</span>
    <b>{{number_format($card->limit_max, 0, '.', ' ')}} ₽</b>
</div>
<div>
    <span class="card-mn-label">Ставка в год</span>
    <b>от {{$card->percent_min}} %</b>
</div>
