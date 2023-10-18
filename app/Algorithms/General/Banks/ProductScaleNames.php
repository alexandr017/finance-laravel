<?php

namespace App\Algorithms\General\Banks;

use Illuminate\Database\Eloquent\Model;

class ProductScaleNames extends Model
{
    private const SCALES = [
        [
            'card_category_id' => 1,
            'alias' => 'loans',
            'scales' => [
                'scale1' => 'Условия займов',
                'scale2' => 'Удобство для заемщика',
                'scale3' => 'Оформление и погашение',
                'scale4' => 'Надежность компании',
                'scale5' => 'Доступность для заемщиков',
            ]
        ],
        [
            'card_category_id' => 4,
            'alias' => 'credits',
            'scales' => [
                'scale1' => 'Условия кредитования',
                'scale2' => 'Удобство для заемщика',
                'scale3' => 'Оформление и погашение',
                'scale4' => 'Надежность банка',
                'scale5' => 'Доступность для заемщика',
            ]
        ],
        [
            'card_category_id' => 8,
            'alias' => 'autocredit',
            'scales' => [
                'scale1' => 'Условия кредитования',
                'scale2' => 'Удобство для заемщика',
                'scale3' => 'Оформление и погашение',
                'scale4' => 'Надежность банка',
                'scale5' => 'Доступность для заемщика',
            ]
        ],
        [
            'card_category_id' => 6,
            'alias' => 'debit-cards',
            'scales' => [
                'scale1' => 'Обслуживание карты',
                'scale2' => 'Пополнение и снятие',
                'scale3' => 'Проценты и бонусы',
                'scale4' => 'Дополнительные услуги',
                'scale5' => 'Надежность банка',
            ]
        ],
        [
            'card_category_id' => 5,
            'alias' => 'credit-cards',
            'scales' => [
                'scale1' => 'Условия кредитования',
                'scale2' => 'Пополнение и снятие',
                'scale3' => 'Бонусная программа',
                'scale4' => 'Дополнительные услуги',
                'scale5' => 'Надежность банка',
            ]
        ],
        [
            'card_category_id' => 6,
            'alias' => 'rko',
            'scales' => [
                'scale1' => 'Обслуживание счета',
                'scale2' => 'Денежные операции',
                'scale3' => 'Дополнительные услуги',
                'scale4' => 'Надежность банка',
                'scale5' => 'Доступность для клиента',
            ]
        ],
        [
            'card_category_id' => 9,
            'alias' => 'cashback',
            'scales' => [
                'scale1' => 'Условия кэшбэка',
                'scale2' => 'Размер кэшбэка',
                'scale3' => 'Удобство для держателя',
                'scale4' => 'Дополнительные услуги',
                'scale5' => 'Надежность банка',
            ]
        ],
        [
            'card_category_id' => 10,
            'alias' => 'mortgage',
            'scales' => [
                'scale1' => '',
                'scale2' => '',
                'scale3' => '',
                'scale4' => '',
                'scale5' => '',
            ]
        ],
        [
            'card_category_id' => 11,
            'alias' => 'deposits',
            'scales' => [
                'scale1' => '',
                'scale2' => '',
                'scale3' => '',
                'scale4' => '',
                'scale5' => '',
            ]
        ]
    ];

    private const EMPTY_SCALES = [
        'card_category_id' => 0,
        'alias' => '',
        'scales' => [
            'scale1' => '',
            'scale2' => '',
            'scale3' => '',
            'scale4' => '',
            'scale5' => '',
        ]
    ];


    public static function getScalesByCategoryAlias($categoryAlias)
    {
        foreach (self::SCALES as $scale) {
            if ($scale['alias'] == $categoryAlias) {
                return $scale['scales'];
            }
        }

        return self::EMPTY_SCALES['scales'];
    }

    public static function getScalesByCategoryID($categoryID)
    {
        foreach (self::SCALES as $scale) {
            if ($scale['card_category_id'] == $categoryID) {
                return $scale['scales'];
            }
        }

        return self::EMPTY_SCALES['scales'];

    }


}