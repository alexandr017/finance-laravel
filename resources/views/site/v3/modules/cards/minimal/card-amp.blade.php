 <div class="one-offer shadow @if($card->promo == 1) spec-offer @endif @if($card->label != 0)label label{{$card->label}} @endif">
    @if(@$card->promo == 1)
    <div class="title-top">Специальное предложение</div>
    @endif

    <div class="top-cart">
        <amp-img class="card-logo" width="250" height="120" layout="fixed" src="{{$card->logo}}" alt="{{$card->title}}"></amp-img>

        <div class="top-cart-info">
            <div class="name-line h4"><?php
                $showEntityLink = $card->link_to_entity != null && str_replace('https://finance.ru', '', $card->link_to_entity) != '/' . $card->link_to_entity;
                if ($showEntityLink) {
                    echo '<a class="org-card" target="_blank" href="'. $card->link_to_entity .'">' . $card->title . '</a>';
                } else {
                    echo $card->title;
                }
                $idUserCompanies = getIdUserCompanies();
                if(in_array($card->company_id, $idUserCompanies)) {
                    echo '<span class="verified-icon vzo_icons def_bg" data-src="/old_theme/img/icon-veryfied.png" data-title="Официальный представитель на сайте"></span>';
                }
                ?></div>

            @if(isset($card->ratingValue))
            <div class="rating-line">
                <?php $showEntityReviewsLink = $card->link_to_reviews_page != null && str_replace('https://finance.ru', '', $card->link_to_reviews_page) != '/' . $card->link_to_reviews_page; ?>
                @if ($showEntityReviewsLink)
                {!! RatingParser::printImgRatingByValueForAMP($card->ratingValue) !!}
                <div class="text-rating">
                    <a target="_blank" href="{{$card->link_to_reviews_page}}">{{$card->ratingCount}} {{System::endWords($card->ratingCount, ['отзыв', 'отзыва', 'отзывов'])}}</a> ({{$card->ratingValue}} из 5)
                </div>
                @endif
            </div>
            @endif
        </div>

        <div class="clearfix"></div>
    </div>



        <div class="flex-top">
            @if(file_exists( base_path().'/resources/views/site/v3/modules/cards/minimal/fields/'.$card->category_id.'-head.blade.php'))
            @include("site.v3.modules.cards.minimal.fields.$card->category_id-head")
            @endif

        </div>



            <?php if($card->link_type == 1) $link = $card->link_1; else $link = $card->link_2; ?>
            <a href="{{$link}}" target="_blank" class="form-btn1 {{$card->yandex_event}}"> <i class="fa fa-lock"></i> Подать заявку</a>





            <label class="toggle-card-button">
                <input type="checkbox" class="card-checkbox">
                <span class="show-card-btn">Подробные условия</span>
                <span class="hide-card-btn">Скрыть детали</span>
                <div class="main-card">


                    @if(isset($card->approval_indicator))
                    <div class="bor">
                        <div class="approval-line no-print">
                            <div class="tt">Одобрение</div>
                            <div class="progressbar">
                                <div class="progress progress-bar bg-success progress-bar-striped" style="width: {{$card->approval_indicator}}%" ></div>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if(file_exists( base_path().'/resources/views/site/v3/modules/cards/card/fields/'.$card->category_id.'.blade.php'))
                    @include("site.v3.modules.cards.card.fields.$card->category_id")
                    @endif

                    @if(isset($card->additional))
                    @if($card->additional != null)
                    <?php
                    $c_additional = str_replace("\r", '', $card->additional);
                    $additionalArr = explode("\n", $c_additional);
                    ?>
                    <ul class="lv-list">
                        @foreach($additionalArr as $additional)
                        <?php if($additional == '') continue ?>
                        <li>{{$additional}}</li>
                        @endforeach
                    </ul>
                    @endif
                    @endif
                </div>
            </label>



    </div><?php /* end carts */ ?>


<style>
    .clearfix{
        clear: both;
    }

    .name-line {
        text-align: left;
    }
    .top-cart {
        text-align: left;
        margin-top: 15px;
        position: relative;
        border: 1px solid #f6f6f6;
        padding: 15px;
    }
    .top-cart-info{

    }

    .card-logo{
        float: left;
        border: 1px solid #f6f6f6;
        margin-right: 15px;
    }

    .flex-top{
        display: flex;
        justify-content: space-around;
        margin: 15px 0;
    }

    .card-mn-label {
        margin-bottom: 20px;
        color: #A7A6C6;
        display: block;
    }


    .informer__title {
        color: #292929;
    }

    .show-card-btn{
        color: #02b7f7;
        margin: auto;
        width: 170px;
        padding-right: 15px;
        background: url('/old_theme/img/arrow-top.png') no-repeat right;
        margin-top: 15px;
        cursor: pointer;
    }

    .hide-card-btn{
        color: #02b7f7;
        margin: auto;
        width: 135px;
        padding-right: 15px;
        background: url('/old_theme/img/arrow-bottom.png') no-repeat right;
        font-size: 17px;
        margin-top: 15px;
        cursor: pointer;
    }


    @media screen and (max-width: 420px) {
        .card-logo {
            float: none;
            margin: 0;
            max-width: 100%;
            border: 0;
        }

        .flex-top {
            flex-wrap: wrap;
        }

        .flex-top > div {
            width: 50%;
        }

        .card-mn-label {
            margin-top: 20px;
            margin-bottom: 0;
        }
    }
</style>
