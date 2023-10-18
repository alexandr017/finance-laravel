$(function(){

    push_vote = function(object, vote){

        var token = $('meta[name="csrf-token"]').attr('content');
        var term_id = window.term_id;

        $.ajax({
            type: "POST",
            url: "/actions/dictionary-push-vote",
            data: {
                '_token': token,
                'term_id': term_id,
                'vote': vote
            },
            success: function(data){
                $('#formModal .modal-body').html('<p>'+data.message+'</p>');
                $('#formModal').modal();
                if (data.result) {
                    var current_value = parseInt(object.next().text());
                    object.next().text(++current_value);
                }
            }
        });

    }


    $('#pushUpLike').on('click',function () {
        push_vote($(this), 1);
    });

    $('#pushFownLike').on('click',function () {
        push_vote($(this),0);
    });






});