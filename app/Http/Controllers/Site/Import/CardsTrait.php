<?php

namespace App\Http\Controllers\Site\Import;

use A\B;
use Illuminate\Http\Request;
use App\Models\Cards\Cards;
use Cache;
use DB;
use App\Models\Companies\Companies;
use App\Models\Banks\Bank;
use App\Models\Banks\BankCategoryPage;

trait CardsTrait
{
    public function updateCards(Request $request)
    {
        $categoryID = (int) clear_data($request['category_id']);
        match($categoryID) {
            1 => $this->updateCategory1(),
            2 => $this->updateCategory2(),
            4 => $this->updateCategory4(),
            5 => $this->updateCategory5(),
            6 => $this->updateCategory6(),
            8 => $this->updateCategory8(),
            10 => $this->updateCategory10(),
            11 => $this->updateCategory11(),
        };
    }

    private function updateCategory1()
    {
        DB::update('update cards set status = 0 where category_id = 1');

        $cards = Cards::select('id')->where(['category_id' => 1])->get();
        foreach ($cards as $_card) {
            $card = Cards::find($_card->id);
            $card->logo = str_replace('.svg', '.png', $card->logo);
            $card->logo = str_replace('https://vsezaimyonline.ru/', '/', $card->logo);

            if (!str_contains($card->account_link, '/mfo') && $card->id != 9188 && $card->id != 9292) {
                $card->account_link = '/mfo' . $card->account_link;
                $card->account_link = str_replace('/login', '/lichnyj-kabinet', $card->account_link);
            }
            if (!str_contains($card->support_link, '/mfo/')) {
                $card->support_link = '/mfo' . $card->support_link;
            }

            if (!str_contains($card->link_to_reviews_page, '/mfo/')) {
                $card->link_to_reviews_page = '/mfo' . $card->link_to_reviews_page;
                $card->link_to_reviews_page = str_replace('/reviews', '/otzyvy', $card->link_to_reviews_page);
            }

            if (!str_contains($card->link_to_entity, '/mfo/')) {
                $card->link_to_entity = '/mfo' . $card->link_to_entity;
            }

            $company = Companies::find($card->company_id);
            if ($company != null && $company->status == 1) {
                $card->status = 1;
            }

            /////

            if ($card->id == 33) {
                $card->logo = '/images/zajm/4slovo.png';
            }

            if (in_array($card->id, [9693, 9682, 9683])) {
                $card->status = 0;
            }

            ////








            if (in_array($card->id, [30,1062,8293])) {
                $card->link_to_entity = '/mfo/dobrozaim';
                $card->link_to_reviews_page = '/mfo/dobrozaim/otzyvy';
                $card->account_link = '/mfo/dobrozaim/lichnyj-kabinet';
                $card->support_link = '/mfo/dobrozaim/gorjachaja-linija';
            }

            if (in_array($card->id, [9280,9281,9282])) {
                $card->link_to_entity = '/mfo/vash-kredit';
                $card->link_to_reviews_page = '/mfo/vash-kredit/otzyvy';
                $card->account_link = '/mfo/vash-kredit/lichnyj-kabinet';
                $card->support_link = '/mfo/vash-kredit/gorjachaja-linija';
            }

            if (in_array($card->id, [1100,1367,8073,8239])) {
                $card->link_to_entity = '/mfo/green-money';
                $card->link_to_reviews_page = '/mfo/green-money/otzyvy';
                $card->account_link = '/mfo/green-money/lichnyj-kabinet';
                $card->support_link = '/mfo/green-money/gorjachaja-linija';
            }

            if (in_array($card->id, [48,7077,9009])) {
                $card->link_to_entity = '/mfo/zaimexpress';
                $card->link_to_reviews_page = '/mfo/zaimexpress/otzyvy';
                $card->account_link = '/mfo/zaimexpress/lichnyj-kabinet';
                $card->support_link = '/mfo/zaimexpress/gorjachaja-linija';
            }








            if (in_array($card->id, [1088,1574])) {
                $card->link_to_entity = '/mfo/credit7';
                $card->link_to_reviews_page = '/mfo/credit7/otzyvy';
                $card->account_link = '/mfo/credit7/lichnyj-kabinet';
                $card->support_link = '/mfo/credit7/gorjachaja-linija';
            }

            if (in_array($card->id, [8118,7082,1580])) {
                $card->link_to_entity = '/mfo/ekspress-dengi';
                $card->link_to_reviews_page = '/mfo/ekspress-dengi/otzyvy';
                $card->account_link = '/mfo/ekspress-dengi/lichnyj-kabinet';
                $card->support_link = '/mfo/ekspress-dengi/gorjachaja-linija';
            }

            if (in_array($card->id, [1084])) {
                $card->link_to_entity = '/mfo/max-credit';
                $card->link_to_reviews_page = '/mfo/max-credit/otzyvy';
                $card->account_link = '/mfo/max-credit/lichnyj-kabinet';
                $card->support_link = '/mfo/max-credit/gorjachaja-linija';
            }

            if (in_array($card->id, [13])) {
                $card->link_to_entity = '/mfo/creditter';
                $card->link_to_reviews_page = '/mfo/creditter/otzyvy';
                $card->account_link = '/mfo/creditter/lichnyj-kabinet';
                $card->support_link = '/mfo/creditter/gorjachaja-linija';
            }

            if (in_array($card->id, [10,1017,1109])) {
                $card->link_to_entity = '/mfo/joy-money';
                $card->link_to_reviews_page = '/mfo/joy-money/otzyvy';
                $card->account_link = '/mfo/joy-money/lichnyj-kabinet';
                $card->support_link = '/mfo/joy-money/gorjachaja-linija';
            }

            if (in_array($card->id, [6588,8156,8157])) {
                $card->link_to_entity = '/mfo/zajmy-rf';
                $card->link_to_reviews_page = '/mfo/zajmy-rf/otzyvy';
                $card->account_link = '/mfo/zajmy-rf/lichnyj-kabinet';
                $card->support_link = '/mfo/zajmy-rf/gorjachaja-linija';
            }

            $card = $this->updateTmp($card);

            $card->save();

            if (Cache::has('card'.$_card->id)) {
                Cache::forget('card'.$_card->id);
            }
        }
    }

