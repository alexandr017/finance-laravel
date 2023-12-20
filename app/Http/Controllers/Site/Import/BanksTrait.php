<?php

namespace App\Http\Controllers\Site\Import;

use App\Models\Banks\Bank;
use App\Models\Banks\BankCategoryPage;
use App\Models\Banks\BankInfoPage;
use App\Models\Banks\BankProduct;
use App\Models\Banks\BankReview;
use DB;

trait BanksTrait
{
    public function banks()
    {
        DB::update('update banks set status = 0');

        $id = '1ZRnBmWIYLFUHHUzG4t2TeIcqAgMQeBA3Cc_wIZM3LvA';
        $gid = '0';

        $csv = file_get_contents('https://docs.google.com/spreadsheets/d/' . $id . '/export?format=csv&gid=' . $gid);
        $csv = explode("\r\n", $csv);
        $data = array_map('str_getcsv', $csv);

        $isFirstLine = true;

        //dd($csv);

        DB::transaction(function() use($data, $isFirstLine) {
            foreach ($data as $row) {

                if ($isFirstLine) {
                    $isFirstLine = false;
                    continue;
                }

                $bank = Bank::find($row[0]);
                if ($bank == null) {
                    dd('Не найден элемент для ID ' .  $row[0]);
                }

                $bank->name = $row[1];
                $bank->title = $row[2];
                $bank->meta_description = $row[3];
                $bank->h1 = $row[4];
                $bank->lead = $row[5];
                $bank->content = $row[6];
                $bank->alias = $row[7];
                $bank->breadcrumb = $row[8];

                $bank->show_credit_cards = $row[9];
                $bank->show_debit_cards = $row[10];
                $bank->show_auto_credits = $row[11];
                $bank->show_deposits = $row[12];
                $bank->show_mortgage = $row[13];
                $bank->show_rko = $row[14];

                $bank->logo = $row[15];

                $bank->status = 1;
                $bank->save();

            }
        });

        echo 'Все ок';
    }


    public function bankChildren()
    {
        DB::update('update bank_info_pages set status = 0');

        $id = '1NBqG27cY_mTEErSPB6AnXgcclR-BxfT9kyWHOJlujZg';
        $gid = '0';

        $csv = file_get_contents('https://docs.google.com/spreadsheets/d/' . $id . '/export?format=csv&gid=' . $gid);
        $csv = explode("\r\n", $csv);
        $data = array_map('str_getcsv', $csv);

        $isFirstLine = true;


        DB::transaction(function() use($data, $isFirstLine) {
            foreach ($data as $row) {

                //dd($data);

                if ($isFirstLine) {
                    $isFirstLine = false;
                    continue;
                }

                $page = BankInfoPage::where(['bank_id' => $row[0], 'type_id' => $row[1]])->first();
                if ($page == null) {
                    dd('Не найден элемент для ID ' .  $row[0], ' type_id ' . $row[1]);
                }

                $page->title = $row[2];
                $page->meta_description = $row[3];
                $page->h1 = $row[4];
                $page->lead = $row[5];
                $page->content = $row[6];
                $page->status = 1;
                $page->save();

            }
        });

        echo 'Все ок';
    }

