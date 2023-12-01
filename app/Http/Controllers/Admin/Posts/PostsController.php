<?php

namespace App\Http\Controllers\Admin\Posts;

use App\Algorithms\System;
use Illuminate\Http\Request;
use App\Models\Posts\PostsCategories;
use App\Models\Companies\Companies;
use App\Models\Posts\Posts;
use App\Models\Posts\PostsUpdates;
use Validator;
use Cache;
use Auth;
use Log;
use DB;
use App\Repositories\Admin\Posts\PostTagRepository;
use App\Repositories\Admin\Posts\PostTagRelationRepository;
use App\Models\Posts\PostsTagsRelations;
use App\Models\Posts\Authors;

class PostsController extends BasePostController
{

    public function index()
    {
        $posts = DB::table('posts')
            ->join('posts_categories', 'posts_categories.id', '=', 'posts.pcid')
            ->select('posts.*', 'posts_categories.alias_category')
            ->orderBy('id','desc')
            ->paginate(750);


        $breadcrumbs = [
            ['h1' => 'Записи', 'link' => '']
        ];

        return view('admin.posts.posts.index',['posts'=>$posts, 'breadcrumbs' => $breadcrumbs]);
    }

    public function posts_by_category($id)
    {
        $posts = DB::table('posts')
            ->join('posts_categories', 'posts_categories.id', '=', 'posts.pcid')
            ->select('posts.*', 'posts_categories.alias_category')
            ->orderBy('id','desc')
            ->where(['posts.pcid'=>$id])
            ->paginate(750);

        $breadcrumbs = [
            ['h1' => 'Записи', 'link' => route('admin.posts.posts.index')],
            ['h1' => 'Категории', 'link' => route('admin.posts.categories.index')],
            ['h1' => 'Редактирование', 'link' => route('admin.cards.categories.edit', $id)],
            ['h1' => 'Записи категории']
        ];
        
        return view('admin.posts.posts.index',['posts'=>$posts, 'breadcrumbs' => $breadcrumbs]);
    }

    public function create()
    {
        $companies = Companies::all();
        $companiesArr = System::convertToArray($companies,'h1', [null => 'Не выбрано']);

        $postTagRepository = app(PostTagRepository::class);
        $tagsArr = $postTagRepository->getForSelectWithCategoryName();

        $banks = DB::table('banks')->select('id', 'name')->get();
        $banksArr = System::convertToArray($banks,'name', [null => 'Не выбрано']);

        $postsCategories = PostsCategories::all();
        $postsCategoriesArr = System::convertToArray($postsCategories,'h1');
        $posts = Posts::select('id','h1')->where(['status' => 1])->get();
        $postsArr = System::convertToArray($posts,'h1');
        $authors = Cache::rememberForever('authors', function(){
            return Authors::all();
        });
        $authorsArr = System::convertToArray($authors,'name',[0 => 'Не выбран']);

        $breadcrumbs = [
            ['h1' => 'Записи', 'link' => route('admin.posts.posts.index')],
            ['h1' => 'Создание']
        ];

        return view('admin.posts.posts.create',['postsCategoriesArr' => $postsCategoriesArr,
            'postsArr'=>$postsArr,'authorsArr'=>$authorsArr, 'companiesArr' => $companiesArr,
            'banksArr' => $banksArr, 'tagsArr' => $tagsArr, 'breadcrumbs' => $breadcrumbs
            ]);
    }

