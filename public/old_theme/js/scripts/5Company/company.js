addTableWrap('.overpayment-table');

function addTableWrap(selector){
    $(selector).each(function(){
        let table = $(this);
        i = 0;
        $(table).find('tr').each(function(){
            i++;
        });
        if(i > 7){
            i = 0;
            table.wrap('<div class="table-toggle-wrap"></div>');
            table.after('<span class="table-toggle down">Показать всё <i class="fa fa-chevron-down"></i></span>');
            $(table).find('tr').each(function(){
                i++;
                if(i>7) $(this).addClass('hide');
            });
        }
    });
}

$(document).on('click','.table-toggle.down',function(){
    $(this).html('Скрыть <i class="fa fa-chevron-up"></i>').removeClass('down').addClass('up');
    $(this).parent('.table-toggle-wrap').find('tr').removeClass('hide');
});

$(document).on('click','.table-toggle.up',function(){
    $(this).html('Показать всё <i class="fa fa-chevron-down"></i>').removeClass('up').addClass('down');
    let table = $(this).parent().find('table');
    i = 0;
    $(table).find('tr').each(function() {
        i++;
        if (i > 7) {
            $(this).addClass('hide');
        }
    })
});









$(function(){
    $.ajax({
        type: "GET",
        url: "https://analytics.vsezaimyonline.ru//api/v1/push_company_show",
        data: {
            'company_id': window.company_id
        },
        success: function(data){
            console.log(data);
        }
    });
});

$(function(){
   $('#show_more_companies_icons').on('click',function(){
     $('.companies_icons_wrap .col-sm-4').each(function(){
       $(this).removeClass('display_none');
         $('#show_more_companies_icons').remove();
     });
   });
});


$('#load_card_for_company').on('click', function (){
    $.ajax({
        type: "GET",
        url: "/actions/load_card_for_company",
        data: {
            'company_id': window.company_id
        },
        success: function(data){
            $('.offers-list').html(data['code']);
            update_img_and_bg();
        }
    });
    $(this).closest('.row').find('.col-sm-6').removeClass('col-sm-6').addClass('col-sm-12');
    $(this).parent().remove();
});

