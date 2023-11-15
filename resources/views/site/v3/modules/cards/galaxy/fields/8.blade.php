<?php /*
@if($card->icon_after_name != null)
    <div class="pay-icons auto-credit">
        <?php
        $icons = $card->icon_after_name;
        $iconsArr = explode(',',$icons);
        foreach ($iconsArr as $key => $value) {
            echo "<span data-icon=\"$value\" class=\"auto-credit-pic pic$value\"></span>";
        }
        ?>
    </div>
@endif

*/ ?>

<div class="row">
    <div class="col-md-6">
        @if(isset($card->sum_min)) @if($card->sum_min !== null)
            <div class="lvc fa-rub">Сумма:
                <div class="value">от {{number_format($card->sum_min, 0, '.', ' ')}} @if(isset($card->sum_max)) @if($card->sum_max != null) до {{number_format($card->sum_max, 0, '.', ' ')}} ₽ @endif @endif</div>
            </div>
        @endif @endif
        @if(isset($card->term_min)) @if($card->term_min !== null)
            <div class="lvc fa-calendar">Срок:
                <div class="value">от {{$card->term_min}} @if(isset($card->term_max)) @if($card->sum_max != null) до {{$card->term_max}} месяцев @endif @endif</div>
            </div>
        @endif @endif
        @if(isset($card->percent_min)) @if($card->percent_min !== null)
            <div class="lvc fa-percent">Процентная ставка:
                <div class="value">
                    @if(isset($card->percent_max))
                        @if($card->percent_max != 0)
                            от {{$card->percent_min}} до {{$card->percent_max}}%
                        @else
                            от {{$card->percent_min}}%
                        @endif
                    @else
                        от {{$card->percent_min}}%
                    @endif
                </div>
            </div>
        @endif @endif
        @if(isset($card->age_min)) @if($card->age_min !== null)
            <div class="lvc fa-users">Возраст:
                <div class="value">от {{$card->age_min}} @if(isset($card->age_max)) @if($card->age_max != null) до {{$card->age_max}} лет @endif  @else @if($card->age_min == 21) года @else лет @endif  @endif</div>
            </div>
        @endif @endif
        @if(isset($card->licency)) @if($card->licency !== null)
            <div class="lvc fa-file-pdf-o">Лицензия: <div class="value">{{$card->licency}}</div></div>
        @endif @endif
        @if(isset($card->security)) @if($card->security !== null)
            <div class="lvc fa-handshake-o">Обеспечение: <div class="value">{{$card->security}}</div></div>
        @endif @endif
    </div>
    <div class="col-md-6">
        @if(isset($card->an_initial_fee)) @if($card->an_initial_fee !== null)
            <div class="lvc fa-money">Первоначальный взнос: <div class="value">{{$card->an_initial_fee}}</div></div>
        @endif @endif
        @if(isset($card->docs)) @if($card->docs !== null)
            <div class="lvc fa-address-card">Документы: <div class="value">{{$card->docs}}</div></div>
        @endif @endif
        @if(isset($card->speed_see)) @if($card->speed_see !== null)
            <div class="lvc fa-bolt">Скорость рассмотрения заявки: <div class="value">{{$card->speed_see}}</div></div>
        @endif @endif
        @if(isset($card->register)) @if($card->register !== null)
            <div class="lvc fa-building">Регистрация: <div class="value">{{$card->register}}</div></div>
        @endif @endif
        @if(isset($card->experience)) @if($card->experience !== null)
            <div class="lvc fa-tachometer">Стаж: <div class="value">{{$card->experience}}</div></div>
        @endif @endif
        @if(isset($card->additional_field)) @if($card->additional_field !== null)
            <div class="lvc fa-newspaper-o">Дополнительно: <div class="value">{{$card->additional_field}}</div></div>
        @endif @endif
    </div>
</div><?php /* end  row*/ ?>
