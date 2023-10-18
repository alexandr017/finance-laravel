$('#vashinvestorForm').on('submit', function () {
    var name = $('#vi_name').val();
    if (name == '') {
        alert('Вы не указали имя');
        return false;
    }

    var phone = $('#vi_phone').val();
    if (phone == '') {
        alert('Вы не указали телефон');
        return false;
    }

    var token = $('meta[name="csrf-token"]').attr('content');

    var vi_sum = $('#vi_sum').val();
    var vi_comment = $('#vi_comment').val();

    var url = window.location.href;

    $.ajax({
        type: "POST",
        url: "/actions/partners/vashinvestor",
        data: {
            '_token': token,
            'name': name,
            'phone': phone,
            'sum' : vi_sum,
            'comment': vi_comment,
            'url': url

        },
        success: function(data){
            $('#vashinvestorBody').text(data);
            window.open('https://finance.ru/zlg/vashinvestor', '_blank');

        }
    });

    return false;

});
