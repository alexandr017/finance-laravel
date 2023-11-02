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

                <div class="row">
                    @if($post->studied_the_topic !=null)
                        <div class="col-sm-4"><span><i class="fa fa-graduation-cap"></i> Изучали тему:</span> {{$post->studied_the_topic}} мин.</div>
                    @endif
                    @if($post->read_the_sources !=null)
                        <div class="col-sm-4"><span><i class="fa fa-book"></i> Прочитали источников:</span> {{$post->read_the_sources}} шт.</div>
                    @endif
                    @if($post->write_articles !=null)
                        <div class="col-sm-4"><span><i class="fa fa-hourglass-half"></i> Писали статью:</span> {{$post->write_articles}} мин.</div>
                    @endif
                </div>

                @if($post->the_author_answers)
                    <div class="the_author_answers">&#9989; Автор отвечает на вопросы</div>
                @endif

                @if($postCategory->show_date_publish_in_posts && $post->date != null)
                <p class="date">Опубликовано: {{date('d.m.Y',strtotime($post->date))}}</p>
                @endif

                @if($post->valid_until != null && $post->pcid == 8)
                <p class="date">Действует до: {{date('d.m.Y',strtotime($post->valid_until))}}</p>
                @endif

                
                <div class="content" itemtype="http://schema.org/Article">

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

                </div><?/* content  */ ?>


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

<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "NewsArticle",
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "https://google.com/article"
  },
  "headline": "Article headline",
  "image": [
    "https://vsezaimyonline.ru{{$post->thumbnail}}"
  ],
  "datePublished": "{{$post->created_at}}",
  "dateModified": "{{$post->updated_at}}",
  "author": {
    "@type": "Person",
    "name": "Максим Иванов"
  },
   "publisher": {
    "@type": "Organization",
    "name": "ФинансыРу",
    "logo": {
      "@type": "ImageObject",
      "url": "https://finance.ru/vzo_theme/img/logo.png"
    }
  },
  "description": "{{$post->h1}}"
}
</script>

@endsection