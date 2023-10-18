<div>
    @if(isset($card->km5))
        <span class="card-mn-label card-mn-open-km-rating"><span class="card-mn-km-img"></span> К5М</span>
        <b>{{@str_replace('.0','',$card->km5)}}</b>
    @endif
</div>
<div>
    <span class="card-mn-label">Открытие</span>
    <b>{{number_format($card->opened, 0, '.', ' ')}} руб.</b>
</div>
<div>
    <span class="card-mn-label">Обслуживание</span>
    <b>{{number_format($card->maintenance, 0, '.', ' ')}} руб.</b>
</div>