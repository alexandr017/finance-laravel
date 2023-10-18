@extends('frontend.layouts.app')
@section ('title', $page->title)
@section ('h1', $page->h1)
@section ('meta_description', $page->meta_description)


@section('compress-styles')
    @parent
@endsection

@section('content')

    @include('frontend.includes.breadcrumbs')

    <section class="container main single-page">
        <div class="row">
            <div class="col-lg-9 col-md-12">
                <h1 class="p-h1">{{$page->h1}}</h1>
                @if($bankTopCard != null)
                    @include('frontend.banks.modules.head_fixed_block.pc_and_mob')
                @endif

                @if(is_mobile_device())
                    @include('frontend.banks.modules.menu.mob')
                @else
                    @include('frontend.banks.modules.menu.pc')
                @endif

                @if(is_mobile_device())
                    @include('frontend.banks.modules.category_and_product_face.mob')
                @else
                    @include('frontend.banks.modules.category_and_product_face.pc')
                @endif

                <div class="offers-list">
                    <?php /*
                    @if(count($cards) == 1)
                    @foreach($cards as $card)
                            @include('frontend.cards.card.card')
                    @endforeach
                    @endif
 */ ?>
                </div>

                <div class="text-block" id="single_content_wrap">
                    {!! TagsParser::compile(Shortcode::compile($page->content)) !!}
                </div>

                <div class="bordered-rating star-rating light-border">
                    {!! RatingParser::printIRatingByValue($page->average_rating) !!}
                    (<strong>{{count($reviews)}}</strong> оценок, среднее: <strong>{{round($page->average_rating, 2)}}</strong> из 5)
                </div>

            </div><?php /* end col-md-9 */ ?>
            <div class="col-lg-3 d-lg-block d-xs-none d-none">
                @include('frontend.includes.sidebar.bank')
            </div><?php /* md-3 */ ?>
        </div><?php /*row */ ?>
    </section>
@endsection

@section('additional-scripts')
    <script src="/old_theme/js/modal.js" defer></script>

    <script>
        $('#load_card_for_bank').on('click', function () {
            $.ajax({
                type: "GET",
                dataType: "html",
                url: '/actions/load-cards-for-bank-on-product?item_id='+{{$page->id}},
                success: function (data) {
                    var json = JSON.parse(data);
                    $('.offers-list').html(json.code);
                    update_img_and_bg_full_version();
                }
            });
        });
    </script>

    <?php
        if(isset($cards[0])) {
            $page->img = $cards[0]->logo;
        }
    ?>
    {!! App\Algorithms\Frontend\StructuredData\Product\BankFullProduct::render($cards, $page) !!}
@endsection
