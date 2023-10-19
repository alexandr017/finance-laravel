<?php $active_fields = 0; $offset_fields_const = 1; $add_break = false;
if(isset($card->opened)) if(($card->opened!==null))$active_fields++;
if(isset($card->maintenance)) $active_fields++;
if(isset($card->count_payment)) if(($card->count_payment!==null))$active_fields++;
if(isset($card->speed_opened)) if(($card->speed_opened!==null))$active_fields++;
if(isset($card->licency)) if(($card->licency!==null))$active_fields++;
if(isset($card->internet_bank)) if(($card->internet_bank!==null))$active_fields++;;
if(isset($card->mobile_bank)) if(($card->mobile_bank!==null))$active_fields++;
if(isset($card->sms_info)) if(($card->sms_info!==null))$active_fields++;
if(isset($card->docs)) if(($card->docs!==null))$active_fields++;
if(isset($card->set_payment)) if(($card->set_payment!==null))$active_fields++;
if(isset($card->get_payment)) if(($card->get_payment!==null))$active_fields++;
if(isset($card->additional_field)) if(($card->additional_field!==null))$active_fields++;
if(isset($card->corporate_cards)) if(($card->corporate_cards!==null))$active_fields++;
if(isset($card->intenernet_acquiring)) if(($card->intenernet_acquiring!==null)){$active_fields++;;$add_break = true; }
if(isset($card->acquiring_terms_connect)) if(($card->acquiring_terms_connect!==null)){$active_fields++;$add_break = true; }
if(isset($card->acquiring_support)) if(($card->acquiring_support!==null)){$active_fields++;$add_break = true; }
if(isset($card->support_module_for_shop)) if(($card->support_module_for_shop!==null)){$active_fields++;$add_break = true; }
if(isset($card->acquiring_terms_enlistment)) if(($card->acquiring_terms_enlistment!==null)){$active_fields++;$add_break = true; }
if(isset($card->acquiring_additional_services)) if(($card->acquiring_additional_services!==null)){$active_fields++;$add_break = true; }
if(isset($card->salary_project)) if(($card->salary_project!==null)){$active_fields++;$add_break = true; }
if(isset($card->salary_project_speed)) if(($card->salary_project_speed!==null)){$active_fields++;$add_break = true; }
if(isset($card->salary_project_additional_services)) if(($card->salary_project_additional_services!==null)){$active_fields++;$add_break = true; }
if(isset($card->currency_control)) if(($card->currency_control!==null)){$active_fields++;$add_break = true; }
if(isset($card->exchange_control_opened)) if(($card->exchange_control_opened!==null)){$active_fields++;$add_break = true; }
if(isset($card->exchange_control_account)) if(($card->exchange_control_account!==null)){$active_fields++;$add_break = true; }
if(isset($card->salary_project_agent)) if(($card->salary_project_agent!==null)){$active_fields++;$add_break = true; }
if(isset($card->exchange_control_passport)) if(($card->exchange_control_passport!==null)){$active_fields++;$add_break = true; }
if(isset($card->exchange_control_charge)) if(($card->exchange_control_charge!==null)){$active_fields++;$add_break = true; }
if(isset($card->exchange_control_reference)) if(($card->exchange_control_reference!==null)){$active_fields++;$add_break = true; }
if(isset($card->exchange_control_additional_services)) if(($card->exchange_control_additional_services!==null)){$active_fields++;$add_break = true; }
if(isset($card->onep_bonus)) if(($card->onep_bonus!==null))$active_fields++;
?>
<?php $active_fields += $offset_fields_const;?>
@if($card->icon_after_name != null)
<div class="pay-icons rko_cards">
    <?php
    $icons = $card->icon_after_name;
    $iconsArr = explode(',',$icons);
    foreach ($iconsArr as $key => $value) {
        echo "<span><i data-icon=\"$value\" class=\"rko-pic pic$value\"></i></span>";
    }
    ?>
