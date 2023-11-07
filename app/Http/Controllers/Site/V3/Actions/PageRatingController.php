<?php
/*
    Здесь описана вся обработка системы голосования ВЗО.
    Модуль голосования бывает 2ух типов:
        - непосредственно голосуемым
        - рассчитывается на основе кол-во и рейтинга отзывов
    В данном файле описана логика только первого типа.
    В свою очередь первый тип по степени хранения голосов и рейтинга может быть 2ух подтипов:
        - страница привязана к опредлеенной сущности
        - страница физически не имеет сущности.
    Ниже представлены списки из обоих подтипов.
    Сначала идет название типа сущности, далее в квадратных кавычках название таблицы где это хранится.
    Если это тип без физический страниц мы заранее знаем его id в таблице.

    index [seo_for_pages]
    mfo [seo_for_pages]
    category-listing [cards_categories] Cache
    old-listing [cards_children_pages]
    listing [listings]
    listing-two-level [cards_children_pages_level_2]
    translation [translations]
    banks-index [seo_for_pages]
    insurance-index [seo_for_pages]
    insurance-category [insurance_categories] todo Доделать!!!
    insurance-listing [insurance_pages] todo Доделать!!!
    post [posts]
    qa-index [seo_for_pages]
    qa-tag [qa_tags]
    qa-question [qa_questions]
    about-index [seo_for_pages]
    about-experts [seo_for_pages]
    about-team [seo_for_pages]
    about-employee [authors]
    about-expert [experts]
    about-k5m [seo_for_pages]
    contacts-index [seo_for_pages]
    services-index [seo_for_pages]
    services-personal-data [seo_for_pages]
    services-unsubscribing [seo_for_pages]
    services-credit-history [seo_for_pages]
*/
namespace App\Http\Controllers\Site\V3\Actions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageRatingController extends Controller
{
    const MAX_RATING = 5;
    const MIN_RATING = 1;

    public function addVote(Request $request)
    {
        $id = (int) clear_data($request['id']);
        $type = clear_data($request['type']);
        $rating = clear_data($request['rating']);

        if ($rating > self::MAX_RATING || $rating < self::MIN_RATING) {
            return 'Ошибка голосования';
        }

        switch ($type) {
            case 'index': return $this->pushVote('\App\Models\StaticPages\StaticPage', 4, $rating);
            case 'mfo': return $this->pushVote('\App\Models\StaticPages\StaticPage', 2, $rating);
            case 'category-listing': return $this->pushVote('\App\Models\Cards\CardsCategories', $id, $rating, 'cards_categories');
            case 'old-listing': return $this->pushVote('\App\Models\Cards\CardsChildrenPages', $id, $rating);
            case 'listing': return $this->pushVote('\App\Models\Cards\Listing', $id, $rating);
            case 'translation': return $this->pushVote('\App\Models\Translation\Translation', $id, $rating);
            case 'banks-index': return $this->pushVote('\App\Models\StaticPages\StaticPage', 5, $rating);
            case 'insurance-index': return $this->pushVote('\App\Models\StaticPages\StaticPage', 6, $rating);
            case 'insurance-category': return $this->pushVote('\App\Models\Insurance\InsuranceCategories', $id, $rating);
            case 'insurance-listing': return $this->pushVote('\App\Models\Insurance\InsurancePages', $id, $rating);
            case 'post': return $this->pushVote('\App\Models\Posts\Posts', $id, $rating);
            case 'qa-index': return $this->pushVote('\App\Models\StaticPages\StaticPage', 7, $rating);
            case 'qa-tag': return $this->pushVote('\App\Models\QA\QATag', $id, $rating);
            case 'qa-question': return $this->pushVote('\App\Models\QA\QAQuestion', $id, $rating);
            case 'about-index': return $this->pushVote('\App\Models\StaticPages\StaticPage', 8, $rating);
            case 'about-experts': return $this->pushVote('\App\Models\StaticPages\StaticPage', 9, $rating);
            case 'about-team': return $this->pushVote('\App\Models\StaticPages\StaticPage', 10, $rating);
            case 'about-employee': return $this->pushVote('\App\Models\Posts\Authors', $id, $rating);
            case 'about-expert': return $this->pushVote('\App\Models\Expert\Expert', $id, $rating);
            case 'about-k5m': return $this->pushVote('\App\Models\StaticPages\StaticPage', 11, $rating);
            case 'contacts-index': return $this->pushVote('\App\Models\StaticPages\StaticPage', 12, $rating);
            case 'services-index': return $this->pushVote('\App\Models\StaticPages\StaticPage', 13, $rating);
            case 'services-personal-data': return $this->pushVote('\App\Models\StaticPages\StaticPage', 14, $rating);
            case 'services-unsubscribing': return $this->pushVote('\App\Models\StaticPages\StaticPage', 15, $rating);
            case 'services-credit-history': return $this->pushVote('\App\Models\StaticPages\StaticPage', 16, $rating);
            case 'business': return $this->pushVote('\App\Models\StaticPages\StaticPage', 18, $rating);
            case 'franchise': return $this->pushVote('\App\Models\StaticPages\StaticPage', 19, $rating);
            case 'franchise-category': return $this->pushVote('\App\Models\Franchises\FranchiseCategory', $id, $rating);
            case 'mortgage-calculator': return $this->pushVote('\App\Models\StaticPages\StaticPage', 20, $rating);
            case 'currency': return $this->pushVote('\App\Models\StaticPages\StaticPage', 21, $rating);
            case 'currency-converter': return $this->pushVote('\App\Models\StaticPages\StaticPage', 22, $rating);
            case 'currency-cb-rf': return $this->pushVote('\App\Models\StaticPages\StaticPage', 23, $rating);
            case 'currency-ticker': return $this->pushVote('\App\Models\Currency\CurrencyPage', $id, $rating);
            case 'listing_children_page': return $this->pushVote('\App\Models\Companies\CompaniesChildrenPages', $id, $rating);
        }
    }

    /**
     * @param string $model
     * @param integer $id
     * @param integer $rating
     * @return string
     */
    private function pushVote($model, $id, $rating, $cache = null)
    {
        $object = $model::find($id);

        if($object == null) {
            return 'Ошибка голосования';
        }

        $current_average_rating = $object->average_rating;
        $current_number_of_votes = $object->number_of_votes;
        //(ср.рейт*кол-во оценок + новая оценка)/(кол-во оценок + 1)
        $new_average_rating = ($current_average_rating * $current_number_of_votes + $rating) / ($current_number_of_votes + 1);
        $object->average_rating = $new_average_rating;
        $object->number_of_votes = $current_number_of_votes + 1;
        $object->save();

        if ($cache != null && Cache::has($cache)) {
            Cache::forget($cache);
        }

        return 'Спасибо, ваш голос учтен!';
    }


}