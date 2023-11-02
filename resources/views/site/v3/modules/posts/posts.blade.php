@foreach($posts as $post)
    <?php $post_h1 = ($post->h1_in_category != null) ? $post->h1_in_category : $post->h1; ?>
    <div class="col-md-4">
        <a href="/{{$post->alias_category}}/{{$post->alias}}.html">
            <?php $availability = ($post->availability == null || $post->availability =='no') ? 'unavailable' : 'available'; ?>
            <?php echo Shortcode::compile($post_h1); ?>
        </a>
        <div class="post-info">
            <div class="post-date">{{date('d.m.Y',strtotime($post->date))}}</div>
            <div class="post-views"><i class="fa fa-eye"></i> {{$post->views}}</div>
            <div class="post-comments"><i class="fa fa-comment-o"></i> {{$post->comments_count}}</div>
        </div>
    </div>
@endforeach