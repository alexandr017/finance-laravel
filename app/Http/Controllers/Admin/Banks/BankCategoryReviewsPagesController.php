<?php

namespace App\Http\Controllers\Admin\Banks;

use App\Models\Banks\BankCategoryReviewsPage;
use App\Repositories\Admin\Banks\BankRepository;
use App\Repositories\Admin\Banks\BankCategoryReviewsPageRepository;
use App\Http\Requests\Admin\Banks\BankCategoryReviewsPageRequest;

class BankCategoryReviewsPagesController extends BaseBankController
{
    private const MIN_AVERAGE_RATING = 4.0;
    private const MAX_AVERAGE_RATING = 5.0;

    private const MIN_NUMBER_OF_VOTES = 15;
    private const MAX_NUMBER_OF_VOTES = 25;


    private $bank_category_page_repository;

    private $bank_repository;


    public function __construct()
    {
        parent::__construct();

        $this->bank_category_reviews_page_repository = app(BankCategoryReviewsPageRepository::class);
        $this->bank_repository = app(BankRepository::class);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $bankID
     * @param int $parentPageID
     * @return \Illuminate\Http\Response
     */
    public function show($bankID, $parentPageID)
    {
        $item = $this->bank_category_reviews_page_repository->findByParentPageID($parentPageID);

        $breadcrumbs = [
            ['h1' => 'Банки', 'link' => route('admin.banks.banks.index')],
            ['h1' => 'Редактирование', 'link' => route('admin.banks.banks.edit', $bankID)],
            ['h1' => 'Категорийные страницы', 'link' => route('admin.banks.categories.index', $bankID)],
            ['h1' => 'Редактирование', 'link' => route('admin.banks.categories.edit', [$bankID, $parentPageID])],
            ['h1' => 'Редактирование страницы отзывов']
        ];

        return view('admin.banks.categories.reviews', compact('item',  'bankID','parentPageID', 'breadcrumbs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $bankID
     * @param int $parentPageID
     * @param  \App\Http\Requests\admin\Banks\BankCategoryReviewsPageRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($bankID, $parentPageID, BankCategoryReviewsPageRequest $request)
    {
        $data = $request->all();
        $data['bank_category_page_id'] = (int) $parentPageID;
        $data = empty_str_to_null($data);

        $item = BankCategoryReviewsPage::where(['bank_category_page_id' => $parentPageID])
            ->whereNull('deleted_at')
            ->first();

        if ($item == null) {
            $item = new BankCategoryReviewsPage($data);
            $result = $item->save();
        } else {
            $result = $item->update($data);
        }


        adminLog('Страницы отзывов категорийных страниц банка', $item->id, 'update');

        if ($result) {
            return redirect()
                ->route('admin.banks.categories.edit', [$bankID, $parentPageID])
                ->with('flash_success', 'Страница отзывов категорийной страницы банка обновлена!');
        } else {
            return redirect()
                ->route('admin.banks.categories.edit', [$bankID, $parentPageID])
                ->with('flash_errors', 'Ошибка редактирования!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $bankID
     * @param  int  $parentPageID
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($bankID, $parentPageID, $id)
    {
        $item = BankCategoryReviewsPage::findOrFail($id);

        $result = $item->delete();

        adminLog('Страницы отзывов категорийных страниц банка', $id, 'delete');

        if ($result) {
            return redirect()
                ->route('admin.banks.categories.edit', [$bankID, $parentPageID])
                ->with('flash_success', 'Страница отзывов категорийной страницы банка удалена!');
        } else {
            return redirect()
                ->route('admin.banks.categories.edit', [$bankID, $parentPageID])
                ->with('flash_errors', 'Ошибка удаления!');
        }
    }
}
