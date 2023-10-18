<?php

namespace App\Algorithms\Frontend\Banks;

use App\Models\Banks\BankReview;
use DB;

class BankReviews {

    public static function reviewsParse($banks)
    {
        foreach ($banks as $key => $bank) {

            $reviews = BankReview::where(['bank_id'=>$bank->id,'status'=>1])->get();

            $realCount = 0; $ratingValueTmp = 0;
            foreach ($reviews as  $review) {
                if ($review->rating != null) {
                    $ratingValueTmp += $review->rating;
                    $realCount++;
                }
            }
            if ($ratingValueTmp != 0) {
                $ratingValue = round($ratingValueTmp / $realCount,2);
            } else {
                $ratingValue = 0;
            }
            $banks[$key]->ratingValue = $ratingValue;
            $banks[$key]->ratingCount = count($reviews);
        }
        return $banks;
    }

    public static function getRatingByReviews($reviews)
    {
        global $realReviewsCount;
        global $ratingReviewsValue;

        $realCount = 0;
        $ratingValueTmp = 0;

        foreach ($reviews as  $review) {
            if($review->rating != null){
                $ratingValueTmp += $review->rating;
                $realCount++;
            }
        }


        if($realCount != 0){
            $realReviewsCount = $realCount;
            $ratingReviewsValue = round($ratingValueTmp / $realCount,2);
            return $ratingReviewsValue;
        }

        $realReviewsCount = 0;
        $ratingReviewsValue = 0;
        return 0;
    }

}