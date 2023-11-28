@if(Request::path() == 'banki' && isset($relinkData))
@foreach($relinkData as $categoryName => $groups)
<div class="side-block-dart">
    <div class="side-title"><i class="fa fa-angle-up"></i> {{$categoryName}}</div>
    <div class="side-box links-list display_none">
        @foreach($groups as $group)
        <div class="bold text-center">{{$group->group_name}}</div>
        @foreach($group->items as $link)
        <a class="sidebar" href="<?= str_replace('https://finance.ru', '', $link->link) ?>">{{$link->title}}</a>
        @endforeach
        <br>
        <br>
        @endforeach
    </div>
</div>
@endforeach
@endif