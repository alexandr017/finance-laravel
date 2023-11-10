@extends('site.v3.layouts.app')
@section ('title', $postsCategory->title)
@section ('h1', $postsCategory->h1)
@section ('meta_description', $postsCategory->meta_description)

@section('content')

    @include('site.v3.modules.includes.breadcrumbs')

    <section class="container main">
        <div class="row">
            <div class="col-lg-9 col-md-12">
                <h1 class="p-h1 text-center">{{$postsCategory->h1}}</h1>

                {!!$postsCategory->lead!!}

                <div class="news-post-wrap">
                    @foreach($posts as $post_category)
                        @if(count($post_category))
                        <div class="sub-title-category bold">{{$post_category->first()->category_h1}}</div>
                        <div class="news-post-block">
                        @include('site.v3.modules.posts.posts', ['posts' => $post_category])
                        </div>
                        <?php $firstPost = $post_category->first(); ?>
                        <div class="news-post-load-block">
                            <button class="news-post-load bold" data-page="1" data-id="{{$firstPost->category_id}}">Показать ещё</button>
                        </div>
                        @endif
                    @endforeach


                </div>

            </div><?php /* end col-md-9 */ ?>
            <div class="col-lg-3 d-lg-block d-xs-none d-none">
                @include('site.v3.modules.includes.sidebar')
            </div><?php /* md-3 */ ?>
        </div><?php /*row */ ?>
    </section>

@endsection


@section('additional-scripts')
    <script async src="/old_theme/js/typed.min.js"></script>
    <script async src="/old_theme/js/scripts/7PostsCategory/postsCategory.js?v=1"></script>
    <?php /*<script src="/vzo_theme/js/scripts/typed.js"></script> */ ?>
@endsection
@section('listings-scripts')
    <script async src="/old_theme/js/modal.js"></script>
@endsection
