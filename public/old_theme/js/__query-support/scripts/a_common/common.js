$(function(){

    // hide FAQ first element for mobile
    if(document.body.clientWidth <= 769){
        //$('#ca1').collapse('hide');
    }

    // selects
    $(document).on('click','.new-select span',function(){
        var text = $(this).text();
        var val = $(this).attr('data-val');
        $(this).closest('.new-select').find('b').text(text);
        $(this).closest('.new-select').find('b').attr('data-val',val);
        $(this).closest('div').hide();
    });

    $('.new-select i').on('click',function(){
        $('.new-select div').not($(this).closest('.new-select').find('div')).hide();
        $(this).closest('.new-select').find('div').toggle();
    });


});


// menu hover on desktop
if($(window).width() > 769){
    $('header ul li').on('mouseover',function(e){
        $(this).find('ul').show();
        width = $(this).find('a').width();
        $(this).find('.menu-cursor').css('transform','translateX('+ (width/2-7) +'px) rotate(45deg)');

    }).on('mouseout',function(e){

        $(this).find('ul').hide();
        $(this).find('.menu-cursor').remove();
    });
}


