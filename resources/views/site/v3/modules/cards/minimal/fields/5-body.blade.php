<ul class="nav">
    <li class="active" data-tab="card-mn-conditions">Условия и ставки</li>
    <li data-tab="card-mn-docs">Требования и документы</li>
</ul>
<div class="card-mn-tab-content">
    <div class="active card-mn-conditions">
        @if(isset($card->limit_max) && $card->limit_max !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Максимальный лимит</span>
                <b class="card-mn-row-value">{{number_format($card->limit_max, 0, '.', ' ')}} ₽</b>
            </div>
        @endif
        @if(isset($card->percent_min) && $card->percent_min !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Процентная ставка в год</span>
                <b class="card-mn-row-value"> от {{$card->percent_min}} @if(isset($card->percent_max) && $card->percent_max != null)
                        до {{$card->percent_max}} @endif %</b>
            </div>
        @endif
        @if(isset($card->none_percent_period) && $card->none_percent_period !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Беспроцентный период</span>
                <b class="card-mn-row-value">{{$card->none_percent_period}} дн.</b>
            </div>
        @endif
        @if(isset($card->opened) && $card->opened !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Открытие</span>
                <b class="card-mn-row-value">{{$card->opened}} ₽</b>
            </div>
        @endif
        @if(isset($card->maintenance) && $card->maintenance !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Обслуживание</span>
                <b class="card-mn-row-value">{{$card->maintenance}} ₽</b>
            </div>
        @endif
        @if(isset($card->other_maintenance)  &&  $card->other_maintenance !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Доп.условия обслуживания</span>
                <b class="card-mn-row-value">{{$card->other_maintenance}}</b>
            </div>
        @endif
        @if(isset($card->cache_back) && $card->cache_back !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Кэшбэк</span>
                <b class="card-mn-row-value">{{$card->cache_back}}</b>
            </div>
        @endif
    </div>
    <div class="card-mn-tab-pane card-mn-docs">
        @if(isset($card->age_min) && $card->age_min !== null)
            <div class="card-mn-gray-row card-mn-row">
                <span class="card-mn-details">Возраст</span>
                <b class="card-mn-row-value">от {{$card->age_min}} @if(isset($card->age_max)) @if($card->age_max != null)
                        до {{$card->age_max}} лет @endif  @else @if($card->age_min == 21) года @else
                        лет @endif  @endif</b>
            </div>
        @endif
        @if(isset($card->speed_see)  &&  $card->speed_see !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Скорость рассмотрения заявки</span>
                <b class="card-mn-row-value">{{$card->speed_see}}</b>
            </div>
        @endif
        @if(isset($card->age_work) && $card->age_work !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Срок выпуска</span>
                <b class="card-mn-row-value">{{$card->age_work}}</b>
            </div>
        @endif
        @if(isset($card->licency) && $card->licency !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Лицензия</span>
                <b class="card-mn-row-value">{{$card->licency}}</b>
            </div>
        @endif
        @if(isset($card->docs) && $card->docs !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Документы</span>
                <b class="card-mn-row-value">{{$card->docs}}</b>
            </div>
        @endif
        @if(isset($card->register) && $card->register !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Регистрация</span>
                <b class="card-mn-row-value">{{$card->register}}</b>
            </div>
        @endif
        @if(isset($card->experience) && $card->experience !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Стаж</span>
                <b class="card-mn-row-value">{{$card->experience}}</b>
            </div>
        @endif
        @if(isset($card->additional_field) && $card->additional_field !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Дополнительно</span>
                <b class="card-mn-row-value">{{$card->additional_field}}</b>
            </div>
        @endif
    </div>
</div>
