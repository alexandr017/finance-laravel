<?php

namespace App\Algorithms;


use App\Models\Companies\Companies;
use App\Models\Companies\CompaniesUrl;

use App\Models\Cards\Cards;
use Cache;
use DB;
use App\Models\System as System;


class SimilarCompanies {
    public static function getSimilarCompanies($company){

        if($company == null) return [];
        $section_id = $company->id;
        /*************/

        $cards = [];
        $cardsRow = DB::select("select id, category_id from cards where company_id=$section_id or company_id2=$section_id");

        if(!empty($cardsRow)){
            // govno-code start
            foreach ($cardsRow as $key => $value) {
                $cardsRow[$key]->category_id = System::getCardsTableNameById($value->category_id);
            }

            $cards2 = [];

            $cardsColl = collect($cardsRow);
            $cards2 = collect($cards2);
            foreach ($cardsRow as $key => $value) {
                $cards2[$key] = DB::table('cards')
                    ->leftjoin($value->category_id,'cards.id', $value->category_id.'.card_id')
                    ->where('cards.id',$value->id)
                    ->first();
            }

            $cards = collect([]);
            foreach ($cardsRow as $key => $value) {
                $cards [] = collect($value)->merge($cards2[$key]);
            }


            foreach ($cards as $key => $value) {
                $cards[$key] = (object) $value;
                foreach ($value as $key2 => $value2){
                    $cards[$key]->$key2 = $value2;
                }
            }
            // govno-code finish
        }


        // выбор имени компании и нахождение максимального к5м из карточек компании
        $company_name = ($company->company_name != null) ? $company->company_name : $company->h1;
        $max_k5m = 0;
        foreach ($cards as $card){
            if($card->km5 > $max_k5m) $max_k5m = $card->km5;
        }

        // для дебетовых карт своя логика
        $similar_companies_row = DB::table("companies")
            ->select("companies.*", DB::raw("(select cards.km5 from cards where company_id = companies.id or company_id2 = companies.id limit 1) as km5" ))
            ->where(['companies.status' => 1])
            ->get();


        // отбор компаний, у карточек которых к5ь равен текущей.
        $similar_companies = [];
        foreach ($similar_companies_row as $key => $value){
            if($value->km5 == $max_k5m && $value->id != $company->id){
                $similar_companies [] = $value;
                unset($similar_companies_row[$key]);
            }

        }

        // если не хватает карточек, берем с большим рейтингом
        if(count($similar_companies)<3){
            foreach ($similar_companies_row as $key => $value){
                if($value->km5 > $max_k5m && $value->id != $company->id){
                    $similar_companies [] = $value;
                    unset($similar_companies_row[$key]);

                }

            }
        }

        // если не хватает берем с меньшим в интервале на 1
        $arrTmp = [];
        if(count($similar_companies)<3){
            foreach ($similar_companies_row as $key => $value){
                if(($max_k5m - $value->km5)  >= 1 || ($max_k5m - $value->km5) <= 0 ){
                } else {
                    $arrTmp [] = $similar_companies_row[$key];
                }
            }
            // если по прежнему не набралось 3 компании
            shuffle($arrTmp);
            if(count($similar_companies) == 0){
                if(isset($arrTmp[count($arrTmp)-1])){$similar_companies [] = $arrTmp[count($arrTmp)-1]; unset($arrTmp[count($arrTmp)-1]);}
                if(isset($arrTmp[count($arrTmp)-1])){$similar_companies [] = $arrTmp[count($arrTmp)-1]; unset($arrTmp[count($arrTmp)-1]);}
                if(isset($arrTmp[count($arrTmp)-1])){$similar_companies [] = $arrTmp[count($arrTmp)-1]; unset($arrTmp[count($arrTmp)-1]);}

            } elseif(count($similar_companies) == 1){
                if(isset($arrTmp[count($arrTmp)-1])){$similar_companies [] = $arrTmp[count($arrTmp)-1]; unset($arrTmp[count($arrTmp)-1]);}
                if(isset($arrTmp[count($arrTmp)-1])){$similar_companies [] = $arrTmp[count($arrTmp)-1]; unset($arrTmp[count($arrTmp)-1]);}

            } elseif(count($similar_companies) == 2){
                if(isset($arrTmp[count($arrTmp)-1])){$similar_companies [] = $arrTmp[count($arrTmp)-1]; unset($arrTmp[count($arrTmp)-1]);}
            }

        }

        shuffle($similar_companies);
        $count = count($similar_companies);

        // если по каким-то причинам получили больше 3 компаний
        if(count($similar_companies) > 3){
            for($i=3; $i<$count; $i++){
                unset($similar_companies[$i]);
            }
        }

        return $similar_companies;

    }
}



