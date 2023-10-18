
        @if(isset($card->limit_max)) @if($card->limit_max !== null)
        <p class="border-left border-right bg-grey"><b class="label">Максимальный лимит:</b> {{number_format($card->limit_max, 0, '.', ' ')}} руб</p>
        @endif @endif
        @if(isset($card->percent_min)) @if($card->percent_min !== null)
        <p class="border-left border-right bg-grey">
                <b class="label">Процентная ставка в год:</b>
                @if(isset($card->percent_max))
                @if($card->percent_max !== null)
                от {{$card->percent_min}} до {{$card->percent_max}}%
                @else
                {{$card->percent_min}}%
                @endif
                @else
                {{$card->percent_min}}%
                @endif
        </p>
        @endif @endif
        @if(isset($card->none_percent_period)) @if($card->none_percent_period !== null)
                <p class="border-left border-right bg-grey"><b class="label">Беспроцентный период:</b> {{$card->none_percent_period}} {{App\Models\System::endWords($card->none_percent_period,['день','дня','дней'])}}</p>
        @endif @endif
        @if(isset($card->opened)) @if($card->opened !== null)
                <p class="border-left border-right bg-grey"><b class="label">Открытие:</b> {{$card->opened}} руб</p>
        @endif @endif
        @if(isset($card->maintenance)) @if($card->maintenance !== null)
                <p class="border-left border-right bg-grey"><b class="label">Обслуживание:</b> {{$card->maintenance}} руб</p>
        @endif @endif
        @if(isset($card->age_min)) @if($card->age_min !== null)
                <p class="border-left border-right bg-grey"><b class="label">Возраст:</b> от {{$card->age_min}} @if(isset($card->age_max)) @if($card->age_max != null) до {{$card->age_max}} лет @endif @endif</p>
        @endif @endif
        @if(isset($card->speed_see)) @if($card->speed_see !== null)
                <p class="border-left border-right bg-grey"><b class="label">Скорость рассмотрения заявки:</b> {{$card->speed_see}}</p>
        @endif @endif
        @if(isset($card->age_work)) @if($card->age_work !== null)
                <p class="border-left border-right bg-grey"><b class="label">Срок выпуска:</b> {{$card->age_work}}</p>
        @endif @endif
        @if(isset($card->licency)) @if($card->licency !== null)
                <p class="border-left border-right bg-grey"><b class="label">Лицензия:</b>{{$card->licency}}</p>
        @endif @endif
        @if(isset($card->docs)) @if($card->docs !== null)
                <p class="border-left border-right bg-grey"><b class="label">Документы:</b> {{$card->docs}}</p>
        @endif @endif
        @if(isset($card->register)) @if($card->register !== null)
                <p class="border-left border-right bg-grey"><b class="label">Регистрация:</b> {{$card->register}}</p>
        @endif @endif
        @if(isset($card->experience)) @if($card->experience !== null)
                <p class="border-left border-right bg-grey"><b class="label">Стаж:</b> {{$card->experience}}</p>
        @endif @endif
        @if(isset($card->additional_field)) @if($card->additional_field !== null)
                <p class="border-left border-right bg-grey"><b class="label">Дополнительно:</b> {{$card->additional_field}}</p>
        @endif @endif
        @if(isset($card->cache_back)) @if($card->cache_back !== null)
                <p class="border-left border-right bg-grey"><b class="label">Кэшбэк:</b> {{$card->cache_back}}</p>
        @endif @endif
