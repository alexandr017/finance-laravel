<?php

namespace App\Http\Controllers\Site\V3\Listings;

use App\Http\Controllers\Controller;
use App\Models\Banks\Popular;
use App\Models\Cards\Listing;
use App\Repositories\Site\Card\CardRepository;
use App\Repositories\Site\Relinking\RelinkingRepository;
use Illuminate\Contracts\View\View;

class ListingController extends Controller
{

    public function indexZaimy() : View
    {
        return $this->render(1);
    }

    public function indexKredity() : View
    {
        return $this->render(4);
    }

    public function indexKreditnyeKarty() : View
    {
        return $this->render(5);
    }

    public function indexDebetovyeKarty() : View
    {
        return $this->render(6);
    }

    public function indexIpoteki() : View
    {
        return $this->render(10);
    }

    public function indexAvtokredity() : View
    {
        return $this->render(8);
    }

    public function indexVklady() : View
    {
        return $this->render(11);
    }

    public function indexRKO() : View
    {
        return $this->render(2);
    }


    public function zaimy($tagAlias) : View
    {
        return $this->render(1, $tagAlias);
    }

    public function kredity($tagAlias) : View
    {
        return $this->render(4, $tagAlias);
    }

    public function kreditnyeKarty($tagAlias) : View
    {
        return $this->render(5, $tagAlias);
    }

    public function debetovyeKarty($tagAlias) : View
    {
        return $this->render(6, $tagAlias);
    }

    public function ipoteki($tagAlias) : View
    {
        return $this->render( 10, $tagAlias);
    }

    public function avtokredity($tagAlias) : View
    {
        return $this->render( 8, $tagAlias);
    }

    public function vklady($tagAlias) : View
    {
        return $this->render( 11, $tagAlias);
    }

    public function RKO($tagAlias) : View
    {
        return $this->render(2, $tagAlias);
    }


    private function render($categoryID, $tagAlias = '/') : View
    {
        $page = Listing::where(['alias' => $tagAlias, 'category_id' => $categoryID])->first();

        $relinkData = (new RelinkingRepository)->getRelinkByCategory($categoryID);

        if ($page == null) {
            abort(404);
        }

        $card_repository = new CardRepository;

        if ($tagAlias == '/') {
            $cards = $card_repository->getProductForSection($categoryID);
        } elseif ($page->id != 0) {
            $cards = $card_repository->getSortedCards($page->id);
            //dd($cards);
        } else {
            $cards = [];
        }

        if ($tagAlias != '/') {
            $parentBreadcrumbs = $this->getParentBreadcrumbsBuCategoryID((int) $page->category_id);
            $breadcrumbs = [
                [...$parentBreadcrumbs],
                ['h1' => $page->h1]
            ];
        } else {
            $breadcrumbs = [
                ['h1' => $page->h1]
            ];
        }


        $popularBanks = Popular::where(['category_id'=> $page->category_id])->first();

        $blade =  'site.v3.templates.listings.listing';

        $editLink = null;

        return view($blade, compact(['page', 'breadcrumbs', 'cards', 'popularBanks', 'relinkData', 'editLink', 'categoryID']));
    }

    private function getParentBreadcrumbsBuCategoryID(int $categoryID) : array
    {
        return match($categoryID){
            1 => ['link' => '/zaimy', 'h1' => 'Займы'],
            2 => ['link' => '/rko', 'h1' => 'РКО'],
            4 => ['link' => '/kredity', 'h1' => 'Кредиты'],
            5 => ['link' => '/kreditnye-karty', 'h1' => 'Кредитные карты'],
            6 => ['link' => '/debetovye-karty', 'h1' => 'Дебетовые карты'],
            8 => ['link' => '/avtokredity', 'h1' => 'Автокредиты'],
            10 => ['link' => '/ipoteki', 'h1' => 'Ипотеки'],
            11 => ['link' => '/vklady', 'h1' => 'Вклады'],
            default => ['link' => '', 'h1' => '']
        };
    }

}