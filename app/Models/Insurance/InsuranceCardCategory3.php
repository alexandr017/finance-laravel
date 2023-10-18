<?php

namespace App\Models\Insurance;

use App\Models\BaseModel;

class InsuranceCardCategory3 extends BaseModel
{
    protected $table = 'insurance_cards_3';

    protected $fillable  = [
        'card_id',
        'basic_insurance_amount', // Базовая страховая сумма
        'assistance', // Ассистанс
        'covered_costs_basic', // Покрываемые расходы (базовая страховка)
        'covered_costs_extended', // Покрываемые расходы (расширенная страховка)
        'additional_options', // Дополнительные опции
        'franchise', // Франшиза
        'policy_for_schengen', // Полис для Шенгена
        'number_of_people', // Кол-во человек в полисе
        'age_of_man', // Возраст вписанного лица
        'annual_policy', // Годовой полис
        'method_of_execution', // Способ оформления
        'speed_of_execution', // Скорость оформления
        'payment_method' // Способ оплаты
    ];


    private static $fields  = [
        'card_id',
        'basic_insurance_amount', // Базовая страховая сумма
        'assistance', // Ассистанс
        'covered_costs_basic', // Покрываемые расходы (базовая страховка)
        'covered_costs_extended', // Покрываемые расходы (расширенная страховка)
        'additional_options', // Дополнительные опции
        'franchise', // Франшиза
        'policy_for_schengen', // Полис для Шенгена
        'number_of_people', // Кол-во человек в полисе
        'age_of_man', // Возраст вписанного лица
        'annual_policy', // Годовой полис
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
