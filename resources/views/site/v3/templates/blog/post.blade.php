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
                @if($post->date_upd != null)
                @if($post->pcid != '8')
                <div class="upd-post"><i class="fa fa-refresh"></i> Информация обновлена: {{date('d.m.Y',strtotime($post->date_upd))}}</div>
                @endif
                @endif

                @if($postCategory->show_date_publish_in_posts && $post->date != null)
                <p class="date">Опубликовано: {{date('d.m.Y',strtotime($post->date))}}</p>
                @endif
        
                @if($post->valid_until != null)
                <p class="date">Действует до: {{date('d.m.Y',strtotime($post->valid_until))}}</p>
                @endif

                <div class="clearfix"></div>

                
                <div class="content">
                    {!! TagsParser::compile(Shortcode::compile($post->content)) !!}


                    @if(count($relatedPosts)>0)
                    <div class="related">
                        <b class="h2">Рекомендовано для вас</b>
                        <ul>
                            @foreach($relatedPosts as $p)
                            <li><a href="/{{$p->alias_category}}/{{$p->alias}}.html" rel="bookmark" title="{{$p->h1}}">{{$p->h1}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="bordered-rating star-rating light-border">
                        <div class="post-ratings" data-type="post" data-id="{{$post->id}}">
                            {!! RatingParser::printIRatingByValue($post->average_rating) !!}
                            (<span class="bold">{{$post->number_of_votes}}</span> оценок, среднее: <span class="bold">{{$post->average_rating}}</span> из 5)
                            <br />
                        </div>
                    </div>

                    <div class="share-wrap light-border">
                        <script async src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
                        <script async src="//yastatic.net/share2/share.js"></script>
                        <div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,twitter,lj"></div>
                    </div>

                </div><?php /* content  */ ?>


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
                                    <input id="commentUserName" class="width-100" name="name" required>
                                    <input type="hidden" id="commentUserId" name="id" value="null">
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
                    </div><?php /* comments-add-form */ ?>
                    @endif

            </div>


        </div><?php /* end col-md-9 */ ?>
        <div class="col-lg-3 d-lg-block d-xs-none d-none">
            @include('site.v3.modules.includes.sidebar')
        </div><?php /* md-3 */ ?>
    </div><?php /*row */ ?>
</section>

@endsection


@section('additional-scripts')
<script async src="/vzo_theme/js/scripts/8_posts/posts.js?v=2"></script>
<script>window.post_id = "{{$post->id}}"</script>
@endsection
