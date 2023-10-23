<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Banks\Bank;
use App\Models\Banks\BankInfoPage;
use App\Models\Companies\Companies;
use DB;

class ImportController extends Controller
{
    public function banks()
    {

        $id = '1ZRnBmWIYLFUHHUzG4t2TeIcqAgMQeBA3Cc_wIZM3LvA';
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
                $bank->save();

            }
        });

        dd('Все ок');
    }


    public function bankChildren()
    {
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
                $page->save();

            }
        });

        dd('Все ок');
    }


    public function companies()
    {
        $id = '1IpCuClu4Cz9MIirCH6sUCzCs_GQJIfEt-ObaHw0KQ4w';
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


                $page = Companies::find($row[0]);
                if ($page == null) {
                    dd('Не найден элемент для ID ' .  $row[0]);
                    //continue;
                }

                //$page->name = $row[1];
                $page->title = $row[2];
                $page->meta_description = $row[3];
                $page->h1 = $row[4];
                $page->text_before = $row[5];
                $page->text_after = $row[6];
                $page->alias = $row[7];
                $page->breadcrumb = $row[8];
                $page->save();

            }
        });

        dd('Все ок');
    }

}
