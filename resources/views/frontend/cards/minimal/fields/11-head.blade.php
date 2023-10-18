<div>
    <span class="card-mn-label">Минимальная сумма</span>
    <b>От {{number_format($card->sum_min, 0, '.', ' ')}}</b>
</div>
<div>
    <span class="card-mn-label">Макс. процентная ставка</span>
    <b>от {{$card->percent_max}} % в год</b>
</div>
<div>
    <span class="card-mn-label">Минимальный срок</span>
    <b>от {{$card->term_min}} дней</b>
</div>