@foreach($structured_data_video as $item)
<script type="application/ld+json">
{
"@context": "https://schema.org",
"@type": "VideoObject",
"name": "{{$item->name}}",
"description": "{{$item->description}}",
"thumbnailUrl": [
"{{$item->thumbnailUrl}}"
],
"uploadDate": "{{$item->uploadDate}}T09:00:00+03:00",
"duration": "PT5M12S",
"contentUrl": "{{$item->contentUrl}}",
"embedUrl": "{{$item->contentUrl}}"
}
</script>
@endforeach

