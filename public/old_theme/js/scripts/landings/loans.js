$(function () {
    // function sort(sort_by_field, sort_direction) {
    //     var nodeList = document.querySelectorAll('.card-mn-simple .card-mn-main-details');
    //     var itemsArray = [];
    //     var parent = nodeList[0].parentNode.parentNode.parentNode;
    //     var field = sort_by_field;
    //     for (var i = 0; i < nodeList.length; i++) {
    //         itemsArray.push(parent.removeChild(nodeList[i].parentNode.parentNode));
    //     }
    //     itemsArray.sort(function (nodeA, nodeB) {
    //         var numberA = Number((nodeA.querySelector('.card-mn-simple .sorting-field-' + field + '').textContent).replace(/\s/g, ''));
    //         var numberB = Number((nodeB.querySelector('.card-mn-simple .sorting-field-' + field + '').textContent).replace(/\s/g, ''));
    //         if (sort_direction == 0) {
    //             if (numberA < numberB) return -1;
    //             if (numberA > numberB) return 1;
    //         } else {
    //             if (numberA < numberB) return 1;
    //             if (numberA > numberB) return -1;
    //         }
    //         return 0;
    //     })
    //         .forEach(function (node) {
    //             $('.offers-list').append(node);
    //         });
    // }

    // $('.sort-item').on('click',function () {
    //     $('.sort-item').not(this).removeClass('up');
    //     $('.sort-item .fa').removeClass('fa-arrow-circle-down');
    //     $('.sort-item .fa').removeClass('fa-arrow-circle-up');
    //     $('.sort-item').removeClass('active');
    //     $(this).addClass('active');
    //     var sort_by_field = $(this).data('field');
    //     $(this).toggleClass('up');
    //     if(!$(this).hasClass('up')){
    //         $('.sorting-line .active').find('.fa').removeClass('fa-arrow-circle-down');
    //         $('.sorting-line .active').find('.fa').addClass('fa-arrow-circle-up');
    //         var sort_direction = 0;
    //     } else{
    //         $('.sorting-line .active').find('.fa').removeClass('fa-arrow-circle-up');
    //         $('.sorting-line .active').find('.fa').addClass('fa-arrow-circle-down');
    //         var sort_direction = 1;
    //     }
    //     sort(sort_by_field,sort_direction);
    // });
    $('.sort-item').on('click', function () {
        $('.sort-item').not(this).removeClass('up');
        $('.sort-item .fa').removeClass('fa-arrow-circle-down');
        $('.sort-item .fa').removeClass('fa-arrow-circle-up');
        $('.sort-item').removeClass('active');
        $(this).addClass('active');
        var sort_by_field = $(this).data('field');
        $(this).toggleClass('up');
        if (!$(this).hasClass('up')) {
            $('.sorting-line .active').find('.fa').removeClass('fa-arrow-circle-down');
            $('.sorting-line .active').find('.fa').addClass('fa-arrow-circle-up');
            var sort_direction = 0;
        } else {
            $('.sorting-line .active').find('.fa').removeClass('fa-arrow-circle-up');
            $('.sorting-line .active').find('.fa').addClass('fa-arrow-circle-down');
            var sort_direction = 1;
        }
        var filters = getCheckedFilters();
        if (filters.zaimSum != '' || filters.zaimTerm != '' || filters.dayPerc != '' || filters.age != '' || filters.advancedSearchFilters.length != 0 || filters.advancedSearchOptions.length != 0) {
            searchQuizes(1);
        } else {
            var token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type: "POST",
                url: "loans/sort",
                data: {
                    '_token': token,
                    'sort_direction': sort_direction,
                    'sort_by_field': sort_by_field
                },
                success: function (data) {
                    $('.loans-first-block .offers-list').html(data.result);
                    var loadedCardslength = $('.offers-list .one-offer').length;
                    var countPrefix = (data['countCards'] <= 20) ? (data['countCards'] - 10) : 10;
                    if($('#loans-load_more').length != 0 && $('#quiz_load_more').length ==0) {
                        $('#loans-load_more span').html(countPrefix);
                        $('#loans-load_more').css('display','inline-block');
                    } else {
                        $('#quiz_load_more').css('display','inline-block');
                    }
                }
            });
        }

    });
    $('.loans-quiz-multiselect-value').on('click', function () {
        var loansSelect = $(this).parent().find('.quiz-checkboxes-and-labels');
        $(this).find('i').toggleClass('fa-chevron-down');
        $(this).find('i').toggleClass('fa-chevron-up');
        if (loansSelect.is(':visible')) {
            loansSelect.fadeOut(300);
        } else {
            loansSelect.fadeIn(300);
        }
    })
    $(document).on('mouseup', function (e) {
        var loansSelect = $('.checkboxes-multiselect');
        if (loansSelect.has(e.target).length === 0) {
            loansSelect.fadeOut(300);
        }
    });
    $('.loans-quiz .checkboxes-multiselect span').on('click', function () {
        var checkedInputs = $(this).parent().find("input:checked");
        var loansMultiselectValue = $(this).parent().parent().find('.loans-quiz-multiselect-value');
        if (checkedInputs.length > 0) {
            var checkedInputsText = '';
            if (checkedInputs.length < 3) {
                checkedInputs.each(function () {
                    if (checkedInputs.length != 1) {
                        checkedInputsText += $(this).next('label').text() + ', ';
                    } else {
                        checkedInputsText += $(this).next('label').text();
                    }
                })
                loansMultiselectValue.html(checkedInputsText);
            } else {
                loansMultiselectValue.html('Выбрано: ' + checkedInputs.length);
            }
        } else {
            var arrow = '<i class="fa fa-chevron-down" aria-hidden="true"></i>';
            loansMultiselectValue.html('Выбрать' + arrow);
        }
    })
    $('.index-cards-count > div').click(function () {
        location.href = $(this).attr('data-url');
    });
    window.number_page = 1;
    window.listing_id = -1;
    window.category_id = 1;
    window.count_on_page = 10;
    window.field = 'km5';
    window.sort_type = 'desc';
    window.sidebar_listings = {};
    if (document.body.clientWidth > 768) {
        //$('header').addClass('fixed');
        $(window).scroll(function () {
            if ($(this).scrollTop() != 0) {
                $('header').addClass('fixed');
                $('header').css('border-bottom', '1px solid #ddd');
            } else {
                $('header').css('border-bottom', '0');
                $('header').removeClass('fixed');
            }
        });
    }

    $('.quiz-btn-search').on('click', function () {
        var category = $('#quiz-cat-sel .active-element').attr('data-val');
        searchQuizes(category);
        if ($('.sort-item').hasClass('active')) {
            $('.sorting-line .active i').attr('class','fa');
            $('.sort-item').attr('class','sort-item');
        }
        $('#loans-load_more').css('display', 'none');
    })
    $('.refresh-by-selected-quizz').on('click', function () {
        var category = $('#quiz-cat-sel .active-element').attr('data-val');
        if ($('.sort-item').hasClass('active')) {
            $('.sorting-line .active i').attr('class','fa');
            $('.sort-item').attr('class','sort-item');
        }
        searchQuizes(category);
        $('#loans-load_more').css('display', 'none');
    })
    $('#quiz-autocredit-sum').on('change', function () {
        if ($(this).val() > 0) {
            $('#quiz-autocredit-first-pay').removeAttr('disabled');
        } else if ($(this).val() == '' || $(this).val() == 0) {
            $('#quiz-autocredit-first-pay').attr('disabled', 'disabled');
            $('#quiz-autocredit-first-pay').val('');
        }
    })

    function getCheckedFilters() {
        var zaimSum = $('#quiz-zaim-sum').val();
        var zaimTerm = $('#quiz-zaim-term').val();
        var dayPerc = $('#quiz-perc-per-day').val();
        dayPerc = (dayPerc && dayPerc != '') ? dayPerc.replace(',', '.') : '';
        var age = $('#quiz-age').val();
        var advancedSearchFilters = [];
        var advancedSearchOptions = [];
        $('.quiz-payment-methods span input:checked').each(function () {
            advancedSearchFilters.push($(this).val());
        })
        $('.quiz-borrower span input:checked').each(function () {
            advancedSearchFilters.push($(this).val());
        })
        $('.quiz-history span input:checked').each(function () {
            advancedSearchFilters.push($(this).val());
        })
        $('.quiz-docs span input:checked').each(function () {
            advancedSearchFilters.push($(this).val());
        })
        $('.quiz-other span input:checked').each(function () {
            if ($(this).val() == 'prolongation') {
                advancedSearchOptions.push($(this).val());
            }
            advancedSearchFilters.push($(this).val());
        })
        if ($('#quiz-speed').val() != '') {
            advancedSearchFilters.push($('#quiz-speed').val());
        }
        if ($('#quiz-city').val() != '') {
            advancedSearchFilters.push($('#quiz-city').val());
        }
        var filters = [];
        filters.advancedSearchFilters = advancedSearchFilters;
        filters.advancedSearchOptions = advancedSearchOptions;
        filters.zaimSum = zaimSum;
        filters.zaimSum = zaimSum;
        filters.zaimTerm = zaimTerm;
        filters.dayPerc = dayPerc;
        filters.age = age;
        return filters;
    }

    function searchQuizes(category, quizLoadedCardslength = 0) {
        var token = $('meta[name="csrf-token"]').attr('content');
        if (category == 1) {
            var filters = getCheckedFilters();
            var data = {
                '_token': token,
                'category': category,
                'zaimSum': filters.zaimSum,
                'zaimTerm': filters.zaimTerm,
                'dayPerc': filters.dayPerc,
                'age': filters.age,
                'advancedSearchFilters': filters.advancedSearchFilters,
                'advancedSearchOptions': filters.advancedSearchOptions
            };
            if (filters.zaimSum != '' || filters.zaimTerm != '' || filters.dayPerc != '' || filters.age != '' || filters.advancedSearchFilters.length != 0 || filters.advancedSearchOptions.length != 0) {
                var sortElement = $('.sorting-line .active');
                var sort_filed = sortElement.data('field');
                data.sortField = sort_filed;
                if (sortElement.hasClass('up')) {
                    data['sort_direction'] = 'desc';
                } else {
                    data['sort_direction'] = 'asc';
                }
                data['sort_by_field'] = sort_filed;
            }
        }
        data['quizLoadedCardslength'] = quizLoadedCardslength;
        $.ajax({
            type: "POST",
            url: 'load-quizz',
            data: data,
            success: function (data) {
                var quizCardsForLoading = data['card_count'] - quizLoadedCardslength;
                var countPrefix = (quizCardsForLoading < 20) ? (quizCardsForLoading - 10) : 10;
                if (countPrefix <= 0) {
                    $('#quiz_load_more').css('display', 'none');
                }
                if (quizCardsForLoading == data['card_count']) {
                    $('.offers-list').fadeOut();
                    $('.listing .offers-list').html(data['result']);
                    $('.offers-list').fadeIn();
                    $('#quiz_load_more').parent().remove();
                    if (data['card_count'] > 10) {
                        $('.listing .offers-list').after('<div class="text-center"><button class="form-btn1" id="quiz_load_more" data-cards = "10">Показать ещё <span>' + countPrefix + '</span></button></div>');
                    }
                } else {
                    $('.listing .offers-list').append(data['result']);
                    quizLoadedCardslength = $('.offers-list .one-offer').length;
                    $('#quiz_load_more').attr('data-cards', quizLoadedCardslength);
                    $('#quiz_load_more span').html(countPrefix);
                    // update_img_and_bg_full_version();
                    return;
                }
                // update_img_and_bg_full_version();
                $('#quiz_load_more').on('click', function () {
                    $('#quiz_load_more').attr('disabled','disabled');
                    var category = $('#quiz-cat-sel .active-element').attr('data-val');
                    quizLoadedCardslength = $('.offers-list .one-offer').length;
                    searchQuizes(category, quizLoadedCardslength);
                    setTimeout(function(){ $('#quiz_load_more').removeAttr('disabled'); }, 1000);


                })
            }
        })
    }

    $('.quizz #quiz-cat-sel .line').on('click', function () {
        var elem = $('.quiz-div-search .quiz-search-terms');
        var newActiveEl = $(this).data('val');
        if (!elem.hasClass('.display_none')) {
            elem.removeClass('d-flex')
            elem.addClass('display_none')
        }
        $('.quizz-' + newActiveEl).removeClass('display_none');
        $('.quizz-' + newActiveEl).addClass('d-flex');
        $('.quizz .quiz-adv-search').html('');
        var url = 'load-advance-block/' + newActiveEl;
        $.ajax({
            type: "GET",
            url: url,
            success: function (data) {
                $('.quizz .quiz-adv-search').append(data);
            }
        })
    })
    $('.quizAdvSearch').on('click', function () {
        $('.quiz-adv-search').toggleClass('display_none');
        $(this).find('i').toggleClass('fa-chevron-down');
        $(this).find('i').toggleClass('fa-chevron-up');
        $('.quiz-div-button').toggleClass('display_none');
    })
    $('.quiz-reset-selected').on('click', function () {
        $('.loans-quiz input:checked').each(function () {
            $(this)[0].checked = false;
        })
        $('.loans-quiz select').val('');
        $('.loans-quiz .quiz-adv-search-first-row input').val('');
        $('.loans-quiz .quiz-search-terms input:not(.quiz-btn-search)').val('');
        var arrow = '<i class="fa fa-chevron-down" aria-hidden="true"></i>';
        $('.loans-quiz-multiselect-value').html('<span>Выбрать</span>' + arrow);
        if ($('.sort-item').hasClass('active')) {
            $('.sorting-line .active i').attr('class','fa');
            $('.sort-item').attr('class','sort-item');
        }
        $.ajax({
            type: "GET",
            url: 'loans-cards',
            success: function (data) {
                $('.loans-first-block .offers-list').html(data.codeCards);
                if(data.countCards > 10){
                    $('#loans-load_more').css('display','inline-block');
                    var countPrefix = (data['countCards'] <= 20) ? (data['countCards'] - 10) : 10;
                    $('#loans-load_more span').html(countPrefix);
                    if($('#quiz_load_more').length != 0) {
                        $('#quiz_load_more').parent().remove();
                    }
                }
            }
        })
    })
    $('.def_bg[data-src]').each(function () {
        $(this).css('background', 'url(' + $(this).attr('data-src') + ')').removeAttr('data-src');
    })
    $('#loans-load_more').on('click', function () {
        var token = $('meta[name="csrf-token"]').attr('content');
        var loadedCardsCount = $('.offers-list .one-offer').length;
        var data = {
            '_token': token,
            'loadedCardsCount': loadedCardsCount,
        };
        if ($('.sorting-line .active').length !== 0) {
            var sortElement = $('.sorting-line .active');
            var sort_filed = sortElement.data('field');
            data.sortField = sort_filed;
            if (sortElement.hasClass('up')) {
                data.sortDirection = 'desc';
            } else {
                data.sortDirection = 'asc';
            }
        }
        $.ajax({
            type: "POST",
            url: 'loans/load-more',
            data: data,
            success: function (data) {
                $('.offers-list').append(data['result']);
                var countPrefix = (data['countCards'] <= 20) ? (data['countCards'] - 10) : 10;
                if (countPrefix > 0) {
                    $('#loans-load_more span').html(countPrefix);
                } else {
                    $('#loans-load_more').css('display', 'none');
                }
            }
        })
    })
})
