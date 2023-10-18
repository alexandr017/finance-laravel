$('#pollVotingBtn').on('click', function(){
    $(function () {
        $('#poolVotingQuestionsWrap').slick({
            dots: false,
            infinite: false,
            speed: 0,
            infinite: false,
            arrows: false,
            slidesToShow: 1,
            slidesToScroll: 1,
        });
    });
    $('#poolVotingModal').modal();
});




$(function () {

    var poolVotingAllPages = $('#poolVotingQuestionsWrap').attr('data-count');
    //ar poolVotingResult = new Array({"key" : 1, "data": []},{"key" : 2, "data": []}, {"key" : 3, "data": []}, {"key" : 4, "data": []}, {"key" : 5, "data": []}, {"key" : 6, "data": []});
    var poolVotingResult = new Array([],[],[],[],[],[],[],[],[]);


    // кнопка назад
    $('#poolVotingPrev').on('click', function () {
        $("#poolVotingQuestionsWrap").slick('slickPrev');
        var poolVotingCurrentPage = $('.pool-voting-question.slick-active').attr('data-item');
        if (poolVotingCurrentPage == 1) {
            $(this).hide();
        } else if (poolVotingCurrentPage > 1 && poolVotingCurrentPage < poolVotingAllPages) {
            $(this).show();
        }
        $('#poolVotingSubmit').hide();
        $('#poolVotingNext').css('display','inline-block');
    });


    // изменение чекбокса в вопросе 3
    //$('#pool-voting-q3-4').on('change', function (){
    $('input:radio[name=question3]').on('change', function (){
        if ($('#pool-voting-q3-4').is(':checked') && $('#pool-voting-q3-4').val() == '') {
            $('#pool-voting-q3-4-text').show();
        } else {
            $('#pool-voting-q3-4-text').hide();
        }
    });

    // кнопка вперед
    $('#poolVotingNext').on('click', function () {
        var poolVotingCurrentPage = $('.pool-voting-question.slick-active').attr('data-item');


        if (poolVotingCurrentPage == 3) {
            if ($('#pool-voting-q3-4').is(':checked') && $('#pool-voting-q3-4').val() == '') {
                var customText = $('#pool-voting-q3-4-text').val();
                if (customText == '') {
                    return '';
                } else {
                    $('#pool-voting-q3-4').val(customText);
                }
            }
        }


        if (setCheckedInputFromCurrentSlide() == false) {
            $('.pool-voting-question.slick-active').css('border','1px dotted red');
            return false;
        }

        $('.pool-voting-question.slick-active').css('border','1px dotted #ccc');
        $("#poolVotingQuestionsWrap").slick('slickNext');

        if (poolVotingCurrentPage == poolVotingAllPages - 1) {
            $(this).hide();
            $('#poolVotingSubmit').css('display','inline-block');
        }
        $('#poolVotingPrev').css('display','inline-block');

    });



    // отправка данных
    $('#poolVotingSubmit').on('click', function () {

        if (setCheckedInputFromCurrentSlide() == false) {
            $('.pool-voting-question.slick-active').css('border','1px dotted red');
            return false;
        }

        // отправка
        var token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: "POST",
            url: "/actions/pool-voting/send-data",
            data: {
                '_token': token,
                'cliend_id': window.clientID,
                'data': JSON.stringify(poolVotingResult)
            },
            success: function (data) {
                $('#poolVotingModal .modal-body').html('<p class="text-center">' + data + '</p>');
            }
        });
        //console.log(poolVotingResult);
    });


    function setCheckedInputFromCurrentSlide() {
        var poolVotingCurrentPage = $('.pool-voting-question.slick-active').attr('data-item');
        var resultOnCurrentPage = new Array();
        $('.pool-voting-question.slick-active input:checked').each(function () {
            resultOnCurrentPage.push($(this).val());
        });

        // если ничего не отмечено прерываем
        if (resultOnCurrentPage.length == 0) {
            return false;
        }


        // устанавливаем отмеченные инпуты в конечный массив

        Object.keys(poolVotingResult).map(function(key) {
            if (key == (poolVotingCurrentPage - 1)) {
                poolVotingResult[key] = resultOnCurrentPage;
            }
        });

        if (poolVotingCurrentPage == poolVotingAllPages) {
            poolVotingResult[poolVotingAllPages] = new Array(window.city);
        }

        return true;
    }

});