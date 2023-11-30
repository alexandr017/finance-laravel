<script type="application/ld+json">
{
     "@context": "http://schema.org",
     "@type": "Product",
     "aggregateRating": {
     "@type": "AggregateRating",
       "bestRating": "5",
       "ratingCount": "{{$post->number_of_votes}}",
       "ratingValue": "{{$post->average_rating}}"
     },
     "image": "https://finance.ru/old_theme/img/logo.svg",
     "name": "{{$post->h1}}",
     "description" : "{{$post->meta_description}}",
     "sku": "{{$post->id}}",
     "slogan": "ФинансРу",
     "url": "https://finance.ru{{$_SERVER['REQUEST_URI']}}",
     "brand": "ФинансРу"
    }
}
</script>