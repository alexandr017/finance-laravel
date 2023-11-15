@if($card->icon_after_name != null)
<div class="pay-icons zaym_cards">
    <?php
    $icons = $card->icon_after_name;
    $iconsArr = explode(',',$icons);
    foreach ($iconsArr as $key => $value) {
        echo "<span><i data-icon=\"$value\" class=\"zaym-pic pic$value\"></i></span>";
    }
    ?>
</div>
@endif
<div class="row">
                                    <div class="col-md-6">
                                        @if(isset($card->sum_min)) @if($card->sum_min !== null)
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-money"></i>Сумма:</div>
                                            <div class="value">от {{number_format($card->sum_min, 0, '.', ' ')}} @if(isset($card->sum_max)) @if($card->sum_max != null) до {{number_format($card->sum_max, 0, '.', ' ')}} ₽ @endif @endif</div>
                                        </div>
                                        @endif @endif
                                        @if(isset($card->term_min)) @if($card->term_min !== null)
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-calendar"></i>Срок:</div>
                                            <div class="value">от {{$card->term_min}} @if(isset($card->term_max)) @if($card->sum_max != null) до {{$card->term_max}} дней @endif @endif</div>
                                        </div>
                                        @endif @endif
                                        @if(isset($card->percent)) @if($card->percent !== null)
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-percent"></i>Ставка в день:</div>
                                            <div class="value">{{$card->percent}}%</div>
                                        </div>
                                        @endif @endif
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-money"></i>Переплата, от:</div>
                                            <div class="value">
                                                <?php
                                                    $m_min = (isset($card->sum_min)) ? $card->sum_min : 0;
                                                    $m_term_min = (isset($card->term_min)) ? $card->term_min : 0;
                                                    $m_percent = (isset($card->percent)) ? $card->percent : 0;
                                                    $res = $m_min * ($m_percent /100) * $m_term_min;
                                                    echo number_format($res, 0, '.', ' ') . ' ₽';
                                                ?>
                                            </div>
                                        </div>
                                        @if(isset($card->age_min)) @if($card->age_min !== null)
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-users"></i>Возраст:</div>
                                            <div class="value">от {{$card->age_min}} @if(isset($card->age_max)) @if($card->age_max != null) до {{$card->age_max}} лет @endif  @else @if($card->age_min == 21) года @else лет @endif  @endif</div>
                                        </div>
                                        @endif @endif
                                        @if(isset($card->pay_method)) @if($card->pay_method !== null)
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-plus-circle"></i>Способ выплаты:</div>
                                            <div class="value mob-block">
                                            <?php
                                                if(!$amp){
                                                $result_val = $card->pay_method;
                                            	include base_path().'/resources/views/frontend/cards/card/fields/sprite.php';
                                                } else {
                                                    echo $card->pay_method;
                                                } 
                                            ?>
                                            </div>
                                        </div>
                                        @endif @endif
                                        @if(isset($card->payment_method)) @if($card->payment_method !== null)
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-share-square-o"></i>Способ погашения:</div>
                                            <div class="value mob-block">
                                            <?php
                                                if(!$amp){
                                                $result_val = $card->payment_method;
                                                include base_path().'/resources/views/frontend/cards/card/fields/sprite.php';
                                                } else {
                                                    echo $card->payment_method;
                                                } 
                                            ?>
                                            </div>
                                        </div>
                                        @endif @endif
                                    </div>
                                    <div class="col-md-6">
                                        @if(isset($card->docs)) @if($card->docs !== null)
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-id-card-o"></i>Документы:</div>
                                            <div class="value">{{$card->docs}}</div>
                                        </div>
                                        @endif @endif
                                        @if(isset($card->review_speed)) @if($card->review_speed !== null)
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-bolt"></i>Скорость рассмотрения заявки:</div>
                                            <div class="value">{{$card->review_speed}}</div>
                                        </div>
                                        @endif @endif
                                        @if(isset($card->payout_speed)) @if($card->payout_speed !== null)
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-tachometer"></i>Скорость выплаты:</div>
                                            <div class="value">{{$card->payout_speed}}</div>
                                        </div>
                                        @endif @endif
                                        @if(isset($card->identification)) @if($card->identification !== null)
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-id-badge"></i>Идентификация:</div>
                                            <div class="value">{{$card->identification}}</div>
                                        </div>
                                        @endif @endif
                                        @if(isset($card->schedule)) @if($card->schedule !== null)
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-clock-o"></i>График работы:</div>
                                            <div class="value">{{$card->schedule}}</div>
                                        </div>
                                        @endif @endif
                                        @if(isset($card->poor_ch)) @if($card->poor_ch !== null)
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-user-secret"></i>Плохая КИ:</div>
                                            <div class="value">@if($card->poor_ch==1) Да @else Нет @endif</div>
                                        </div>
                                        @endif @endif
                                        @if(isset($card->extension)) @if($card->extension !== null)
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-hourglass-half"></i>Продление:</div>
                                            <div class="value">{{$card->extension}}</div>
                                        </div>
                                        @endif @endif
                                        @if(isset($card->investors)) @if($card->investors !== null)
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-briefcase"></i>Инвесторам:</div>
                                            <div class="value">{{$card->investors}}</div>
                                        </div>
                                        @endif @endif
                                        @if(isset($card->year)) @if($card->year !== null)
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-calendar-o"></i>Начало работы:</div>
                                            <div class="value">{{$card->year}}</div>
                                        </div>
                                        @endif @endif
                                    </div>
                                </div><?php /* end  row*/ ?>
