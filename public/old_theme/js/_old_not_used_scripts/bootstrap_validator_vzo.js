$(document).ready(function() {
    // 1. Добавить организацию /add
    /*
    $('#company_add').bootstrapValidator({
        message: 'Это значение недействительно',
        feedbackIcons: {
            valid: 'fa fa-check',
            invalid: 'fa fa-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            name: {
                message: 'Некорректное имя',
                validators: {
                    notEmpty: {
                        message: 'Имя обязательно и не может быть пустым'
                    },
                    stringLength: {
                        min: 2,
                        max: 30,
                        message: 'Имя должно быть более 2 и менее 30 символов'
                    },
                    regexp: {
                        regexp: /^[а-яА-Я0-9_]+$/,
                        message: 'Имя может состоять только из русских букв'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'Email является обязательным и не может быть пустым'
                    },
                    emailAddress: {
                        message: 'Набранные символы не является действительным адресом электронной почты'
                    }
                }
            },
            comment : {
                validators: {
                    stringLength: {
                        min: 10,
                        max: 3000,
                        message: 'Описание должно быть более 10 и менее 3000 символов'
                    },
                }
            }
        }
    });
    */

    // 2. Виджет #ВЗО для организаций /widget
    $('#widget_install').bootstrapValidator({
        message: 'Это значение недействительно',
        feedbackIcons: {
            valid: 'fa fa-check',
            invalid: 'fa fa-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            name: {
                message: 'Некорректное имя',
                validators: {
                    notEmpty: {
                        message: 'Имя обязательно и не может быть пустым'
                    },
                    stringLength: {
                        min: 2,
                        max: 30,
                        message: 'Имя должно быть более 2 и менее 30 символов'
                    },
                    regexp: {
                        regexp: /^[а-яА-Я0-9_]+$/,
                        message: 'Имя может состоять только из русских букв'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'Email является обязательным и не может быть пустым'
                    },
                    emailAddress: {
                        message: 'Набранные символы не является действительным адресом электронной почты'
                    }
                }
            },
            company: {
                message: 'Некорректное название компании',
                validators: {
                    notEmpty: {
                        message: 'поле "Компания" не может быть пустым'
                    },
                    stringLength: {
                        min: 3,
                        max: 30,
                        message: 'Название должно быть более 3 и менее 30 символов'
                    },
                    regexp: {
                        regexp: /^[а-яА-Я0-9_a-zA-Z-]+$/,
                        message: 'Название может состоять только из букв, цифр, тире и знака подчеркивания'
                    }
                }
            },
            comment : {
                validators: {
                    stringLength: {
                        min: 10,
                        max: 3000,
                        message: 'Комментарий должен быть более 10 и менее 3000 символов'
                    },
                }
            }
        }
    });

    // 3. Служба поддержки и контакты /contacts
    $('#support').bootstrapValidator({
        message: 'Это значение недействительно',
        feedbackIcons: {
            valid: 'fa fa-check',
            invalid: 'fa fa-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            name: {
                message: 'Некорректное имя',
                validators: {
                    notEmpty: {
                        message: 'Имя обязательно и не может быть пустым'
                    },
                    stringLength: {
                        min: 2,
                        max: 30,
                        message: 'Имя должно быть более 2 и менее 30 символов'
                    },
                    regexp: {
                        regexp: /^[а-яА-Я0-9_]+$/,
                        message: 'Имя может состоять только из русских букв'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'Email является обязательным и не может быть пустым'
                    },
                    emailAddress: {
                        message: 'Набранные символы не является действительным адресом электронной почты'
                    }
                }
            },
            comment : {
                validators: {
                    notEmpty: {
                        message: 'Комментарий не может быть пустым'
                    },
                    stringLength: {
                        min: 10,
                        max: 3000,
                        message: 'Комментарий должен быть более 10 и менее 3000 символов'
                    },
                }
            }
        }
    });

    // 4. Рекламное сотрудничество с #ВЗО /advertising
    $('#form_advertising').bootstrapValidator({
        message: 'Это значение недействительно',
        feedbackIcons: {
            valid: 'fa fa-check',
            invalid: 'fa fa-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            name: {
                message: 'Некорректное имя',
                validators: {
                    notEmpty: {
                        message: 'Имя обязательно и не может быть пустым'
                    },
                    stringLength: {
                        min: 2,
                        max: 30,
                        message: 'Имя должно быть более 2 и менее 30 символов'
                    },
                    regexp: {
                        regexp: /^[а-яА-Я0-9_]+$/,
                        message: 'Имя может состоять только из русских букв'
                    }
                }
            },
            phone: {
                message: 'Некорректный телефон',
                validators: {
                    notEmpty: {
                        message: 'Телефон обязательный и не может быть пустым'
                    },
                    regexp: {
                        regexp: /^\+7\(\d\d\d\)\d\d\d-\d\d-\d\d$/,
                        message: 'Телефон должен быть в формате +7(ХХХ)ХХХ-ХХ-ХХ'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'Email является обязательным и не может быть пустым'
                    },
                    emailAddress: {
                        message: 'Набранные символы не является действительным адресом электронной почты'
                    }
                }
            },
            company: {
                message: 'Некорректное название компании',
                validators: {
                    stringLength: {
                        min: 3,
                        max: 30,
                        message: 'Название должно быть более 3 и менее 30 символов'
                    },
                    regexp: {
                        regexp: /^[а-яА-Я0-9_a-zA-Z-]+$/,
                        message: 'Название может состоять только из букв, цифр, тире и знака подчеркивания'
                    }
                }
            },
            question: {
                message: 'Некорректное вопрос',
                validators: {
                    stringLength: {
                        min: 10,
                        max: 1000,
                        message: 'Вопрос должен быть более 10 и менее 1000 символов'
                    },
                }
            },
        }
    });



    // 5. добавление комментария
    $('#AddComment').bootstrapValidator({
        message: 'Это значение недействительно',
        feedbackIcons: {
            valid: 'fa fa-check',
            invalid: 'fa fa-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            name: {
                message: 'Некорректное имя',
                validators: {
                    notEmpty: {
                        message: 'Имя обязательно и не может быть пустым'
                    },
                    stringLength: {
                        min: 2,
                        max: 30,
                        message: 'Имя должно быть более 2 и менее 30 символов'
                    },
                    regexp: {
                        regexp: /^[а-яА-Я0-9_]+$/,
                        message: 'Имя может состоять только из русских букв'
                    }
                }
            },
            comment : {
                validators: {
                    notEmpty: {
                        message: 'Комментарий не может быть пустым'
                    },
                    stringLength: {
                        min: 10,
                        max: 3000,
                        message: 'Комментарий должен быть более 10 и менее 3000 символов'
                    },
                }
            }
        }
    });


    // 6. добавления отзыва
    $('#AddReview').bootstrapValidator({
        message: 'Это значение недействительно',
        feedbackIcons: {
            valid: 'fa fa-check',
            invalid: 'fa fa-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            name: {
                message: 'Некорректное имя',
                validators: {
                    notEmpty: {
                        message: 'Имя обязательно и не может быть пустым'
                    },
                    stringLength: {
                        min: 2,
                        max: 30,
                        message: 'Имя должно быть более 2 и менее 30 символов'
                    },
                    regexp: {
                        regexp: /^[а-яА-Я0-9_]+$/,
                        message: 'Имя может состоять только из русских букв'
                    }
                }
            },
            reviewUserComment : {
                validators: {
                    notEmpty: {
                        message: 'Комментарий не может быть пустым'
                    },
                    stringLength: {
                        min: 10,
                        max: 3000,
                        message: 'Комментарий должен быть более 10 и менее 3000 символов'
                    },
                }
            },
            pros: {
                message: 'Некорректно заполненное поле',
                validators: {
                    stringLength: {
                        min: 3,
                        max: 1000,
                        message: 'Поле должно быть более 3 и менее 1000 символов'
                    }
                }
            },
            minuses: {
                message: 'Некорректно заполненное поле',
                validators: {
                    stringLength: {
                        min: 3,
                        max: 1000,
                        message: 'Поле должно быть более 3 и менее 1000 символов'
                    }
                }
            }
        }
    });


    // 7. КР
    $('#creditRating').bootstrapValidator({
        message: 'Это значение недействительно',
        feedbackIcons: {
            valid: 'fa fa-check',
            invalid: 'fa fa-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            last_name: {
                message: 'Некорректная фамилия',
                validators: {
                    notEmpty: {
                        message: 'Поле "Фамилия" обязательно и не может быть пустым'
                    },
                    stringLength: {
                        min: 2,
                        max: 50,
                        message: 'Фамилия должно быть более 2 и менее 50 символов'
                    },
                    regexp: {
                        regexp: /^[а-яА-Я0-9_]+$/,
                        message: 'Фамилия может состоять только из русских букв'
                    }
                }
            },
            first_name: {
                message: 'Некорректное имя',
                validators: {
                    notEmpty: {
                        message: 'Поле "Имя" обязательно и не может быть пустым'
                    },
                    stringLength: {
                        min: 2,
                        max: 30,
                        message: 'Имя должно быть более 2 и менее 30 символов'
                    },
                    regexp: {
                        regexp: /^[а-яА-Я0-9_]+$/,
                        message: 'Имя может состоять только из русских букв'
                    }
                }
            },
            middle_name: {
                message: 'Некорректное отчество',
                validators: {
                    notEmpty: {
                        message: 'Поле "Отчество" обязательно и не может быть пустым'
                    },
                    stringLength: {
                        min: 2,
                        max: 30,
                        message: 'Отчество должно быть более 2 и менее 30 символов'
                    },
                    regexp: {
                        regexp: /^[а-яА-Я0-9_]+$/,
                        message: 'Отчество может состоять только из русских букв'
                    }
                }
            },
            birthday: {
                message: 'Некорректная дата рождения',
                validators: {
                    notEmpty: {
                        message: 'Поле "Дата рождения" обязательно и не может быть пустым'
                    },
                    date: {
                        format: 'DD.MM.YYYY',
                        message: 'Неверный формат ввода',
                    }
                }
            },
            passport: {
                message: 'Некорректная серия и номер паспорта',
                validators: {
                    notEmpty: {
                        message: 'Поле "Серия и номер паспорта" обязательно и не может быть пустым'
                    },
                    regexp: {
                        regexp: /^[0-9]{10}$/,
                        message: 'Серия и номер паспорта могут состоять только из 10 цифр'
                    }
                }
            },
            passport_date: {
                message: 'Некорректная дата выдачи паспорта',
                validators: {
                    notEmpty: {
                        message: 'Поле "Дата выдачи паспорта" обязательно и не может быть пустым'
                    },
                    date: {
                        format: 'DD.MM.YYYY',
                        message: 'Неверный формат ввода',
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'Email является обязательным и не может быть пустым'
                    },
                    emailAddress: {
                        message: 'Набранные символы не является действительным адресом электронной почты'
                    }
                }
            }
        }
    });

    // 8. подписка юнисендер
    $('#subscription_form').bootstrapValidator({
        message: 'Это значение недействительно',
        feedbackIcons: {
            valid: 'fa fa-check',
            invalid: 'fa fa-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            email: {
                validators: {
                    notEmpty: {
                        message: 'Email является обязательным и не может быть пустым'
                    },
                    emailAddress: {
                        message: 'Набранные символы не является действительным адресом электронной почты'
                    }
                }
            },
            name: {
                message: 'Некорректное имя',
                validators: {
                    notEmpty: {
                        message: 'Имя обязательно и не может быть пустым'
                    },
                    stringLength: {
                        min: 2,
                        max: 30,
                        message: 'Имя должно быть более 2 и менее 30 символов'
                    },
                    regexp: {
                        regexp: /^[а-яА-Я0-9_]+$/,
                        message: 'Имя может состоять только из русских букв'
                    }
                }
            }
        }
    });



    // 9. заказать звонок
    $('#callMeForm_').bootstrapValidator({
        message: 'Это значение недействительно',
        feedbackIcons: {
            valid: 'fa fa-check',
            invalid: 'fa fa-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            name: {
                message: 'Некорректное имя',
                validators: {
                    notEmpty: {
                        message: 'Имя обязательно и не может быть пустым'
                    },
                    stringLength: {
                        min: 2,
                        max: 30,
                        message: 'Имя должно быть более 2 и менее 30 символов'
                    },
                    regexp: {
                        regexp: /^[а-яА-Я0-9_]+$/,
                        message: 'Имя может состоять только из русских букв'
                    }
                }
            },
            phone: {
                message: 'Некорректный телефон',
                validators: {
                    notEmpty: {
                        message: 'Телефон обязательный и не может быть пустым'
                    },
                    regexp: {
                        regexp: /^\d{5,12}$/,
                        message: 'Телефон должен состоять только из цифр (5-12 символов)'
                    }

                }
            }
        }
    });


    // 10. получить 50р
    $('#quick_action').bootstrapValidator({
        message: 'Это значение недействительно',
        feedbackIcons: {
            valid: 'fa fa-check',
            invalid: 'fa fa-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            url: {
                message: 'Некорректная ссылка',
                validators: {
                    notEmpty: {
                        message: 'URL записи не может быть пустым'
                    },
                    uri: {
                        message: 'Некорректная ссылка'
                    }
                }
            },
            phone: {
                message: 'Некорректный телефон',
                validators: {
                    notEmpty: {
                        message: 'Телефон обязательный и не может быть пустым'
                    },
                    regexp: {
                        regexp: /^\+7\(\d\d\d\)\d\d\d-\d\d-\d\d$/,
                        message: 'Телефон должен быть в формате +7(ХХХ)ХХХ-ХХ-ХХ'
                    }
                }
            },
        }
    });



    // 11. регистрация

    // 12. авторизация
    $('#login_form').bootstrapValidator({
        message: 'Это значение недействительно',
        feedbackIcons: {
            valid: 'fa fa-check',
            invalid: 'fa fa-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            email: {
                validators: {
                    notEmpty: {
                        message: 'Email является обязательным и не может быть пустым'
                    },
                    emailAddress: {
                        message: 'Набранные символы не является действительным адресом электронной почты'
                    }
                }
            },
            password : {
                validators: {
                    stringLength: {
                        min: 6,
                        message: 'Пароль не может быть менее 6 симвлов'
                    },
                }
            }
        }
    });


    // 13. личный кабинет
    $('#options_upadate').bootstrapValidator({
        message: 'Это значение недействительно',
        feedbackIcons: {
            valid: 'fa fa-check',
            invalid: 'fa fa-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            last_name: {
                message: 'Некорректная фамилия',
                validators: {
                    notEmpty: {
                        message: 'Поле "Фамилия" обязательно и не может быть пустым'
                    },
                    stringLength: {
                        min: 2,
                        max: 50,
                        message: 'Фамилия должно быть более 2 и менее 50 символов'
                    },
                    regexp: {
                        regexp: /^[а-яА-Я0-9_]+$/,
                        message: 'Фамилия может состоять только из русских букв'
                    }
                }
            },
            first_name: {
                message: 'Некорректное имя',
                validators: {
                    notEmpty: {
                        message: 'Поле "Имя" обязательно и не может быть пустым'
                    },
                    stringLength: {
                        min: 2,
                        max: 30,
                        message: 'Имя должно быть более 2 и менее 30 символов'
                    },
                    regexp: {
                        regexp: /^[а-яА-Я0-9_]+$/,
                        message: 'Имя может состоять только из русских букв'
                    }
                }
            },
            middle_name: {
                message: 'Некорректное отчество',
                validators: {
                    notEmpty: {
                        message: 'Поле "Отчество" обязательно и не может быть пустым'
                    },
                    stringLength: {
                        min: 2,
                        max: 30,
                        message: 'Отчество должно быть более 2 и менее 30 символов'
                    },
                    regexp: {
                        regexp: /^[а-яА-Я0-9_]+$/,
                        message: 'Отчество может состоять только из русских букв'
                    }
                }
            },
            birthday: {
                message: 'Некорректная дата рождения',
                validators: {
                    notEmpty: {
                        message: 'Поле "Дата рождения" обязательно и не может быть пустым'
                    },
                    date: {
                        format: 'DD.MM.YYYY',
                        message: 'Неверный формат ввода',
                    }
                }
            },
            passport_series: {
                message: 'Некорректная серия паспорта',
                validators: {
                    notEmpty: {
                        message: 'Поле "Серия паспорта" обязательно и не может быть пустым'
                    },
                    regexp: {
                        regexp: /^[0-9]{4}$/,
                        message: 'Серия паспорта может состоять только из 4 цифр'
                    }
                }
            },
            passport_number: {
                message: 'Некорректный номер паспорта',
                validators: {
                    notEmpty: {
                        message: 'Поле "Номер паспорта" обязательно и не может быть пустым'
                    },
                    regexp: {
                        regexp: /^[0-9]{6}$/,
                        message: 'Номер паспорта может состоять только из 6 цифр'
                    }
                }
            },
            passport_date: {
                message: 'Некорректная дата выдачи паспорта',
                validators: {
                    notEmpty: {
                        message: 'Поле "Дата выдачи паспорта" обязательно и не может быть пустым'
                    },
                    date: {
                        format: 'DD.MM.YYYY',
                        message: 'Неверный формат ввода',
                    }
                }
            }
        }
    });


});