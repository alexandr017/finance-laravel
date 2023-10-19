<div class="post-wrap">
    @foreach ($vzo_news as $key => $post)
        <div class="vzo_news_block">
            <div class="vzo_news_img">
                <img loading="lazy" src="{!! $post->thumbnail !!}" alt="{!! $post->h1 !!}">
            </div>
            <div class="vzo_news_text">
                <a href="/news/vzo/{!! $post->alias !!}.html">{!! $post->h1 !!}</a>
                <p>{!! $post->short_content !!}</p>
            </div>
        </div>
    @endforeach
    <a class="read-full-posts" href="/news/vzo">Все новости #ВЗО <i class="fa fa-chevron-right"></i></a>
</div>