</div>
@endif
<div class="row">
                                    <div class="col-md-6">
                                        @if(isset($card->opened)) @if(($card->opened!==null))
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-clock-o"></i>Открытие:</div>
                                            <div class="value">{{$card->opened}} руб.</div>
                                        </div>
                                        @endif @endif
                                        @if(isset($card->maintenance)) @if(($card->maintenance!==null))
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-spinner"></i>Обслуживание:</div>
                                            <div class="value">{{$card->maintenance}} руб.</div>
                                        </div>
                                        @endif @endif
                                        @if(isset($card->count_payment)) @if(($card->count_payment!==null))
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-calculator"></i>Платежка:</div>
                                            <div class="value">{{$card->count_payment}} руб.</div>
                                        </div>
                                        @endif @endif
                                        @if(isset($card->speed_opened)) @if(($card->speed_opened!==null))
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-hourglass-o"></i>Скорость открытия:</div>
                                            <div class="value">{{$card->speed_opened}}</div>
                                        </div>
                                        @endif @endif
                                        @if(isset($card->licency)) @if(($card->licency!==null))
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-file-pdf-o"></i>Лицензия:</div>
                                            <div class="value">{{$card->licency}}</div>
                                        </div>
                                        @endif @endif
                                        @if(isset($card->internet_bank)) @if(($card->internet_bank!==null))
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-university"></i>Интернет-банк:</div>
                                            <div class="value">{{$card->internet_bank}}</div>
                                        </div>
                                        @endif @endif
                                        @if(isset($card->mobile_bank)) @if(($card->mobile_bank!==null))
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-mobile"></i>Мобильный банк:</div>
                                            <div class="value">{{$card->mobile_bank}}</div>
                                        </div>
                                        @endif @endif
                                        <?php if(($active_fields>10)&&($active_fields<=15)&&($add_break == false)) echo "</div><div class=\"col-md-6\">"; //!!!!!!!! ?>
                                        @if(isset($card->sms_info)) @if(($card->sms_info!==null))
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-envelope"></i>СМС-информирование:</div>
                                            <div class="value">{{$card->sms_info}}</div>
                                        </div>
                                        @endif @endif
                                        @if(isset($card->docs)) @if(($card->docs!==null))
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-address-card"></i>Документы:</div>
                                            <div class="value">{{$card->docs}}</div>
                                        </div>
                                        @endif @endif
                                        @if(isset($card->set_payment)) @if(($card->set_payment!==null))
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-money"></i>Прием наличных:</div>
                                            <div class="value">{{$card->set_payment}}</div>
                                        </div>
                                        @endif @endif
                                        @if(isset($card->get_payment)) @if(($card->get_payment!==null))
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-sign-language"></i>Выдача наличных:</div>
                                            <div class="value">{{$card->get_payment}}</div>
                                        </div>
                                        @endif @endif
                                        @if(isset($card->additional_field)) @if(($card->additional_field!==null))
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-newspaper-o"></i>Дополнительно:</div>
                                            <div class="value">{{$card->additional_field}}</div>
                                        </div>
                                        @endif @endif
                                        <?php if(($active_fields>10)&&($active_fields<=15)&&($add_break == true)) echo "</div><div class=\"col-md-6\">"; //!!!!!!!! ?>
                                        <?php if(($active_fields<=10)) echo"</div><div class=\"col-md-6\">"; //!!!!!!!! ?>
                                        <?php if(($active_fields>15)&&($active_fields<=20)) echo"</div><div class=\"col-md-6\">"; //!!!!!!!! ?>
                                        <?php if(($active_fields>30)&&($active_fields<43)) echo"</div><div class=\"col-md-6\">"; //!!!!!!!! ?>
                                        @if(isset($card->corporate_cards)) @if(($card->corporate_cards!==null))
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-credit-card"></i>Корпоративные карты:</div>
                                            <div class="value">{{$card->corporate_cards}}</div>
                                        </div>
                                        @endif @endif
                                        @if(isset($card->intenernet_acquiring)) @if(($card->intenernet_acquiring!==null))
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-credit-card-alt"></i>Эквайринг:</div>
                                            <div class="value">{{$card->intenernet_acquiring}}</div>
                                        </div>
                                        @endif @endif
                                        @if(isset($card->acquiring_terms_connect)) @if(($card->acquiring_terms_connect!==null))
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-clock-o"></i>Эквайринг (сроки подключения):</div>
                                            <div class="value">{{$card->acquiring_terms_connect}}</div>
                                        </div>
                                        @endif @endif                                    
