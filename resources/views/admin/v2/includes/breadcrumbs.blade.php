@if (isset($breadcrumbs))
    <div class="page-breadcrumb">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/admin/index" class="breadcrumb-link">Панель управления</a>
                </li>
                @foreach ($breadcrumbs as $breadcrumb)
                    @if (!$loop->last)
                        <li class="breadcrumb-item"><a href="{{ $breadcrumb['link'] }}">{{ $breadcrumb['h1'] }}</a></li>
                    @else
                        <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb['h1'] }}</li>
                    @endif
                @endforeach
            </ol>
        </nav>
    </div>
@endif
