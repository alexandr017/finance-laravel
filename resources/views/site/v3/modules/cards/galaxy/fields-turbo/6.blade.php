@if(isset($card->opened)) @if($card->opened !== null)
<p class="border-left border-right bg-grey"><b class="label">Открытие:</b> {{number_format($card->opened, 0, '.', ' ')}} ₽</p>
@endif @endif
@if(isset($card->maintenance)) @if($card->maintenance !== null)
<p class="border-left border-right bg-grey"><b class="label">Обслуживание:</b> {{number_format($card->maintenance, 0, '.', ' ')}} ₽</p>
@endif @endif
@if(isset($card->age_min)) @if($card->age_min !== null)
<p class="border-left border-right bg-grey"><b class="label">Возраст:</b> от {{$card->age_min}} @if(isset($card->age_max)) @if($card->age_max != null) до {{$card->age_max}} лет @endif @endif</p>
@endif @endif
@if(isset($card->licency)) @if($card->licency !== null)
<p class="border-left border-right bg-grey"><b class="label">Лицензия:</b> {{$card->licency}}</p>
@endif @endif
@if(isset($card->docs)) @if($card->docs !== null)
<p class="border-left border-right bg-grey"><b class="label">Документы:</b> {{$card->docs}}</p>
@endif @endif
@if(isset($card->register)) @if($card->register !== null)
<p class="border-left border-right bg-grey"><b class="label">Регистрация:</b> {{$card->register}}</p>
@endif @endif
@if(isset($card->cache_back)) @if($card->cache_back !== null)
<p class="border-left border-right bg-grey"><b class="label">Кэшбэк:</b> {{$card->cache_back}}</p>
@endif @endif
@if(isset($card->age_work)) @if($card->age_work !== null)
<p class="border-left border-right bg-grey"><b class="label">Срок выпуска:</b> {{$card->age_work}}</p>
@endif @endif
@if(isset($card->additional_field)) @if($card->additional_field !== null)
<p class="border-left border-right bg-grey"><b class="label">Дополнительно:</b> {{$card->additional_field}}</p>
@endif @endif
@if(isset($card->percent_on_balance)) @if($card->percent_on_balance !== null)
<p class="border-left border-right bg-grey"><b class="label">% на остаток:</b> {{$card->percent_on_balance}}</p>
@endif @endif
