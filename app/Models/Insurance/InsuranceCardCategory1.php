<?php

namespace App\Models\Insurance;

use App\Models\BaseModel;

class InsuranceCardCategory1 extends BaseModel
{
    protected $table = 'insurance_cards_1';

    protected $fillable  = [
        'card_id',
        'base_rate', // Базовый тариф
        'basic_insurance_amount', // Базовая страховая сумма
        'risks_covered', // Покрываемые риски
        'additional_options', // Дополнительные опции
        'e_osago', // e-ОСАГО
        'green_map', // Зеленая карта
        'unlimited_policy', // Полис без ограничений
        'vehicle_types', // Типы ТС
        'renewal', // Продление
        'method_of_execution', // Способ оформления
        'speed_of_execution', // Скорость оформления
        'payment_method' // Способ оплаты
    ];

    private static $fields  = [
        'card_id',
        'base_rate', // Базовый тариф
        'basic_insurance_amount', // Базовая страховая сумма
        'risks_covered', // Покрываемые риски
        'additional_options', // Дополнительные опции
        'e_osago', // e-ОСАГО
        'green_map', // Зеленая карта
        'unlimited_policy', // Полис без ограничений
        'vehicle_types', // Типы ТС
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
