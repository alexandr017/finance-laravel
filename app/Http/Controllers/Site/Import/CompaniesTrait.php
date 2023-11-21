<?php

namespace App\Http\Controllers\Site\Import;

use App\Models\Cards\Cards;
use App\Models\Companies\Companies;
use App\Models\Companies\CompaniesChildrenPages;
use App\Models\Companies\CompaniesReviews;
use DB;

trait CompaniesTrait
{
    public function companies()
    {
        DB::update('update companies set status = 0');

        DB::update('update cards set status = 0 where category_id = 1');

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
                $page->img = $row[10];
                $page->og_img = $row[10];
                $page->status = 1;
                $page->save();

                $cardsArr = explode(',', $row[9]);
                foreach ($cardsArr as $cardId) {
                    $card = Cards::find($cardId);
                    if ($card != null) {
                        $card->status = 1;
                    }
                    $card->save();
                }

            }
        });

        echo 'Все ок';
    }

    public function companyChildren()
    {
        DB::update('update companies_children_pages set status = 0');

        $id = '1UJqMbC_ooN46ZnGKcfNKJU3KMOSSh6nnCIoeYXtUfVs';
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

                $page = CompaniesChildrenPages::where(['company_id' => $row[0], 'type_id' => $row[5]])->first();
                if ($page == null) {
                    dd('Не найден элемент для ID ' .  $row[0], ' type_id ' . $row[5]);
                }

                $page->title = $row[2];
                $page->meta_description = $row[3];
                $page->h1 = $row[4];
                //$page->text_before = $row[6];
                $page->content = $row[6] . $row[7];
                $page->breadcrumb = $row[8];
                $page->status = 1;
                $page->save();

            }
        });

        echo 'Все ок';
    }

    public function reviews()
    {

        //DB::delete('delete from companies_reviews');

        $id = '1jvmjAwIY9qmpT7NJWnBqPB405B634XdFUJzSqs0ryS0';
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

                $dataForInsert = [
                    'company_id' => $row[0],
                    'author' => $row[1],
                    'rating' => $row[2],
                    'review' => $row[3],
                    'pros' => $row[4] ?? null, // ?
                    'minuses' => $row[5] ?? null, // ?
                    'status' => 1
                ];
                $review = new CompaniesReviews($dataForInsert);
                $review->save();
            }
        });

        echo 'Все ок';
    }
}