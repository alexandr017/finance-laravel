<?php

namespace App\Http\Controllers\Site\V3\Banks;

use App\Models\StaticPages\StaticPage;
use App\Repositories\Site\Relinking\RelinkingRepository;
use DB;
use App\Algorithms\Frontend\Cards\CardsBoot;
use App\Algorithms\Frontend\Banks\BankReviews;
use Illuminate\Contracts\View\View;
use App\Repositories\Site\Bank\BankRepository;

class IndexPageBanksController extends BaseBankController
{
    public function render() : View
    {
        $page = StaticPage::findByAlias();

        if ($page == null) {
            abort(404);
        }

        $breadcrumbs = [];
        $breadcrumbs [] = ['h1' => $page->breadcrumb ?? $page->h1];

        $banks = DB::table('banks')->where(['status' => 1])->whereNull('deleted_at')->get();
        $banks = BankReviews::reviewsParse($banks);

        $editLink = null;

        $bankRepository = new BankRepository;

        $cardsRKOIDs = $bankRepository->getTopProductByCategory(2);
        $cardsRKO = CardsBoot::getCardsForListingByIDs($cardsRKOIDs);
        $cardsRKO = $this->arrMerge($cardsRKO, $cardsRKOIDs);

        $cardsCreditsIDs = $bankRepository->getTopProductByCategory(4);
        $cardsCredits = CardsBoot::getCardsForListingByIDs($cardsCreditsIDs);
        $cardsCredits = $this->arrMerge($cardsCredits, $cardsCreditsIDs);

        $cardsCreditCardsIDs = $bankRepository->getTopProductByCategory(5);
        $cardsCreditCards = CardsBoot::getCardsForListingByIDs($cardsCreditCardsIDs);
        $cardsCreditCards = $this->arrMerge($cardsCreditCards, $cardsCreditCardsIDs);

        $cardsDebitCardsIds = $bankRepository->getTopProductByCategory(6);
        $cardsDebitCards = CardsBoot::getCardsForListingByIDs($cardsDebitCardsIds);
        $cardsDebitCards = $this->arrMerge($cardsDebitCards, $cardsDebitCardsIds);

        $cardsMortgageIds = $bankRepository->getTopProductByCategory(10);
        $cardsMortgage = CardsBoot::getCardsForListingByIDs($cardsMortgageIds);
        $cardsMortgage = $this->arrMerge($cardsMortgage, $cardsMortgageIds);

        $cardsDepositIds = $bankRepository->getTopProductByCategory(11);
        $cardsDeposits = CardsBoot::getCardsForListingByIDs($cardsDepositIds);
        $cardsDeposits = $this->arrMerge($cardsDeposits, $cardsDepositIds);

        $reviews =  DB::table('bank_reviews')
            ->leftjoin('banks','banks.id','bank_reviews.bank_id')
            ->select('bank_reviews.*', 'banks.name as bankName', 'banks.logo as bankLogo', 'banks.alias as bankAlias')
            ->where(['bank_reviews.status' => 1, 'bank_reviews.off_answer' => null])
            ->where('bank_reviews.bank_id','!=',0)
            ->whereNotNull('bank_reviews.bank_id')
            ->whereNull('bank_reviews.deleted_at')
            ->orderBy('bank_reviews.id','desc')
            ->limit(10)
            ->get();

        $relinkData = (new RelinkingRepository)->getRelinkForBanks();


        $template = 'site.v3.templates.banks.index';

        return view($template, compact('page','breadcrumbs','banks','relinkData', 'editLink',
            'cardsRKO', 'cardsCredits', 'cardsCreditCards', 'cardsDebitCards', 'cardsMortgage', 'cardsDeposits', 'reviews'
        ));
    }
}
