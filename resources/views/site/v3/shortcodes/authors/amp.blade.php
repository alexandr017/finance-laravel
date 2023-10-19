<div class="go_to_account author_in_post">
    <div class="authors_code_block">
        <div class="author_img">
            <amp-img src="{!! $current_author->photo !!}" width="145px" height="145px" alt="{!! $current_author->name !!}" layout="fixed"></amp-img>
            <p class="author_name">{!! $current_author->name !!}</p>
        </div>
        <div class="author_text">
            {!! $content !!}
        </div>
    </div>
</div>