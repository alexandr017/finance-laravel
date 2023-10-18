$(function () {
    $('.post-slider').slick({
        dots: false,
        infinite: true,
        speed: 300,
        slidesToShow: 3,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

});

$('.news-post-load').on('click', function(){

    var btn = $(this);

    var offsetTop = $(window).scrollTop();

    var category_id = $(this).attr('data-id');
    var page = $(this).attr('data-page');
    page++;
    $(this).attr('data-page',page);

    $.ajax({
        url: "/posts/load_more",
        method: "GET",
        data: {
            'category_id':category_id,
            'page':page
        },
        success: function(html){
            btn.parent().prev().append(html['code']);
            update_img_and_bg_full_version();
            $(window).scrollTop(offsetTop);
            if (!html['next_count']) {
               btn.hide();
            }
        }
    });


});



