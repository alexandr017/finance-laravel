<div class="pay-icons c_d_cards">
<?php
$icons = $card->icon_after_name;
$iconsArr = explode(',',$icons);
foreach ($iconsArr as $key => $value) {
    echo "<span><i data-icon=\"$value\" class=\"pay-icon$value\"></i></span>";
}
?>
</div>
<div class="row"> 
                                    <div class="col-md-6">
	                                    @if(isset($card->limit_max)) @if($card->limit_max !== null)
	                                    <div class="lvc">
	                                        <div class="label"><i class="fa fa-line-chart"></i>Максимальный лимит:</div>
	                                        <div class="value">{{number_format($card->limit_max, 0, '.', ' ')}} руб.</div>
	                                    </div>
	                                    @endif @endif
										@if(isset($card->percent_min)) @if($card->percent_min !== null)
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-percent"></i>Процентная ставка в год:</div>
                                            <div class="value">
                                                @if(isset($card->percent_max))
                                                    @if($card->percent_max !== null)
                                                        от {{$card->percent_min}} до {{$card->percent_max}}%
                                                    @else
                                                        {{$card->percent_min}}%
                                                    @endif
                                                @else
                                                    {{$card->percent_min}}%
                                                @endif
                                            </div>
                                        </div>
                                        @endif @endif
	                                    @if(isset($card->none_percent_period)) @if($card->none_percent_period !== null)
	                                    <div class="lvc">
	                                        <div class="label"><i class="fa fa-calendar"></i>Беспроцентный период:</div>
	                                        <div class="value">{{$card->none_percent_period}} {{System::endWords($card->none_percent_period,['день','дня','дней'])}}</div>
	                                    </div>
	                                    @endif @endif
                                       	@if(isset($card->opened)) @if($card->opened !== null)
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-clock-o"></i>Открытие:</div>
                                            <div class="value">{{$card->opened}} руб.</div>
                                        </div>
                                        @endif @endif
                                        @if(isset($card->maintenance)) @if($card->maintenance !== null)
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-wrench"></i>Обслуживание:</div>
                                            <div class="value">{{$card->maintenance}} руб.</div>
                                        </div>
                                        @endif @endif
                                        @if(isset($card->age_min)) @if($card->age_min !== null)
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-users"></i>Возраст:</div>
                                            <div class="value">от {{$card->age_min}} @if(isset($card->age_max)) @if($card->age_max != null) до {{$card->age_max}} лет @endif  @else @if($card->age_min == 21) года @else лет @endif  @endif</div>
                                        </div>
                                        @endif @endif
                                       	@if(isset($card->speed_see)) @if($card->speed_see !== null)
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-bolt"></i>Скорость рассмотрения заявки:</div>
                                            <div class="value">{{$card->speed_see}}</div>
                                        </div>
                                        @endif @endif
                                       	@if(isset($card->age_work)) @if($card->age_work !== null)
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-bolt"></i>Срок выпуска:</div>
                                            <div class="value">{{$card->age_work}}</div>
                                        </div>
                                        @endif @endif                                        
                                    </div>
                                    <div class="col-md-6">
                                        @if(isset($card->licency)) @if($card->licency !== null)
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-refresh"></i>Лицензия:</div>
                                            <div class="value">{{$card->licency}}</div>
                                        </div>
                                        @endif @endif                                    
                                        @if(isset($card->docs)) @if($card->docs !== null)
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-address-card"></i>Документы:</div>
                                            <div class="value">{{$card->docs}}</div>
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
                                        @if(isset($card->cache_back)) @if($card->cache_back !== null)
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-thumbs-up"></i>Кэшбэк:</div>
                                            <div class="value">{{$card->cache_back}}</div>
                                        </div>
                                        @endif @endif
                                    </div>
                                </div><?php /* end  row*/ ?>
