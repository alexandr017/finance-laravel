$('#yourfinpartnerForm').on('submit', function () {
    var last_name = $('#yf_last_name').val();
    if (last_name == '') {
        alert('Вы не указали фамилию');
        return false;
    }

    var first_name = $('#yf_first_name').val();
    if (first_name == '') {
        alert('Вы не указали имя');
        return false;
    }

    var second_name = $('#yf_second_name').val();
    if (second_name == '') {
        alert('Вы не указали отчество');
        return false;
    }

    var passport_serial = $('#yf_passport_serial').val();
    if (passport_serial == '') {
        alert('Вы не серию паспорта');
        return false;
    }

    var passport_number = $('#yf_passport_number').val();
    if (passport_number == '') {
        alert('Вы не номер паспорта');
        return false;
    }

    var phone = $('#yf_phone').val();
    if (phone == '') {
        alert('Вы не указали телефон');
        return false;
    }

    var token = $('meta[name="csrf-token"]').attr('content');



    var url = window.location.href;

    $.ajax({
        type: "POST",
        url: "/actions/partners/yourfinpartner",
        data: {
            '_token': token,
            'last_name': last_name,
            'first_name': first_name,
            'second_name': second_name,
            'passport_serial': passport_serial,
            'passport_number': passport_number,
            'phone': phone,

            'url': url

        },
        success: function(data){
            $('#yourfinpartnerBody').text(data);
            //window.open('https://finance.ru/zlg/yourfinpartner', '_blank');

        }
    });

    return false;

});
