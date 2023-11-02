<?php

namespace App\Repositories\Admin\Cards;

use App\Repositories\Repository;
use App\Models\Cards\Listing as Model;
use DB;
use Config;

class ListingRepository extends Repository
{
    const COUNT_ON_PAGE = 1000;

    private $page_type;

    public function __construct()
    {
        $this->page_type = Config::get('urls-types.card-listings');
    }

    public function getForShow($categoryID = null)
    {
        if($categoryID != null){
            $result = DB::table('listings')
                ->select('listings.id','listings.h1','listings.category_id','listings.status', 'listings.alias')
                ->where('listings.category_id' ,'=', $categoryID)
                ->whereNull('listings.deleted_at')
                ->paginate(self::COUNT_ON_PAGE);
        } else {
            $result = DB::table('listings')
                ->select('listings.id','listings.h1','listings.category_id','listings.status', 'listings.alias')
                ->whereNull('listings.deleted_at')
                ->paginate(self::COUNT_ON_PAGE);
        }

        //$result = self::paginate(self::COUNT_ON_PAGE);
        return $result;
    }

    public function findOrFail($id)
    {
        return Model::findOrFail($id);
    }

    public function getForShowById($id){
        return  DB::table('listings')
            ->select('listings.id','listings.h1','listings.category_id','listings.status','listings.alias')
            ->where(['urls.section_type' => $this->page_type, 'listings.id' => $id])
            ->whereNull('listings.deleted_at')
            ->paginate(self::COUNT_ON_PAGE);
    }

}