    private function updateCategory2()
    {
        DB::update('update cards set status = 0 where category_id = 2');

        $linksVZO = DB::table('hide_links_vzo')
            ->select('*', DB::raw("CONCAT('/',`in`) as `in`"))
            ->get()
            ->pluck('straight', 'in')
            ->toArray();
        $test = [];

        $cards = Cards::select('id')->where(['category_id' => 2])->get();
        foreach ($cards as $_card) {
            $card = Cards::find($_card->id);
            $card->logo = str_replace('.svg', '.png', $card->logo);
            $card->logo = str_replace('https://vsezaimyonline.ru/', '/', $card->logo);

            $card->link_2 = str_replace('https://vsezaimyonline.ru/', '/' , $card->link_2);
            if (isset($linksVZO[$card->link_2])) {
                //$test [$card->id] = true;
                $card->link_2 = $linksVZO[$card->link_2];
            } else {
                //$test [$card->id] = $card->link_2;
            }
            $card->link_type = 0;
            //echo $card->link_2 . '<br>';


            if (!str_contains($card->account_link, '/banki')) {
                $card->account_link = str_replace('/banks', '/banki', $card->account_link);
                $card->account_link = str_replace('/login', '/lichnyj-kabinet', $card->account_link);

            }
            if (!str_contains($card->support_link, '/banki')) {
                $card->support_link = str_replace('/banks', '/banki', $card->support_link);
                $card->support_link = str_replace('/hotline', '/gorjachaja-linija', $card->support_link);
            }

            if (!str_contains($card->link_to_reviews_page, '/banki')) {
                $card->link_to_reviews_page = str_replace('/banks', '/banki', $card->link_to_reviews_page);
                $card->link_to_reviews_page = str_replace('/reviews', '/otzyvy', $card->link_to_reviews_page);
            }

            if (!str_contains($card->link_to_entity, '/banki')) {
                $card->link_to_entity = str_replace('/banks', '/banki', $card->link_to_entity);
                $tmpArr = explode('/', $card->link_to_entity);
                if (isset($tmpArr[1]) && isset($tmpArr[2]) && isset($tmpArr[3])) {
                    $card->link_to_entity = '/' . $tmpArr[1] . '/' . $tmpArr[2] . '/' . $tmpArr[3];
                }
            }

            $bank = Bank::find($card->bank_id);
            if ($bank != null && $bank->status == 1) {
                $bankCategoryPage = BankCategoryPage::where(['bank_id' => $bank->id, 'category_id' => 2, 'status' => 1])->first();
                if ($bankCategoryPage != null) {
                    $card->status = 1;
                }
            }

            $card = $this->updateTmp($card);

            $card->save();

            if (Cache::has('card'.$_card->id)) {
                Cache::forget('card'.$_card->id);
            }
        }

        //dd($test);
        //dd($linksVZO);
    }

