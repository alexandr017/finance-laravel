<?php

namespace App\Http\Controllers\Admin\Banks;

use App\Models\Banks\BankProductReviewsPage;
use App\Repositories\Admin\Banks\BankRepository;
use App\Repositories\Admin\Banks\BankProductReviewsPageRepository;
use App\Http\Requests\Admin\Banks\BankProductReviewsPageRequest;

class BankProductsReviewsPagesController extends BaseBankController
{
    private $bank_repository;

    public function __construct()
    {
        parent::__construct();

        $this->bank_product_reviews_page_repository = app(BankProductReviewsPageRepository::class);
        $this->bank_repository = app(BankRepository::class);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $bankID
     * @param int $parentPageID
     * @return \Illuminate\Http\Response
     */
    public function show($bankID,$categoryID, $parentPageID)
    {
        $item = $this->bank_product_reviews_page_repository->findByParentPageID($parentPageID);

        $breadcrumbs = [
            ['h1' => 'Банки', 'link' => route('admin.banks.banks.index')],
            ['h1' => 'Редактирование', 'link' => route('admin.banks.banks.edit', $bankID)],
            ['h1' => 'Категорийные страницы', 'link' => route('admin.banks.categories.index', $bankID)],
            ['h1' => 'Редактирование', 'link' => route('admin.banks.categories.edit', [$bankID, $categoryID])],
            ['h1' => 'Продукты', 'link' => route('admin.banks.products.index', [$bankID, $categoryID])],
            ['h1' => 'Редактирование', 'link' => route('admin.banks.products.edit', [$bankID, $categoryID, $parentPageID])],
            ['h1' => 'Редактирование страницы отзывов']
        ];

        return view('admin.banks.products.reviews', compact('item',  'bankID','parentPageID','categoryID','breadcrumbs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $bankID
     * @param int $parentPageID
     * @param  \App\Http\Requests\admin\Banks\BankProductReviewsPageRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($bankID,$parentPageID,$categoryID, BankProductReviewsPageRequest $request)
    {
        $data = $request->all();
        $data['bank_product_id'] = (int) $parentPageID;
        $data = empty_str_to_null($data);
        $item = BankProductReviewsPage::where(['bank_product_id' => $parentPageID])
            ->whereNull('deleted_at')
            ->first();
        if ($item == null) {
            $item = new BankProductReviewsPage($data);
            $result = $item->save();
        } else {
            $result = $item->update($data);
        }

        adminLog('Страницы отзывов продуктов банков', $item->id, 'update');

        if ($result) {
            return redirect()
                ->route('admin.banks.products.edit', [$bankID,$categoryID,$parentPageID])
                ->with('flash_success', 'Страница отзывов продукта банка обновлена!');
        } else {
            return redirect()
                ->route('admin.banks.products.edit', [$bankID,$categoryID,$parentPageID])
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
    public function destroy($bankID, $product_id,$category_id, $reviewsId)
    {
        $item = BankProductReviewsPage::findOrFail($reviewsId);
        $result = $item->delete();

        adminLog('Страницы отзывов продуктов банков', $reviewsId, 'delete');

        if ($result) {
            return redirect()
                ->route('admin.banks.products.edit', [$bankID,$category_id,$product_id])
                ->with('flash_success', 'Страница отзывов продукта банка удалена!');
        } else {
            return redirect()
                ->route('admin.banks.products.edit', [$bankID,$category_id,$product_id])
                ->with('flash_errors', 'Ошибка удаления!');
        }
    }
}
