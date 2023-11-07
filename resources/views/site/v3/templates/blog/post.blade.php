@extends('site.v3.layouts.app')
@section ('title', $post->title)
@section ('h1', $post->h1)
@section ('meta_description', str_replace('"',"'",$post->meta_description))

@if(is_null($post->og_img))
@section ('og_image', 'https://vsezaimyonline.ru'.$post->thumbnail)
@else
@section ('og_image', 'https://vsezaimyonline.ru'.$post->og_img)
@endif

@section('content')

@include('site.v3.modules.includes.breadcrumbs')

<section class="container main">
    <div class="row">
        <div class="col-lg-9 col-md-12">

            <h1 class="p-h1">{{$post->h1}}</h1>
            <div class="single">


                @if($post->studied_the_topic !=null || $post->read_the_sources !=null || $post->write_articles !=null )
                <div class="row">
                    @if($post->studied_the_topic !=null)
                    <div class="col-sm-4"><div class="t-in"><span><i class="fa fa-graduation-cap"></i> Изучали тему:</span> {{$post->studied_the_topic}} мин.</div></div>
                    @endif
                    @if($post->read_the_sources !=null)
                    <div class="col-sm-4"><div class="t-in"><span><i class="fa fa-book"></i> Прочитали источников:</span> {{$post->read_the_sources}} шт.</div></div>
                    @endif
                    @if($post->write_articles !=null)
                    <div class="col-sm-4"><div class="t-in"><span><i class="fa fa-hourglass-half"></i> Писали статью:</span> {{$post->write_articles}} мин.</div></div>
                    @endif
                    <br><br>
                </div>
                @endif

                @if($post->the_author_answers)
                    <div class="the_author_answers"><i class="fa fa-check-square-o"></i> Автор отвечает на вопросы</div>
                @endif

                @if($post->date_upd != null)
                @if($post->pcid != '8')
                <div class="upd-post"><i class="fa fa-refresh"></i> Информация обновлена: {{date('d.m.Y',strtotime($post->date_upd))}}</div>
                @endif
                @endif

                @if($postCategory->show_date_publish_in_posts && $post->date != null)
                <p class="date">Опубликовано: {{date('d.m.Y',strtotime($post->date))}}</p>
                @endif
        
                @if($post->valid_until != null && $post->pcid == 8)
                <p class="date">Действует до: {{date('d.m.Y',strtotime($post->valid_until))}}</p>
                @endif

                <div class="clearfix"></div>

                
                <div class="content">

                    {!! TagsParser::compile(Shortcode::compile($post->content)) !!}

                    @if(is_mobile_device())
                    @if($post->infographic != null)
                        <img loading="lazy" src="{{$post->infographic}}" alt="{{$post->h1}}">
                    @endif
                    @endif


                    @if(count($related)>0)
                    <div class="related">
                        <b class="h2">Рекомендовано для вас</b>
                        <ul>
                            @foreach($related as $p)
                            <li><a href="/{{$p->alias_category}}/{{$p->alias}}.html" rel="bookmark" title="{{$p->h1}}">{{$p->h1}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    @endif


                    @if($postCategory->show_author_in_posts && $author != null)
                    <div class="author-info">
                        <div class="left-wrap"><img loading="lazy" src="{{$author->photo}}" alt="{{$author->name}}"></div>
                        <div class="right-wrap">
                            <a href="/about#{{\Str::slug($author->name)}}" class="name_wrap">{{$author->name}}</a>
                            <div class="desc_wrap"><p>{!! $author->text !!}</p>
                            </div>
                            <span class="email_wrap">{{$author->email}}</span>
                        </div>
                    </div>
                    @endif

                    @if(isset($GLOBALS['shortcodes']['experts']) != null)
                        @foreach($GLOBALS['shortcodes']['experts'] as $expert)
                            <div class="author-info">
                                <div class="left-wrap"><img loading="lazy" src="{{$expert->photo}}" alt="{{$expert->name}}"></div>
                                <div class="right-wrap">
                                    <a href="/about#{{str_slug($expert->name)}}" class="name_wrap">{{$expert->name}}</a>
                                    <div class="desc_wrap"><p>{!! $expert->short_text !!}</p>
                                    </div>
                                    <span class="email_wrap">{{$expert->email}}</span>
                                    <div class="social_networks_wrap">{!! $expert->social_networks !!}</div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                    <div class="bordered-rating star-rating light-border">
                        <div class="post-ratings"  data-nonce="2d7c6c6fcb" data-type="post" data-id="{{$post->id}}">
                            {!! RatingParser::printIRatingByValue($post->average_rating) !!}
                            (<span class="bold">{{$post->number_of_votes}}</span> оценок, среднее: <span class="bold">{{$post->average_rating}}</span> из 5)
                            <br />
                        </div>
                    </div>
                    
                    @if($author != null)
                        <?php if ( !isset($GLOBALS['issetStructuredProduct'])) $GLOBALS['issetStructuredProduct'] = true; ?>
                        <script type="application/ld+json">{
                             "@context": "http://schema.org",
                             "@type": "Product",
                             "aggregateRating": {
                             "@type": "AggregateRating",
                               "bestRating": "5",
                               "ratingCount": "{{$post->number_of_votes}}",
                               "ratingValue": "{{$post->average_rating}}"
                             },
                             "review": {
                             "@type": "Review",
                             "name": "{{$post->h1}}" ,
                             "author": "{{$author->name}}"
                             },
                             "image": "https://finance.ru/old_theme/img/logo_old.png",
                             "name": "{{$post->h1}}",
                             "description" : "{{$post->meta_description}}",
                            "sku": "{{$post->id}}",
                             "slogan": "ФинансыРу",
                             "url": "https://finance.ru{{$_SERVER['REQUEST_URI']}}",
                             "brand": "ФинансыРу"
                            }
                        </script>
                    @endif


                    <div class="share-wrap light-border">
                        <script async src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
                        <script async src="//yastatic.net/share2/share.js"></script>
                        <div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,twitter,lj"></div>
                    </div>

                </div><?/* content  */ ?>


                    @if($postCategory->show_comments_in_posts)
                    <div class="comments-add-form">
                        <div id="AddCommentWrap">
                            <div class="title-comments"><i class="fa fa-commenting"></i> Оставить комментарий</div>
                            <form action="#" method="post" id="AddComment">
                                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                <input type="hidden" name="post" id="commentPost" value="{{$post->id}}">
                                <input type="hidden" name="parent" id="commentParent" value="0">

                                <div class="form-line form-group">
                                    <label>Имя:</label>
                                    @if($uid != null)
                                    <input id="commentUserName" class="width-100" name="name" required readonly="true" value="{{$uidName}}">
                                    <input type="hidden" id="commentUserId" name="id" value="{{$uid}}">
                                    @else
                                    <input id="commentUserName" class="width-100" name="name" required>
                                    <input type="hidden" id="commentUserId" name="id" value="null">
                                    @endif
                                </div>
                                <div class="form-line form-group">
                                    <label>Комментарий:</label>
                                    <textarea id="commentUserComment" class="width-100" name="comment" required></textarea>
                                </div>
                                @if(Auth::id()==null)
                                <div class="form-group">
                                    <div class="g-recaptcha" data-sitekey="6LdYqz0UAAAAAPKI1karX0-Gr35D7_MVfO8IN2TD"></div>
                                </div>
                                @endif
                                <div class="form-line form-group">
                                    <button class="width-100 form-btn1">Отправить комментарий <i class="fa fa-arrow-right"></i></button>
                                </div>
                            </form>
                        </div>
                        @foreach($postsComments as $comment)
                        <div class="comment-item" id="comment-{{$comment->id}}">
                            <div class="title-line form-group">@if($comment->author_name!=null) {{$comment->author_name}} @else {{$comment->last_name}} {{$comment->first_name}} {{$comment->middle_name}} @endif</div>
                            <div class="text-rew">
                                <p>{{$comment->comment}}</p>
                            </div>
                            @if(isset($comment->child))
                            @foreach($comment->child as $child)
                                <div class="comment-item" id="comment-{{$child->id}}">
                                    <div class="title-line">@if($child->author_name!=null) {{$child->author_name}} @else {{$child->last_name}} {{$child->first_name}} {{$child->middle_name}} @endif</div>
                                    <div class="text-rew">
                                        <p>{{$child->comment}}</p>
                                    </div>
                                </div>
                            @endforeach
                            @endif
                            <div class="reply" data-id="{{$comment->id}}">
                                <a rel="nofollow" class="comment-reply-link" href="#">Ответить</a>
                            </div>
                        </div>
                        @endforeach
                    </div><?/* comments-add-form */ ?>
                    @endif


                    <progress value="0">
                        <div class="progress-container">
                            <span class="progress-bar"></span>
                        </div>
                    </progress>
                
            </div>


        </div><?php /* end col-md-9 */ ?>
        <div class="col-lg-3 d-lg-block d-xs-none d-none">
            @include('site.v3.modules.includes.sidebar')
        </div><?php /* md-3 */ ?>
    </div><?php /*row */ ?>
</section>

@endsection


@section('additional-scripts')
<script async src="/vzo_theme/js/MathJax/MathJax.js?config=TeX-MML-AM_CHTML"></script>
<script>
    /*
    MathJax.Hub.Config({
        "HTML-CSS" : {
            availableFonts : ["STIX"],
            preferredFont : "STIX",
            webFont : "Latin-Modern",
            imageFont : null
        }
    });
    */
</script>
<script async src="/vzo_theme/js/scripts/8_posts/posts.js?v=2"></script>
<script>window.post_id = "{{$post->id}}"</script>
@endsection