    private function updateCategory4()
    {
        DB::update('update cards set status = 0 where category_id = 4');

        $linksVZO = DB::table('hide_links_vzo')
            ->select('*', DB::raw("CONCAT('/',`in`) as `in`"))
            ->get()
            ->pluck('straight', 'in')
            ->toArray();
        $test = [];

        $cards = Cards::select('id')->where(['category_id' => 4])->get();
        foreach ($cards as $_card) {
            $card = Cards::find($_card->id);
            $card->logo = str_replace('.svg', '.png', $card->logo);
            $card->logo = str_replace('https://vsezaimyonline.ru/', '/', $card->logo);

            $card->link_2 = str_replace('https://vsezaimyonline.ru/', '/' , $card->link_2);
            if (isset($linksVZO[$card->link_2])) {
                //$test [$card->id] = true;
                $card->link_2 = $linksVZO[$card->link_2];
            } else {
                //$test [$card->id] = $card->link_2;
            }
            $card->link_type = 0;
            //echo $card->link_2 . '<br>';

            if (!str_contains($card->account_link, '/banki')) {
                $card->account_link = str_replace('/banks', '/banki', $card->account_link);
                $card->account_link = str_replace('/login', '/lichnyj-kabinet', $card->account_link);

            }
            if (!str_contains($card->support_link, '/banki')) {
                $card->support_link = str_replace('/banks', '/banki', $card->support_link);
                $card->support_link = str_replace('/hotline', '/gorjachaja-linija', $card->support_link);
            }

            if (!str_contains($card->link_to_reviews_page, '/banki')) {
                $card->link_to_reviews_page = str_replace('/banks', '/banki', $card->link_to_reviews_page);
                $card->link_to_reviews_page = str_replace('/reviews', '/otzyvy', $card->link_to_reviews_page);
            }

            if (!str_contains($card->link_to_entity, '/banki')) {
                $card->link_to_entity = str_replace('/banks', '/banki', $card->link_to_entity);
                $card->link_to_entity = str_replace('/credits', '/kredity', $card->link_to_entity);
                $tmpArr = explode('/', $card->link_to_entity);
                if (isset($tmpArr[1]) && isset($tmpArr[2]) && isset($tmpArr[3])) {
                    $card->link_to_entity = '/' . $tmpArr[1] . '/' . $tmpArr[2] . '/' . $tmpArr[3];
                }
            }

            $bank = Bank::find($card->bank_id);
            if ($bank != null && $bank->status == 1) {
                $bankCategoryPage = BankCategoryPage::where(['bank_id' => $bank->id, 'category_id' => 4, 'status' => 1])->first();
                if ($bankCategoryPage != null) {
                    $card->status = 1;
                }
            }

            $card = $this->updateTmp($card);

            $card->save();

            if (Cache::has('card'.$_card->id)) {
                Cache::forget('card'.$_card->id);
            }
        }

        //dd($test);
    }

