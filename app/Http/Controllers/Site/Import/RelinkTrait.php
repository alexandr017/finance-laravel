<?php

namespace App\Http\Controllers\Site\Import;

use App\Models\Relinking\Relinking;
use App\Models\Relinking\RelinkingGroup;
use DB;

trait RelinkTrait
{
    public function relink()
    {
        DB::delete('delete from relinking');
        DB::update("ALTER TABLE relinking AUTO_INCREMENT = 1;");
        DB::delete('delete from relinking_groups');
        DB::update("ALTER TABLE relinking_groups AUTO_INCREMENT = 1;");

        $id = '1R2TnSVthg6ltEyIdq-8siYzFuRCs2BRMcOHJCLYRTP0';
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

                if ($row[0] == '') {
                    continue;
                }


                $group = DB::table('relinking_groups')
                    ->where(['category_id' => $row[3], 'group_name' => trim($row[2])])
                    ->first();


                if ($group == null) {
                    $group = new RelinkingGroup([
                        'group_name' => trim($row[2]),
                        'category_id' => $row[3]
                    ]);
                    $group->save();
                }

                $relinkingGroupID = $group->id;



                $dataForInsert = [
                    'category_id' => $row[3],
                    'relinking_group_id' => $relinkingGroupID,
                    'title'  => $row[0],
                    'link'  => $row[1]
                ];

                $relink = new Relinking($dataForInsert);
                $relink->save();

            }
        });

        echo 'Все ок';
    }
}