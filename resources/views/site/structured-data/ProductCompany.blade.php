@if($company->number_of_votes > 0)
<?php
    if (!isset($page)) {
        $page = $company;
    }
    [$highPrice, $lowPrice, $offersCode] = \App\Algorithms\Frontend\StructuredData\Product\Companies::render($cards);
?>
<script type="application/ld+json">
{
    "@context": "http://schema.org",
        "@type": "Product",
        "aggregateRating": {
        "@type": "AggregateRating",
        "bestRating": "5",
        "ratingCount": "{{$company->number_of_votes}}",
        "ratingValue": "{{$company->average_rating}}"
    },
    "image": "https://finance.ru{{$company->img}}",
    "name": "{{$page->h1}}",
    "description" : "{{Shortcode::compile($page->meta_description)}}",
    "sku": "{{$page->id}}",
    "offers": {
        "@type": "AggregateOffer",
        "highPrice": "{{$highPrice}}",
        "lowPrice": "{{$lowPrice}}",
        "offerCount": "{{count($cards)}}",
        "priceCurrency": "Rub",
    "offers": [
     {!! $offersCode !!}
    ]
    }
}
</script>
@endif