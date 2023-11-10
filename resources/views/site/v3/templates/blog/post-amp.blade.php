@extends('site.v3.layouts.amp')
@section ('title', $post->title)
@section ('h1', $post->h1)
@section ('meta_description', $post->meta_description)

@section('content')

@include('site.v3.modules.includes.breadcrumbs')

<section class="container main">
    <div class="row">
        <div class="col-lg-12 col-md-12">

            <article class="single">
                <h1 class="p-h1"><?php echo Shortcode::compile($post->h1); ?></h1>

                @if($postCategory->show_date_publish_in_posts && $post->date != null)
                <p class="date">Опубликовано: {{date('d.m.Y',strtotime($post->date))}}</p>
                @endif

                @if($post->valid_until != null)
                <p class="date">Действует до: {{date('d.m.Y',strtotime($post->valid_until))}}</p>
                @endif

                
                <div class="content">
        			<?php echo \App\Algorithms\AMP::render( Shortcode::compile(System::nofollow($post->content)) ); ?>

                   @if(count($related)>0)
                    <div class="related">
                        <div class="h3">Читайте также:</div>
                        <ul>
                            @foreach($related as $p)
                            <li><a href="/{{$p->alias_category}}/{{$p->alias}}.html" rel="bookmark" title="{{$p->h1}}">{{$p->h1}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                </div><?php /* content  */ ?>


                @if($postCategory->show_comments_in_posts)
                <noindex>
                    <?php $linkToCommentForm = '/' . preg_replace('/\/amp$/', '', \Request::path()) . '#AddCommentWrap'; ?>
                    <p><i>Для того чтобы оставить комментарий перейдите на <a href="{{$linkToCommentForm}}">полную версию сайта.</a></i></p>
                </noindex>
                @endif

            </article>


        </div><?php /* end col-md-12 */ ?>
 
    </div><?php /*row */ ?>
</section>
@endsection