$(function() {
    $(document).on('click','.card-mn-open-km-rating',function(event) {
        var target = $(event.target);
        var element = target.parent().parent().parent().parent().parent();
        element.find('.card-mn-more-details').click();
        element.find('.card-mn-km-rate').click();
    })
    $(document).on('click','.card-mn-more-details',function(event){
        var target = $( event.target );
        event.preventDefault();
        target.parent().find('.card-mn-details-block').toggleClass('display_none');
        target.find('i').toggleClass('fa-chevron-up');
        target.find('i').toggleClass('fa-chevron-down');
        /*
        target.parent().find('.card-mn-icons-slider').not('.slick-initialized').slick({
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
        */
        target.parent().find('.card-mn-icons-slider-js').addClass('jsSlideTemporaryClass'+target.parent()[0].id);
        var cardMnIconsClassList = target.parent().find('.card-mn-icons-slider-js')[0].classList;
        if(cardMnIconsClassList.value.indexOf('jsSlideMainBlock')== -1){
            slideShow({
                element:'.jsSlideTemporaryClass'+target.parent()[0].id,
                slidesToShow:4,
                slidesToScroll:1,
                circleScroll:false,
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
            })
        }

        /*
        target.parent().find('.card-mn-icons-slider').on('init', function(event, slick){
            $(this).removeClass('.display_none')
        });

         */

        target.parent().find('.k5m-info').html('<p class="card-mn-text-centered">К5М® — рейтинг, с помощью которого мы оцениваем финансовые продукты (например, микрозаймы, кредиты или кредитные карты). Для объективной оценки используется сложная формула, которая учитывает большое число параметров (в сентябре 2016 года их было всего 5 штук, а через два года — уже более 80). В процессе оценки задействованы не только основные параметры продукта (такие как сумма или процентная ставка кредита), но и оценки клиентов.</p>\n' +
            '<a class="form-btn1" target="_blank" rel="nofollow" href="/about">Детальнее о К5М</a>');

        target.parent().find('.needCR-text').text('С помощью кредитного рейтинга вы можете моментально узнать свое «финансовое здоровье», которое представлено в виде числового показателя в районе 300-850 баллов. Главное преимущество — вы получите информацию, заполнив лишь небольшую форму, в режиме онлайн совершенно бесплатно. Без платы за подписку и навязчивой рекламы.');

    })
    $(document).on('click','.video-button',function(event){
            var target = $( event.target );
            var parent = $(this).closest('.insert-video-wrap');
            var video = parent.find('.data-video').attr('data-video');
            var html = '<div class="iframe-shadow"><iframe width="560" height="315" src="'+ video +'"></iframe></div>';
            parent.html(html);
    });
    $(document).on('click','.card-mn-details-block .nav li',function(event){
        var element = $(event.target);
        event.preventDefault();
        var tabBlock = element.attr('data-tab');
        var elBlock = element.parent().parent().parent();
        elBlock.find('.active').addClass('card-mn-tab-pane');
        elBlock.find('.active').removeClass('active');
        elBlock.find('.nav').removeClass('active');
        element.addClass('active');
        elBlock.find('.card-mn-tab-content .card-mn-tab-pane').css('display','none');
        if(elBlock.find('.card-mn-tab-content .'+tabBlock).length !=0) {
            elBlock.find('.card-mn-tab-content .'+tabBlock).css('display','flex')
        }
    })
})

