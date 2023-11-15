<div class="row">
                                    <div class="col-md-6">
	                                    @if(isset($card->zalog_type)) @if($card->zalog_type !== null)
	                                    <div class="lvc fa-building-o">Виды залога: <div class="value">{{$card->zalog_type}}</div></div>
	                                    @endif @endif
                                        @if(isset($card->sum_min)) @if($card->sum_min !== null)
                                        <div class="lvc fa-money">Сумма: <div class="value">от {{number_format($card->sum_min, 0, '.', ' ')}} @if(isset($card->sum_max)) @if($card->sum_max != null) до {{number_format($card->sum_max, 0, '.', ' ')}} ₽ @endif @endif</div></div>
                                        @endif  @endif
                                        @if(isset($card->term_min)) @if($card->term_min !== null)
                                        <div class="lvc fa-calendar">Срок: <div class="value">от {{$card->term_min}} @if(isset($card->term_max)) @if($card->sum_max != null) до {{$card->term_max}} дней @endif @endif</div></div>
                                        @endif @endif
                                        @if(isset($card->percent_min)) @if($card->percent_min !== null)
                                        <div class="lvc fa-percent">Процентная ставка в месяц: <div class="value">от {{$card->percent_min}}@if(isset($card->percent_max)) @if($card->sum_max != null) до {{$card->percent_max}} @endif @endif%</div></div>
                                        @endif @endif
                                    </div>
                                    <div class="col-md-6">
                                        @if(isset($card->year)) @if($card->year !== null)
                                        <div class="lvc fa-calendar-o">Начало работы: <div class="value">{{$card->year}}</div></div>
                                        @endif @endif 
                                        @if(isset($card->licency)) @if($card->licency !== null)
                                        <div class="lvc fa-refresh">Лицензия: <div class="value">{{$card->licency}}</div></div>
                                        @endif @endif
                                        @if(isset($card->docs)) @if($card->docs !== null)
                                        <div class="lvc fa-address-card">Документы: <div class="value">{{$card->docs}}</div></div>
                                        @endif @endif
                                        @if(isset($card->work_time)) @if($card->work_time !== null)
                                        <div class="lvc fa-clock-o">График работы: <div class="value">{{$card->work_time}}</div></div>
                                        @endif @endif
                                        @if(isset($card->repayment)) @if($card->repayment !== null)
                                        <div class="lvc fa-briefcase">Выкуп: <div class="value">{{$card->repayment}}</div></div>
                                        @endif @endif                                        
                                        @if(isset($card->investors)) @if($card->investors !== null)
                                        <div class="lvc fa-sign-language">Инвесторам: <div class="value">{{$card->investors}}</div></div>
                                        @endif @endif
                                        @if(isset($card->additional_field)) @if($card->additional_field !== null)
                                        <div class="lvc fa-newspaper-o">Дополнительно: <div class="value">{{$card->additional_field}}</div></div>
                                        @endif @endif                                                                              
                                    </div>
                                </div><?php /* end  row*/ ?>

