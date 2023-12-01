<?php

namespace App\Http\Controllers\Admin\Posts;

use Illuminate\Http\Request;
use App\Models\Posts\PostsComments;
use App\Repositories\Admin\Posts\PostRepository;
use App\Repositories\Admin\Posts\AuthorsRepository;
use App\Repositories\Admin\Posts\PostCommentRepository;
use App\Http\Requests\Admin\Posts\CommentRequest;

class PostsCommentsController extends BasePostController
{
    public function __construct()
    {
        parent::__construct();
        $this->postCommentRepository = app(PostCommentRepository::class);
        $this->postRepository = app(PostRepository::class);
        $this->authorsRepository = app(AuthorsRepository::class);
    }

    public function index()
    {
    	$postsComments = $this->postCommentRepository->getForShow();

        $breadcrumbs = [
            ['h1' => 'Записи', 'link' => route('admin.posts.posts.index')],
            ['h1' => 'Комментарии']
        ];

        return view('admin.posts.comments.index', compact('postsComments', 'breadcrumbs'));
    }

   	public function create()
    {
        $postsArr = $this->postRepository->getForComments();
        $vzoAuthors = $this->authorsRepository->getForComments();

        $breadcrumbs = [
            ['h1' => 'Записи', 'link' => route('admin.posts.posts.index')],
            ['h1' => 'Комментарии', 'link' => route('admin.posts.comments.index')],
            ['h1' => 'Создание']
        ];

        return view('admin.posts.comments.create', compact('postsArr','vzoAuthors', 'breadcrumbs'));
    }

    public function store(CommentRequest $request)
    {
        $data = $request->all();
        $data = empty_str_to_null($data);

        $data['comment'] = preg_replace('/(?:"([^>]*)")(?!>)/', '«$1»', $data['comment']);
        $data['comment'] = preg_replace('/(?:"([^>]*)")(?!>)/', '«$1»', $data['comment']);

        $comment = new PostsComments($data);
        $result = $comment->save();

        if ($result) {
            adminLog('Комментарий', $comment->id, 'create');

            return redirect()
                ->route('admin.posts.comments.index')
                ->with('flash_success', 'Комментарий успешно добавлен!');
        }

        return redirect()
            ->route('admin.posts.comments.index')
            ->with('flash_errors', 'Ошибка создания!');
    }

    public function edit($id)
    {
        $postComments = $this->postCommentRepository->getForEdit($id);
        $postsArr = $this->postRepository->getForComments();
        $vzoAuthors = $this->authorsRepository->getForComments();

        $breadcrumbs = [
            ['h1' => 'Записи', 'link' => route('admin.posts.posts.index')],
            ['h1' => 'Комментарии', 'link' => route('admin.posts.comments.index')],
            ['h1' => 'Редактирование']
        ];

        return view('admin.posts.comments.edit', compact('postComments', 'postsArr', 'vzoAuthors', 'breadcrumbs'));
    }

    public function update(CommentRequest $request, $id)
    {
        $data = $request->all();
        $data = empty_str_to_null($data);

        $data['comment'] = preg_replace('/(?:"([^>]*)")(?!>)/', '«$1»', $data['comment']);
        $data['comment'] = preg_replace('/(?:"([^>]*)")(?!>)/', '«$1»', $data['comment']);

        $comment = $this->postCommentRepository->getForEdit($id);
        $result = $comment->update($data);

        if ($result) {
            adminLog('Комментарий', $comment->id, 'update');

            return redirect()
                ->route('admin.posts.comments.index')
                ->with('flash_success', 'Комментарий успешно обновлен!');
        }

        return redirect()
            ->route('admin.posts.comments.index')
            ->with('flash_errors', 'Ошибка обновления!');
    }


    public function destroy($id)
    {
        $item = $this->postCommentRepository->getForDelete($id);

        $result = $item->delete();

        if ($result) {
            adminLog('Комментарии', $id, 'delete');

            return redirect()
                ->route('admin.posts.comments.index')
                ->with('flash_success', 'Комментарий успешно удалён!');
        }

        return redirect()
            ->route('admin.posts.comments.index')
            ->with('flash_errors', 'Ошибка удаления!');
    }

    public function comments_by_post($id)
    {
        $postsComments = $this->postCommentRepository->getForShow($id);

        return view('admin.posts.comments.index', compact('postsComments'));
    }


    public function search(Request $request)
    {
        $search = clear_data($request['search']);

        $postsComments = $this->postCommentRepository->getForSearch($search);

        return view('admin.posts.comments.index', compact('postsComments','search'));
    }

    public function change_status($id)
    {
        $postComments = $this->postCommentRepository->getForEdit($id);
        $postComments->status = ($postComments->status == 1) ? 0 : 1;
        $postComments->save();

//        Log::alert("Администратор c ID ". Auth::id() . " изменил статус комментария '$id'");

        return redirect()
            ->route('admin.posts.comments.index')
            ->with('flash_success', 'Статус успешно изменен!');
    }

}
