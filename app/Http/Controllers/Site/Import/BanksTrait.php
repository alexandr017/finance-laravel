<?php

namespace App\Http\Controllers\Site\Import;

use App\Models\Banks\Bank;
use App\Models\Banks\BankCategoryPage;
use App\Models\Banks\BankInfoPage;
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

                //dd($data);

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


                $page = BankCategoryPage::where(['bank_id' => $row[0], 'category_id' => $row[1]])->first();
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


    public function bankReviews()
    {

    }

}