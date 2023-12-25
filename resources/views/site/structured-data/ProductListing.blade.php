@if($page->number_of_votes > 0)
<?php
[$highPrice, $lowPrice, $offersCode] = \App\Algorithms\Frontend\StructuredData\Product\Companies::render($cards);
?>
<script type="application/ld+json">
{
    "@context": "http://schema.org",
    "@type": "Product",
    "aggregateRating": {
    "@type": "AggregateRating",
        "bestRating": "5",
        "ratingCount": "{{$page->number_of_votes}}",
        "ratingValue": "{{$page->average_rating}}"
    },
    "image": "https://finance.ru{{$page->img}}",
    "name": "{{$page->h1}}",
    "description" : "{{\Shortcode::compile($page->meta_description)}}",
    "sku": "{{$page->id}}",
    "offers": {
        "@type": "AggregateOffer",
        "highPrice": "{{$highPrice}}",
        "lowPrice": "{{$lowPrice}}",
        "offerCount": "{{count($cards)}}",
        "priceCurrency": "RUB",
        "offers": [
            {!! $offersCode !!}
        ]
    }
}
</script>
@endif