    private function updateCategory5()
    {
        DB::update('update cards set status = 0 where category_id = 5');

        $linksVZO = DB::table('hide_links_vzo')
            ->select('*', DB::raw("CONCAT('/',`in`) as `in`"))
            ->get()
            ->pluck('straight', 'in')
            ->toArray();
        $test = [];

        $cards = Cards::select('id')->where(['category_id' => 5])->get();
        foreach ($cards as $_card) {
            $card = Cards::find($_card->id);
            $card->logo = str_replace('.svg', '.png', $card->logo);
            $card->logo = str_replace('https://vsezaimyonline.ru/', '/', $card->logo);

            $card->link_2 = str_replace('https://vsezaimyonline.ru/', '/' , $card->link_2);
            if (isset($linksVZO[$card->link_2])) {
                //$test [$card->id] = true;
                $card->link_2 = $linksVZO[$card->link_2];
            } else {
                //$test [$card->id] = $card->link_2;
            }
            $card->link_type = 0;
            //echo $card->link_2 . '<br>';

            if (!str_contains($card->account_link, '/banki')) {
                $card->account_link = str_replace('/banks', '/banki', $card->account_link);
                $card->account_link = str_replace('/login', '/lichnyj-kabinet', $card->account_link);

            }
            if (!str_contains($card->support_link, '/banki')) {
                $card->support_link = str_replace('/banks', '/banki', $card->support_link);
                $card->support_link = str_replace('/hotline', '/gorjachaja-linija', $card->support_link);
            }

            if (!str_contains($card->link_to_reviews_page, '/banki')) {
                $card->link_to_reviews_page = str_replace('/banks', '/banki', $card->link_to_reviews_page);
                $card->link_to_reviews_page = str_replace('/reviews', '/otzyvy', $card->link_to_reviews_page);
            }

            if (!str_contains($card->link_to_entity, '/banki')) {
                $card->link_to_entity = str_replace('/banks', '/banki', $card->link_to_entity);
                $card->link_to_entity = str_replace('/credit-cards', '/kreditnye-karty', $card->link_to_entity);
                $tmpArr = explode('/', $card->link_to_entity);
                if (isset($tmpArr[1]) && isset($tmpArr[2]) && isset($tmpArr[3])) {
                    $card->link_to_entity = '/' . $tmpArr[1] . '/' . $tmpArr[2] . '/' . $tmpArr[3];
                }
            }

            $bank = Bank::find($card->bank_id);
            if ($bank != null && $bank->status == 1) {
                $bankCategoryPage = BankCategoryPage::where(['bank_id' => $bank->id, 'category_id' => 5, 'status' => 1])->first();
                if ($bankCategoryPage != null) {
                    $card->status = 1;
                }
            }

            $card = $this->updateTmp($card);

            $card->save();

            if (Cache::has('card'.$_card->id)) {
                Cache::forget('card'.$_card->id);
            }
        }
    }

    private function updateCategory6()
    {
        DB::update('update cards set status = 0 where category_id = 6');

        $linksVZO = DB::table('hide_links_vzo')
            ->select('*', DB::raw("CONCAT('/',`in`) as `in`"))
            ->get()
            ->pluck('straight', 'in')
            ->toArray();
        $test = [];

        $cards = Cards::select('id')->where(['category_id' => 6])->get();
        foreach ($cards as $_card) {
            $card = Cards::find($_card->id);
            $card->logo = str_replace('.svg', '.png', $card->logo);
            $card->logo = str_replace('https://vsezaimyonline.ru/', '/', $card->logo);

            $card->link_2 = str_replace('https://vsezaimyonline.ru/', '/' , $card->link_2);
            if (isset($linksVZO[$card->link_2])) {
                //$test [$card->id] = true;
                $card->link_2 = $linksVZO[$card->link_2];
            } else {
                //$test [$card->id] = $card->link_2;
            }
            $card->link_type = 0;
            //echo $card->link_2 . '<br>';

            if (!str_contains($card->account_link, '/banki')) {
                $card->account_link = str_replace('/banks', '/banki', $card->account_link);
                $card->account_link = str_replace('/login', '/lichnyj-kabinet', $card->account_link);

            }
            if (!str_contains($card->support_link, '/banki')) {
                $card->support_link = str_replace('/banks', '/banki', $card->support_link);
                $card->support_link = str_replace('/hotline', '/gorjachaja-linija', $card->support_link);
            }

            if (!str_contains($card->link_to_reviews_page, '/banki')) {
                $card->link_to_reviews_page = str_replace('/banks', '/banki', $card->link_to_reviews_page);
                $card->link_to_reviews_page = str_replace('/reviews', '/otzyvy', $card->link_to_reviews_page);
            }

            if (!str_contains($card->link_to_entity, '/banki')) {
                $card->link_to_entity = str_replace('/banks', '/banki', $card->link_to_entity);
                $card->link_to_entity = str_replace('/debit-cards', '/debetovye-karty', $card->link_to_entity);
                $tmpArr = explode('/', $card->link_to_entity);
                if (isset($tmpArr[1]) && isset($tmpArr[2]) && isset($tmpArr[3])) {
                    $card->link_to_entity = '/' . $tmpArr[1] . '/' . $tmpArr[2] . '/' . $tmpArr[3];
                }
            }

            $bank = Bank::find($card->bank_id);
            if ($bank != null && $bank->status == 1) {
                $bankCategoryPage = BankCategoryPage::where(['bank_id' => $bank->id, 'category_id' => 6, 'status' => 1])->first();
                if ($bankCategoryPage != null) {
                    $card->status = 1;
                }
            }

            $card = $this->updateTmp($card);

            $card->save();

            if (Cache::has('card'.$_card->id)) {
                Cache::forget('card'.$_card->id);
            }
        }
    }

