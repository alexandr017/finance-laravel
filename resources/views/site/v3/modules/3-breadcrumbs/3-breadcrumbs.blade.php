@if(isset($breadcrumbs))
<div class="breadchumb" id="navigation">
    <div class="bx-breadcrumb max-width">
        <span class="bx-breadcrumb-item">
        <a href="/" title="Главная">
            <span>Главная</span>
        </a>
        </span>
        @foreach($breadcrumbs as $key => $breadcrumb)
            @if(is_integer($key))
                @if ($key != (count($breadcrumbs)-1))
                    <span class="bx-breadcrumb-item">
                    <span class="separator">/</span>
                        <a href="/about/" title="{{$breadcrumb['h1']}}">
                            <span>{{$breadcrumb['h1']}}</span>
                        </a>
                    </span>
                @else
                    @if(isset($breadcrumb['h1']))
                        <span class="bx-breadcrumb-item last-element">
                            <span class="separator">/</span>
                            <span>{{$breadcrumb['h1']}}</span>
                        </span>
                        <span style="clear:both"></span>
                    @else
                        <span class="bx-breadcrumb-item last-element">
                            <span class="separator">/</span>
                            <span>{{$breadcrumb}}</span>
                        </span>
                        <span style="clear:both"></span>
                    @endif
                @endif
            @elseif (is_string($breadcrumb))
                <span class="bx-breadcrumb-item last-element">
                    <span class="separator">/</span>
                        <span>{{$breadcrumb}}</span>
                    </span>
                <span style="clear:both"></span>
            @endif
        @endforeach
    </div>
</div>
@endif
