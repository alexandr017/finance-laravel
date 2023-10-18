        @if(isset($card->sum_min)) @if($card->sum_min !== null)
            <p class="border-left border-right bg-grey"><b class="label">Сумма:</b> от {{number_format($card->sum_min, 0, '.', ' ')}} @if(isset($card->sum_max)) @if($card->sum_max != null) до {{number_format($card->sum_max, 0, '.', ' ')}} руб. @endif @endif</p>
        @endif @endif
        @if(isset($card->term_min)) @if($card->term_min !== null)
            <p class="border-left border-right bg-grey"><b class="label">Срок:</b> от {{$card->term_min}} @if(isset($card->term_max)) @if($card->sum_max != null) до {{$card->term_max}} месяцев @endif @endif</p>
        @endif @endif
        @if(isset($card->percent_min)) @if($card->percent_min !== null)
            <p class="border-left border-right bg-grey">
                <b class="label">Процентная ставка:</b>
                    @if(isset($card->percent_max))
                        @if($card->percent_max != null)
                            от {{$card->percent_min}} до {{$card->percent_max}}%
                        @else
                            {{$card->percent_max}}%
                        @endif
                    @endif
            </p>
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
        @if(isset($card->speed_see)) @if($card->speed_see !== null)
            <p class="border-left border-right bg-grey"><b class="label">Скорость рассмотрения заявки:</b> {{$card->speed_see}}</p>
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
