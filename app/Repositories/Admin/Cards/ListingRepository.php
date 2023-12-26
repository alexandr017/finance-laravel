<?php

namespace App\Repositories\Admin\Cards;

use App\Repositories\Repository;
use App\Models\Cards\Listing as Model;
use DB;
use Config;

class ListingRepository extends Repository
{
    const COUNT_ON_PAGE = 1000;

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

    public function getForShowById($id)
    {
        return  DB::table('listings')
            ->select('listings.id','listings.h1','listings.category_id','listings.status', 'listings.alias')
            ->whereNull('listings.deleted_at')
            ->where('id', $id)
            ->paginate(self::COUNT_ON_PAGE);
    }

    public function findByLink(string $link, int $categoryId): object|null
    {
        $path = parse_url($link, PHP_URL_PATH);
        $alias = ltrim($path, '/');

        return $this->findByAlias($alias, $categoryId);
    }

    public function findByAlias(string $alias, int $categoryId): object|null
    {
        return DB::table('listings')
            ->where('alias', $alias)
            ->where('category_id', $categoryId)
            ->first();
    }

}
