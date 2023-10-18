

/* добавление отзыва */
$(document).on('submit','#AddReview',function(e){
    e.preventDefault();
    var name = $('#reviewUserName').val();
    var id = $('#reviewUserId').val();
    var rating = $('#reviewRating').val();
    if(window.answer == false || window.answer == undefined){
        if(rating == 0){alert('Вы не указали рейтинг'); return false;}
    }
    var review = $('#reviewUserComment').val();

    if(name == '') {
        alert('Вы не указали имя');
        return false;
    }

    if(review == '') {
        alert('Вы не заполнили текст отзыва');
        return false;
    }

    var company = $('#reviewCompany').val();
    var token = $('#token').val();
    var parent = $('#reviewParent').val();

    var pros = $('#pros').val();
    var minuses = $('#minuses').val();

    var parent = $(this).parent().attr('data-id');
    if(parent == undefined) parent = 'null';

    var captcha = $(this).find('.g-recaptcha-response').val();
    var review_data = {
        '_token': token,
        'rating':rating,
        'name': name,
        'uid': id,
        'company_id' : company,
        'parent':parent,
        'review': review,
        'pros':pros,
        'minuses':minuses,
        'captcha':captcha
    };
    if (window.location.pathname.indexOf('/banks/') != -1){
        if($('#bank-category-id').length){
            review_data.bank_category_id = $('#bank-category-id').val();
        } else {
            review_data.bank_category_id = $('#bank-category-page-id').val();
        }
        review_data.product_id = $('#product_id').val();
        var url = '/actions/banks/add-review';
    } else {
        var url = '/actions/add-review';
    }
    $.ajax({
        type: "POST",
        url: url,
        data: review_data,
        success: function(data){
            $('#formModal .modal-body').html('<p>'+data+'</p>');
            $('#formModal').modal();
        }
    });
    $('#reviewUserComment').val('');
    $('#pros').val('');
    $('#minuses').val('');
    $('#bank-category-id').prop('selectedIndex',0);
    $('.companies-rating .fa').removeClass('fa-star');
    $('.companies-rating .fa').addClass('fa-star-o');
    if(!$('#reviewUserName').prop('readonly')){
        $('#reviewUserName').val('');
    }
    return false;
});


$(document).on('click','#cancel-review-reply-link',function(e){
    e.preventDefault();
    var form = $('#AddReview');
    $('#AddReviewWrap').html(form);
    $(this).next('form').remove();
    $('#reviewParent').val(0);
    $('#cancel-review-reply-link').before('<a rel="nofollow" class="review-reply-link" href="#">Ответить</a>');
    $(this).remove();
    window.answer = false;
    $('#pros').closest('.sub-form-line').show();
    $('#minuses').closest('.sub-form-line').show();
    $('.review-button-name').text('Отправить отзыв');
    $('#reviewRating').closest('.form-line').show();
});


$(document).on('click','.review-reply-link',function(e){
    e.preventDefault();
    var form = $('#AddReview');
    $('#AddReviewWrap').html('');
    $(this).after(form);
    $('#cancel-review-reply-link').before('<a rel="nofollow" class="review-reply-link" href="#">Ответить</a>');
    $('#cancel-review-reply-link').remove();
    $('#reviewParent').val($(this).parent().attr('data-id'));
    $(this).after('<a rel="nofollow" href="#" id="cancel-review-reply-link">Отменить ответ</a>');
    $(this).remove();
    window.answer = true;
    $('#pros').closest('.sub-form-line').hide();
    $('#minuses').closest('.sub-form-line').hide();
    $('.review-button-name').text('Отправить ответ');
    $('#reviewRating').closest('.form-line').hide();
});
/* конец добавления отзыва */

$(document).on('click','.hidden-review-name',function(){
    $(this).closest('.comment-item').find('.hidden-review-body').toggle();
});



// сортировка отзывов
$('.reviews_items li span').on('click', function(){

    $('.reviews-list-wrap').html('<i class="fa fa-refresh fa-spin fa-3x fa-fw"></i>');

    if($(this).parent().hasClass('active')){
        if($(this).parent().find('i').hasClass('fa-arrow-circle-up')){
            var sort_type = 'desc';
        } else {
            var sort_type = 'asc';
        }
    }
    if (sort_type == undefined) {
        sort_type = 'desc';
    }

    var data = {};
    data['sort_type'] = sort_type;
    data['company_id'] = $(this).closest('.reviews_items').attr('data-term-id');
    data['sort_field'] = $(this).closest('li').attr('data-field');

    $.ajax({
        type: "GET",
        url: "/actions/load_sorted_reviews",
        data: data,
        success: function(data){
            $('.reviews-list-wrap').html(data);
            $('#loadReviews').attr('data-groups-current', 1);
            update_img_and_bg_full_version();
        }
    });
});

$('#bank-review-pr-select .line').on('click',function () {
    var prodcutId = $(this).data('val');
    if(prodcutId == 0){
        $('.comment-item').removeClass('hide');
        $('.filterRemove').addClass('display_none');
        $('#loadReviews').removeClass('hide');
        $('#loadReviews').addClass('form-btn1');
        return;
    }
    $('#loadReviews').addClass('hide');
    $('#loadReviews').removeClass('form-btn1');
    $('.comment-item').each(function () {
        if($(this).data('product') != prodcutId){
            $(this).addClass('hide');
        } else{
            if($(this).hasClass('display_none')){
                $(this).addClass('filterRemove');
            }
            $(this).removeClass('hide');
            $(this).removeClass('display_none');
        }
    })
})

var loadBtn = $('#loadReviews').clone(true);
$('#bank-review-cat-select .line').on('click',function () {
    // var i = 0;
    // var group = 0;
    var catId = $(this).data('val');
    if(catId == 0){
        $('.comment-item').removeClass('hide');
        $('.filterRemove').addClass('display_none');
        $('#loadReviews').removeClass('hide');
        $('#loadReviews').addClass('form-btn1');
        return;
    }
    // if($('#loadReviews').length == 1) {
    //     loadBtn = $('#loadReviews').clone(true);
    // }
    $('#loadReviews').addClass('hide');
    $('#loadReviews').removeClass('form-btn1');
    $('.comment-item').each(function (e) {
        if($(this).data('category') != catId){
            $(this).addClass('hide');
        } else{
            if($(this).hasClass('display_none')){
                $(this).addClass('filterRemove');
            }
            $(this).removeClass('hide');
            $(this).removeClass('display_none');
            // if(i<10){
            //     $(this).removeClass('hide');
            //     $(this).removeClass('display_none');
            // }
            // if(i%10 == 0){
            //     group++;
            // }
            // i++;
            // $(this).addClass('filteredGroupId-'+group);
        }
    })

    // if(group <= 1){
    //     $('#loadReviews').addClass('hide');
    //     $('#loadReviews').removeClass('form-btn1');
    // } else{
    //     $('#loadReviews').removeClass('hide');
    //     $('#loadReviews').addClass('form-btn1');
    // }
    // $('#loadReviews').attr('filter','true');
    // $('#loadReviews').attr('data-groups-count',group);
})