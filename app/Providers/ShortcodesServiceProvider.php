<?php

namespace App\Providers;

use App\Shortcodes\InsertVideo\InsertVideo;
use App\Shortcodes\OurTeam\OurTeam;
use App\Shortcodes\TimeLine\TimeLineInner;
use App\Shortcodes\TimeLine\TimeLineWrap;
use App\Shortcodes\VzoNews\VzoNews;
use Illuminate\Support\ServiceProvider;

use Shortcode;

use App\Shortcodes\ContentItem\ContentItemWrap;
use App\Shortcodes\ContentItem\ContentItem;
use App\Shortcodes\OfferInRating\OfferInRating;
use App\Shortcodes\BGBlock\BGBlock;
use App\Shortcodes\OfRat\OfRatBlock;
use App\Shortcodes\BigStarList\BigStarList;
use App\Shortcodes\OfRat\OfRatPlus;
use App\Shortcodes\OfRat\OfRatMinus;
use App\Shortcodes\VsezaimyAccordion\VsezaimyAccordion;
use App\Shortcodes\VsezaimyAccordion\VsezaimyAccordionItem;
use App\Shortcodes\ShortButton\ShortButton;
use App\Shortcodes\Alert\AlertSuccess;
use App\Shortcodes\Alert\AlertInfo;
use App\Shortcodes\YaRTB\YaRTB;

use App\Shortcodes\Rat\RatBlockWrap;
use App\Shortcodes\Rat\RatBlock;
use App\Shortcodes\Rat\RatPros;
use App\Shortcodes\Rat\RatCons;

use App\Shortcodes\Comparison\Comparison;
use App\Shortcodes\Comparison\ComparisonInner;

use App\Shortcodes\GoogleTrends\GoogleTrends;

use App\Shortcodes\VerticalTab\VerticalTabsWrap;
use App\Shortcodes\VerticalTab\VerticalTab;

use App\Shortcodes\Summary\Summary;

use App\Shortcodes\Tarify\Tarify;

use App\Shortcodes\Promo\Promo;


use App\Shortcodes\Cards\MaxSum;
use App\Shortcodes\Cards\CartsCount;
use App\Shortcodes\Cards\MaxDay;
use App\Shortcodes\Cards\MinPercent;
use App\Shortcodes\Cards\MaxLimit;
use App\Shortcodes\Cards\MinMaintenance;
use App\Shortcodes\Cards\MaxMaintenance;
use App\Shortcodes\Cards\OstatokOnPercent;
use App\Shortcodes\Cards\FirstNTitlesCards;

use App\Shortcodes\Phone\Phone;
use App\Shortcodes\Phone\PhoneWithImg;
use App\Shortcodes\Phone\PhoneComplaint;


use App\Shortcodes\MonthYear\Month;
use App\Shortcodes\MonthYear\PMonth;
use App\Shortcodes\MonthYear\Year;


use App\Shortcodes\GoToAccount\GoToAccount;

use App\Shortcodes\Reviews\ReviewsCount;


use App\Shortcodes\ReadMore\ReadMore;


use App\Shortcodes\RKOCalc\RKOCalc;

use App\Shortcodes\OverpaymentTable\OverpaymentTable;


use App\Shortcodes\HotLines\HotLines;


use App\Shortcodes\BlockWithIcon\BlockWithIcon;


use App\Shortcodes\Quote\Quote;


use App\Shortcodes\StructuredDataVideo\SDV;
use App\Shortcodes\StructuredFAQ\SFAQ;


use App\Shortcodes\Emoji\Emoji;

use App\Shortcodes\Banks\BankRequisites;

use App\Shortcodes\Mfo\MfoCount;
use App\Shortcodes\Banks\BanksCount;


class ShortcodesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $GLOBALS['short_code_css'] = [];
        $GLOBALS['short_code_js'] = [];
        Shortcode::register('ya_RTB', YaRTB::class); //Яндекс RTB


        //Shortcode::register('sdv', SDV::class); //Яндекс RTB
        Shortcode::register('sfaq', SFAQ::class); //faq структурированная разметка

        
        Shortcode::register('content_item_wrap', ContentItemWrap::class); // Меню
        Shortcode::register('content_item', ContentItem::class);


        Shortcode::register('bg_block', BGBlock::class); // Фоновый блок


        Shortcode::register('of_rat_block', OfRatBlock::class); // Подробное описание
        Shortcode::register('offer_in_rating', OfferInRating::class);
        Shortcode::register('big_star_list', BigStarList::class);
        Shortcode::register('of_rat_plus', OfRatPlus::class);
        Shortcode::register('of_rat_minus', OfRatMinus::class);

        Shortcode::register('vsezaimy_accordion', VsezaimyAccordion::class); // Аккордеон
        Shortcode::register('vsezaimy_accordion_item', VsezaimyAccordionItem::class);
        

        Shortcode::register('short_button', ShortButton::class); // Одиночная кнопка


        Shortcode::register('vsezaimy_important', AlertSuccess::class); // Сообщение (Зеленое)
        Shortcode::register('vsezaimy_info', AlertInfo::class); // Сообщение (Синее)



        Shortcode::register('rat_block_wrap', RatBlockWrap::class); // Краткий обзор
        Shortcode::register('rat_block', RatBlock::class);
        Shortcode::register('pros', RatPros::class);
        Shortcode::register('cons', RatCons::class);


        Shortcode::register('comparison', Comparison::class); // Сравнение
        Shortcode::register('comparison_inner', ComparisonInner::class);


        Shortcode::register('summary', Summary::class); // Сводка


        Shortcode::register('tarify', Tarify::class); // Тарифы

        


        Shortcode::register('google_trends', GoogleTrends::class);


        Shortcode::register('vertical_tabs_init', VerticalTabsWrap::class);
        Shortcode::register('vertical_tab', VerticalTab::class);

        Shortcode::register('promo', Promo::class); // Promo



        Shortcode::register('max_sum', MaxSum::class); // Карточки
        Shortcode::register('carts_count', CartsCount::class); // Карточки
        Shortcode::register('max_day', MaxDay::class); // Карточки
        Shortcode::register('min_percent', MinPercent::class); // Карточки
        Shortcode::register('max_limit', MaxLimit::class); // Карточки
        Shortcode::register('min_maintenance', MinMaintenance::class); // Карточки
        Shortcode::register('max_maintenance', MaxMaintenance::class); // Карточки
        Shortcode::register('ostatok_on_percent', OstatokOnPercent::class); // Карточки
        Shortcode::register('first_n_titles_cards', FirstNTitlesCards::class); // Карточки


        Shortcode::register('phone', Phone::class); // Телефон
        Shortcode::register('phone_with_img', PhoneWithImg::class); // Телефон с картинкой
        Shortcode::register('phone_complaint', PhoneComplaint::class); // Телефон с картинкой

        Shortcode::register('current_month', Month::class); // Текущий год и месяц
        Shortcode::register('p_current_month', PMonth::class); // Текущий год и месяц
        Shortcode::register('current_year', Year::class); // Текущий год и месяц

        Shortcode::register('go_to_account', GoToAccount::class); // Текущий год и месяц


        Shortcode::register('reviews_count', ReviewsCount::class); // Кол-во отзывов





        Shortcode::register('read_more', ReadMore::class); // Читать далее




        Shortcode::register('rko_calc_ooo_and_ip', RKOCalc::class); // Калькулятор в РКО для ИП и ООО


        Shortcode::register('overpayment_table', OverpaymentTable::class); // таблица переплаты на странице организаций для займов


        Shortcode::register('hot_lines', HotLines::class); // плашка горячих линий у помпаний для перелинковки



        Shortcode::register('quote', Quote::class); // вставка комментария в контент

        Shortcode::register('block_with_icon', BlockWithIcon::class); // плашка с текстом (слева картинка)


        Shortcode::register('insert_video', InsertVideo::class); // вставка видео в контент
        Shortcode::register('vzo_news', VzoNews::class); // наши новости
        Shortcode::register('ours_command', OurTeam::class); // наша редакция
        Shortcode::register('timeline_wrap', TimeLineWrap::class);
        Shortcode::register('timeline_item', TimeLineInner::class);



        Shortcode::register('em', Emoji::class); //эмодзи


        Shortcode::register('bank_requisites', BankRequisites::class); // банковские реквизиты

        Shortcode::register('mfo_count', MfoCount::class); // кол-ао мфо
        Shortcode::register('banks_count', BanksCount::class); // кол-ао банков




    }
}
