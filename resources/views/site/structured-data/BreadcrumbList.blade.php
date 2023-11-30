@if(isset($breadcrumbs))
    <script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
    {
            "@type": "ListItem",
            "position": 1,
            "name":  "ФинансыРу" ,
            "item":  "https://finance.ru"
    },
    <?php $breadcrumbCounter = 2; ?>
        @foreach($breadcrumbs as $key => $breadcrumb)
            @if($breadcrumbCounter != 2)
                @if (count($breadcrumbs)-1),@endif
            @endif
            {
                "@type": "ListItem",
                "position": {{$breadcrumbCounter}},
            "name": @if(isset($breadcrumb['h1'])) "{{$breadcrumb['h1']}}" @else "" @endif,
            @if ($key != (count($breadcrumbs)-1))
                "item": @if(isset($breadcrumb['link'])) "https://finance.ru{{$breadcrumb['link']}}" @else "" @endif
            @else
                "item": "{{Request::url()}}"
            @endif
            }
<?php $breadcrumbCounter++; ?>
        @endforeach
        ]
    }
</script>
@endif