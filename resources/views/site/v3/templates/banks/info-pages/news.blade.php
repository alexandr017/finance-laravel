<?php
$page_prefix = '';
if (isset($number_page)) {
    $page_prefix = ($number_page > 1)
        ? ' - страница ' . $number_page
        : '';
}
?>
@extends('frontend.layouts.app')
@section ('title', Shortcode::compile($page->title) . $page_prefix)
@section ('h1', Shortcode::compile($page->h1)  . $page_prefix)
@section ('meta_description', $page->meta_description  . $page_prefix)

@section('content')

    @include('site.v3.modules.includes.breadcrumbs')

    <section class="container main">
                <h1 class="p-h1 text-center">{{$page->h1  . $page_prefix}}</h1>

                @if(is_mobile_device())
                    @include('site.v3.modules.banks.menu.mob')
                @else
                    @include('site.v3.modules.banks.menu.pc')
                @endif

                <div class="post-category-text">
                    {!! TagsParser::compile(Shortcode::compile($page->content)) !!}
                </div>

                <div class="post-wrap">
                    @foreach($news as $post)
                        <?php $post_h1 = ($post->h1_in_category != null) ? $post->h1_in_category : $post->h1; ?>
                        <div class="row">
                            <?php $availability = ($post->availability == null || $post->availability =='no') ? 'unavailable' : 'available'; ?>
                            <div class="col-md-4">
                                <div class="{{$availability}}">
                                    <a href="/{{$post->alias_category}}/{{$post->alias}}.html">
                                        <img loading="lazy" src="{{$post->thumbnail}}" alt="{{$post_h1}}">
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <a href="/{{$post->alias_category}}/{{$post->alias}}.html"><?php echo Shortcode::compile($post_h1); ?></a>
                                @if($page->id == 13)
                                    <p class="date">{{date('d.m.Y',strtotime($post->date))}}</p>
                                @endif
                                @if($post->valid_until != null && $page->id == 8)
                                    <p class="date">Действует до: {{date('d.m.Y',strtotime($post->valid_until))}}</p>
                                @endif
                                <p>{!! $post->short_content !!}</p>
                            </div>
                        </div>
                    @endforeach

                    <?php
                        $page = $postsCount->currentPage();
                    ?>
                    @include('vendor.pagination.vzo-bank-post')

                </div>

    </section>


@endsection


@section('additional-scripts')
    <script async src="/old_theme/js/typed.min.js"></script>
    <script async src="/old_theme/js/scripts/7PostsCategory/postsCategory.js"></script>
@endsection
@section('listings-scripts')
    <script async src="/old_theme/js/modal.js"></script>
    <script>

    </script>
@endsection
