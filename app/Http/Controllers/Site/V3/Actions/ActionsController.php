<?php

namespace App\Http\Controllers\Site\V3\Actions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Companies\CompaniesReviews;
use App\Models\SideBar\SideBar;
use App\Models\System;
use Cache;
use Auth;
use DB;
use App\Models\GoogleCaptcha\GoogleCaptcha;
use App\Algorithms\Frontend\Cards\CardsBoot;
use App\Algorithms\Frontend\Cards\CardSorting;
use Storage;

class ActionsController extends Controller
{
    public function remove_review(Request $request){
    	$tmpArr = explode('-',$request['id']);
    	if(isset($tmpArr[1])){
    		$id = (int) clear_data($tmpArr[1]);
            DB::delete("delete from companies_reviews where id=?",[$id]);
            if(Cache::has('through_reviews')) Cache::forget('through_reviews');

    	}
    }

    public function edit_review(Request $request)
    {
        $id = (int) clear_data($request['id']);
        $rating = (float) clear_data($request['rating']);
        if(!$id || !$rating){
            return false;
        }
        DB::update('update companies_reviews set rating = ? where id = ?', [$rating, $id]);
        if(Cache::has('through_reviews')) Cache::forget('through_reviews');
    }

    public function remove_card(Request $request){
        $card_id = (int) clear_data($request['card_id']);
        $children_id = (int) clear_data($request['listing_id']);
        $ccid = (int) clear_data($request['ccid']);
        DB::delete("delete from cards_childrens where id=?",[$ccid]);
        //DB::delete("delete from cards_childrens where card_id=? and children_id=?",[$card_id,$children_id]);
        return 1;
    }

    public function add_review(Request $request){

        $rating = clear_data($request['rating']); 
		$author = clear_data($request['name']); 
        $uid = clear_data($request['uid']); 
        $company_id = clear_data($request['company_id']);
        $parent = clear_data($request['parent']);
        $rev = clear_data($request['review']);
        $pid = clear_data($request['pid']);
        $pros = clear_data($request['pros']);
        $minuses = clear_data($request['minuses']);

        if(Auth::id() == null){
            $captcha = clear_data($request['captcha']);
            $captchaCheck = GoogleCaptcha::init($captcha);
            if(!$captchaCheck)
                return 'Вы не прошли проверку Captcha';
        }


        $review = new CompaniesReviews();
        $review->author = $author;
        if(($uid != 'null') && ($uid != '')){
            $review->uid = $uid;
        }
        if($rating != '0'){
            $review->rating = $rating;
        }
        $review->review = $rev;
        if(($pros != 'null') && ($pros != '')){
            $review->pros = $pros;
        }
        if(($minuses != 'null') && ($minuses != '')){
            $review->minuses = $minuses;
        }
        $review->company_id	 = $company_id;
        if(($parent != 'null') && ($parent != '')){
        	$review->parent_id = (int) $parent;
    	}
        $review->status = 0;
        $review->save();
        return 'Данные успешно отправлены. <br> Ваш комментарий появится после проверки администратором';

    }

    public function inc_help_count(Request $request)
    {
        $link =  clear_data($request['link']);
        $link  = preg_replace('/^\//','',$link);

        $card_id = (int) clear_data($request['card_id']);



        $link_id_row = DB::select("select id from hide_links where `in` = ?", [$link]);
        if(isset($link_id_row[0])){
            $link_id = $link_id_row[0]->id;
        } else {
            $link_id = null;
        }

        $company_id_row = DB::select("select * from cards where id=?", [$card_id]);
        if(isset($link_id_row[0])){
            $company_id = $company_id_row[0]->company_id;
        } else {
            $company_id = null;
        }

        DB::insert('insert into cards_clicks (hl_id, card_id, company_id, date) values (?, ?, ?, ?)', [$link_id, $card_id, $company_id, date('Y-m-d H:i:s')]);

        $help_count = SideBar::find('help_count');
        $help_count->side_value = $help_count->side_value +1;
        if(Cache::has('sidebar')) Cache::forget('sidebar');
        $help_count->save(); 
    }

    public function favorites_load(Request $request){
        $favoritesArr = explode(',',$request['favorites']);
        foreach ($favoritesArr as $key => $value) {
            $favoritesArr[$key] = (int) clear_data($value);
            if($favoritesArr[$key] == 0) unset($favoritesArr[$key]);
        }
        $cards_list = implode(',', $favoritesArr);

        $cards_ = DB::select("select id, category_id from cards where id in ($cards_list)");

        $cards = CardsBoot::getCardsForListingByIDs($cards_);
        $cards = CardSorting::sort($cards);


        $result = '';

        foreach($cards as $card){
            $result .= view('frontend.cards.card.card',['card'=>$card,'section_type'=>-1,'amp'=>0])->render();
        }

        return $result;

    }

    public function unisender(Request $request){

            //$name = strip_tags (htmlspecialchars(stripslashes(addslashes($_POST["name"]);
        $email = clear_data($_POST["email"]);

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        // Ваш ключ доступа к API (из Личного Кабинета)
        $api_key = "5jrd9k9h7o3use74r7j1pyj7f8ni9gtnp6tidmhe";

        // Данные о новом подписчике
        $user_email = $email;
        //$user_name = $name;
        $user_lists = "1174568";
        $user_ip = $ip;

        // Создаём POST-запрос
        $POST = array (
            'api_key' => $api_key,
            'list_ids' => $user_lists,
            'fields[email]' => $user_email,
            //'fields[Name]' => $user_name,
            'request_ip' => $user_ip,
        );
        //отправить файл справку
        $file = 'files/spravka.pdf';
        \Mail::send([], compact('file'),function ($message) use($user_email,$file){
            $message->to($user_email)->subject('8 Лайфхаков о кредитах и займах от #ВсеЗаймыОнлайн');
                    $message->attach($file);
        });
        // Устанавливаем соединение
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $POST);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_URL,'https://api.unisender.com/ru/api/subscribe?format=json');
        $result = curl_exec($ch);

        if ($result) {
            // Раскодируем ответ API-сервера
            $jsonObj = json_decode($result);
            if(null===$jsonObj) {
                // Ошибка в полученном ответе
                echo "Invalid JSON";
            } elseif(!empty($jsonObj->error)) {
                // Ошибка добавления пользователя
                echo "An error occured: " . $jsonObj->error . "(code: " . $jsonObj->code . ")";
            } else {
                // Новый пользователь успешно добавлен
                echo "Added. ID is " . $jsonObj->result->person_id;
            }
        } else {
            // Ошибка соединения с API-сервером
            echo "API access error";
        }

    }

    public function pushUserIP(Request $request)
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip=$_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  {
            $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip=$_SERVER['REMOTE_ADDR'];
        }

        $date = date('d-m H:m:s');

        $action = clear_data($request['action']);

        $actionMessage = $action == 'before' ? 0 : 1;

        Storage::append('geo.log', $ip . ' - ' . $date . ' - ' . $actionMessage);
    }

    public function loadCardForCompany(Request $request)
    {
        $company_id = (int) clear_data($request['company_id']);

        $cardIDs = DB::select("select id, category_id from cards where company_id=$company_id or company_id2=$company_id");

        if ($cardIDs != null) {

            $cards = CardsBoot::getCardsForListingByIDs($cardIDs);
            $code = '';
            $hideEntityLink = true;

            foreach($cards as $key => $card){

                $code .= view('site.v3.modules.cards.minimal.card', compact('card','hideEntityLink'))->render();
            }

            return [
                'code' => $code
            ];
        }



        return ['code' => null];
    }

}
