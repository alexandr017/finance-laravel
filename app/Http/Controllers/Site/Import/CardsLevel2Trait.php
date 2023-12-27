<?php

namespace App\Http\Controllers\Site\Import;

use App\Models\Cards\Cards;
use Cache;

trait CardsLevel2Trait
{
    public function updateCardsLevel2()
    {
        $id = '1Tg4ooBarb0JrcnlBzuxWDYFz0sjlWtucp_n6NDA7aVk';
        $gid = '0';

        //dd('https://docs.google.com/spreadsheets/d/' . $id . '/export?format=csv&gid=' . $gid);
        $csv = file_get_contents('https://docs.google.com/spreadsheets/d/' . $id . '/export?format=csv&gid=' . $gid);
        $csv = explode("\r\n", $csv);
        $data = array_map('str_getcsv', $csv);

        $isFirstLine = true;


        //DB::transaction(function() use($data, $isFirstLine) {
            foreach ($data as $row) {

                if ($isFirstLine) {
                    $isFirstLine = false;
                    continue;
                }

                $card = Cards::find($row[0]);
                $card->title = $row[1];
                $card->logo = $row[2];
                $card->status = $row[3];
                $card->link_1 = $row[4];
                $card->link_2 = $row[5];
                $card->link_type = $row[6];
                $card->link_to_entity = $row[7];
                $card->link_to_reviews_page = $row[8];
                $card->account_link = $row[9];
                $card->support_link = $row[10];

                $card->save();

                if (Cache::has('card'.$card->id)) {
                    Cache::forget('card'.$card->id);
                }


            }
        //});

        echo 'Все ок';
    }
}