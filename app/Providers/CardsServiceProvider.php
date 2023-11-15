<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Response;
use App\Models\System;

class CardsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('cardHeader1', function($header_1,$category_id){
            switch ($category_id) {
                case '1': return number_format((float)$header_1, 0, '.', ' ')  . ' ₽';
                    break;
                case '2':
                    # code...
                    break;                    
                case '3': 
                    # code...
                    break;
                case '4': return number_format((float)$header_1, 0, '.', ' ')  . ' ₽';
                    break;
                case '5':
                    # code...
                    break;
                case '6':
                    # code...
                    break;
                case '7': return number_format((float)$header_1, 0, '.', ' ')  . ' ₽';
                    break;
                case '8':
                    return number_format((float)$header_1, 0, '.', ' ')  . ' ₽';
                    break;
                case '10':
                    return number_format((float)$header_1, 0, '.', ' ')  . ' ₽';
                    break;
                default: return $header_1;
            }
        });


        Response::macro('cardHeader2', function($header_2,$category_id){
            switch ($category_id) {
                case '1':
                    return $header_2  . System::endWords($header_2,[' день',' дня',' дней']) ;
                    break;
                case '2':
                    # code...
                    break;                    
                case '3': 
                    # code...
                    break;
                case '4': return $header_2  . System::endWords($header_2,[' месяц',' месяца',' месяцев']);
                    # code...
                    break;
                case '5':
                    # code...
                    break;
                case '6':
                    # code...
                    break;
                case '7':
                    return $header_2  . System::endWords($header_2,[' день',' дня',' дней']) ;
                    break;
                case '8':
                    return $header_2  . System::endWords($header_2,[' месяц',' месяца',' месяцев']);
                    break;
                case '10':
                    return $header_2  . System::endWords($header_2,[' год',' года',' лет']);
                    break;
                default: return $header_2;
            }
        });


        Response::macro('cardHeader3', function($header_3,$category_id){
            switch ($category_id) {
                case '1': return $header_3  . ' % в день';
                    # code...
                    break;
                case '2':
                    # code...
                    break;                    
                case '3': 
                    # code...
                    break;
                case '4': return $header_3  . ' % в год';
                    # code...
                    break;
                case '5':
                    # code...
                    break;
                case '6':
                    # code...
                    break;
                case '7': return $header_3  . ' % в неделю';
                    # code...
                    break;
                case '8':
                    return $header_3  . ' % в год';
                    break;
                case '10':
                    return $header_3  . ' % в год';
                    break;
                default: return $header_3;
            }
        });

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
