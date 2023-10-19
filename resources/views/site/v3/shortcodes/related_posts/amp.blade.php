<div class="related_in_post border">
    <div class="h3 text-center">Рекомендовано для вас</div>
    <ul>
    @foreach($postsDB as $key => $post)
        @if(!$post->status)
            @continue
        @endif
        @php
            $categoryUrl = '';
        @endphp
        @foreach($posts_categories as $key2 => $category)
            @php
                if($post->pcid == $category->id) $categoryUrl = $category->alias_category;
            @endphp
        @endforeach
        @php
            $h1 = str_replace('"', "'", $post->h1);
        @endphp
        <li><a href="/{{$categoryUrl}}/{{ $post->alias }}.html">{{ $h1 }}</a></li>
    @endforeach
    @if(isset($terms))
        @foreach ($termsDB as $key => $term)
            @php
                $h1 = str_replace('"', "'", $term->h1);
            @endphp
            <li><a href="/terms/{{ $term->alias }}" target="_blank">{{ $h1 }}</a></li>
        @endforeach
    @endif
    </ul>
</div>