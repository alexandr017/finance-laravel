<?php

namespace App\Http\Controllers\Site\Import;

trait BlogTrait
{
    public function blogCategories()
    {
        DB::update('update banks set status = 0');

        $id = '1NYxyApKlyYX-a450wDcwFyLdmBMwzPXfDuSg6gm41MI';
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

                if ($bank == null) {
                    dd('Не найден элемент для ID ' .  $row[0]);
                }

                $bank->name = $row[1];
                $bank->title = $row[2];
                $bank->meta_description = $row[3];
                $bank->h1 = $row[4];
                $bank->lead = $row[5];
                $bank->content = $row[6];

                $bank->status = 1;
                $bank->save();

            }
        });

        echo 'Все ок';
    }

    public function blogPosts()
    {

    }
}