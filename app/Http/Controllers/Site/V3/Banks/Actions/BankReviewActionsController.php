<?php

namespace App\Http\Controllers\Site\V3\Banks\Actions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Banks\BankReview;
use Auth;
use App\Models\GoogleCaptcha\GoogleCaptcha;

class BankReviewActionsController extends Controller
{

    public function removeReview(Request $request){
        exit;
        // переделать для банков
        $tmpArr = explode('-',$request['id']);
        if(isset($tmpArr[1])){
            $id = (int) clear_data($tmpArr[1]);
            DB::delete("delete from companies_reviews where id=?",[$id]);
            if(Cache::has('through_reviews')) Cache::forget('through_reviews');

        }
    }

    public function editReview(Request $request)
    {
        exit;
        // переделать для банков
        $id = (int) clear_data($request['id']);
        $rating = (float) clear_data($request['rating']);
        if(!$id || !$rating){
            return false;
        }
        DB::update('update companies_reviews set rating = ? where id = ?', [$rating, $id]);
        if(Cache::has('through_reviews')) Cache::forget('through_reviews');
    }

    public function addReview(Request $request)
    {
        if (Auth::id() == null) {
            $captcha = clear_data($request['captcha']);
            $captchaCheck = GoogleCaptcha::init($captcha);
            if (!$captchaCheck)
                return 'Вы не прошли проверку Captcha';
        }
        $bank_cat_id = clear_data($request['bank_category_id']);

        if($bank_cat_id == ''){
            return 'Вы не указали категорию банка';
        }

        $data = [
            'parent_id' => $request['parent'],
            'author' => $request['name'],
            'uid' => $request['uid'],
            'review' => $request['review'],
            'rating' => $request['rating'],
            'pros' => $request['pros'],
            'minuses' => $request['minuses'],
            'bank_id' => $request['company_id'],
            'bank_category_id' => $bank_cat_id,
            'product_id' => $request['product_id'],
        ];
//        dd($data);
        foreach ($data as $key => $value){
            $data[$key] = clear_data($value);
        }
        $review = new BankReview($data);

        $review->save();
        return 'Данные успешно отправлены. <br> Ваш отзыв появится после проверки администратором';
    }

}