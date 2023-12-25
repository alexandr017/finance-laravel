<?php

namespace App\Http\Controllers\Site\Import;

use App\Models\StaticPages\StaticPage;
use DB;

trait StaticPagesTrait
{
    public function staticPages()
    {
        $id = '14tkp77oqngkldO9mZmDGedf9LMR9hd0GgZFzpM92GnI';
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


                $page = StaticPage::find($row[0]);
                if ($page == null) {
                    echo 'Не найден элемент для ID ' .  $row[0] . '<br>';
                    continue;
                }

                //$page->name = $row[1];
                $page->title = $row[2];
                $page->meta_description = $row[3];
                $page->h1 = $row[4];
                $page->lead = $row[5];
                $page->content = $row[6];
                $page->alias = $row[7];
                $page->breadcrumb = $row[8];
                $page->average_rating = 4 + (rand(1, 10) / 10);
                $page->number_of_votes = rand(20, 50);
                $page->save();

            }
        });

        echo 'Все ок';
    }
}