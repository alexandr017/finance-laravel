<?php

namespace App\Http\Controllers\Site\Import;

use App\Models\Cards\Listing;
use App\Models\Cards\ListingCards;
use DB;
use App\Models\Cards\Cards;

trait ListingsTrait
{
    public function listings()
    {
        DB::delete('delete from listings');
        DB::update("ALTER TABLE listings AUTO_INCREMENT = 1;");
//        DB::delete('delete from listing_cards');
//        DB::update("ALTER TABLE listing_cards AUTO_INCREMENT = 1;");

        $id = '1316Sq78XzT0OC0IjAM36_SyG0k3y0ldLdEKx3igmCZE';
        $gid = '0';

        $csv = file_get_contents('https://docs.google.com/spreadsheets/d/' . $id . '/export?format=csv&gid=' . $gid);
        $csv = explode("\r\n", $csv);
        $data = array_map('str_getcsv', $csv);

        $isFirstLine = true;

        $i = 0;


        //DB::transaction(function() use($data, $isFirstLine) {
            foreach ($data as $row) {

                if ($isFirstLine) {
                    $isFirstLine = false;
                    continue;
                }

                if (count($row) != 11) {
                    dd($row);
                }

                $i++;
                if ($i > 30) {
                    //dd($data);
                    //break;
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
                    'alias' => trim($row[5])
                ];

                $listing = new Listing($dataForInsert);
                $listing->save();
                $listingID = $listing->id;



//                if ($row[5] != '/') {
//                    if ($row[8] == '') {
//                        $allEnableCards = Cards::select('id')->where(['category_id' => $listing->category_id, 'status' => 1])->get();
//                        foreach ($allEnableCards as $card) {
//                            $listingCard = new ListingCards([
//                                'listing_id' => $listing->id,
//                                'card_id' => $card->id
//                            ]);
//                            $listingCard->save();
//                        }
//                    } else {
//                        if ($row[9] == 'o') {
//                            $allListingCards = DB::table('cards_childrens_vzo')->where(['children_id' => $row[8]])->get();
//                            foreach ($allListingCards as $card) {
//                                $listingCard = new ListingCards([
//                                    'listing_id' => $listing->id,
//                                    'card_id' => $card->card_id
//                                ]);
//                                $listingCard->save();
//                            }
//                            dd($allListingCards, 5, );
//                        } else {
//                            $allListingCards = DB::table('listing_cards_vzo')->where(['listing_id' => $row[8]])->get();
//                            foreach ($allListingCards as $card) {
//                                $listingCard = new ListingCards([
//                                    'listing_id' => $listing->id,
//                                    'card_id' => $card->card_id
//                                ]);
//                                $listingCard->save();
//                            }
//                        }
//                    }
//
//                }



            }
        //});

        echo 'Все ок';
    }
}