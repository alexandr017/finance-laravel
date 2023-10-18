<?php

namespace App\Models\Insurance;

use App\Models\BaseModel;

class InsuranceCardCategory2 extends BaseModel
{
    protected $table = 'insurance_cards_2';

    protected $fillable  = [
        'card_id',
        'risks_covered', // Покрываемые риски
        'additional_options', // Дополнительные опции
        'franchise', // Франшиза
        'type_of_insurance_amount', // Тип страховой суммы
        'number_of_drivers', // Число водителей
        'vehicle_requirements', // Требования к ТС
        'policy_validity_period', // Срок действия полиса
        'renewal', // Продление
        'method_of_execution', // Способ оформления
        'speed_of_execution', // Скорость оформления
        'payment_method' // Способ оплаты
    ];


    private static $fields  = [
        'card_id',
        'risks_covered', // Покрываемые риски
        'additional_options', // Дополнительные опции
        'franchise', // Франшиза
        'type_of_insurance_amount', // Тип страховой суммы
        'number_of_drivers', // Число водителей
        'vehicle_requirements', // Требования к ТС
        'policy_validity_period', // Срок действия полиса
        'renewal', // Продление
        'method_of_execution', // Способ оформления
        'speed_of_execution', // Скорость оформления
        'payment_method' // Способ оплаты
    ];



    /**
     * @return array
     */
    public static function getFields(): array
    {
        return self::$fields;
    }
}
