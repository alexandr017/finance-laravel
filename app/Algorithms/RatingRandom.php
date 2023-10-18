<?php

namespace App\Algorithms;


use App\Models\Companies\CompaniesChildrenPages;
use Cache;
use DB;
use App\Models\System as System;


class RatingRandom {

    public static function setCompanyChildrenRating($page){
        $p = CompaniesChildrenPages::find($page->id);
        $p->average_rating = (rand(5,9)/10 + 4);
        $p->number_of_votes = rand(10,15);
        $p->save();
    }
}



