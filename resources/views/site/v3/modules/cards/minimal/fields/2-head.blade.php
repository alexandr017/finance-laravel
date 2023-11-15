<div>
    @if(isset($card->km5))
        <span class="card-mn-label card-mn-open-km-rating"><span class="card-mn-km-img"></span> К5М</span>
        <b>{{@str_replace('.0','',$card->km5)}}</b>
    @endif
</div>
<div>
    <span class="card-mn-label">Открытие</span>
    <b>@if($card->opened != null){{$card->opened}} ₽ @endif</b>
</div>
<div>
    <span class="card-mn-label">Обслуживание</span>
    <b>@if($card->maintenance != null) {{$card->maintenance}} ₽ @endif</b>
</div>
<div>
    <span class="card-mn-label">Скорость открытия</span>
    <b>@if($card->speed_opened != null){{$card->speed_opened}}@endif</b>
</div>
