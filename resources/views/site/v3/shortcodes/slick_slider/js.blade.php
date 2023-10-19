@if(is_array($GLOBALS['shortCodeSlider']))
    @foreach($GLOBALS['shortCodeSlider'] as $slideItem)
        <?php if(!is_array($slideItem)) continue ?>
<script>
    $(function(){
        $('#sliderWrap{{$slideItem['sliderId']}}').slick({
            dots: false,
            infinite: false,
            speed: 300,
            infinite: true,
            slidesToShow: {{$slideItem['pcShow']}},
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: {{$slideItem['mobShow']}},
                        slidesToScroll: 1
                    }
                }
            ]
        });
    });

</script>
    @endforeach
@endif
