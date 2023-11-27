<?php

namespace App\Algorithms\Frontend\Banks;

use Illuminate\Database\Eloquent\Model;

class ProductScaleRender extends Model
{
    private const BASE_SCALES = [
        1 => [
            'title' => '',
            'sum' => 0,
            'count' => 0,
        ],
        2 => [
            'title' => '',
            'sum' => 0,
            'count' => 0,
        ],
        3 => [
            'title' => '',
            'sum' => 0,
            'count' => 0,
        ],
        4 => [
            'title' => '',
            'sum' => 0,
            'count' => 0,
        ],
        5 => [
            'title' => '',
            'sum' => 0,
            'count' => 0,
        ],
    ];


    public static function getScales($scaleNames, $products) : array
    {
        $scales = self::BASE_SCALES;

        $scales [1]['title'] = $scaleNames['scale1'];
        $scales [2]['title'] = $scaleNames['scale2'];
        $scales [3]['title'] = $scaleNames['scale3'];
        $scales [4]['title'] = $scaleNames['scale4'];
        $scales [5]['title'] = $scaleNames['scale5'];

        foreach ($products as $product) {
            if($product->scale_1 != null) {
                $scales[1]['sum'] += $product->scale_1;
                $scales[1]['count'] ++;
            }
            if($product->scale_2 != null) {
                $scales[2]['sum'] += $product->scale_2;
                $scales[2]['count'] ++;
            }
            if($product->scale_3 != null) {
                $scales[3]['sum'] += $product->scale_3;
                $scales[3]['count'] ++;
            }
            if($product->scale_4 != null) {
                $scales[4]['sum'] += $product->scale_4;
                $scales[4]['count'] ++;
            }
            if($product->scale_5 != null) {
                $scales[5]['sum'] += $product->scale_5;
                $scales[5]['count'] ++;
            }

        }

        return $scales;
    }

}