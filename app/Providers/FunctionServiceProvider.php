<?php

namespace App\Providers;

use Illuminate\Routing\Router;
use Response;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use App\Models\SideBar\SideBar;
use App\Models\Menu\Menu;
use App\Models\Posts\Posts;
use App\Models\Blocks\Blocks;
use App\Models\Blocks\Partners;
use App\Models\Blocks\MediaAboutUs;

use App\Models\Options\Options;


use App\Models\Users\UsersMeta;

use App\Models\SideBar\SidebarRating;


use App\Models\Forms\FormWidgetInstall;
use App\Models\Forms\FormCompanyAdd;
use App\Models\Forms\FormSupport;
use App\Models\Forms\FormAdvertising;

use App\Models\Forms\FormZalogi;
use App\Models\Forms\FormRKO;

use Cache;
use DB;
use Auth;
use URL;

class FunctionServiceProvider extends ServiceProvider {

	/**
	 * This namespace is applied to the controller routes in your routes file.
	 *
	 * In addition, it is set as the URL generator's root namespace.
	 *
	 * @var string
	 */
	protected $namespace = 'App\Http\Controllers';

	/**
	 * Define your route model bindings, pattern filters, etc.
	 *
	 * @param  \Illuminate\Routing\Router  $router
	 * @return void
	 */
	public function boot()
	{

		/* backend */
		Response::macro('getFormWidgetInstall', function(){
			$count = 0;
	    	$items = Cache::rememberForever('form_widget_install', function(){
        		return FormWidgetInstall::all();
      		});
	    	if($items != null){
	    		foreach ($items as $key => $value) {
	    			if($value->status ==0) $count++;
	    		}
	    		return $count;
	    	}
	    	else return -1;
		});

		Response::macro('getFormCompanyAdd', function(){
			$count = 0;
	    	$items = Cache::rememberForever('form_company_add', function(){
        		return FormCompanyAdd::all();
      		});
	    	if($items != null){
	    		foreach ($items as $key => $value) {
	    			if($value->status ==0) $count++;
	    		}
	    		return $count;
	    	}
	    	else return -1;
		});

		Response::macro('getFormSupport', function(){
			$count = 0;
	    	$items = Cache::rememberForever('form_support', function(){
        		return FormSupport::all();
      		});
	    	if($items != null){
	    		foreach ($items as $key => $value) {
	    			if($value->status ==0) $count++;
	    		}
	    		return $count;
	    	}
	    	else return -1;
		});

		Response::macro('getFormAdvertising', function(){
			$count = 0;
	    	$items = Cache::rememberForever('form_advertising', function(){
        		return FormAdvertising::all();
      		});
	    	if($items != null){
	    		foreach ($items as $key => $value) {
	    			if($value->status ==0) $count++;
	    		}
	    		return $count;
	    	}
	    	else return -1;
		});

		Response::macro('getFormZalogi', function(){
			$count = 0;
	    	$items = Cache::rememberForever('form_zalogi', function(){
        		return FormAdvertising::all();
      		});
	    	if($items != null){
	    		foreach ($items as $key => $value) {
	    			if($value->status ==0) $count++;
	    		}
	    		return $count;
	    	}
	    	else return -1;
		});


		Response::macro('getFormRKO', function(){
			$count = 0;
	    	$items = Cache::rememberForever('form_rko', function(){
        		return FormAdvertising::all();
      		});
	    	if($items != null){
	    		foreach ($items as $key => $value) {
	    			if($value->status ==0) $count++;
	    		}
	    		return $count;
	    	}
	    	else return -1;
		});



		Response::macro('adminPanel', function(){
	    	$id = Auth::id();
	    	if($id != null){
	    		$roleDB = DB::select("select * from role_user where user_id=?",[$id]);
	    		if(isset($roleDB[0])){
	    			if($roleDB[0]->role_id == 1){
	    				$userMeta = UsersMeta::where(['user_id'=>$id])->first();
	    				if($userMeta!=null){
	    					return $userMeta->admin_panel;
	    				}
	    			}
	    		}
	    	}
	    	return -1; 
		});

		Response::macro('check_mobile', function(){
	    	$mobile_agent_array = array('ipad', 'iphone', 'android', 'pocket', 'palm', 'windows ce', 'windowsce', 'cellphone', 'opera mobi', 'ipod', 'small', 'sharp', 'sonyericsson', 'symbian', 'opera mini', 'nokia', 'htc_', 'samsung', 'motorola', 'smartphone', 'blackberry', 'playstation portable', 'tablet browser');
	    	$agent = strtolower($_SERVER['HTTP_USER_AGENT']);    

	    	foreach ($mobile_agent_array as $value) {    
	        	if (strpos($agent, $value) !== false) return true;   
	    	}       
	    	return false; 
		});
		
		/* frontend */
		Response::macro('getIndexBreadcrumb', function(){
			$allRows = Cache::rememberForever('options', function(){
            	return Options::all();
        	});


        	foreach ($allRows as $key => $value) {
        		if($value['attributes']['key'] == 'index_breadcrumb'){
					return $value['attributes']['value'];
        		}
        	}
			return '';
		});

		/*

		Response::macro('getSidebar', function(){

			$allRows = Cache::rememberForever('sidebar', function(){
        		return SideBar::all();
      		});

			$keyed = $allRows->mapWithKeys(function ($item) {
            	return [$item['id'] =>[
            	'side_key' => $item['attributes']['side_key'],
            	'side_value' =>  $item['side_value']
            	]];
        	});

	        $SideBar = array();
	        foreach ($keyed as $key => $value) {
	            $SideBar [$value['side_key']] = $value['side_value'];
	        }

            return $SideBar;

		});

		*/

        Response::macro('getSidebarK5M', function(){
            $SideBar = Cache::rememberForever('sidebar_k5m', function(){
                return SidebarRating::all();
            });
            return $SideBar;
        });

		Response::macro('getThroughReviews', function(){

			$allRows = Cache::rememberForever('through_reviews', function(){
        		return $allRows = DB::table('companies_reviews')
					    ->select('companies_reviews.*')
                        ->where(['companies_reviews.status' => 1, 'off_answer' => null])
					    ->orderBy('companies_reviews.id','desk')
					    ->limit(10)
					    ->get();
      		});

      		return $allRows;
		});


		Response::macro('getThroughAdvice', function(){
      		$allRows = Posts::where(['pcid'=>17])->inRandomOrder()->limit(10)->get();
      		return $allRows;
		});

		Response::macro('getThroughPartners', function(){
			$allRows = Cache::rememberForever('through_partners', function(){
        		return Partners::all();
      		});
      		return $allRows;
		});

		Response::macro('getThroughMediaAboutUs', function(){
			$allRows = Cache::rememberForever('through_media_about_us', function(){
        		return MediaAboutUs::all();
      		});
      		return $allRows;
		});

		Response::macro('getThroughWeCompare', function(){
			$allRows = Cache::rememberForever('through_we_compare', function(){
        		return Blocks::find('we_compare');
      		});

			global $ALL_ENABLE_REVIEWS;

			if ($ALL_ENABLE_REVIEWS == null) {
                $reviews = DB::select('select count(*) as count from companies_reviews where status=1');
                $ALL_ENABLE_REVIEWS = $reviews;
            } else {
                $reviews = $ALL_ENABLE_REVIEWS;
            }


			if(isset($reviews[0])){
			    if(isset($reviews[0]->count))
			        $count = number_format($reviews[0]->count, 0, '.', ' ');
			        $allRows->block_value = str_replace('[all_reviews_count]', $count, $allRows->block_value);
            }


      		$data = json_decode($allRows->block_value);
      		return $data;
		});


		Response::macro('getThroughIKBlock', function(){
		    /*
			$allRows = Cache::rememberForever('through_ik_block', function(){
        		return Blocks::find('ik_block');
      		});
      		$data = json_decode($allRows->block_value);

			$R_U = $_SERVER['REQUEST_URI'];
			$obj = '';
			switch (true) {
			  case strstr($R_U,'zalogi'):
			    $obj = $data->zalogi;
			    break;
			  case strstr($R_U,'online-credit'):
			    $obj = $data->online_credit;
			    break;
			  case strstr($R_U,'credit-cards'):
			    $obj = $data->credit_carts;
			    break;
			  case strstr($R_U,'debit-cards'):
			    $obj = $data->debit_carts;
			    break;
			  case strstr($R_U,'vklady'):
			    $obj = $data->vklady;
			    break;
			  case strstr($R_U,'rko'):
			    $obj = $data->rko;
			    break;
			  case strstr($R_U,'options'):
			    $obj = $data->options;
			    break;
			}
			if($obj == '') $obj = $data->zaimy;
*/

      		$lastNews = Posts::where('pcid',13)->orderBy('id','desk')->limit(4)->get();  // news

      		$res['lastNews'] = $lastNews;
      		//$res['obj'] = $obj;
      		return $res;
		});	


		Response::macro('getMenu', function($id){
			$allRows = Cache::rememberForever('menu', function(){
        		return Menu::all();
      		});
      		foreach ($allRows as $key => $value) {
      			if($value->id == $id) return $value;
      		}
      		return null;
		});



		Response::macro('getCanonical', function(){
			$url = URL::current();
			$canonical = preg_replace("/\/page\/\d/", '', $url);
			if(strstr($url,'page'))
				$canonical = preg_replace("/\d\d?\d?$/", '', $canonical);
      		return $canonical;
		});

		Response::macro('getCanonicalNext', function($section_id,$pages){
			if($section_id == 7){
				if($pages == 1) return null;
				$url = URL::current();
				$url = preg_replace('/\/$/', '', $url);
                $urlArr = explode('/', $url);
                $page = (int)$urlArr[count($urlArr)-1];
				if($page < $pages){
					if($page == 0) {
						return $url . '/page/2';
					} else {
						return str_replace('/page/'.$page, '/page/'.($page+1), $url);
					}
				} return null;
			}
      		return null;
		});

		Response::macro('getCanonicalPrev', function($section_id){
			if($section_id == 7){
				$url = URL::current();
				$url = preg_replace('/\/$/', '', $url);
                $urlArr = explode('/', $url);
                $page = (int) $urlArr[count($urlArr)-1];
				if($page > 2){
					return str_replace('/page/'.$page, '/page/'.($page-1), $url);
				} elseif($page == 2){
					return str_replace('/page/'.$page, '', $url);
				} else return null;
			}
      		return null;
		});





/*
		Response::macro('getSiteName', function()
		{
			$siteName = Cache::rememberForever('options1', function()
			{
				return options::where('id',1)->get();
			});
			return $siteName[0]->value;
		});
*/
	}

	/**
	 * Define the routes for the application.
	 *
	 * @param  \Illuminate\Routing\Router  $router
	 * @return void
	 */
	public function map(Router $router)
	{
		$router->group(['namespace' => $this->namespace], function($router)
		{
			require app_path('Http/routes.php');
		});
	}

}
