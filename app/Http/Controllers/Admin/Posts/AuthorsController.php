<?php

namespace App\Http\Controllers\Admin\Posts;

use App\Models\Posts\Authors;
use Cache;
use App\Http\Requests\Admin\Posts\AuthorsRequest;
use App\Repositories\Admin\Posts\AuthorsRepository;

class AuthorsController extends BasePostController
{
    public function __construct()
    {
        parent::__construct();
        $this->authorsRepository = app(AuthorsRepository::class);
    }

    public function index()
    {
    	$authors = Cache::rememberForever('authors', function(){
        	return $this->authorsRepository->getForShow();
      	});

        $breadcrumbs = [
            ['h1' => 'Записи', 'link' => route('admin.posts.posts.index')],
            ['h1' => 'Авторы']
        ];

    	return view('admin.posts.authors.index', compact('authors', 'breadcrumbs'));
    }

    public function create()
    {
        $breadcrumbs = [
            ['h1' => 'Записи', 'link' => route('admin.posts.posts.index')],
            ['h1' => 'Авторы', 'link' => route('admin.posts.authors.index')],
            ['h1' => 'Создание']
        ];

    	return view('admin.posts.authors.create', compact('breadcrumbs'));
    }

    public function store(AuthorsRequest $request)
    {
        $data = $request->all();
        $data = empty_str_to_null($data);
        $author = new Authors($data);
        $result = $author->save();

        if (Cache::has('authors')) {
            Cache::forget('authors');
        }

        if (Cache::has('authors_arr')) {
            Cache::forget('authors_arr');
        }

        adminLog('Авторы', $author->id, 'create');

        if ($result) {
            return redirect()
                ->route('admin.posts.authors.index')
                ->with('flash_success', 'Автор успешно добавлен!');
        }

        return redirect()
            ->route('admin.posts.authors.index')
            ->with('flash_errors', 'Ошибка создания!');
    }

    public function edit($id)
    {
        $author = $this->authorsRepository->getForEdit($id);

        if($author == null){
            return redirect()
                ->route('admin.posts.authors.index')
                ->with('flash_danger', "Попытка отредактировать автора с несуществующим ID = '.$id");
        }

        $breadcrumbs = [
            ['h1' => 'Записи', 'link' => route('admin.posts.posts.index')],
            ['h1' => 'Авторы', 'link' => route('admin.posts.authors.index')],
            ['h1' => 'Редактирование']
        ];

     	return view('admin.posts.authors.edit', compact('author', 'breadcrumbs'));
    }

    public function update(AuthorsRequest $request, $id)
    {
        $data = $request->all();
        $data = empty_str_to_null($data);
        $madia = $this->authorsRepository->getForEdit($id);
        $result = $madia->update($data);

        adminLog('Авторы', $id, 'update');

        if (Cache::has('authors')) {
            Cache::forget('authors');
        }

        if (Cache::has('authors_arr')) {
            Cache::forget('authors_arr');
        }

        if ($result) {
            return redirect()
                ->route('admin.posts.authors.index')
                ->with('flash_success', 'Автор успешно обновлен!');
        }

        return redirect()
            ->route('admin.posts.authors.index')
            ->with('flash_errors', 'Ошибка обновления!');
    }


    public function destroy($id)
    {
        $item = $this->authorsRepository->getForDelete($id);
        $result = $item->delete();

        if (Cache::has('authors')) {
            Cache::forget('authors');
        }

        if (Cache::has('authors_arr')) {
            Cache::forget('authors_arr');
        }

        adminLog('Авторы', $id, 'delete');

        if ($result) {
            return redirect()
                ->route('admin.posts.authors.index')
                ->with('flash_success', 'Автор успешно удалён!');
        }

        return redirect()
            ->route('admin.posts.authors.index')
            ->with('flash_errors', 'Ошибка удаления!');
    }

}
