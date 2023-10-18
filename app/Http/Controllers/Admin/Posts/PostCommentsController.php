<?php

namespace App\Http\Controllers\Admin\Posts;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\Admin\Posts\PostCommentRequest;
use App\Repositories\Admin\Posts\PostsRepository;
use App\Repositories\Admin\Posts\PostCommentsRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class PostCommentsController extends AdminController
{
    private mixed $postsRepository;
    private mixed $postCommentsRepository;

    public function __construct()
    {
        $this->postsRepository = new PostsRepository;
        $this->postCommentsRepository = new PostCommentsRepository;
    }

    /**
     * Display a listing of the resource.
     * @return View
     */
    public function index() : View
    {
        $comments = $this->postCommentsRepository->getAllCommentsForShow();

        $breadcrumbs = [['h1' => 'Комментарии']];

        return view('admin.v2.posts.comments.index', compact('comments', 'breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     * @return View
     */
    public function create() : View
    {
        $posts = $this->postsRepository->getPostsForSelect();

        $breadcrumbs = [
            ['h1' => 'Комментарии', 'link' => route('admin.post-comments.index')],
            ['h1' => 'Создание']
        ];

        return view('admin.v2.posts.comments.create', compact( 'posts', 'breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     * @param PostCommentRequest $request
     * @return RedirectResponse
     */
    public function store(PostCommentRequest $request) : RedirectResponse
    {
        $errors = $request->getErrors();
        if (count($errors) > 0) {
            return back()->withInput()->with('flash_warning', json_encode($errors));
        }

        $data = $request->all();
        $data = emptyDataToNull($data);
        $result = $this->postCommentsRepository->createComment($data);

        if ($result) {
            return redirect()
                ->route('admin.post-comments.index')
                ->with('flash_success', 'Комментарий создан!');
        } else {
            return redirect()
                ->route('admin.post-comments.index')
                ->with('flash_errors', 'Ошибка создания!');
        }
    }


    /**
     * Show the form for editing the specified resource.
     * @param string $id
     * @return View
     */
    public function edit(string $id) : View
    {
        $item = $this->postCommentsRepository->find($id);

        if ($item == null) {
            abort(404);
        }

        $posts = $this->postsRepository->getPostsForSelect();

        $breadcrumbs = [
            ['h1' => 'Комментарии', 'link' => route('admin.post-comments.index')],
            ['h1' => 'Редактирование'],
        ];

        return view('admin.v2.posts.comments.edit', compact('item', 'breadcrumbs', 'posts'));
    }

    /**
     * Update the specified resource in storage.
     * @param PostCommentRequest $request
     * @param string $id
     * @return RedirectResponse
     */
    public function update(PostCommentRequest $request, string $id) : RedirectResponse
    {
        $errors = $request->getErrors();
        if (count($errors) > 0) {
            return back()->withInput()->with('flash_warning', json_encode($errors));
        }

        $data = $request->all();
        $data = emptyDataToNull($data);
        $result = $this->postCommentsRepository->updateComment($id, $data);

        if ($result) {
            return redirect()
                ->route('admin.post-comments.index')
                ->with('flash_success', 'Комментарий обнавлен!');
        } else {
            return redirect()
                ->route('admin.post-comments.index')
                ->with('flash_errors', 'Ошибка обновления!');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param string $id
     * @return RedirectResponse
     */
    public function destroy(string $id) : RedirectResponse
    {
        $result = $this->postCommentsRepository->deleteComment($id);

        if ($result) {
            return redirect()
                ->route('admin.post-comments.index')
                ->with('flash_success', 'Комментарий удален!');
        } else {
            return redirect()
                ->route('admin.post-comments.index')
                ->with('flash_errors', 'Ошибка удаления!');
        }
    }
}
