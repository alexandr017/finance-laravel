<?php

namespace App\Http\Controllers\Admin\StaticPages;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\Admin\StaticPages\StaticPageRequest;
use App\Models\StaticPages\StaticPage;
use App\Repositories\Admin\StaticPages\StaticPageRepository;
use Illuminate\Http\Request;

class StaticPagesController extends AdminController
{
    private const min_average_rating = 4.0;
    private const max_average_rating = 5.0;

    private const min_number_of_votes = 15;
    private const max_number_of_votes = 25;


    public function __construct()
    {
        $this->staticPageRepository = app(StaticPageRepository::class);
    }

    public function index()
    {
        $staticPages = $this->staticPageRepository->getForShow();

        return view('admin.static-pages.index', compact('staticPages'));
    }

    public function create()
    {
        return view('admin.static-pages.create');
    }

    public function store(StaticPageRequest $request)
    {
        $data = $request->all();

        $data['average_rating'] = (self::min_average_rating + (self::max_average_rating - self::min_average_rating) * (mt_rand() / mt_getrandmax()));
        $data['number_of_votes'] = rand(self::min_number_of_votes, self::max_number_of_votes);

        $data = empty_str_to_null($data);

        $item = new StaticPage($data);

        $result = $item->save();

//        adminLog('Static page', $item->id, 'create');

        if ($result) {
            return redirect()
                ->route('admin.static-pages.index')
                ->with('flash_success', 'Листинг создан!');
        }

        return redirect()
            ->route('admin.static-pages.index')
            ->with('flash_errors', 'Ошибка создания!');
    }

    public function edit(string $id)
    {
        $item = $this->staticPageRepository->findOrFail($id);

        return view('admin.static-pages.edit', compact('item'));
    }

    public function update(StaticPageRequest $request, string $id)
    {
        $item = $this->staticPageRepository->findOrFail($id);

        $data = $request->all();

        $data = empty_str_to_null($data);

        $result = $item->update($data);

//        adminLog('Static page', $item->id, 'update');

        if ($result) {
            return redirect()
                ->route('admin.static-pages.index')
                ->with('flash_success', 'Листинг создан!');
        }

        return redirect()
            ->route('admin.static-pages.index')
            ->with('flash_errors', 'Ошибка создания!');
    }

    public function destroy(string $id)
    {
        $item = $this->staticPageRepository->findOrFail($id);

        $result = $item->delete();

//        adminLog('Static page', $id, 'delete');

        if ($result) {
            return redirect()
                ->route('admin.static-pages.index')
                ->with('flash_success', 'Листинг удален!');
        }

        return redirect()
            ->route('admin.static-pages.index')
            ->with('flash_errors', 'Ошибка удаления!');
    }
}