    public function create_save(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'alias' => 'required',
                'h1' => 'required',
                'pcid' => 'required',
                'short_content' => 'required'
            ],
            [
                'title.required' => '"Title" обязательное поле',
                'h1.required' => '"H1" обязательное поле',
                'alias.required' => '"Постоянная ссылка" обязательное поле',
                'pcid.required' => '"Категория" обязательное поле',
                'short_content.required' => '"Краткое описние" обязательное поле',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $post = new Posts();
        $post->title = $request['title'];
        $url = System::stripUrl($request['alias']);
        if($url == '') $url = '/';
        $post->alias = $url;
        $post->h1 = $request['h1'];
        $post->h1_in_category = (empty($request['h1_in_category'])) ? null :  $request['h1_in_category'];
        $post->pcid = $request['pcid'];
        $post->short_content = $request['short_content'];
        $post->content = (empty($request['content'])) ? '' :  $request['content'];
        $post->expert_anchor = (empty($request['expert_anchor'])) ? null :  $request['expert_anchor'];
        $post->breadcrumb = (empty($request['breadcrumb'])) ? null :  $request['breadcrumb'];
        $post->lead = (empty($request['lead'])) ? null :  $request['lead'];
        $post->infographic = (empty($request['infographic'])) ? null :  $request['infographic'];
        $post->thumbnail = (empty($request['thumbnail'])) ? '' :  $request['thumbnail'];
        $post->main_photo = (empty($request['main_photo'])) ? '' :  $request['main_photo'];
        $post->og_img = (empty($request['og_img'])) ? null :  $request['og_img'];
        $post->date = (empty($request['date'])) ? date('Y-m-d') :  $request['date'];
        $post->time_pub = (empty($request['time_pub'])) ? date('h:i') :  $request['time_pub'];
        $post->meta_description = (empty($request['meta_description'])) ? '' :  $request['meta_description'];
        $post->status = (int) $request['status'];
        $post->pinned = (int) $request['pinned'];
        $post->average_rating = (rand(5,9)/10 + 4);
        $post->number_of_votes = rand(10,15);
        $post->related = ($request['related']==null) ? '' : implode(',', $request['related']);
        $post->views = 0;
        $post->show_in_slider = $request['show_in_slider'];
        $post->the_author_answers = $request['the_author_answers'];
        $post->author_id = ($request['author_id']==null) ? null : $request['author_id'];
        $post->individual_signature = empty_str_to_null($request['individual_signature']) ?? null;
        $post->company_id = ($request['company_id']==null) ? null : $request['company_id'];
        $post->bank_id = ($request['bank_id']==null) ? null : $request['bank_id'];
        $post->studied_the_topic = (empty($request['studied_the_topic'])) ? null :  $request['studied_the_topic'];
        $post->read_the_sources = (empty($request['read_the_sources'])) ? null :  $request['read_the_sources'];
        $post->write_articles = (empty($request['write_articles'])) ? null :  $request['write_articles'];
        $post->valid_until = (empty($request['valid_until'])) ? null :  $request['valid_until'];

        $post->table_of_contents = (empty($request['table_of_contents'])) ? null :  $request['table_of_contents'];

        //для автоматизации заполнения блока читайте также start
        if($request['related']==null) {
            $query = DB::table('posts')
                ->select('posts.id');
            if($request['bank_id'] != null){
                $query->where('bank_id',$request['bank_id']);
            } elseif ($request['company_id']!= null){
                $query->where('company_id',$request['company_id']);
            } else {
                $query->where('pcid',$request['pcid']);
            }
            $relatedPosts = $query->orderBy('id','desc')->take(3)->pluck('id')->toArray();
        }
        $post->related = (isset($relatedPosts) && count($relatedPosts) !=0) ? implode(',', $relatedPosts) : implode(',', $request['related']);
        //для автоматизации заполнения блока читайте также end
        $post->save();

        if (is_array($request['tags'])) {
            foreach ($request['tags'] as $tag) {
                $postsTagsRelations = new PostsTagsRelations([
                    'post_id' => $post->id,
                    'tag_id' => (int) $tag,
                ]);

                $postsTagsRelations->save();
            }
        }

        //Log::info("Администратор c ID ". Auth::id() . " создал запись '$post->h1'");

        $category = PostsCategories::find($request['pcid']);

        adminLog('Записи', $post->id, 'create');

        DB::insert("insert into urls (url, section_id, section_type) values (?, ?, ?)", [$category->alias_category . '/'. $url.'.html', $post->id, 8]);

        if(Cache::has('id_companies_stocks')) Cache::forget('id_companies_stocks');

        return redirect()
            ->route('admin.posts.posts.index')
            ->with('flash_success', 'Запись успешна добавлена!');
    }

