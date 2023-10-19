        @if(isset($card->zalog_type)) @if($card->zalog_type !== null)
        <p class="border-left border-right bg-grey"><b class="label">Виды залога:</b>{{$card->zalog_type}}</p>
        @endif @endif
        @if(isset($card->sum_min)) @if($card->sum_min !== null)
        <p class="border-left border-right bg-grey"><b class="label">Сумма:</b> от {{number_format($card->sum_min, 0, '.', ' ')}} @if(isset($card->sum_max)) @if($card->sum_max != null) до {{number_format($card->sum_max, 0, '.', ' ')}} руб @endif @endif</p>
        @endif  @endif
        @if(isset($card->term_min)) @if($card->term_min !== null)
        <p class="border-left border-right bg-grey"><b class="label">Срок:</b> от {{$card->term_min}} @if(isset($card->term_max)) @if($card->sum_max != null) до {{$card->term_max}} дней @endif @endif</p>
        @endif @endif
        @if(isset($card->percent_min)) @if($card->percent_min !== null)
        <p class="border-left border-right bg-grey"><b class="label">Процентная ставка в месяц:</b> от {{$card->percent_min}}@if(isset($card->percent_max)) @if($card->sum_max != null) до {{$card->percent_max}} @endif @endif%</p>
        @endif @endif
        @if(isset($card->year)) @if($card->year !== null)
        <p class="border-left border-right bg-grey"><b class="label">Год:</b> {{$card->year}}</p>
        @endif @endif
        @if(isset($card->licency)) @if($card->licency !== null)
        <p class="border-left border-right bg-grey"><b class="label">Лицензия:</b> {{$card->licency}}</p>
        @endif @endif
        @if(isset($card->docs)) @if($card->docs !== null)
        <p class="border-left border-right bg-grey"><b class="label">Документы:</b> {{$card->docs}}</p>
        @endif @endif
        @if(isset($card->work_time)) @if($card->work_time !== null)
        <p class="border-left border-right bg-grey"><b class="label">График работы:</b> {{$card->work_time}}</p>
        @endif @endif
        @if(isset($card->repayment)) @if($card->repayment !== null)
        <p class="border-left border-right bg-grey"><b class="label">Выкуп:</b> {{$card->repayment}}</p>
        @endif @endif
        @if(isset($card->investors)) @if($card->investors !== null)
        <p class="border-left border-right bg-grey"><b class="label">Инвесторам:</b> {{$card->investors}}</p>
        @endif @endif
        @if(isset($card->additional_field)) @if($card->additional_field !== null)
        <p class="border-left border-right bg-grey"><b class="label">Дополнительно:</b> {{$card->additional_field}}</p>
        @endif @endif