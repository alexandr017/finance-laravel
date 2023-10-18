<?php

namespace App\Models\Companies;

use Illuminate\Database\Eloquent\Model;

class CompaniesUrl extends Model
{
    protected $table = 'companies_url';



    
    public static function getScales()
    {
        return [
            //Займы
            1 => [
                'scale1' => 'Условия займов',
                'scale2' => 'Удобство для заемщика',
                'scale3' => 'Оформление и погашение',
                'scale4' => 'Надежность компании',
                'scale5' => 'Доступность для заемщиков',
            ],
            //Кредиты
            2 => [
                'scale1' => 'Условия кредитования',
                'scale2' => 'Удобство для заемщика',
                'scale3' => 'Оформление и погашение',
                'scale4' => 'Надежность банка',
                'scale5' => 'Доступность для заемщика',
            ],
            //Криптовалютные биржи
            3 => [
                'scale1' => '',
                'scale2' => '',
                'scale3' => '',
                'scale4' => '',
                'scale5' => '',
            ],
            //Дебетовые карты
            4 => [
                'scale1' => 'Обслуживание карты',
                'scale2' => 'Пополнение и снятие',
                'scale3' => 'Проценты и бонусы',
                'scale4' => 'Дополнительные услуги',
                'scale5' => 'Надежность банка',
            ],
            //Кредитные карты
            5 => [
                'scale1' => 'Условия кредитования',
                'scale2' => 'Пополнение и снятие',
                'scale3' => 'Бонусная программа',
                'scale4' => 'Дополнительные услуги',
                'scale5' => 'Надежность банка',
            ],
            //Расчетные счета
            6 => [
                'scale1' => 'Обслуживание счета',
                'scale2' => 'Денежные операции',
                'scale3' => 'Дополнительные услуги',
                'scale4' => 'Надежность банка',
                'scale5' => 'Доступность для клиента',
            ],
            //Займы под залог
            7 => [
                'scale1' => '',
                'scale2' => '',
                'scale3' => '',
                'scale4' => '',
                'scale5' => '',
            ],
            //Кредитные карты c кэшбэком
            8 => [
                'scale1' => 'Условия кэшбэка',
                'scale2' => 'Размер кэшбэка',
                'scale3' => 'Удобство для держателя',
                'scale4' => 'Дополнительные услуги',
                'scale5' => 'Надежность банка',
            ],
            //test
            9 => [
                'scale1' => '',
                'scale2' => '',
                'scale3' => '',
                'scale4' => '',
                'scale5' => '',
            ],
            //Карты с кэшбэком
            10 => [
                'scale1' => 'Условия кэшбэка',
                'scale2' => 'Размер кэшбэка',
                'scale3' => 'Удобство для держателя',
                'scale4' => 'Дополнительные услуги',
                'scale5' => 'Надежность банка',
            ],
            //Ипотеки
            11 => [
                'scale1' => '',
                'scale2' => '',
                'scale3' => '',
                'scale4' => '',
                'scale5' => '',
            ],
        ];

    }
}
