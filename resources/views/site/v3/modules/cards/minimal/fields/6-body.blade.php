<ul class="nav">
    <li class="active" data-tab="card-mn-conditions">Условия и ставки</li>
    <li data-tab="card-mn-docs">Требования и документы</li>
</ul>
<div class="card-mn-tab-content">
    <div class="active card-mn-conditions">
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
        @if(isset($card->other_maintenance) && $card->other_maintenance !== null)
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
        @if(isset($card->percent_on_balance) && $card->percent_on_balance !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">% на остаток</span>
                <b class="card-mn-row-value">{{$card->percent_on_balance}}</b>
            </div>
        @endif
    </div>
    <div class="card-mn-tab-pane card-mn-docs">
        @if(isset($card->age_min) && $card->age_min !== null)
            <div class="card-mn-gray-row card-mn-row">
                <span class="card-mn-details">Возраст</span>
                <b class="card-mn-row-value">от {{$card->age_min}} @if(isset($card->age_max) && $card->age_max != null)
                        до {{$card->age_max}} лет  @else @if($card->age_min == 21) года @else
                        лет @endif  @endif</b>
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
        @if(isset($card->additional_field) && $card->additional_field !== null)
            <div class="card-mn-row">
                <span class="card-mn-details">Дополнительно</span>
                <b class="card-mn-row-value">{{$card->additional_field}}</b>
            </div>
        @endif 
    </div>
</div>