<?php

namespace App\Http\Controllers\Site\Import;

use App\Models\Cards\Listing;
use App\Models\Cards\ListingCards;

trait ListingsTrait
{
    public function listings()
    {
        DB::delete('delete from listing');
        DB::delete('delete from listing_cards');

        $categoryAlias = clear_data( request()->segment(count(request()->segments())) );

        $gid = match($categoryAlias) {
            'zaimy' => '0',
            'kredity' => '1362018890',
            'kreditnye-karty' => '1845891490',
            'ipoteki' => '1792920671',
            'avtokredity' => '155015470',
            'debetovye-karty' => '1322689392',
            'vklady' => '935293583',
            'rko' => '1518609891',
            default => dd('Не удалось найти лист для указанной категории')
        };

        $id = '1316Sq78XzT0OC0IjAM36_SyG0k3y0ldLdEKx3igmCZE';

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
                    'category_id' => $row[6],
                    'parent_id'  => null,
                    'parent_table' => null,
                    'title' => $row[0],
                    'meta_description' => $row[1],
                    'h1' => $row[2],
                    'breadcrumb' => $row[7],
                    'expert_anchor' => null,
                    'h2' => null,
                    'img' => '', // !!
                    'infographic' => null,
                    'lead' => $row[3],
                    'content' => $row[4],
                    'total_compare_label' => null,
                    'city_id' => null,
                    'number_in_exel' => null,
                    'average_rating' => (self::min_average_rating + (self::max_average_rating - self::min_average_rating) * (mt_rand() / mt_getrandmax())),
                    'number_of_votes' => rand(self::min_number_of_votes, self::max_number_of_votes),
                    'status' => 1,
                    'alias' => $row[5]
                ];

                $listing = new Listing($dataForInsert);
                $listing->save();
                $listingID = $listing->id;

                $cards = explode(',', $row[8]);

                foreach ($cards as $cardID) {
                    $listingCard = new ListingCards([
                        'listing_id' => $listingID,
                        'card_id' => trim($cardID),
                    ]);
                    $listingCard->save();
                }

            }
        });

        echo 'Все ок';
    }
}