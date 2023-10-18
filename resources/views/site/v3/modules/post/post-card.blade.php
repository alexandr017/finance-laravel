<div class="news_item" id="bx_3088343977_17844">

    <div class="news_item-head">
        <div class="news_item-pic">
            <a href="/{{$post->urls?->url}}">
                <img class="preview_picture" border="0" src="{{$post->preview}}" alt="{{$post->h1}}" title="{{$post->h1}}" style="float:left">
            </a>
        </div>

        <div class="news_item-section_tag">
            <a href="/{{$post->category?->urls?->url}}">
                {{$post->category->h1}}
            </a>
        </div>
    </div>

    <div class="news_item-data">
        <div class="news_item-data_head">
            <div class="news_item-date_time">
                {{$post->created_at?->formatLocalized('%e %B %Y')}}
            </div>
            <div class="news_item-rating">
                {{$post->rating_value}}
            </div>
            <div class="news_item-rating_star">
                <img src="/images/system/rating_star_blue.svg" alt="Рейтинг статьи" title="Рейтинг статьи">
            </div>
        </div>
        <div class="news_item-title">
            <a href="{{$post->urls?->url}}">
                {{$post->h1}}
            </a>
        </div>
    </div>

</div>

@push('styles')
    <link href="{{ Vite::asset('resources/css/post/post-card.css') }}" rel="stylesheet">
@endpush