    private function updateCategory8()
    {
        DB::update('update cards set status = 0 where category_id = 8');

        $linksVZO = DB::table('hide_links_vzo')
            ->select('*', DB::raw("CONCAT('/',`in`) as `in`"))
            ->get()
            ->pluck('straight', 'in')
            ->toArray();
        $test = [];

        $cards = Cards::select('id')->where(['category_id' => 8])->get();
        foreach ($cards as $_card) {
            $card = Cards::find($_card->id);
            $card->logo = str_replace('.svg', '.png', $card->logo);
            $card->logo = str_replace('https://vsezaimyonline.ru/', '/', $card->logo);

            $card->link_2 = str_replace('https://vsezaimyonline.ru/', '/' , $card->link_2);
            if (isset($linksVZO[$card->link_2])) {
                //$test [$card->id] = true;
                $card->link_2 = $linksVZO[$card->link_2];
            } else {
                //$test [$card->id] = $card->link_2;
            }
            $card->link_type = 0;
            //echo $card->link_2 . '<br>';

            if (!str_contains($card->account_link, '/banki')) {
                $card->account_link = str_replace('/banks', '/banki', $card->account_link);
                $card->account_link = str_replace('/login', '/lichnyj-kabinet', $card->account_link);

            }
            if (!str_contains($card->support_link, '/banki')) {
                $card->support_link = str_replace('/banks', '/banki', $card->support_link);
                $card->support_link = str_replace('/hotline', '/gorjachaja-linija', $card->support_link);
            }

            if (!str_contains($card->link_to_reviews_page, '/banki')) {
                $card->link_to_reviews_page = str_replace('/banks', '/banki', $card->link_to_reviews_page);
                $card->link_to_reviews_page = str_replace('/reviews', '/otzyvy', $card->link_to_reviews_page);
            }

            if (!str_contains($card->link_to_entity, '/banki')) {
                $card->link_to_entity = str_replace('/banks', '/banki', $card->link_to_entity);
                $card->link_to_entity = str_replace('/autocredit', '/avtokredity', $card->link_to_entity);
                $tmpArr = explode('/', $card->link_to_entity);
                if (isset($tmpArr[1]) && isset($tmpArr[2]) && isset($tmpArr[3])) {
                    $card->link_to_entity = '/' . $tmpArr[1] . '/' . $tmpArr[2] . '/' . $tmpArr[3];
                }
            }

            $bank = Bank::find($card->bank_id);
            if ($bank != null && $bank->status == 1) {
                $bankCategoryPage = BankCategoryPage::where(['bank_id' => $bank->id, 'category_id' => 8, 'status' => 1])->first();
                if ($bankCategoryPage != null) {
                    $card->status = 1;
                }
            }

            $card = $this->updateTmp($card);

            $card->save();

            if (Cache::has('card'.$_card->id)) {
                Cache::forget('card'.$_card->id);
            }
        }
    }

