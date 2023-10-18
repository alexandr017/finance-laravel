@if($card->icon_after_name != null)
<div class="pay-icons credit_cards">
    <?php
    $icons = $card->icon_after_name;
    $iconsArr = explode(',',$icons);
    foreach ($iconsArr as $key => $value) {
        echo "<span><i data-icon=\"$value\" class=\"credit-pic pic$value\"></i></span>";
    }
    ?>
</div>
@endif
<div class="row">
                                    <div class="col-md-6">
                                        @if(isset($card->sum_min)) @if($card->sum_min !== null)
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-rub"></i>Сумма:</div>
                                            <div class="value">от {{number_format($card->sum_min, 0, '.', ' ')}} @if(isset($card->sum_max)) @if($card->sum_max != null) до {{number_format($card->sum_max, 0, '.', ' ')}} руб. @endif @endif</div>
                                        </div>
                                        @endif @endif
                                        @if(isset($card->term_min)) @if($card->term_min !== null)
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-calendar"></i>Срок:</div>
                                            <div class="value">от {{$card->term_min}} @if(isset($card->term_max)) @if($card->sum_max != null) до {{$card->term_max}} месяцев @endif @endif</div>
                                        </div>
                                        @endif @endif
                                        @if(isset($card->percent_min)) @if($card->percent_min !== null)
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-percent"></i>Процентная ставка:</div>
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
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-users"></i>Возраст:</div>
                                            <div class="value">от {{$card->age_min}} @if(isset($card->age_max)) @if($card->age_max != null) до {{$card->age_max}} лет @endif  @else @if($card->age_min == 21) года @else лет @endif  @endif</div>
                                        </div>
                                        @endif @endif
                                        @if(isset($card->licency)) @if($card->licency !== null)
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-file-pdf-o"></i>Лицензия:</div>
                                            <div class="value">{{$card->licency}}</div>
                                        </div>
                                        @endif @endif
                                    </div>
                                    <div class="col-md-6">
                                        @if(isset($card->docs)) @if($card->docs !== null)
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-address-card"></i>Документы:</div>
                                            <div class="value">{{$card->docs}}</div>
                                        </div>
                                        @endif @endif
                                        @if(isset($card->speed_see)) @if($card->speed_see !== null)
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-bolt"></i>Скорость рассмотрения заявки:</div>
                                            <div class="value">{{$card->speed_see}}</div>
                                        </div>
                                        @endif @endif
                                        @if(isset($card->register)) @if($card->register !== null)
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-building"></i>Регистрация:</div>
                                            <div class="value">{{$card->register}}</div>
                                        </div>
                                        @endif @endif
                                        @if(isset($card->experience)) @if($card->experience !== null)
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-tachometer"></i>Стаж:</div>
                                            <div class="value">{{$card->experience}}</div>
                                        </div>
                                        @endif @endif
                                        @if(isset($card->additional_field)) @if($card->additional_field !== null)
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-newspaper-o"></i>Дополнительно:</div>
                                            <div class="value">{{$card->additional_field}}</div>
                                        </div>
                                        @endif @endif
                                    </div>
                                </div><?php /* end  row*/ ?>
