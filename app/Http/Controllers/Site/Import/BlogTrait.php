<?php

namespace App\Http\Controllers\Site\Import;

use App\Models\Posts\Posts;
use App\Models\Posts\PostsCategories;
use DB;

trait BlogTrait
{
    public function blogCategories()
    {
        DB::delete('delete from posts_categories');
        DB::update("ALTER TABLE posts_categories AUTO_INCREMENT = 1;");

        $id = '1NYxyApKlyYX-a450wDcwFyLdmBMwzPXfDuSg6gm41MI';
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
                    'title' => $row[1],
                    'alias_category' => $row[2],
                    'h1' => $row[3],
                    'breadcrumbs' => $row[4],
                    'lead' => $row[5],
                    'meta_description' => $row[6],
                    'sidebar_menu' => $row[7],
                    'sidebar_order' => $row[8],
                    'short_name' => $row[9]
                ];

                $category = new PostsCategories($dataForInsert);
                $category->save();
            }
        });

        echo 'Все ок';
    }

    public function blogPosts()
    {
        DB::delete('delete from posts');
        DB::update("ALTER TABLE posts AUTO_INCREMENT = 1;");

        $id = '1m5PtO6EEOqIzlUF8D2BHO01KsfsjJS-37WLP1eQ4X4k';
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
                    'pcid' => $row[1],
                    'title' => $row[2],
                    'meta_description' => $row[3],
                    'h1' => $row[4],
                    'alias' => $row[5],
                    'breadcrumbs' => $row[6],
                    'short_content' => $row[7],
                    'content' => $row[8],
                    'date' => date("Y-m-d H:i:s", strtotime($row[9])),
                    'related' => $row[10],
                    'status' => 1
                ];

                //dd($dataForInsert, $data);

                $category = new Posts($dataForInsert);
                $category->save();
            }
        });

        echo 'Все ок';
    }
}