@if(isset($blogCategories))
    <div class="side-block news-categories">
        <div class="side-title"><i class="fa fa-folder-open-o"></i> Рубрики</div>
        <div class="side-box options-list">
            <ul class="mb0 rating-mfk">
                @foreach($blogCategories as $blogCategory)
                    <li><a rel="nofollow" href="/{{$blogCategory->alias_category}}">{{$blogCategory->short_name}}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
@endif