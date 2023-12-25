<?php

namespace App\Http\Controllers\Site\Import;

use App\Models\HideLinks\HideLinks;
use DB;
use Cache;
use App\Models\Cards\Cards;

trait LinksTrait
{
    public function links()
    {
        DB::delete('delete from hide_links');
        DB::update("ALTER TABLE hide_links AUTO_INCREMENT = 1;");

        $id = '1En3NVZhlMH0nbyHH_upAa_LyWL3ho2pYwgSlTrHN40g';
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

                if ($row[0] == '') {
                    continue;
                }


                $dataForInsert = [
                    'in' => $row[0],
                    'out' => $row[1],
                    'straight' => $row[2],
                    'clicks' => 0,
                    'redirect_type' => 301,
                    'affiliate_program_id' => 0,
                    'permission_type' => 0
                ];

                $link = new HideLinks($dataForInsert);
                $link->save();

                $cards = explode(',', $row[3]);
                foreach ($cards as $_card) {
                    if ((int) $_card > 0) {
                        $card = Cards::find($_card);
//                        if ($card == null) {
//                            dd($row, $_card);
//                        }

                        $typeLink = explode('/', $row[0]);
                        if ($typeLink[0] == 'd') {
                            $card->link_1 = '/' . $link->in;
                        } else {
                            $card->link_2 = '/' . $link->in;
                        }

                        $card->save();

                        if (Cache::has('card'.$card->id)) {
                            Cache::forget('card'.$card->id);
                        }
                    }
                }

            }
        });

        echo 'Все ок';
    }
}