    public function bankCategories()
    {
        //dd(BankCategoryPage::select('*')->orderBy('id','desc')->first());
        //dd(BankCategoryPage::select('*')->where(['bank_id' => 70, 'category_id' => 2])->get());
        DB::update('update bank_category_pages set status = 0');

        $id = '1r5S-Wh4IITHAm4vQSl5G_9TP6v-lrCMvdYf5VZp7epc';
        $gid = '0';

        $csv = file_get_contents('https://docs.google.com/spreadsheets/d/' . $id . '/export?format=csv&gid=' . $gid);
        $csv = explode("\r\n", $csv);
        $data = array_map('str_getcsv', $csv);

        $isFirstLine = true;


        DB::transaction(function() use($data, $isFirstLine) {
            foreach ($data as $row) {

                if ($isFirstLine) {
                    $isFirstLine = false;
                    continue;
                }

                //dd($data);

                $page = BankCategoryPage::where(['bank_id' => $row[0], 'category_id' => $row[1]])
                    ->whereNull('deleted_at')
                    ->first();
                if ($page == null) {
                    $data = [
                        'bank_id'  => $row[0],
                        'category_id' => $row[1],
                        'title' => $row[2],
                        'meta_description' => $row[3],
                        'h1' => $row[4],
                        'lead' => $row[5],
                        'content' => $row[6],
                        'breadcrumb' => $row[7],
                        'status' => 1,
                    ];

                    if ($data['lead'] == '') $data['lead'] = 'test';
                    if ($data['content'] == '') $data['content'] = 'test';

                    $page = new BankCategoryPage($data);
                } else {
                    $page->title = $row[2];
                    $page->meta_description = $row[3];
                    $page->h1 = $row[4];
                    $page->lead = $row[5];
                    $page->content = $row[6];
                    $page->breadcrumb = $row[7];
                    $page->status = 1;
                }

                $page->save();

//                if ($row[0] == 70 && $row[1] == 2) {
//                    dd($page);
//                }

            }
        });

        echo 'Все ок';
    }

    public function bankProducts()
    {
        DB::update('update bank_category_pages set status = 0');

        $id = '15kK8WIyWEUA2X412axFgMvABGBWbfmDBnausAICeO9g';
        $gid = '0';

        $csv = file_get_contents('https://docs.google.com/spreadsheets/d/' . $id . '/export?format=csv&gid=' . $gid);
        $csv = explode("\r\n", $csv);
        $data = array_map('str_getcsv', $csv);

        $isFirstLine = true;


        DB::transaction(function() use($data, $isFirstLine) {
            foreach ($data as $row) {

                if ($isFirstLine) {
                    $isFirstLine = false;
                    continue;
                }

                $page = BankProduct::find($row[0]);
                if ($page == null) {
                    dd('Не найден элемент для ID ' .  $row[1]);
                }

                $page->title = $row[2];
                $page->meta_description = $row[3];
                $page->h1 = $row[4];
                $page->lead = $row[5];
                $page->content = $row[6];
                $page->breadcrumb = $row[7];
                $page->status = 1;
                $page->save();

                // cards todo

            }
        });

        echo 'Все ок';
    }


    public function bankReviews()
    {
        DB::delete('delete from bank_reviews');
        DB::update("ALTER TABLE bank_reviews AUTO_INCREMENT = 1;");

        $id = '1O4gqxPgV94q-15TvJnOjPibSA-4ufKvLutITnFnurRU';
        $gid = '0';

        $csv = file_get_contents('https://docs.google.com/spreadsheets/d/' . $id . '/export?format=csv&gid=' . $gid);
        $csv = explode("\r\n", $csv);
        $data = array_map('str_getcsv', $csv);

        $isFirstLine = true;

        DB::transaction(function () use ($data, $isFirstLine) {
            foreach ($data as $row) {

                if ($isFirstLine) {
                    $isFirstLine = false;
                    continue;
                }

                $bankCategoryPage = BankCategoryPage::where(['bank_id' => $row[0], 'category_id' =>$row[1]])->first();
                if ($bankCategoryPage == null) {
                    dd(1, $row);
                }

                $dataForInsert = [
                    'bank_id' => $row[0],
                    'bank_category_id' => $bankCategoryPage->id,
                    'product_id' => null,
                    'author' => $row[3],
                    'rating' => $row[4],
                    'review' => $row[5],
                    'pros' => null,
                    'minuses' => null,
                    'status' => 1
                ];
                $review = new BankReview($dataForInsert);
                $review->save();
            }
        });

//        $cards = Cards::select('id')->where(['category_id' => 1])->get();
//        foreach ($cards as $_card) {
//            if (Cache::has('card' . $_card->id)) {
//                Cache::forget('card' . $_card->id);
//            }
//        }
//
//        $companies = Companies::select('id')->get();
//
//        foreach ($companies as $_company) {
//            if (Cache::has('company_reviews_avg' . $_company->id)) {
//                Cache::forget('company_reviews_avg' . $_company->id);
//            }
//        }

        echo 'Все ок';
    }
}