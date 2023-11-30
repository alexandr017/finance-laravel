@if($page->number_of_votes > 0)
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
    "image": "{{$page->img}}",
    "name": "{{$page->h1}}",
    "description" : "{{$page->meta_description}}",
    "sku": "{{$page->id}}",
    "slogan": "ФинансыРу",
    "url": "https://finance.ru{{$_SERVER['REQUEST_URI']}}",
    "brand": "ФинансыРу"
}
</script>
@endif