    private function updateCategory10()
    {
        DB::update('update cards set status = 0 where category_id = 10');

        $linksVZO = DB::table('hide_links_vzo')
            ->select('*', DB::raw("CONCAT('/',`in`) as `in`"))
            ->get()
            ->pluck('straight', 'in')
            ->toArray();
        $test = [];

        $cards = Cards::select('id')->where(['category_id' => 10])->get();
        foreach ($cards as $_card) {
            $card = Cards::find($_card->id);
            $card->logo = str_replace('.svg', '.png', $card->logo);
            $card->logo = str_replace('https://vsezaimyonline.ru/', '/', $card->logo);

            $card->link_2 = str_replace('https://vsezaimyonline.ru/', '/' , $card->link_2);
            if (isset($linksVZO[$card->link_2])) {
                //$test [$card->id] = true;
                $card->link_2 = $linksVZO[$card->link_2];
            } else {
                //$test [$card->id] = $card->link_2;
            }
            $card->link_type = 0;
            //echo $card->link_2 . '<br>';

            if (!str_contains($card->account_link, '/banki')) {
                $card->account_link = str_replace('/banks', '/banki', $card->account_link);
                $card->account_link = str_replace('/login', '/lichnyj-kabinet', $card->account_link);

            }
            if (!str_contains($card->support_link, '/banki')) {
                $card->support_link = str_replace('/banks', '/banki', $card->support_link);
                $card->support_link = str_replace('/hotline', '/gorjachaja-linija', $card->support_link);
            }

            if (!str_contains($card->link_to_reviews_page, '/banki')) {
                $card->link_to_reviews_page = str_replace('/banks', '/banki', $card->link_to_reviews_page);
                $card->link_to_reviews_page = str_replace('/reviews', '/otzyvy', $card->link_to_reviews_page);
            }

            if (!str_contains($card->link_to_entity, '/banki')) {
                $card->link_to_entity = str_replace('/banks', '/banki', $card->link_to_entity);
                $card->link_to_entity = str_replace('/mortgage', '/ipoteki', $card->link_to_entity);
                $tmpArr = explode('/', $card->link_to_entity);
                if (isset($tmpArr[1]) && isset($tmpArr[2]) && isset($tmpArr[3])) {
                    $card->link_to_entity = '/' . $tmpArr[1] . '/' . $tmpArr[2] . '/' . $tmpArr[3];
                }
            }

            $bank = Bank::find($card->bank_id);
            if ($bank != null && $bank->status == 1) {
                $bankCategoryPage = BankCategoryPage::where(['bank_id' => $bank->id, 'category_id' => 10, 'status' => 1])->first();
                if ($bankCategoryPage != null) {
                    $card->status = 1;
                }
            }

            $card = $this->updateTmp($card);

            $card->save();

            if (Cache::has('card'.$_card->id)) {
                Cache::forget('card'.$_card->id);
            }
        }
    }

    private function updateCategory11()
    {
        DB::update('update cards set status = 0 where category_id = 11');

        $linksVZO = DB::table('hide_links_vzo')
            ->select('*', DB::raw("CONCAT('/',`in`) as `in`"))
            ->get()
            ->pluck('straight', 'in')
            ->toArray();
        $test = [];

        $cards = Cards::select('id')->where(['category_id' => 11])->get();
        foreach ($cards as $_card) {
            $card = Cards::find($_card->id);
            $card->logo = str_replace('.svg', '.png', $card->logo);
            $card->logo = str_replace('https://vsezaimyonline.ru/', '/', $card->logo);

            $card->link_2 = str_replace('https://vsezaimyonline.ru/', '/' , $card->link_2);
            if (isset($linksVZO[$card->link_2])) {
                //$test [$card->id] = true;
                $card->link_2 = $linksVZO[$card->link_2];
            } else {
                //$test [$card->id] = $card->link_2;
            }
            $card->link_type = 0;
            //echo $card->link_2 . '<br>';

            if (!str_contains($card->account_link, '/banki')) {
                $card->account_link = str_replace('/banks', '/banki', $card->account_link);
                $card->account_link = str_replace('/login', '/lichnyj-kabinet', $card->account_link);

            }
            if (!str_contains($card->support_link, '/banki')) {
                $card->support_link = str_replace('/banks', '/banki', $card->support_link);
                $card->support_link = str_replace('/hotline', '/gorjachaja-linija', $card->support_link);
            }

            if (!str_contains($card->link_to_reviews_page, '/banki')) {
                $card->link_to_reviews_page = str_replace('/banks', '/banki', $card->link_to_reviews_page);
                $card->link_to_reviews_page = str_replace('/reviews', '/otzyvy', $card->link_to_reviews_page);
            }

            if (!str_contains($card->link_to_entity, '/banki')) {
                $card->link_to_entity = str_replace('/banks', '/banki', $card->link_to_entity);
                $card->link_to_entity = str_replace('/deposits', '/vklady', $card->link_to_entity);
                $tmpArr = explode('/', $card->link_to_entity);
                if (isset($tmpArr[1]) && isset($tmpArr[2]) && isset($tmpArr[3])) {
                    $card->link_to_entity = '/' . $tmpArr[1] . '/' . $tmpArr[2] . '/' . $tmpArr[3];
                }
            }

            $bank = Bank::find($card->bank_id);
            if ($bank != null && $bank->status == 1) {
                $bankCategoryPage = BankCategoryPage::where(['bank_id' => $bank->id, 'category_id' => 11, 'status' => 1])->first();
                if ($bankCategoryPage != null) {
                    $card->status = 1;
                }
            }

            $card = $this->updateTmp($card);


            $card->save();

            if (Cache::has('card'.$_card->id)) {
                Cache::forget('card'.$_card->id);
            }
        }
    }

