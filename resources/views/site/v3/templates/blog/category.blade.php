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

            <div class="post-category-text">
                {!! TagsParser::compile(Shortcode::compile($postCategory->lead)) !!}
            </div>

            <div class="post-wrap">
                @foreach($posts as $post)
                <?php $post_h1 = ($post->h1_in_category != null) ? $post->h1_in_category : $post->h1; ?>
                <div class="row">
                    <?php $availability = ($post->availability == null || $post->availability =='no') ? 'unavailable' : 'available'; ?>
                    <div class="col-md-12">
                        <a href="/{{$postCategory->alias_category}}/{{$post->alias}}.html"><?php echo Shortcode::compile($post_h1); ?></a>
                        @if($postCategory->id == 13)
                            <p class="date">{{date('d.m.Y',strtotime($post->date))}}</p>
                        @endif
                        @if($post->valid_until != null && $postCategory->id == 8)
                            <p class="date">Действует до: {{date('d.m.Y',strtotime($post->valid_until))}}</p>
                        @endif
                        <p>{!! $post->short_content !!}</p>
                    </div>
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
<script async src="/vzo_theme/js/typed.min.js"></script>
<script async src="/vzo_theme/js/scripts/7PostsCategory/postsCategory.js?id=2"></script>
<?php /*<script src="/vzo_theme/js/scripts/typed.js"></script> */ ?>
@endsection
@section('listings-scripts')
<script async src="/vzo_theme/js/modal.js"></script>
<script>

</script>
@endsection
