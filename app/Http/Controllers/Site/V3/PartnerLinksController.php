<?php

namespace App\Http\Controllers\Site\V3;

use App\Models\HideLinks\HideLinks;
use App\Http\Controllers\Controller;
use Cache;

class PartnerLinksController extends Controller
{
    public function findLink()
    {
        $resUrl = 'test';

        $hideLink = HideLinks::where(['in'=>$resUrl])->first();

        if($hideLink != null){
            $hideLink = hideLinks::find($hideLink->id);
            $hideLink->increment('clicks');
            if(Cache::has('hide_links')) Cache::forget('hide_links');


            // добавление адреса страницы с которой был клик
            // и доменного имени с которого пришел клиент
            if (strstr($hideLink->out, 'vsezaimyonline.click')) {
                $prevLink = URL::previous();
                $vzoReferrer = str_replace('https://finance.ru/', '' , $prevLink);
                $vzoReferrer = str_replace('/', '+' , $vzoReferrer);
                $hideLink->out = (strstr($hideLink->out, '?'))
                    ? $hideLink->out . '&page=' . $vzoReferrer
                    : $hideLink->out . '?page=' . $vzoReferrer;

                global $REDEFINED_REFERRER_DOMAIN;
                if ($REDEFINED_REFERRER_DOMAIN!= null) {
                    $hideLink->out = $hideLink->out . '&ref=' . clear_data($REDEFINED_REFERRER_DOMAIN);
                } elseif (isset($_COOKIE['REFERRER_DOMAIN'])) {
                    $hideLink->out = $hideLink->out . '&ref=' . clear_data($_COOKIE['REFERRER_DOMAIN']);
                }

                return redirect($hideLink->out, $hideLink->redirect_type);

            }

            //ddd('обычная 2', $hideLink->out);
            return redirect($hideLink->out, $hideLink->redirect_type);
        }

        return abort(404);
    }

}
