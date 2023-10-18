<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;

class PostsUpdates extends Model
{
    protected $table = 'posts_updates';

    protected $save_limit = 15;

    public static function UserUpdate($post_id){
        // add row
        $row = new self();
        $row->post_id = $post_id;
        $row->user_id = Auth::id();
        $row->save();
        // deleted old rows
    }


    public static function getUsers($post_id){
        $model = new self();
        $items = DB::table($model->table)
            ->leftJoin('users_meta','users_meta.user_id',$model->table.".user_id")
            ->select($model->table.'.created_at','users_meta.first_name','users_meta.last_name')
            ->where([$model->table.'.post_id' => $post_id])
            ->orderBy($model->table.'.id','desc')
            ->get();
        return $items;
    }

}
