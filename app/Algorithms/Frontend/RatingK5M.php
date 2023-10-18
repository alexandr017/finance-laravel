<?php

namespace App\Algorithms\Frontend;

use App\Models\RatingK5M\RatingK5M as Model;
use DB;

class RatingK5M
{
    private $rating = [];

    private $category_id;

    /**
     * RatingK5M constructor.
     * @param $category_id
     */
    public function __construct($category_id)
    {
        $this->category_id = $category_id;

        $this->rating = Model::where(['category_id' => $category_id])
            ->select('id','category_id','k5m','month','year')
            ->get()
            ->toArray();

        $this->unsetElements();
        $this->sortNestedArrays();

        if(count($this->rating)  != 12) {
            $this->setCurrentMonth($category_id);
        }

    }

    /**
     * @return array
     */
    public function getRatingForChart()
    {
        $result = [];

        foreach ($this->rating as $item) {
            $result [] = (float) $item['k5m'];
        }

        return $result;
    }

    /**
     * @return array
     */
    public function getMonthForChart()
    {
        $result = [];

        $months = [
            1 => "Январь",
            2 => "Февраль",
            3 => "Март",
            4 => "Апрель",
            5 => "Май",
            6 => "Июнь",
            7 => "Июль",
            8 => "Август",
            9 => "Сентябрь",
            10 => "Октябрь",
            11 => "Ноябрь",
            12 => "Декабрь"
        ];

        foreach ($this->rating as $item) {
            if (
                isset(
                    $months[(int)$item['month']]
                )
            ) {

                $result [] = $months[(int)$item['month']];
            } else {
                $result [] = '';
            }
        }

        return $result;

    }

    /**
     *
     */
    private function unsetElements()
    {
        $m = date('m');
        $y = date('Y');

        $rating = $this->rating;

        foreach ($rating as $key => $value) {

            if ($y != $value['year']) {
                if ($value['month'] <= $m) {
                    unset($rating[$key]);
                }
            }
        }

        $this->rating = $rating;
    }

    /**
     * @param array $args
     */
    private function sortNestedArrays($args = [ 'year' => 'asc', 'month' => 'asc'] ){

        $array = $this->rating;

        usort( $array, function( $a, $b ) use ( $args ){
            $res = 0;

            $a = (object) $a;
            $b = (object) $b;

            foreach( $args as $k => $v ){
                if( $a->$k == $b->$k ) continue;

                $res = ( $a->$k < $b->$k ) ? -1 : 1;
                if( $v=='desc' ) $res= -$res;
                break;
            }

            return $res;
        } );

        $this->rating = $array;
    }

    /**
     * @return array|mixed
     */
    private function setCurrentMonth()
    {
        $category_id = $this->category_id;
        $rating = $this->rating;

        $average = DB::select('select avg(km5) as average from cards where category_id=? limit 1',[$category_id]);

        if (isset ($average[0])) {

            $average_value = round($average[0]->average,1);

            if ($average_value == $rating[count($rating) -1]['k5m']) {
                $average_value = $rating[count($rating) -1]['k5m'] + rand(-3, 3)/10;
            }

            $data = [
                'category_id' => $category_id,
                'month' => (int) date('m'),
                'year' => (int) date('Y'),
                'k5m' => $average_value
            ];

            $item = new Model($data);
            $item->save();

            $data['id'] = $item->id;
            $rating [] = $data;
        }

        $this->rating = $rating;

    }



}