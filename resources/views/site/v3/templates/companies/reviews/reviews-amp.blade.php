@extends('site.v3.layouts.amp')
@section ('title', $page->title)
@section ('h1', $page->h1)
@section ('meta_description', $page->meta_description)

@section('content')

@include('site.v3.modules.includes.breadcrumbs')

<article class="container main single-page">
    <div class="row">
        <div class="col-lg-12 col-md-12">

            <h1 class="p2-h1">{{$page->h1}}</h1>

            <?php echo \App\Algorithms\AMP::render(Shortcode::compile(System::nofollow($page->content))); ?>

            <div class="reviews-wrap">

                    <div class="reviews-wrap comments-add-form">
                        <?php $reviewsGroups = 1; $i = 0;  ?>
                        @foreach($reviews as $comment)
                            <div class="comment-item {{RatingParser::getCssClassForBackground($comment->rating)}} rev-group-{{$reviewsGroups}} " id="comment-{{$comment->id}}">
                                <div class="title-line">@if($comment->author!=null) {{$comment->author}} @else {{$comment->last_name}} {{$comment->first_name}} {{$comment->middle_name}} @endif
                                    <div class="rating-line rev">
                                        @if($comment->rating!=null)
                                            {!! RatingParser::printImgRatingByValueForAMP($comment->rating) !!}
                                        @endif
                                    </div>
                                </div>
                                <div class="text-rew">
                                    {!!$comment->review!!}
                                </div>
                                @if(($comment->pros!=null) || ($comment->minuses!=null))
                                    <div class="pros_minuses_wrap">
                                        <div class="pros">{!! $comment->pros !!}</div>
                                        <div class="minuses">{!! $comment->minuses !!}</div>
                                    </div>
                                @endif
                                @if(isset($comment->child))
                                    @foreach($comment->child as $child)
                                        <div class="comment-item @if($child->off_answer != null) off_answer @endif" id="comment-{{$child->id}}">
                                            <div class="title-line">@if($child->off_answer != null) <i class="fa fa-check-square-o"></i> @endif @if($child->author!=null) {{$child->author}} @else {{$child->last_name}} {{$child->first_name}} {{$child->middle_name}} @endif
                                                @if($comment->rating!=null)
                                                    @if($child->off_answer == null)
                                                        <div class="rating-line rev">

                                                        </div>
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="text-rew">
                                                {!!$child->review!!}
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

                            </div>
                            <?php $i++; if($i % 10 == 0) $reviewsGroups++; ?>
                        @endforeach

                        <br>
                        <br>

                    </div>


            </div>

        </div><?php /* end col-md-12 */ ?>
    </div><?php /*row */ ?>
</section>

@endsection