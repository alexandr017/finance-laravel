@extends('site.v3.layouts.amp')
@section ('title', $page->title)
@section ('h1', $page->h1)
@section ('meta_description', $page->meta_description)

@section('content')

    @include('site.v3.modules.includes.breadcrumbs')

    <section class="container main">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <h1 class="p-h1">{{$page->h1}}</h1>

                @include('site.v3.modules.banks.menu.amp')

                <?php echo \App\Algorithms\AMP::render(Shortcode::compile(System::nofollow($page->lead))); ?>

                <?php echo \App\Algorithms\AMP::render(Shortcode::compile(System::nofollow($page->content))); ?>

                <?php
                $realCount = 0; $ratingValue = 0; $ratingValueTmp = 0;
                foreach ($reviews as  $review) {
                    if($review->rating != null){
                        $ratingValueTmp += $review->rating;
                        $realCount++;
                    }
                }
                if($realCount != 0){
                    $ratingValue = round($ratingValueTmp / $realCount,2);
                } else {
                    $ratingValue = 0;
                }
                $page->number_of_votes = $realCount;
                $page->average_rating = $ratingValue;
                ?>

                <div class="bordered-rating star-rating light-border">
                    {!! RatingParser::printImgRatingByValueForAMP($page->average_rating) !!}
                    (<strong>{{count($reviews)}}</strong> оценок, среднее: <strong>{{round($page->average_rating, 2)}}</strong> из 5)
                </div>
            </div><?php /* end col-md-12 */ ?>
        </div><?php /*row */ ?>
    </section>

@endsection