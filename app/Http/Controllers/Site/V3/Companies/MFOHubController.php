<?php


namespace App\Http\Controllers\Site\V3\Companies;

use App\Http\Controllers\Controller;
use App\Models\Cards\CardsCategories;
use App\Models\Cards\Cards;
use App\Algorithms\Frontend\Cards\CardsBoot;
use App\Models\StaticPages\StaticPage;
use App\Repositories\Site\Relinking\RelinkingRepository;



class MFOHubController extends Controller
{
    public function index()
    {
        $categoryID = 1; // const

        $page = StaticPage::findByAlias();

        if ($page == null) {
            abort(404);
        }

        $breadcrumbs = [['h1' => $page->breadcrumb ?? $page->h1]];

        $card_category = CardsCategories::find($categoryID);

        $relinkData = (new (RelinkingRepository::class))->getRelinkByCategory($categoryID);


        $cards =  $this->getSortedMfoCards($categoryID, 'km5', 'desc');

            $blade = (!is_amp_page()) ? 'site.v3.templates.companies.hub.mfo' : 'site.v3.templates.companies.companies.hub-amp';

        return view($blade, compact('categoryID','breadcrumbs',
            'cards', 'relinkData', 'page'));

    }



    private function getSortedMfoCards($cardCategoryID, $field = 'km5', $sort = 'desc')
    {
        $cards = Cards::where(['cards.show_in_habs' => 1,'cards.category_id' => $cardCategoryID, 'cards.status' => 1])
            ->select('id','category_id')
            ->orderBy('flow')
            ->orderBy($field,$sort)
            ->orderBy('cards.id','asc')
            ->get();

        return  CardsBoot::getCardsForListingByIDs($cards);
    }

}
