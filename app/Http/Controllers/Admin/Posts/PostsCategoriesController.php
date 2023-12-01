<?php

namespace App\Http\Controllers\Admin\Posts;

use App\Algorithms\System;
use Illuminate\Http\Request;
use App\Models\Posts\PostsCategories;
use App\Models\Posts\Posts;
use Validator;
use Cache;
use Auth;
use Log;
use DB;  

class PostsCategoriesController extends BasePostController
{

    public function index()
    {
        $rows = PostsCategories::all();

        $breadcrumbs = [
            ['h1' => 'Записи', 'link' => route('admin.posts.posts.index')],
            ['h1' => 'Категории']
        ];

        return view('admin.posts.categories.index',['rows'=>$rows, 'breadcrumbs' => $breadcrumbs]);
    }

    public function create()
    {
        $breadcrumbs = [
            ['h1' => 'Записи', 'link' => route('admin.posts.posts.index')],
            ['h1' => 'Категории', 'link' => route('admin.posts.categories.index')],
            ['h1' => 'Создание']
        ];

        return view('admin.posts.categories.create', compact('breadcrumbs'));
    }

    public function create_save(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'alias_category' => 'required',
                'h1' => 'required',
            ],
            [
                'title.required' => '"Заголовок" обязательное поле',
                'h1.required' => '"H1" обязательное поле',
                'alias_category.required' => '"Постоянная ссылка" обязательное поле',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $model = new PostsCategories();
        $model->title = $request['title'];
        $url = System::stripUrl($request['alias_category']);
        if($url == '') $url = '/';
        $model->alias_category = $url;
        $model->h1 = $request['h1'];
        $model->breadcrumbs = (empty($request['breadcrumbs'])) ? null :  $request['breadcrumbs'];
        $model->text = (empty($request['text'])) ? '' :  $request['text'];
        $model->meta_description = (empty($request['meta_description'])) ? '' :  $request['meta_description'];
        $model->show_date_publish_in_posts = $request['show_date_publish_in_posts'];
        $model->show_author_in_posts = $request['show_author_in_posts'];
        $model->show_comments_in_posts = $request['show_comments_in_posts'];
        $model->sidebar_menu = $request['sidebar_menu'];
        $model->sidebar_order = $request['sidebar_order'];
        $model->short_name = $request['short_name'];
        $model->icon = $request['icon'];
        $model->save();

        adminLog('Рубрики записей', $model->id, 'create');

        $category_id = $model->id;

        Log::info("Администратор c ID ". Auth::id() . " создал новую категорию записей '$model->h1'");

        DB::insert("insert into urls (url, section_id, section_type) values (?, ?, ?)", [$url, $category_id, 7]);

        if(Cache::has('posts_categories')) Cache::forget('posts_categories');

        if (Cache::has('news_id_categories')) {
            Cache::forget('news_id_categories');
        }

        if (Cache::has('articles_id_categories')) {
            Cache::forget('articles_id_categories');
        }

        if (Cache::has('business_id_categories')) {
            Cache::forget('business_id_categories');
        }

        return redirect()
            ->route('admin.posts.categories.index')
            ->with('flash_success', 'Категория успешна создана!');

    }

    public function edit($id)
    {
        $row = PostsCategories::find($id);
        if($row == null){
            Log::warning("Администратор c ID ". Auth::id() . " попытался изменить несуществующую категорию записей с id '$id'");
            return redirect()
                ->route('admin.posts.categories.index')
                ->withErrors(['Попытка отредактировать категорию записей с несуществующим ID = '.$id]);
        }
        $url = DB::select('select * from urls where section_id=? and section_type=?',[$id,7]);

        $breadcrumbs = [
            ['h1' => 'Записи', 'link' => route('admin.posts.posts.index')],
            ['h1' => 'Категории', 'link' => route('admin.posts.categories.index')],
            ['h1' => 'Редактирование']
        ];

        return view('admin.posts.categories.edit',['row'=>$row,'url'=>$url, 'breadcrumbs' => $breadcrumbs]);
    }

    public function edit_save(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'alias_category' => 'required',
                'h1' => 'required',
            ],
            [
                'title.required' => '"Заголовок" обязательное поле',
                'h1.required' => '"H1" обязательное поле',
                'alias_category.required' => '"Постоянная ссылка" обязательное поле',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $model =  PostsCategories::find($request['id']);
        $model->title = $request['title'];
        $url = System::stripUrl($request['alias_category']);
        $old_url = $model->alias_category;
        if($url == '') $url = '/';
        $model->alias_category = $url;
        $model->h1 = $request['h1'];
        $model->breadcrumbs = (empty($request['breadcrumbs'])) ? null :  $request['breadcrumbs'];
        $model->text = (empty($request['text'])) ? '' :  $request['text'];
        $model->meta_description = (empty($request['meta_description'])) ? '' :  $request['meta_description'];
        $model->show_date_publish_in_posts = $request['show_date_publish_in_posts'];
        $model->show_author_in_posts = $request['show_author_in_posts'];
        $model->show_comments_in_posts = $request['show_comments_in_posts'];
        $model->sidebar_menu = $request['sidebar_menu'];
        $model->sidebar_order = $request['sidebar_order'];
        $model->short_name = $request['short_name'];
        $model->icon = $request['icon'];

        if($old_url != $url){
            DB::update("update urls set url = REPLACE(url, ?, ?) where section_id=? and section_type=?",[$old_url,$url,$request['id'],8]);
        }

        $model->save();

        adminLog('Рубрики записей', $model->id, 'update');

        $urlRow = DB::select("select * from urls where section_id=? and section_type=?",[$request['id'],7]);
        if($urlRow){
            DB::update("update urls set url=? where section_id=? and section_type=?",[$url,$request['id'],7]);
        } else {
            DB::insert("insert into urls (url, section_id, section_type) values (?, ?, ?)", [$url, $request['id'], 7]);
        }


        Log::info("Администратор c ID ". Auth::id() . " изменил категорию записей '$model->h1'");

        if(Cache::has('posts_categories')) Cache::forget('posts_categories');

        if (Cache::has('news_id_categories')) {
            Cache::forget('news_id_categories');
        }

        if (Cache::has('articles_id_categories')) {
            Cache::forget('articles_id_categories');
        }

        if (Cache::has('business_id_categories')) {
            Cache::forget('business_id_categories');
        }

        DB::update("update urls set url=? where section_id=? and section_type=?",[$url,$request['id'],7]);

        return redirect()
            ->route('admin.posts.categories.index')
            ->with('flash_success', 'Категория успешна обновлена!');


    }

    public function destroy($id)
    {
        $model = PostsCategories::find($id);
        $posts = Posts::where(['pcid'=>$id]);
        foreach ($posts as $key => $value) {
            DB::delete("delete from posts_categories where pid=?",[$value->id]);
        }
        DB::delete("delete from posts where pcid=?",[$id]);
        DB::delete("delete from urls where section_id=? and section_type=?",[$id,7]);
        DB::delete("delete from posts_categories where id=?",[$id]);

        adminLog('Рубрики записей', $id, 'delete');
        Log::alert("Администратор c ID ". Auth::id() . " удалил категорию записей '$model->h1'");

        if (Cache::has('news_id_categories')) {
            Cache::forget('news_id_categories');
        }

        if (Cache::has('articles_id_categories')) {
            Cache::forget('articles_id_categories');
        }

        if (Cache::has('business_id_categories')) {
            Cache::forget('business_id_categories');
        }
    
        return redirect()->back()->with('flash_success', 'Категория успешно удалёна!');  
    }


}
