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
                        <div class="sub-title-category bold text-center">{{$post_category->first()->category_h1}}</div>
                        <div class="row">
                        @foreach($post_category as $post)
                        <?php $post_h1 = ($post->h1_in_category != null) ? $post->h1_in_category : $post->h1; ?>
                            <div class="col-md-4">
                                <a href="/{{$post->alias_category}}/{{$post->alias}}.html">
                                    <?php $availability = ($post->availability == null || $post->availability =='no') ? 'unavailable' : 'available'; ?>
                                    <span class="dgeff"><?php echo Shortcode::compile($post_h1); ?></span>
                                </a>
                                <div class="post-info">
                                    <div class="post-date">{{date('d.m.Y',strtotime($post->date))}}</div>
                                    <div class="post-views"><i class="fa fa-eye"></i> {{$post->views}}</div>
                                    <div class="post-comments"><i class="fa fa-comment-o"></i> {{$post->comments_count}}</div>
                                </div>
                            </div>
                        @endforeach
                        </div>
                        @if(count($post_category) >= 6)
                        <div class="text-center">
                            <button class="form-btn1 news-post-load" data-page="1" data-id="{{$post->category_id}}">Показать ещё</button>
                        </div>
                        @endif
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
