<?php

namespace App\Http\Controllers\Site\Import;

use App\Models\Posts\Posts;
use App\Models\Posts\PostsCategories;
use DB;

trait BlogTrait
{
    public function blogCategories()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('posts_categories')->truncate();

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
//        DB::statement('SET FOREIGN_KEY_CHECKS=0');
//        DB::table('posts_comments')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('posts')->truncate();

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
                    'breadcrumbs' => $row[5],
                    'short_content' => $row[6],
                    'content' => $row[7],
                    'date' => $row[8],
                    'related' => $row[9],
                    'status' => 1
                ];

                $category = new Posts($dataForInsert);
                $category->save();
            }
        });

        echo 'Все ок';
    }
}