    public function edit($id)
    {

        $post = Posts::find($id);
        if($post == null){
            Log::warning("Администратор c ID ". Auth::id() . " попытался изменить несуществующую запись с id '$id'");
            return redirect()->route('admin.posts.posts.index')->withErrors(['Попытка отредактировать запись с несуществующим ID = '.$id]);
        }

        $companies = Companies::all();
        $companiesArr = System::convertToArray($companies,'h1', [null => 'Не выбрано']);

        $banks = DB::table('banks')->select('id', 'name')->get();
        $banksArr = System::convertToArray($banks,'name', [null => 'Не выбрано']);

        $postTagRepository = app(PostTagRepository::class);
        $tagsArr = $postTagRepository->getForSelectWithCategoryNameByCategoryId($post->pcid);

        $postTagRelationRepository = app(PostTagRelationRepository::class);
        $tagsSelectedArr = $postTagRelationRepository->getForSelectByPostId($id);


        $postsCategories = PostsCategories::all();
        $postsCategoriesArr = System::convertToArray($postsCategories,'h1');
        $url = DB::select('select * from urls where section_id=? and section_type=?',[$id,8]);

        $posts = Posts::select('id','h1')->where(['status' => 1])->get();
        $postsArr = System::convertToArray($posts,'h1');

        $authors = Cache::rememberForever('authors', function(){
            return Authors::all();
        });
        $authorsArr = System::convertToArray($authors,'name',[0 => 'Не выбран']);

        $postsUpdates = PostsUpdates::getUsers($id);

        $breadcrumbs = [
            ['h1' => 'Записи', 'link' => route('admin.posts.posts.index')],
            ['h1' => 'Редактирование']
        ];

        return view('admin.posts.posts.edit',[
            'postsCategoriesArr' => $postsCategoriesArr,
            'post'=>$post,
            'url'=>$url,
            'postsArr'=>$postsArr,
            'authorsArr'=>$authorsArr,
            'postsUpdates' => $postsUpdates,
            'companiesArr' => $companiesArr,
            'banksArr' => $banksArr,
            'tagsArr' => $tagsArr,
            'tagsSelectedArr' => $tagsSelectedArr,
            'breadcrumbs' => $breadcrumbs
            ]);
    }

