$(function () {
    $('.vertical_tab_title').click(function () {
        $('.vertical_tab_mob_block').find('.active').removeClass('active');
        $('.vertical_tab_mob_block').find('.show').removeClass('show');
        $(this).addClass('active');
        $(this).find('.rtext').addClass('show');
    })
})