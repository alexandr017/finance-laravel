@foreach($posts as $post)
    <div class="news-post-item bold">
        <a class="news-post-item-link" href="/{{$post->alias_category}}/{{$post->alias}}.html">
            <span class="news-post-date">{{date('d.m.Y',strtotime($post->date))}}</span>
                <?php $post_h1 = ($post->h1_in_category != null) ? $post->h1_in_category : $post->h1; ?>
            {{Shortcode::compile($post_h1)}}
        </a>
    </div>
@endforeach