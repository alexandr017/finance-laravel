@extends('frontend.layouts.amp')
@section ('title', $page->title)
@section ('h1', $page->h1)
@section ('meta_description', $page->meta_description)
@section('content')

    @include('site.v3.modules.includes.breadcrumbs')

    <section class="container main single-page single">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <h1 class="p-h1">{{$page->h1}}</h1>

                @include('site.v3.modules.banks.menu.amp')

                @include('site.v3.modules.banks.category_and_product_face.amp')

                <div class="offers-list">
                    @foreach($cards as $card)
                        @include('site.v3.modules.cards.card.card-amp')
                    @endforeach
                </div>

                <div class="text-block" id="single_content_wrap">
                    <?php echo AMP::render(Shortcode::compile(System::nofollow($page->content))); ?>
                </div>

                <div class="bordered-rating star-rating light-border">
                    {!! RatingParser::printImgRatingByValueForAMP($page->average_rating) !!}
                    (<strong>{{count($reviews)}}</strong> оценок, среднее: <strong>{{round($page->average_rating, 2)}}</strong> из 5)
                </div>

            </div><?php /* end col-md-12 */ ?>
        </div><?php /*row */ ?>
    </section>

@endsection