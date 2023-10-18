<?php

namespace App\Models\Insurance;

use App\Models\BaseModel;

class InsuranceCard extends BaseModel
{
    protected $table = 'insurance_cards';

    protected $fillable = [
        'category_id',
        'show_in_category_page',
        'title',
        'img',
        'sorting',
        'vzo_link',
        'partner_link',
        'link_type',
        'right_text',
        'hidden_text',
        'status'
    ];

    private static $fields = [
        'category_id',
        'show_in_category_page',
        'title',
        'img',
        'sorting',
        'vzo_link',
        'partner_link',
        'link_type',
        'right_text',
        'hidden_text',
        'status'
    ];

    /**
     * @return array
     */
    public static function getFields(): array
    {
        return self::$fields;
    }



}