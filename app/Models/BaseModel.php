<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{

    public static function convertToArray($list,$field_for_value,$default_value = []){
        $arr = [];
        if(count($default_value) != 0){
            foreach ($default_value as $key => $value) {
                $arr [$key] = $value;
            }
        }
        foreach ($list as $key => $value) {
            $arr [$value->id] = $value->$field_for_value;
        }
        return $arr;
    }

    public static function emptyToNull($list){
        foreach ($list as $key => $value) {
            if ($value === '') {
                $list[$key] = null;
            }
        }
        return $list;
    }


}