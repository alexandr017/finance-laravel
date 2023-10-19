<?php global $c; $c = $cards; ?>
@extends('frontend.layouts.amp')
@section ('title', Shortcode::compile($page->title,$cards))
@section ('h1', $page->h1)
@section ('meta_description', Shortcode::compile($page->meta_description))

@section('content')

@include('site.v3.modules.includes.breadcrumbs')
<?php #dd($cards); ?>
<section class="container main">
    <div class="lwb">
        <div class="lpt">
            <h1 class="p-h1">{{$page->h1}}</h1>
            <div class="pupdate">
                <span class="pup-inner">Обновлено в <span class="lowercase">{{System::getCurrentMonth(false)}}</span> <?= date('Y') ?></span>
                <span class="pupcount"> {{Shortcode::compile("[carts_count]")}} шт.</span>
                @if($page->expert_anchor != null)
                    <a href="{{$page->expert_anchor}}" class="verified_by_expert"><i class="fa fa-check-square-o"></i> Проверено экспертом</a>
                @endif
            </div>
            {!!  AMP::render($page->text_before) !!}
            {!!  AMP::render($page->lead) !!}
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12">

        <div class="offers-list">
        <?php $i=0; ?>
        @foreach($cards as $card)
        <?php /* dd($card); */ ?> 
            @include('frontend.cards.card.card-amp')
        <?php $i++; ?>
        <?php if($i>19) break; ?>
        @endforeach
        </div>


            <div class="total_tables_wrapper">
                @if(isset($category_id))
                    @if(file_exists( base_path().'/resources/views/frontend/listings/includes/total_cards_table/'.$category_id.'.blade.php'))
                        @include("frontend.listings.includes.total_cards_table.$category_id")
                    @endif
                @endif
            </div>

        <div class="listing-wrap">
        {!! AMP::render(Shortcode::compile($page->content)) !!}
        </div>





        </div><?php /* end col-md-12 */ ?>
    </div><?php /*row */ ?>
</section>

@endsection
