<?php

namespace App\Http\Controllers;

use DB;

class TmpController extends Controller
{
    public function index()
    {
        // перелинковка
//        DB::delete('delete from relinking');
//        DB::delete('delete from relinking_groups');


        // компании
        //DB::update('update companies set status = 0');

        // дочки компани
        //DB::update('update companies_children_pages set status = 0');

        // банки
        //DB::update('update banks set status = 0');
        // дочки банков

        //DB::update('update bank_info_pages set status = 0');
        // категории банков
        // продукты банков

        // записи

        // листинги
//        DB::delete('delete from listing');
//        DB::delete('delete from listing_cards');


        //dd(StaticPage::all());
//        for ($i = 1; $i<=11; $i++) {
//            $page = new StaticPage([
//                'title' => 'test',
//                'meta_description' => 'test',
//                'h1' => 'test',
//                'alias' => 'test' . rand(1,10000),
//            ]);
//            $page->save();
//        }

//        $cards = DB::table('cards')->where(['category_id' => 1])->get();

//        foreach ($cards as $_card) {
//            $card = Cards::find($_card->id);
//
//            $card->link_to_entity = '/mfo' . $card->link_to_entity;
//            $card->support_link = '/mfo' . $card->link_to_entity;
//            $card->account_link = '/mfo' . $card->account_link;
//            $card->save();
//        }

//        dd($cards->first());

//        for ($i = 1; $i <= 9000; $i++) {
//            if(\Cache::has('card'.$i)) \Cache::forget('card'.$i);
//        }

//        $statement = "ALTER TABLE cards_children_pages AUTO_INCREMENT = 100000;";
//
//        DB::unprepared($statement);


        //\DB::statement('SET FOREIGN_KEY_CHECKS=0;');
//        \Schema::table('listings', function (Blueprint $table) {
//            $table->bigIncrements('id')->change();
//        });
        //\DB::statement('SET FOREIGN_KEY_CHECKS=1;');

//
//        $children = DB::table('cards_children_pages')->get();
//
//
//        //DB::transaction(function() use($children) {
//
//        foreach ($children as $child) {
//
//            $data = [
//                "id" => rand(10000,100000),
//                "category_id" => $child->cards_category_id,
//                "parent_id" => null,
//                "parent_table" => null,
//                "title" => $child->title,
//                "meta_description"  => $child->meta_description,
//                "h1" => $child->h1,
//                "breadcrumb" => $child->breadcrumb,
//                "expert_anchor" => $child->expert_anchor,
//                "h2" => $child->h2,
//                "img" => $child->img,
//                "infographic" => $child->infographic,
//                "lead" => $child->text_before,
//                "content" => $child->text_after,
//                "total_compare_label" => $child->total_compare_label,
//                "city_id" => $child->city_id,
//                "number_in_exel" => $child->number_in_exel,
//                "average_rating" => $child->average_rating,
//                "number_of_votes" => $child->number_of_votes,
//                "status"=> $child->status,
//                "alias"=> $child->alias
//            ];
//
//            $listing = new \App\Models\Cards\Listing($data);
//            $listing->save();
//
//           // echo $listing->h1 . PHP_EOL;
//        }

        //});


        /*
                if( Auth::id() == 12467) {


                   $json = '[{"id":"3765","url":"news\/banks\/banki-nazvali-ipoteku.html","section_id":"248","section_type":"8"},{"id":"3785","url":"news\/banks\/edinaya-rossiya-predlagaet.html","section_id":"268","section_type":"8"},{"id":"3792","url":"news\/mfk\/obrazovatelnye-zajmy.html","section_id":"275","section_type":"8"},{"id":"3795","url":"news\/mfk\/elektronnye-zajmy-uzakoneny.html","section_id":"278","section_type":"8"},{"id":"3884","url":"news\/mfk\/eps-dlya-mkk-2.html","section_id":"367","section_type":"8"}]';

                   $manage = json_decode($json);


                    foreach ($manage as $item) {
                        $data = [
                            'url' =>$item->url,
                            'section_id' =>$item->section_id,
                        'section_type' => $item->section_type
                        ];
                        $item = new Urls($data);
                        $item->save();
                    }


        dd($json);

                }
                */




        /*
        $redireced = System::redirect();
        if($redireced != null){
            return redirect($redireced, 301);
        }
        */

    }
}