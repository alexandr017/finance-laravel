<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Banks\Bank;
use App\Models\Banks\BankInfoPage;
use App\Models\Cards\Listing;
use App\Models\Cards\ListingCards;
use App\Models\Companies\Companies;
use App\Models\Companies\CompaniesChildrenPages;
use App\Models\Relinking\RelinkingGroup;
use App\Models\StaticPages\StaticPage;
use DB;
use App\Models\Relinking\Relinking;

class ImportController extends Controller
{
    private const min_average_rating = 4.0;
    private const max_average_rating = 5.0;

    private const min_number_of_votes = 15;
    private const max_number_of_votes = 35;

    public function relink()
    {
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


    public function banks()
    {
        $id = '1ZRnBmWIYLFUHHUzG4t2TeIcqAgMQeBA3Cc_wIZM3LvA';
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

                $bank = Bank::find($row[0]);
                if ($bank == null) {
                    dd('Не найден элемент для ID ' .  $row[0]);
                }

                $bank->name = $row[1];
                $bank->title = $row[2];
                $bank->meta_description = $row[3];
                $bank->h1 = $row[4];
                $bank->lead = $row[5];
                $bank->content = $row[6];
                $bank->alias = $row[7];
                $bank->breadcrumb = $row[8];

                $bank->show_credit_cards = $row[9];
                $bank->show_debit_cards = $row[10];
                $bank->show_auto_credits = $row[11];
                $bank->show_deposits = $row[12];
                $bank->show_mortgage = $row[13];
                $bank->show_rko = $row[14];

                $bank->logo = $row[15];

                $bank->status = 1;
                $bank->save();

            }
        });

        echo 'Все ок';
    }


    public function bankChildren()
    {
        $id = '1NBqG27cY_mTEErSPB6AnXgcclR-BxfT9kyWHOJlujZg';
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


                $page = BankInfoPage::where(['bank_id' => $row[0], 'type_id' => $row[1]])->first();
                if ($page == null) {
                    dd('Не найден элемент для ID ' .  $row[0], ' type_id ' . $row[1]);
                }

                $page->title = $row[2];
                $page->meta_description = $row[3];
                $page->h1 = $row[4];
                $page->lead = $row[5];
                $page->content = $row[6];
                $page->status = 1;
                $page->save();

            }
        });

        echo 'Все ок';
    }


    public function companies()
    {
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

            }
        });

        echo 'Все ок';
    }

    public function companyChildren()
    {

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
                    dd('Не найден элемент для ID ' .  $row[0]);
                    //continue;
                }

                //$page->name = $row[1];
                $page->title = $row[2];
                $page->meta_description = $row[3];
                $page->h1 = $row[4];
                $page->lead = $row[5];
                $page->content = $row[6];
                $page->alias = $row[7];
                $page->breadcrumb = $row[8];
                $page->save();

            }
        });

        echo 'Все ок';
    }


    public function listings()
    {
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
