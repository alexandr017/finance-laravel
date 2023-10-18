<?php

namespace App\Models\Partners;

use Illuminate\Database\Eloquent\Model;

class Vashinvestor extends Model
{
    protected $table = 'partners_vashinvestor';

    protected $fillable = [
        'name',
        'phone',
        'sum',
        'comment',
        'city',
        'city_title',
        'deposit',
        'url',
        'date'
    ];

    public $timestamps = false;

    // from API documenter.getpostman.com/view/9478588/SW7UdXEz?version=latest
    const CITIES = [
        'Ростов-на-Дону' => '384',
        'Новосибирск' => '312',
        'Кемерово' => '314',
        'Красноярск' => '316',
        'Екатеринбург' => '318',
        'Тюмень' => '346',
        'Барнаул' => '398',
        'Челябинск' => '600',
        'Тольятти' => '614',
        'Краснодар' => '612',
        'Самара' => '616',
        'Иркутск' => '632',
        'Сызрань' => '682',
        'Казань' => '1772',
        'Другое' => '322'
        ];


}
