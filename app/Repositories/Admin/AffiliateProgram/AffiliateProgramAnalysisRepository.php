<?php

namespace App\Repositories\Admin\AffiliateProgram;

use App\Repositories\Repository;
use App\Models\AffiliateProgram\AffiliateProgramAnalysis as Model;
use DB;

class AffiliateProgramAnalysisRepository extends Repository
{
    /**
     * @param $id
     * @return mixed
     */
    public function getForEditOrFail($id)
    {
        return Model::findOrFail($id);
    }

    public function getForCategoryByFlow($categoryID, $flowID)
    {
        return DB::table('affiliate_program_analysis')
            ->join('cards','cards.id','affiliate_program_analysis.card_id')
            ->select('affiliate_program_analysis.*','cards.id as card_id', 'cards.title','cards.category_id','cards.status','cards.show_in_index', 'cards.flow', 'cards.km5')
            ->where(['cards.category_id' => $categoryID, 'cards.flow' => $flowID, 'status' => 1])
            ->orderBy('cards.flow','asc')
            ->orderBy('cards.km5','desc')
            ->orderBy('cards.id','asc')
            ->get();
    }

    public function getDisabledCardsForCategoryByFlow($categoryID)
    {
        return DB::table('affiliate_program_analysis')
            ->join('cards','cards.id','affiliate_program_analysis.card_id')
            ->select('affiliate_program_analysis.*','cards.id as card_id', 'cards.title','cards.category_id','cards.status','cards.show_in_index', 'cards.flow', 'cards.km5')
            ->where(['cards.category_id' => $categoryID, 'status' => 0])
            ->orderBy('cards.flow','asc')
            ->orderBy('cards.km5','desc')
            ->orderBy('cards.id','asc')
            ->get();
    }

    public function getCardsFromIndexPage()
    {
        $limit = 10;

        return DB::table('affiliate_program_analysis')
            ->join('cards','cards.id','affiliate_program_analysis.card_id')
            ->select('affiliate_program_analysis.*','cards.id as card_id', 'cards.title','cards.category_id','cards.status','cards.show_in_index', 'cards.flow', 'cards.km5')
            ->where(['cards.category_id' => 1, 'cards.show_in_index' => 1, 'status' => 1])
            ->orderBy('cards.flow','asc')
            ->orderBy('cards.km5','desc')
            ->orderBy('cards.id','asc')
            ->limit($limit)
            ->get();
    }

    public function getFromOldListing($id)
    {
        return DB::table('affiliate_program_analysis')
            ->join('cards','cards.id','affiliate_program_analysis.card_id')
            ->join('cards_childrens','cards.id','cards_childrens.card_id')
            ->select('affiliate_program_analysis.*','cards.id as card_id', 'cards.title','cards.category_id','cards.status','cards.show_in_index', 'cards.flow', 'cards.km5')
            ->where(['cards.category_id' => 1,  'status' => 1, 'cards_childrens.children_id' => $id])
            ->orderBy('cards.flow','asc')
            ->orderBy('cards.km5','desc')
            ->orderBy('cards.id','asc')
            ->get();
    }

}
