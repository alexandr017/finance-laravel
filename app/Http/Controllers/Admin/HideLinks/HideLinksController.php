<?php

namespace App\Http\Controllers\Admin\HideLinks;

use App\Models\HideLinks\HideLinks;
use App\Repositories\Admin\HideLinks\HideLinksRepository;
use App\Repositories\Admin\AffiliateProgram\AffiliateProgramRepository;
use App\Http\Requests\Admin\HideLinks\HideLinksRequests;

class HideLinksController extends BaseHideLinksController
{
    /**
     * @var HideLinksRepository
     */
    private $hideLinksRepository;

    /**
     * @var AffiliateProgramRepository
     */
    private $affiliateProgramRepository;

    public function __construct()
    {
        parent::__construct();

        $this->hideLinksRepository = app(HideLinksRepository::class);
        $this->affiliateProgramRepository = app(AffiliateProgramRepository::class);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $items = $this->isSuperAdmin()
//            ? $this->hideLinksRepository->getAllHideLinks()
//            : $this->hideLinksRepository->getOnlyReserveHideLinks();

        $items = $this->hideLinksRepository->getAllHideLinks();

        $breadcrumbs = [
            ['h1' => 'Скрытые ссылки']
        ];

        return view('admin.hide_links.index', compact('items', 'breadcrumbs'));
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function create()
    {
        $affiliatePrograms = $this->affiliateProgramRepository->getAffiliatePrograms();

        $breadcrumbs = [
            ['h1' => 'Скрытые ссылки', 'link' => route('admin.hide_links.index')],
            ['h1' => 'Создание']
        ];

        return view('admin.hide_links.create',compact('affiliatePrograms', 'breadcrumbs'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param HideLinksRequests $request
     * @return mixed
     */
    public function store(HideLinksRequests $request)
    {
        $data = $request->all();

//        if ($this->isAdmin()) {
//            $data['permission_type'] = 0;
//        }

        $item = new HideLinks($data);
        $item->save();

        adminLog('Скрытые ссылки', $item->id, 'create');

        return redirect()
            ->route('admin.hide_links.index')
            ->with('flash_success', 'Ссылка успешна добавлена!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // для обычных админов не даем доступ к редактирования основных скрытых ссылок
//        if ($this->isAdmin()) {
//            if (! $this->hideLinksRepository->checkPermissionForAdmin($id)) {
//                $this->abort();
//            }
//
//        }

        $affiliatePrograms = $this->affiliateProgramRepository->getAffiliatePrograms();

        $item = $this->hideLinksRepository->getForEditOrFail($id);

        $breadcrumbs = [
            ['h1' => 'Скрытые ссылки', 'link' => route('admin.hide_links.index')],
            ['h1' => 'Редактирование']
        ];

     	return view('admin.hide_links.edit',compact('affiliatePrograms','item', 'breadcrumbs'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HideLinksRequests $request,  $id)
    {
        $item = $this->hideLinksRepository->getForEdit($id);

        if(empty($item)){
            return redirect()
                ->route('admin.hide_links.index')
                ->with('flash_errors', 'Ссылка не найдена');
        }

        // для обычных админов не даем доступ к редактирования основных скрытых ссылок
//        if ($this->isAdmin()) {
//            if (! $this->hideLinksRepository->checkPermissionForAdmin($id)) {
//                $this->abort();
//            }
//            $data['permission_type'] = 0;
//        }

        $data = $request->all();

        $result = $item->update($data);

        adminLog('Скрытые ссылки', $id, 'update');

        if ($result) {
            return redirect()
                ->route('admin.hide_links.index')
                ->with('flash_success', 'Ссылка успешно обновлена!');
        } else {
            return redirect()
                ->route('admin.hide_links.index')
                ->with('flash_errors', 'Ошибка редактирования');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // для обычных админов не даем доступ к редактирования основных скрытых ссылок
//        if ($this->isAdmin()) {
//            if (! $this->hideLinksRepository->checkPermissionForAdmin($id)) {
//                $this->abort();
//            }
//        }

        $result = HideLinks::destroy($id);

        adminLog('Скрытые ссылки', $id, 'delete');

        if ($result) {
            return redirect()
                ->route('admin.hide_links.index')
                ->with('flash_success', 'Ссылка успешна удалена!');
        } else {
            return redirect()
                ->route('admin.hide_links.index')
                ->with('flash_errors', 'Ошибка удаления');
        }
    }

}
