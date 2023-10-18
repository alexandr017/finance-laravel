$(function(){

$("#search-company").bind("change paste keyup", function() {
    var search_term = $(this).val().toLowerCase();

    if($(this).val().length>=2){
        $('.companies-flex-item').each(function(val){
            var title = $(this).find('.company_title');
            var lower_case_title = title[0].innerHTML.toLowerCase();
            if(lower_case_title.indexOf(search_term) == -1){
                $(this).css('display','none');
            } else {
                $(this).css('display','block');
            }
        })
    }else{
        $('.companies-flex-item').css('display','block');
    }
});
$(document).on('click', '.bvc-read', function (){
    $(this).next().toggleClass('display_hidden_line');
    $(this).find('i').toggleClass('fa-angle-up').toggleClass('fa-angle-down');
});
function sort(sort_by_field,sort_direction) {
    var nodeList = document.querySelectorAll('.companies-flex-item');
    var itemsArray = [];
    var parent = nodeList[0].parentNode;
    var field = sort_by_field;
    for (var i = 0; i < nodeList.length; i++) {
        itemsArray.push(parent.removeChild(nodeList[i]));
    }
    itemsArray.sort(function(nodeA, nodeB) {
        var numberA = Number((nodeA.querySelector('.showed-line .showed-wrapper-'+field+'').textContent).replace(/\s/g, ''));
        var numberB = Number((nodeB.querySelector('.showed-line .showed-wrapper-'+field+'').textContent).replace(/\s/g, ''));
        if(sort_direction == 0){
            if (numberA < numberB) return -1;
            if (numberA > numberB) return 1;
        }else {
            if (numberA < numberB) return 1;
            if (numberA > numberB) return -1;
        }
        return 0;
    })
        .forEach(function(node) {
            $('.companies_blocks').append(node);
        });
}
$('.sort-item').on('click',function () {
    $('.sort-item').not(this).removeClass('up');
    var sort_by_field = $(this).data('field');
    $(this).toggleClass('up');
    if(!$(this).hasClass('up')){
        var sort_direction = 0;
    } else{
        var sort_direction = 1;
    }
    sort(sort_by_field+1,sort_direction);
});

});



// алгоритм смены направления в сортировке и выбор текущего
$('.sorting-line span').on('click',function() {
    if ($(this).parent().hasClass('active')) {
        if ($(this).parent().find('i').hasClass('fa-arrow-circle-up')) {
            $(this).parent().find('i').removeClass('fa-arrow-circle-up').addClass('fa-arrow-circle-down');
            var sort_type = 'desc';
        } else {
            var sort_type = 'asc';
            $(this).parent().find('i').addClass('fa-arrow-circle-up').removeClass('fa-arrow-circle-down');
        }
        window.sort_type = sort_type;


        window.default_sorting_counter = 0;

    } else {
        $('.sorting-line li').each(function () {
            $(this).removeClass('active');
            $(this).find('i').attr('class', '');
        });
        $(this).parent().find('i').addClass('fa-arrow-circle-down').addClass('fa')
        $(this).parent().addClass('active');

    }
});
