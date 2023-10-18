$(function() {
    $(document).on('click','.beta-card-open-km-rating',function(event) {
        var target = $(event.target);
        var element = target.parent().parent().parent().parent().parent();
        element.find('.beta-card-more-details').click();
        element.find('.beta-card-km-rate').click();
    })
    $(document).on('click','.video-button',function(event){
            var target = $( event.target );
            var parent = $(this).closest('.insert-video-wrap');
            var video = parent.find('.data-video').attr('data-video');
            var html = '<div class="iframe-shadow"><iframe width="560" height="315" src="'+ video +'"></iframe></div>';
            parent.html(html);
    });
    $(document).on('click','.beta-card-more-details',function(event){
        var target = $( event.target );
        event.preventDefault();
        target.parent().find('.beta-card-details-block').toggleClass('display_none');
        target.find('i').toggleClass('fa-chevron-up');
        target.find('i').toggleClass('fa-chevron-down');
        target.parent().find('.beta-card-icons-slider').not('.slick-initialized').slick({
            dots: false,
            infinite: false,
            speed: 300,
            slidesToShow: 4,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                },
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
        target.parent().find('.beta-card-icons-slider').on('init', function(event, slick){
            $(this).removeClass('.display_none')
        });
    })
    $(document).on('click','.beta-card-details-block .nav a',function(event){
        var element = $(event.target);
        event.preventDefault();
        var tabBlock = element.attr('data-tab');
        var elBlock = element.parent().parent().parent();
        elBlock.find('.active').addClass('beta-card-tab-pane');
        elBlock.find('.active').removeClass('active');
        elBlock.find('.nav').removeClass('active');
        element.parent().addClass('active');
        elBlock.find('.beta-card-tab-content .beta-card-tab-pane').css('display','none');
        if(elBlock.find('.beta-card-tab-content .'+tabBlock).length !=0) {
            elBlock.find('.beta-card-tab-content .'+tabBlock).css('display','flex')
        }
    })
})
