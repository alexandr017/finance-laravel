<?php

namespace App\Http\Controllers\Admin\Cards;

use Illuminate\Http\Request;
use App\Models\Cards\ListingCards;
use App\Repositories\Admin\Cards\CardsRepository;
use App\Repositories\Admin\Cards\ListingCardsRepository;

class ListingCardsController extends BaseCardsController
{
    public function edit($id,
                         CardsRepository $cards_repository,
                         ListingCardsRepository $listing_cards_repository
    )
    {
        $cards = $cards_repository->getForCheckboxByCategories($id);
        $selected_cards = $listing_cards_repository->getForCheckboxes($id);

        $breadcrumbs = [
            ['h1' => 'Карточки', 'link' => route('admin.cards.cards.index')],
            ['h1' => 'Категории', 'link' => route('admin.cards.categories.index')],
            ['h1' => 'Список листингов', 'link' => route('admin.cards.listings.index')],
            ['h1' => 'Редактирование', 'link' => route('admin.cards.listings.edit', $id)],
            ['h1' => 'Расстановка карточек']
        ];

        return view('admin.cards.listings.cards',compact('id', 'cards','selected_cards','breadcrumbs'));
    }

    public function update(Request $request, $id)
    {
        ListingCards::where(['listing_id' => $id])->delete();

        if ($request['listings'] != null) {

            foreach ($request['listings'] as $card_id) {

                $data = [
                    'card_id' => $card_id,
                    'listing_id' => $id
                ];

                $item = new ListingCards($data);

                $item->save();

            }
        }

        adminLog('Привязка карточек к листингу', $id, 'update');

        return redirect()
            ->route('admin.cards.listings.index')
            ->with('flash_success', 'Листинг обновлен!');

    }

}
