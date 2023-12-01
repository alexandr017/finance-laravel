<?php

namespace App\Http\Controllers\Admin\Posts;

use App\Repositories\Admin\Posts\PostTagRepository;
use App\Repositories\Admin\Posts\PostCategoryRepository;
use App\Http\Requests\Admin\Posts\PostsTagRequest;
use App\Models\Posts\PostsTag;

class PostTagsController extends BasePostController
{
    private $postTagRepository;
    private $postCategoryRepository;

    public function __construct()
    {
        $this->postTagRepository = new PostTagRepository;
        $this->postCategoryRepository = new PostCategoryRepository;
    }


    public function index()
    {
        $items = $this->postTagRepository->getForShow();

        $breadcrumbs = [
            ['h1' => 'Записи', 'link' => route('admin.posts.posts.index')],
            ['h1' => 'Теги']
        ];

        return view('admin.posts.tags.index', compact('items', 'breadcrumbs'));
    }


    public function create()
    {
        $categoriesArr = $this->postCategoryRepository->getForSelect();
        $tagsArr = $this->postTagRepository->getForSelectByCategories();

        $breadcrumbs = [
            ['h1' => 'Записи', 'link' => route('admin.posts.posts.index')],
            ['h1' => 'Теги', 'link' => route('admin.posts.tags.index')],
            ['h1' => 'Создание']
        ];

        return view('admin.posts.tags.create', compact('categoriesArr', 'tagsArr', 'breadcrumbs'));
    }


    public function store(PostsTagRequest $request)
    {
        $data = $request->all();
        $data = empty_str_to_null($data);

        $item = new PostsTag($data);

        $result = $item->save();

        adminLog('Теги записей', $item->id, 'create');

        if ($result) {
            return redirect()
                ->route('admin.posts.tags.index')
                ->with('flash_success', 'Тег создан!');
        } else {
            return redirect()
                ->route('admin.posts.tags.index')
                ->with('flash_errors', 'Ошибка создания!');
        }
    }


    public function edit($id)
    {
        $item = $this->postTagRepository->getForEdit($id);

        $categoriesArr = $this->postCategoryRepository->getForSelect();

        $tagsArr = [];
        if (!PostsTag::where('parent_id', $id)->exists()) {
            $tagsArr = $this->postTagRepository->getForSelectByCategories();
        }

        $breadcrumbs = [
            ['h1' => 'Записи', 'link' => route('admin.posts.posts.index')],
            ['h1' => 'Теги', 'link' => route('admin.posts.tags.index')],
            ['h1' => 'Редактирование']
        ];

        return view('admin.posts.tags.edit', compact('item', 'categoriesArr', 'tagsArr', 'breadcrumbs'));
    }


    public function update(PostsTagRequest $request, $id)
    {
        $item = $this->postTagRepository->getForEdit($id);

        if ($item == null) {
            abort(404);
        }

        $data = $request->all();
        $data = empty_str_to_null($data);

        $result = $item->update($data);

        adminLog('Теги записей', $id, 'update');

        if ($result) {
            return redirect()
                ->route('admin.posts.tags.index')
                ->with('flash_success', 'Тег обновлен!');
        } else {
            return redirect()
                ->route('admin.posts.tags.index')
                ->with('flash_errors', 'Ошибка редактирования!');
        }
    }


    public function destroy($id)
    {
        $item = PostsTag::find($id);

        if ($item == null) {
            abort(404);
        }

        $result = $item->delete();

        adminLog('Теги записей', $id, 'delete');

        if ($result) {
            return redirect()
                ->route('admin.posts.tags.index')
                ->with('flash_success', 'Тег удален!');
        } else {
            return redirect()
                ->route('admin.posts.tags.index')
                ->with('flash_errors', 'Ошибка удаления!');
        }
    }
}