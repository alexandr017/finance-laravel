$('#phoneComplaintForm').on('submit', function (e){
    e.preventDefault();

    var token = $('meta[name="csrf-token"]').attr('content');
    var h1 = $('h1').text();
    var email = $('#phoneComplaintEmail').val();
    var type_complaint = $('#phoneComplaintSelect b').attr('data-val');
    var comment = $('#phoneComplaintText').val();

    if (type_complaint == 'Прочее' && comment == '') {
        alert('Вы не указали причину жалобы');
        return false;
    }

    $.ajax({
        type: "POST",
        url: "/forms/phone_complaint",
        data: {
            '_token': token,
            'h1': h1,
            'type_complaint' : type_complaint,
            'email': email,
            'comment': comment
        },
        success: function(data){
            $('#phoneComplaint .modal-body').html('<p>'+data+'</p>');
        }
    });
    return false;
});

$('#phoneComplaintSelect .line').on('click', function (){
    if ($(this).text() == 'Прочее') {
        $('#phoneComplaintTextWrap').show();
    } else {
        $('#phoneComplaintTextWrap').hide();
    }
});

$(function(){
    var url = new URL(window.location.href);
    var phone_complaint = url.searchParams.get("phone_complaint");

    console.log('phone_complaint - ' + phone_complaint);
    console.log(phone_complaint == "true");

    if (phone_complaint == "true") {
        $('#phoneComplaint').modal();
    }

});