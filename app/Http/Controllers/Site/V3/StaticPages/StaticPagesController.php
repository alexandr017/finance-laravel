<?php

namespace App\Http\Controllers\Site\V3\StaticPages;

use App\Http\Controllers\Controller;
use App\Models\Cards\Cards;
use App\Repositories\Site\Relinking\RelinkingRepository;
use DB;
use App\Models\StaticPages\StaticPage;
use App\Algorithms\Frontend\Cards\CardsBoot;
use Illuminate\Contracts\View\View;
use App\Repositories\Site\Card\CardRepository;
use App\Repositories\Site\Blog\PostRepository;


class StaticPagesController extends Controller
{
    public function index() : View
    {
        $page = StaticPage::findByAlias();

        if ($page == null) {
            abort(404);
        }

        $cardRepository = new CardRepository;
        $loans = $cardRepository->getProductForIndex(1);
        $rko = $cardRepository->getProductForIndex(2);
        $credits = $cardRepository->getProductForIndex(4);
        $creditCards = $cardRepository->getProductForIndex(5);
        $debitCards = $cardRepository->getProductForIndex(6);
        $autoCredits = $cardRepository->getProductForIndex(8);
        $mortgage = $cardRepository->getProductForIndex(10);
        $deposits = $cardRepository->getProductForIndex(11);

        $postRepository = new PostRepository;
        $news = $postRepository->getNewsForIndex();
        $articles = $postRepository->getArticlesForIndex();

        $reviewsCompany = DB::table('companies_reviews')
            ->leftJoin('companies', 'companies.id', 'companies_reviews.company_id')
            ->select('companies_reviews.*', 'companies.company_name as companyName', 'companies.alias')
            ->where(['companies_reviews.status' => 1, 'off_answer' => null, 'companies.status' => 1, 'companies.closed' => 0])
            ->where('companies_reviews.rating', '>', 2)
            ->orderBy('companies_reviews.created_at', 'desc')
            ->limit(10)
            ->get();

        $reviewsBank = DB::table('bank_reviews')
            ->leftjoin('banks', 'banks.id', 'bank_reviews.bank_id')
            ->select('bank_reviews.*', 'banks.name as bankName', 'banks.alias as bankAlias')
            ->where(['bank_reviews.status' => 1, 'bank_reviews.off_answer' => null, 'banks.status' => 1])
            ->where('bank_reviews.bank_id', '!=', 0)
            ->where('bank_reviews.rating', '>', 2)
            ->whereNotNull('bank_reviews.bank_id')
            ->whereNull('bank_reviews.deleted_at')
            ->orderBy('bank_reviews.created_at', 'desc')
            ->limit(10)
            ->get();
        $reviews = $reviewsCompany->merge($reviewsBank)->toArray();
        shuffle($reviews);


        return view('site.v3.templates.static-pages.index', compact('page', 'loans', 'autoCredits',
        'debitCards', 'creditCards', 'credits', 'rko', 'mortgage', 'deposits', 'news', 'articles', 'reviews'));
    }

    public function mfo() : View
    {
        $categoryID = 1;

        $page = StaticPage::findByAlias();

        if ($page == null) {
            abort(404);
        }

        $breadcrumbs = [['h1' => $page->breadcrumb ?? $page->h1]];

        $relinkData = (new (RelinkingRepository::class))->getRelinkByCategory($categoryID);

        $cards = Cards::where(['cards.show_in_habs' => 1,'cards.category_id' => $categoryID, 'cards.status' => 1])
            ->select(['id','category_id'])
            ->orderBy('flow')
            ->orderBy('km5','desc')
            ->orderBy('cards.id')
            ->get();
        $cards = CardsBoot::getCardsForListingByIDs($cards);

        $blade = 'site.v3.templates.companies.hub.mfo';

        return view($blade, compact('categoryID','breadcrumbs', 'cards', 'relinkData', 'page'));
    }

    public function render() : View
    {
        $page = StaticPage::findByAlias();

        if ($page == null) {
            abort(404);
        }

        $breadcrumbs = [['h1' => $page->breadcrumbs ?? $page->h1]];

        return view('site.v3.templates.static-pages.page', compact('page', 'breadcrumbs'));
    }
}
