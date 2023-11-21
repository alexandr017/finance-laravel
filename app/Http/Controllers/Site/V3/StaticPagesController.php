<?php

namespace App\Http\Controllers\Site\V3;

use App\Http\Controllers\Controller;
use App\Models\Cards\Cards;
use App\Models\Cards\CardsCategories;
use App\Repositories\Site\Relinking\RelinkingRepository;
use DB;
use App\Models\StaticPages\StaticPage;
use App\Algorithms\Frontend\Cards\CardsBoot;


class StaticPagesController extends Controller
{
    public function index()
    {
        $page = StaticPage::findByAlias();

        if ($page == null) {
            abort(404);
        }

        $all_products_count = 0;
        $companies_count = DB::select("select count(id) as count from companies where status=1");
        $bank_products_count = DB::select("select count(id) as count from bank_products where status=1");
        $all_products_count += $companies_count[0]->count;
        $all_products_count += $bank_products_count[0]->count;


        $all_reviews_count = 0;
        $companies_reviews_count = DB::select("select count(id) as count from companies_reviews where status=1");
        $banks_reviews_count = DB::select('select count(id) as count from bank_reviews where status=1');
        $all_reviews_count += $companies_reviews_count[0]->count;
        $all_reviews_count += $banks_reviews_count[0]->count;


        $loans = DB::table('cards')
            //->select('id','category_id')
            ->where(['category_id' =>1 ,'status' => 1, 'show_in_index' => 1])
            ->orderBy('flow')
            ->orderBy('km5','desc')
            ->orderBy('promo','desc')
            ->orderBy('id','asc')
            ->limit(3)
            ->get();


        $rko = DB::table('cards')
            ->where(['status' => 1, 'category_id' => 2, 'flow' => 1])
            ->orderBy('flow')
            ->orderBy('km5','desc')
            ->orderBy('id')
            ->limit(3)
            ->get();

        $credits = DB::table('cards')
            ->where(['status' => 1, 'category_id' => 4, 'flow' => 1])
            ->orderBy('flow')
            ->orderBy('km5','desc')
            ->orderBy('id')
            ->limit(3)
            ->get();

        $creditCards = DB::table('cards')
            ->where(['status' => 1, 'category_id' => 5, 'flow' => 1])
            ->orderBy('flow')
            ->orderBy('km5','desc')
            ->orderBy('id')
            ->limit(3)
            ->get();

        $debitCards = DB::table('cards')
            ->where(['status' => 1, 'category_id' => 6, 'flow' => 1])
            ->orderBy('flow')
            ->orderBy('km5','desc')
            ->orderBy('id')
            ->limit(3)
            ->get();

        $autoCredits = DB::table('cards')
            ->where(['status' => 1, 'category_id' => 8, 'flow' => 1])
            ->orderBy('flow')
            ->orderBy('km5','desc')
            ->orderBy('id')
            ->limit(3)
            ->get();

        $mortgage = DB::table('cards')
            ->where(['status' => 1, 'category_id' => 10, 'flow' => 1])
            ->orderBy('flow')
            ->orderBy('km5','desc')
            ->orderBy('id')
            ->limit(3)
            ->get();

        $deposits = DB::table('cards')
            ->where(['status' => 1, 'category_id' => 11, 'flow' => 1])
            ->orderBy('flow')
            ->orderBy('km5','desc')
            ->orderBy('id')
            ->limit(3)
            ->get();



        $posts = DB::table('posts')
            ->leftJoin('posts_categories','posts.pcid','posts_categories.id')
            ->select('posts.*',
                'posts_categories.id as category_id',
                'posts_categories.alias_category',
                'posts_categories.h1 as category_h1')
            ->where(['posts.status' => 1])
            ->whereIn('posts.pcid', [8, 27, 28, 21, 29, 30, 14])
            ->limit(10)
            ->orderBy('posts.id', 'desc')
            ->get();

        foreach ($posts as $k => $item) {
            if($posts[$k]->valid_until >= date('Y-m-d')){
                $posts[$k]->availability = 'yes';
                //$available_posts[]=$post;
            }else{
                $posts[$k]->availability = 'no';
                //$unavailable_posts[]=$post;
            }
        }


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


        return view('site.v3.templates.static-pages.index',[
            'page' => $page,

            'all_products_count' => $all_products_count,
            'all_reviews_count' => $all_reviews_count,

            'reviews' => $reviews,

            'loans' => $loans,
            'autoCredits' => $autoCredits,
            'debitCards' => $debitCards,
            'creditCards' => $creditCards,
            'credits' => $credits,
            'rko' => $rko,
            'mortgage' => $mortgage,
            'deposits' => $deposits,

            'posts' => $posts

        ]);
    }


    public function about()
    {

//        $categories = CardsCategories::all();
//        foreach ($categories as $_category) {
//            $category = CardsCategories::find($_category->id);
//            if ($_category->id == 4) $category->bank_alias = 'kredity';
//            if ($_category->id == 5) $category->bank_alias = 'kreditnye-karty';
//            if ($_category->id == 5) $category->bank_alias = 'debetovye-karty';
//            if ($_category->id == 10) $category->bank_alias = 'ipotekay';
//            if ($_category->id == 8) $category->bank_alias = 'avtokredity';
//            if ($_category->id == 11) $category->bank_alias = 'vklady';
//            $category->save();
//        }
//
        $page = (object) [
          'title' => 'О нас',
            'meta_description' => '',
            'h1' => 'О нас',
            'content' => 'О нас content'
        ];

        $breadcrumbs = [['h1' => 'О нас']];

        $all_products_count = 0;
        $companies_count = DB::select("select count(id) as count from companies where status=1");
        $bank_products_count = DB::select("select count(id) as count from bank_products where status=1");
        $all_products_count += $companies_count[0]->count;
        $all_products_count += $bank_products_count[0]->count;
        $all_reviews_count = 0;
        $companies_reviews_count = DB::select("select count(id) as count from companies_reviews where status=1");
        $banks_reviews_count = DB::select('select count(id) as count from bank_reviews where status=1');
        $all_reviews_count += $companies_reviews_count[0]->count;
        $all_reviews_count += $banks_reviews_count[0]->count;            $users_count = DB::select("select count(*) as count from users");

        return view('site.v3.templates.static-pages.about',compact(
            'page', 'breadcrumbs',
            'all_products_count', 'all_reviews_count', 'users_count'
        ));
    }

    public function mfo()
    {
        $categoryID = 1;

        $page = StaticPage::findByAlias();

        if ($page == null) {
            abort(404);
        }

        $breadcrumbs = [['h1' => $page->breadcrumb ?? $page->h1]];

        $relinkData = (new (RelinkingRepository::class))->getRelinkByCategory($categoryID);


        $cards = Cards::where(['cards.show_in_habs' => 1,'cards.category_id' => $categoryID, 'cards.status' => 1])
            ->select('id','category_id')
            ->orderBy('flow')
            ->orderBy('km5','desc')
            ->orderBy('cards.id','asc')
            ->get();
        $cards = CardsBoot::getCardsForListingByIDs($cards);


        $blade = (!is_amp_page())
            ? 'site.v3.templates.companies.hub.mfo'
            : 'site.v3.templates.companies.companies.hub-amp';

        return view($blade, compact('categoryID','breadcrumbs', 'cards', 'relinkData', 'page'));

    }

    public function render()
    {
        $page = StaticPage::findByAlias();

        if ($page == null) {
            abort(404);
        }

        $breadcrumbs = [['h1' => $page->breadcrumbs ?? $page->h1]];

        return view('site.v3.templates.static-pages.page', compact('page', 'breadcrumbs'));
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
