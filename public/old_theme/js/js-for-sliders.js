
if(document.getElementById('popular_banks_slider')){
    slideShow({
        element:'#popular_banks_slider',
        slidesToShow:3,
        slidesToScroll:1,
        circleScroll:false,
        customArrowsTop: '35',
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
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
if(document.getElementsByClassName('post-slider').length >0){
    slideShow({
        element:'.post-slider',
        slidesToShow:3,
        slidesToScroll:1,
        circleScroll:true,
        height:'250',
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
    })
}

if(document.getElementsByClassName('reviews').length>0){
    slideShow({
        element:'.reviews',
        slidesToShow:3,
        slidesToScroll:1,
        circleScroll:true,
        height:'285',
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }
        ]
    })
}

/*
if(document.getElementsByClassName('experts').length>0){
    slideShow({
        element:'.experts',
        slidesToShow:4,
        slidesToScroll:1,
        circleScroll:true,
        height:'250',
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 2
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
*/


if(document.getElementById('loansSlider')){
    slideShow({
        element:'#loansSlider',
        slidesToShow:3,
        slidesToScroll:1,
        circleScroll:true,
        height:'140',
        blockWidth: '100',
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }
        ]
    })
}

if(document.getElementById('debitCardsSlider')){
    slideShow({
        element:'#debitCardsSlider',
        slidesToShow:3,
        slidesToScroll:1,
        circleScroll:true,
        height:'190',
        blockWidth: '100',
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }
        ]
    })
}
if(document.getElementById('creditCardsSlider')){
    slideShow({
        element:'#creditCardsSlider',
        slidesToShow:3,
        slidesToScroll:1,
        circleScroll:true,
        height:'170',
        blockWidth:'100',
        responsive: [
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

if(document.getElementById('creditsSlider')){
    slideShow({
        element:'#creditsSlider',
        slidesToShow:3,
        slidesToScroll:1,
        circleScroll:true,
        height:'140',
        blockWidth:'100',
        responsive: [
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
if(document.getElementById('autoCreditsSlider')){
    slideShow({
        element:'#autoCreditsSlider',
        slidesToShow:3,
        slidesToScroll:1,
        circleScroll:true,
        height:'170',
        blockWidth:'100',
        responsive: [
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
if(document.getElementById('rkoSlider')){
    slideShow({
        element:'#rkoSlider',
        slidesToShow:3,
        slidesToScroll:1,
        circleScroll:true,
        height:'140',
        blockWidth:'100',
        responsive: [
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
if(document.getElementById('newsSlider')){
    slideShow({
        element:'#newsSlider',
        slidesToShow:3,
        slidesToScroll:1,
        circleScroll:true,
        height:'280',
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    height:'300'
                }
            }
        ]
    })
}
if(document.getElementById('zalogiSlider')){
    slideShow({
        element:'#zalogiSlider',
        slidesToShow:3,
        slidesToScroll:1,
        circleScroll:true,
        height:'140',
        blockWidth:'100',
        responsive: [
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

if(document.getElementById('mortgageSlider')){
    slideShow({
        element:'#mortgageSlider',
        slidesToShow:3,
        slidesToScroll:1,
        circleScroll:true,
        height:'140',
        blockWidth:'100',
        responsive: [
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

if(document.getElementById('depositsSlider')){
    slideShow({
        element:'#depositsSlider',
        slidesToShow:3,
        slidesToScroll:1,
        circleScroll:true,
        height:'140',
        blockWidth:'100',
        responsive: [
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

if(document.getElementById('cashBackSlider')){
    slideShow({
        element:'#cashBackSlider',
        slidesToShow:3,
        slidesToScroll:1,
        circleScroll:true,
        height:'140',
        blockWidth:'100',
        responsive: [
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
if(document.getElementById('insuranceSlider')){
    slideShow({
        element:'#insuranceSlider',
        slidesToShow:3,
        slidesToScroll:1,
        circleScroll:true,
        height:'140',
        blockWidth:'100',
        responsive: [
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
if(document.getElementById('ic-partner_licenses-slider')){
    slideShow({
        element:'#ic-partner_licenses-slider',
        slidesToShow:3,
        slidesToScroll:1,
        circleScroll:true,
        height:'302',
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    height:'400'
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }
        ]
    })
}
if(document.getElementById('ic-partners-slider')){
    slideShow({
        element:'#ic-partners-slider',
        slidesToShow:3,
        slidesToScroll:1,
        circleScroll:true,
        height:'117',
        customArrowsTop:'25',
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
    })
}
