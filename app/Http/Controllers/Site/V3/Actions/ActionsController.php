<?php

namespace App\Http\Controllers\Site\V3\Actions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Companies\CompaniesReviews;
use Auth;
use DB;
use App\Models\GoogleCaptcha\GoogleCaptcha;
use App\Algorithms\Frontend\Cards\CardsBoot;
use Storage;
use App\Models\Posts\PostsComments;

class ActionsController extends Controller
{
    public function addReview(Request $request){

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




    public function loadPosts(Request $request)
    {
        $PER_PAGE = 6;

        $number_page = clear_data($request['page']);
        $category_id = clear_data($request['category_id']);


        $offset = ($number_page == 0) ? 0 : ($number_page*$PER_PAGE)-$PER_PAGE;
        if($number_page == 1) $offset = 0;

        $posts = DB::table('posts')
            ->leftJoin('posts_categories','posts.pcid','posts_categories.id')
            ->select('posts.*',
                'posts_categories.alias_category',
                'posts_categories.id as category_id')
            ->where(['posts.pcid'=>$category_id,'posts.status'=>1])
            ->limit($PER_PAGE)
            ->orderBy('posts.date', 'desc')
            ->offset($offset)
            ->get()
            ->toArray();


        foreach ($posts as $k => $item) {
            $posts[$k]->comments_count = PostsComments::where(['pid' => $item->id, 'status' => 1])
                ->select(DB::raw('select count(id) as comments_count'))
                ->count();
            if($posts[$k]->valid_until >= date('Y-m-d')){
                $posts[$k]->availability = 'yes';
            }else{
                $posts[$k]->availability = 'no';
            }
        }



        $count_posts_row = DB::table('posts')
            ->select(DB::raw('count(posts.id) as count'))
            ->where(['posts.pcid'=>$category_id,'posts.status'=>1])
            ->first();

        $isset_next_page = ($PER_PAGE * $number_page <= $count_posts_row->count);

        return [
            'code' => view('site.v3.modules.posts.posts',compact('posts'))->render(),
            'next_count' => $isset_next_page
        ];

    }

    public function commentAdd(Request $request)
    {
        $name = clear_data($request['name']);
        $uid = clear_data($request['uid']);
        $pid = clear_data($request['pid']);
        $comment = clear_data($request['comment']);
        $parent = clear_data($request['parent']);

        if(Auth::id() == null){
            $captcha = clear_data($request['captcha']);
            $captchaCheck = GoogleCaptcha::init($captcha);
            if(!$captchaCheck)
                return 'Вы не прошли проверку Captcha';
        }

        $form = new PostsComments();

        if($uid == 'null'){
            $form->author_name = $name;
        }
        $form->uid = ($uid === 'null') ? null : $uid;
        $form->comment = ($comment == '') ? null : $comment;
        $form->pid = $pid;
        $form->parent = ($parent === 'null') ? null : $parent;
        $form->status = 0;
        $form->save();
        return 'Данные успешно отправлены. <br> Ваш комментарий появится после проверки администратором';
    }


}
