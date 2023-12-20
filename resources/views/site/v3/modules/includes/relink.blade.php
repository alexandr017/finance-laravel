@if(isset($relinkData))
        <?php $k=0; ?>
    @foreach($relinkData as $groupName => $groupData)
        <div class="side-block-dart">
            <div class="side-title">{{$groupName}} <i class="fa @if($k==0) fa-angle-up @else fa-angle-down @endif"></i></div>
            <div class="side-box links-list @if($k!=0) display_none @endif">
                @foreach($groupData as $link)
                    <a class="sidebar" href="/{{$link->link}}">{{$link->title}}</a>
                @endforeach
            </div>
        </div>
            <?php $k++ ;?>
    @endforeach
@endif