    private function updateTmp($card)
    {
        $cardsForDisable = [
            7620, 7623, 2627, 3124, 2657, 2658, 2660, 2661, 2662, 2663, 2664, 2665, 2491,
            9677, 7132, 7717, 3493, 1464, 7287, 3185, 3184, 3489, 3494, 2571, 7458, 9693, 9682, 9683
        ];

        if (in_array($card->id, $cardsForDisable)) {
            //dd($card);
            $card->status = 0;
        }

        if ($card->bank_id == 54) {
            $card->link_to_entity = str_replace('mtsbank', 'mts', $card->link_to_entity);
            $card->link_to_reviews_page = str_replace('mtsbank', 'mts', $card->link_to_reviews_page);
            $card->account_link = str_replace('mtsbank', 'mts', $card->account_link);
            $card->support_link = str_replace('mtsbank', 'mts', $card->support_link);
        }
        if ($card->bank_id == 14) {
            $card->link_to_entity = str_replace('bcs-bank', 'bank-bcs', $card->link_to_entity);
            $card->link_to_reviews_page = str_replace('bcs-bank', 'bank-bcs', $card->link_to_reviews_page);
            $card->account_link = str_replace('bcs-bank', 'bank-bcs', $card->account_link);
            $card->support_link = str_replace('bcs-bank', 'bank-bcs', $card->support_link);
        }

        $link2 = str_replace('https://vsezaimyonline.ru', '', $card->link_2);
        if ($link2 == '/crcards/rsb-platinum-res') $card->link_2 = 'https://www.rsb.ru/cards/mc-platinum/';
        if ($link2 == '/zaim/vdplatinum-res') $card->link_2 = 'https://vdplatinum.ru/';
        if ($link2 == '/crcards/alfabank-perekrestok-res') $card->link_2 = 'https://alfabank.ru/get-money/credit-cards/perekrestok/';
        if ($link2 == '/avtocredit/omoda-finance-res') $card->link_2 = 'https://sovcombank.ru/credits/auto/omoda-finance';
        if ($link2 == '/zaim/microdengi-res') $card->link_2 = 'https://mfc-microdengi.ru/';
        if ($link2 == '/zaim/damdengi-res') $card->link_2 = 'https://дамденьги.рф/';
        if ($link2 == '/crcards/alfabank-100-days-res') $card->link_2 = 'https://alfabank.ru/get-money/credit-cards/100-days/';
        if ($link2 == '/crcards/open-credit-biznes-res') $card->link_2 = 'https://www.open.ru/sme/creditcard';

        if ($card->id == 7593) {
            $card->account_link = '/banki/rosbank/lichnyj-kabinet';
        }

        if ($card->id == 3383) {
            $card->account_link = '/banki/gazprombank/lichnyj-kabinet';
        }

        if ($card->id == 489) {
            $card->link_to_reviews_page = '/banki/bank-bcs/otzyvy';
        }

        if ($card->id == 9026) {
            $card->link_2 = 'https://www.open.ru/sme/creditcard';
        }

        if ($card->id == 488) {
            $card->link_to_reviews_page = '/banki/bank-bcs/otzyvy';
        }

        if ($card->id == 8105) {
            $card->account_link = '/banki/rosbank/lichnyj-kabinet';
        }

        if ($card->id == 3693) {
            $card->account_link = '/banki/gazprombank/lichnyj-kabinet';
        }

        if (in_array($card->id, [8175, 8176, 9124])) {
            $card->logo = '/images/zajm/celfin.png';
        }

        if (in_array($card->id, [2172, 9029])) {
            $card->logo = '/images/zajm/cashtoyou.png';
        }

        if (in_array($card->id, [1088, 1574])) {
            $card->logo = '/images/zajm/credit7.png';
        }









        return $card;
    }


}