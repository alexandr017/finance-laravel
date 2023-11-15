<div class="row">
                                    <div class="col-md-6">
	                                    @if(isset($card->zalog_type)) @if($card->zalog_type !== null)
	                                    <div class="lvc">
	                                        <div class="label"><i class="fa fa-building-o"></i>Виды залога:</div>
	                                        <div class="value">{{$card->zalog_type}}</div>
	                                    </div>
	                                    @endif @endif
                                        @if(isset($card->sum_min)) @if($card->sum_min !== null)
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-money"></i>Сумма:</div>
                                            <div class="value">от {{number_format($card->sum_min, 0, '.', ' ')}} @if(isset($card->sum_max)) @if($card->sum_max != null) до {{number_format($card->sum_max, 0, '.', ' ')}} ₽ @endif @endif</div>
                                        </div>
                                        @endif  @endif
                                        @if(isset($card->term_min)) @if($card->term_min !== null)
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-calendar"></i>Срок:</div>
                                            <div class="value">от {{$card->term_min}} @if(isset($card->term_max)) @if($card->sum_max != null) до {{$card->term_max}} дней @endif @endif</div>
                                        </div>
                                        @endif @endif
                                        @if(isset($card->percent_min)) @if($card->percent_min !== null)
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-percent"></i>Процентная ставка в месяц:</div>
                                            <div class="value">от {{$card->percent_min}}@if(isset($card->percent_max)) @if($card->sum_max != null) до {{$card->percent_max}} @endif @endif%</div>
                                        </div>
                                        @endif @endif
                                    </div>
                                    <div class="col-md-6">
                                        @if(isset($card->year)) @if($card->year !== null)
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-calendar-o"></i>Начало работы:</div>
                                            <div class="value">{{$card->year}}</div>
                                        </div>
                                        @endif @endif 
                                        @if(isset($card->licency)) @if($card->licency !== null)
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-refresh"></i>Лицензия:</div>
                                            <div class="value">{{$card->licency}}</div>
                                        </div>
                                        @endif @endif
                                        @if(isset($card->docs)) @if($card->docs !== null)
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-address-card "></i>Документы:</div>
                                            <div class="value">{{$card->docs}}</div>
                                        </div>
                                        @endif @endif
                                        @if(isset($card->work_time)) @if($card->work_time !== null)
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-clock-o"></i>График работы:</div>
                                            <div class="value">{{$card->work_time}}</div>
                                        </div>
                                        @endif @endif
                                        @if(isset($card->repayment)) @if($card->repayment !== null)
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-briefcase"></i>Выкуп:</div>
                                            <div class="value">{{$card->repayment}}</div>
                                        </div>
                                        @endif @endif                                        
                                        @if(isset($card->investors)) @if($card->investors !== null)
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-sign-language"></i>Инвесторам:</div>
                                            <div class="value">{{$card->investors}}</div>
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