<?php /*
                                    </div>
                                    <div class="col-md-6"> */?>
                                        @if(isset($card->acquiring_support)) @if(($card->acquiring_support!==null))
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-life-ring"></i>Эквайринг (поддержка):</div>
                                            <div class="value">{{$card->acquiring_support}}</div>
                                        </div>
                                        @endif @endif
                                        @if(isset($card->support_module_for_shop)) @if(($card->support_module_for_shop!==null))
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-cc-visa"></i>Эквайринг (модули оплаты для интернет-магазинов):</div>
                                            <div class="value">{{$card->support_module_for_shop}}</div>
                                        </div>
                                        @endif @endif
                                        <?php if(($active_fields>20)&&($active_fields<30)) echo"</div><div class=\"col-md-6\">"; //!!!!!!!! ?>

                                        @if(isset($card->acquiring_terms_enlistment)) @if(($card->acquiring_terms_enlistment!==null))
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-history"></i>Эквайринг (сроки зачисления):</div>
                                            <div class="value">{{$card->acquiring_terms_enlistment}}</div>
                                        </div>
                                        @endif @endif
                                        @if(isset($card->acquiring_additional_services)) @if(($card->acquiring_additional_services!==null))
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-user-plus"></i>Эквайринг (дополнительные услуги):</div>
                                            <div class="value">{{$card->acquiring_additional_services}}</div>
                                        </div>
                                        @endif @endif
                                        @if(isset($card->salary_project)) @if(($card->salary_project!==null))
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-suitcase"></i>Зарплатный проект:</div>
                                            <div class="value">{{$card->salary_project}}</div>
                                        </div>
                                        @endif @endif
                                        @if(isset($card->salary_project_speed)) @if(($card->salary_project_speed!==null))
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-tachometer"></i>Зарплатный проект (скорость подключения):</div>
                                            <div class="value">{{$card->salary_project_speed}}</div>
                                        </div>
                                        @endif @endif
                                        @if(isset($card->salary_project_additional_services)) @if(($card->salary_project_additional_services!==null))
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-file-text-o"></i>Зарплатный проект:</div>
                                            <div class="value">{{$card->salary_project_additional_services}}</div>
                                        </div>
                                        @endif @endif
                                        @if(isset($card->currency_control)) @if(($card->currency_control!==null))
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-usd"></i>Валютный контроль:</div>
                                            <div class="value">{{$card->currency_control}}</div>
                                        </div>
                                        @endif @endif
                                        @if(isset($card->exchange_control_opened)) @if(($card->exchange_control_opened!==null))
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-usd"></i>Валютный контроль (открытие счета в ин. валюте):</div>
                                            <div class="value">{{$card->exchange_control_opened}}</div>
                                        </div>
                                        @endif @endif
                                        @if(isset($card->exchange_control_account)) @if(($card->exchange_control_account!==null))
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-rub"></i>Валютный контроль (ведение счета)</div>
                                            <div class="value">{{$card->exchange_control_account}}</div>
                                        </div>
                                        @endif @endif
                                        @if(isset($card->salary_project_agent)) @if(($card->salary_project_agent!==null))
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-percent"></i>Валютный контроль (агент по операциям резидентов):</div>
                                            <div class="value">{{$card->salary_project_agent}}</div>
                                        </div>
                                        @endif @endif
                                        @if(isset($card->exchange_control_passport)) @if(($card->exchange_control_passport!==null))
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-credit-card-alt"></i><span style="display: flex">Валютный контроль (постановка контракта на учет):</span></div>
                                            <div class="value">{{$card->exchange_control_passport}}</div>
                                        </div>
                                        @endif @endif
                                        @if(isset($card->exchange_control_charge)) @if(($card->exchange_control_charge!==null))
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-pencil-square-o"></i>Валютный контроль (платежка):</div>
                                            <div class="value">{{$card->exchange_control_charge}}</div>
                                        </div>
                                        @endif @endif
                                        @if(isset($card->exchange_control_reference)) @if(($card->exchange_control_reference!==null))
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-id-card"></i>Валютный контроль (выдача справок):</div>
                                            <div class="value">{{$card->exchange_control_reference}}</div>
                                        </div>
                                        @endif @endif                                        
                                        @if(isset($card->exchange_control_additional_services)) @if(($card->exchange_control_additional_services!==null))
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-usd"></i>Валютный контроль:</div>
                                            <div class="value">{{$card->exchange_control_additional_services}}</div>
                                        </div>
                                        @endif @endif
                                        @if(isset($card->onep_bonus)) @if(($card->onep_bonus!==null))
                                        <div class="lvc">
                                            <div class="label"><i class="fa fa-hand-peace-o"></i>Бонусы при открытии счета:</div>
                                            <div class="value">{!!$card->onep_bonus!!}</div>
                                        </div>
                                        @endif @endif                                          
                                    </div>
                                </div><?php /* end  row*/ ?>