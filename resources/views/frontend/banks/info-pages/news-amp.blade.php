<?php
$page_prefix = '';
if (isset($number_page)) {
    $page_prefix = ($number_page > 1)
        ? ' - страница ' . $number_page
        : '';
}
?>
@extends('frontend.layouts.amp')
@section ('title', Shortcode::compile($page->title) . $page_prefix)
@section ('h1', Shortcode::compile($page->h1)  . $page_prefix)
@section ('meta_description', $page->meta_description  . $page_prefix)

@section('content')

    @include('frontend.includes.breadcrumbs')

    <section class="container main">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <h1 class="p-h1 text-center">{{$page->h1  . $page_prefix}}</h1>

                @include('frontend.banks.modules.menu.amp')

                <div class="post-category-text">
                    <?php echo AMP::render(Shortcode::compile(System::nofollow($page->content))); ?>
                </div>

                <div class="post-wrap">
                    @foreach($news as $post)
                        <div class="item-post">
                            <?php $post_h1 = ($post->h1_in_category != null) ? $post->h1_in_category : $post->h1; ?>
                            <amp-img width="250" height="155" layout="fixed" src="{{$post->thumbnail}}" alt="{{$post_h1}}"></amp-img>
                                <a href="/{{$post->alias_category}}/{{$post->alias}}.html"><?php echo Shortcode::compile($post_h1); ?></a>
                                @if($page->id == 13)
                                    <p class="date">{{date('d.m.Y',strtotime($post->date))}}</p>
                                @endif
                                @if($post->valid_until != null && $page->id == 8)
                                    <p class="date">Действует до: {{date('d.m.Y',strtotime($post->valid_until))}}</p>
                                @endif
                                <p>{!! $post->short_content !!}</p>
                        </div>
                    @endforeach

                    <?php
                    $page = $postsCount->currentPage();
                    ?>
                    @include('vendor.pagination.vzo-bank-post')

                </div>


            </div>
        </div><?php /*row */ ?>
    </section>


@endsection