    public function edit_save(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'alias' => 'required',
                'h1' => 'required',
                'pcid' => 'required',
                'short_content' => 'required'
            ],
            [
                'title.required' => '"Title" обязательное поле',
                'h1.required' => '"H1" обязательное поле',
                'alias.required' => '"Постоянная ссылка" обязательное поле',
                'pcid.required' => '"Категория" обязательное поле',
                'short_content.required' => '"Краткое описние" обязательное поле',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $post = Posts::find($request['id']);
        $post->title = $request['title'];
        $url = System::stripUrl($request['alias']);
        if($url == '') $url = '/';
        $post->alias = $url;
        $post->h1 = $request['h1'];
        $post->h1_in_category = (empty($request['h1_in_category'])) ? null :  $request['h1_in_category'];
        $post->breadcrumb = (empty($request['breadcrumb'])) ? null : $request['breadcrumb'];
        $post->expert_anchor = (empty($request['expert_anchor'])) ? null :  $request['expert_anchor'];
        $post->lead = (empty($request['lead'])) ? null :  $request['lead'];
        $post->infographic = (empty($request['infographic'])) ? null :  $request['infographic'];
        $post->pcid = $request['pcid'];
        $post->short_content = $request['short_content'];
        if($post->content != $request['content'])
            $post->date_upd = date('Y-m-d');

        $post->content = (empty($request['content'])) ? '' :  $request['content'];
        $post->thumbnail = (empty($request['thumbnail'])) ? '' :  $request['thumbnail'];
        $post->main_photo = (empty($request['main_photo'])) ? '' :  $request['main_photo'];
        $post->og_img = (empty($request['og_img'])) ? null :  $request['og_img'];
        $post->date = (empty($request['date'])) ? date('Y-m-d') :  $request['date'];
        $post->time_pub = (empty($request['time_pub'])) ? date('h:i') :  $request['time_pub'];
        $post->meta_description = (empty($request['meta_description'])) ? '' :  $request['meta_description'];
        $post->company_id = ($request['company_id']==null) ? null : $request['company_id'];
        $post->bank_id = ($request['bank_id']==null) ? null : $request['bank_id'];
        $post->status = (int) $request['status'];
        $post->show_in_slider = $request['show_in_slider'];
        $post->the_author_answers = $request['the_author_answers'];
        $post->author_id = ($request['author_id']==null) ? null : $request['author_id'];
        $post->individual_signature = empty_str_to_null($request['individual_signature']) ?? null;
        $post->related = ($request['related']==null) ? '' : implode(',', $request['related']);
        $post->valid_until = (empty($request['valid_until'])) ? null :  $request['valid_until'];
        $post->studied_the_topic = (empty($request['studied_the_topic'])) ? null :  $request['studied_the_topic'];
        $post->read_the_sources = (empty($request['read_the_sources'])) ? null :  $request['read_the_sources'];
        $post->write_articles = (empty($request['write_articles'])) ? null :  $request['write_articles'];

        $post->table_of_contents = (empty($request['table_of_contents'])) ? null :  $request['table_of_contents'];
        $post->pinned = (int) $request['pinned'];
        $post->save();

        PostsTagsRelations::where(['post_id' => $request['id']])->delete();
        if (is_array($request['tags'])) {
            foreach ($request['tags'] as $tag) {
                $postsTagsRelations = new PostsTagsRelations([
                    'post_id' => $post->id,
                    'tag_id' => (int) $tag,
                ]);

                $postsTagsRelations->save();
            }
        }

        adminLog('Записи', $post->id, 'update');


        Log::info("Администратор c ID ". Auth::id() . " изменил запись '$post->h1'");
        $category = PostsCategories::find($request['pcid']);

        $urlRow = DB::select("select * from urls where section_id=? and section_type=?",[$request['id'],8]);
        if($urlRow){
            DB::update("update urls set url=? where section_id=? and section_type=?",[$category->alias_category . '/'. $url.'.html',$request['id'],8]);
        } else {
            DB::insert("insert into urls (url, section_id, section_type) values (?, ?, ?)", [$category->alias_category . '/'. $url.'.html', $request['id'], 8]);
        }

        PostsUpdates::UserUpdate($post->id);

        if(Cache::has('id_companies_stocks')) Cache::forget('id_companies_stocks');

        return redirect()
            ->route('admin.posts.posts.index')
            ->with('flash_success', 'Запись успешна обновлена!');
    }

    public function search_by_id(Request $request)
    {
        $posts = DB::table('posts')
            ->join('posts_categories', 'posts_categories.id', '=', 'posts.pcid')
            ->select('posts.*', 'posts_categories.alias_category')
            ->where(['posts.id' => $request['post_id']])
            ->orderBy('id','desc')
            ->paginate(1);

        $breadcrumbs = [
            ['h1' => 'Записи', 'link' => route('admin.posts.posts.index')],
            ['h1' => 'Поиск по id']
        ];

        return view('admin.posts.posts.index',['posts'=>$posts, 'breadcrumbs' => $breadcrumbs]);
    }

    public function destroy($id)
    {

        $post = Posts::find($id);

        Log::alert("Администратор c ID ". Auth::id() . " удалил запись '$post->h1'");

        DB::delete("delete from posts where id=?",[$id]);
        DB::delete("delete from posts_comments where pid=?",[$id]);
        DB::delete("delete from urls where section_id=? and section_type=?",[$id,8]);

        adminLog('Записи', $post->id, 'delete');

        if(Cache::has('id_companies_stocks')) Cache::forget('id_companies_stocks');

        return redirect()
            ->route('admin.posts.posts.index')
            ->with('flash_success', 'Запись успешна удалена!');


    }
}
