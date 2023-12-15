<?php
$pagePrefix = '';
if (isset($page)) {
    $pagePrefix = ($page > 1)
        ? ' - страница ' . $page
        : '';
}
?>
@extends('site.v3.layouts.app')
@section ('title', Shortcode::compile($postCategory->title) . $pagePrefix)
@section ('h1', Shortcode::compile($postCategory->h1)  . $pagePrefix)
@section ('meta_description', $postCategory->meta_description  . $pagePrefix)

@section('content')

@include('site.v3.modules.includes.breadcrumbs')

<section class="container main">

    <div class="row">
        <div class="col-lg-9 col-md-12">

            <h1 class="p-h1">{{$postCategory->h1  . $pagePrefix}}</h1>

            @if (is_mobile_device())
                @include('site.v3.modules.blog.categories')
            @endif

            <div class="post-category-text">
                {!! TagsParser::compile(Shortcode::compile($postCategory->text)) !!}
            </div>

            <div class="news-post-block">
                @foreach($posts as $post)
                    <div class="news-action-post-item">
                        <a href="/{{$postCategory->alias_category}}/{{$post->alias}}.html" class="news-post-item-link">
                            <?php $post_h1 = ($post->h1_in_category != null) ? $post->h1_in_category : $post->h1; ?>
                            <b>{{$post_h1}}</b>
                            <p>{!! $post->short_content !!}</p>
                            <span class="news-post-date">{{date('d.m.Y',strtotime($post->date))}}</span>
                        </a>
                    </div>
                @endforeach

            </div>


                @include('site.v3.modules.includes.pagination')
        </div><?php /* end col-md-9 */ ?>
        <div class="col-lg-3 d-lg-block d-xs-none d-none">
            @include('site.v3.modules.includes.sidebar')
        </div><?php /* md-3 */ ?>
    </div><?php /*row */ ?>

</section>

@endsection


@section('additional-scripts')
<script async src="/old_theme/js/scripts/7PostsCategory/postsCategory.js?id=2"></script>
@endsection
@section('listings-scripts')
<script async src="/old_theme/js/modal.js"></script>
<script>

</script>
@endsection
