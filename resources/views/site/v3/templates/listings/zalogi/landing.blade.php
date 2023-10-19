@extends('frontend.layouts.app')
@section ('title', $page->title)
@section ('h1', $page->h1)
@section ('meta_description', $page->meta_description)

@section('content')

    @include('site.v3.modules.includes.breadcrumbs')

    <div class="first-block def_bg" data-src="/old_theme/img/bg/grey-bg.jpg">
    <div class="container">
        <div class="ckl-title"><span class="shadow-span typed-wrap">#ВсеЗаймыОнлайн <span id="typed"></span></span></div>
        <form action="/" id="zalogiLandingForm">
        <div class="flex landing-form">
            <div class="phone-wrap">
                <input class="width-100 form-control" name="zalogi_phone" placeholder="(8xxxxxxxxxx)" id="zalogi_phone" required>
            </div>
            <div class="property-wrap">
                <input class="width-100 form-control" name="zalogi_property" placeholder="Имущество" id="zalogi_property" required>
            </div>
            <div class="bnt-wrap">
                <button type="submit" class="width-100 form-btn1">Отправить заявку</button>
            </div>
        </div>
        </form>

    </div>
    </div>

    <div class="container">

        <span class="sub-title">Преимущества нашего займа</span>
        <div class="our-pluses">
            <div class="item-plus">
                <span class="item-plus-icon"></span>
                <span class="item-plus-title">Полностью бесплатно</span>
                <p class="item-plus-p">С помощью нашего сервиса любой желающий сможет бесплатно отправить заявку в залоговые компании - мы не берем комиссию за это</p>
            </div>
            <div class="item-plus">
                <span class="item-plus-icon"></span>
                <span class="item-plus-title">Только проверенные компании</span>
                <p class="item-plus-p">Мы сотрудничаем только с надежными и лицензированными залоговыми компаниями, которые работают в рамках закона</p>
            </div>
            <div class="item-plus">
                <span class="item-plus-icon"></span>
                <span class="item-plus-title">Быстрое решение</span>
                <p class="item-plus-p">Мы оперативно передаем ваши заявки в залоговые компании, которые быстро рассматривают их</p>
            </div>
            <div class="item-plus">
                <span class="item-plus-icon"></span>
                <span class="item-plus-title">Все регионы России</span>
                <p class="item-plus-p">Мы работаем с залоговыми компаниями по всей стране — от Крыма до Дальнего Востока</p>
            </div>
        </div>

    </div>


    <div class="our-types-wrap">
    <div class="container">
        <span class="sub-title">Какие типы залога мы принимаем?</span>
        <div class="our-types">
            <div class="item-types">
                <span class="item-types-icon"></span>
                <span class="item-types-title">Автомобиль</span>
                <p class="item-types-p">В качестве залога принимаются легковые и грузовые автомобили отечественных и иностранных марок, а также мотоциклы и спецтехника</p>
            </div>
            <div class="item-types">
                <span class="item-types-icon"></span>
                <span class="item-types-title">ПТС</span>
                <p class="item-types-p">В качестве залога принимается не сам автомобиль, а его ПТС — авто при этом остается у вас</p>
            </div>
            <div class="item-types">
                <span class="item-types-icon"></span>
                <span class="item-types-title">Недвижимость</span>
                <p class="item-types-p">Залогом может быть квартира, дом, земельный участок, комната или доля в недвижимости</p>
            </div>
        </div>
    </div>
    </div>


    <div class="container">
        <span class="sub-title">Как получить займ под залог?</span>
        <div class="how-get-loan">
            <div class="item-how-get-loan">
                <span class="item-how-get-loan-title">Отправьте заявку на заем</span>
                <p class="item-how-get-loan-p">Укажите в заявке контактную информацию и данные вашего залога — мы передадим ее в залоговую компанию</p>
            </div>
            <div class="item-how-get-loan">
                <span class="item-how-get-loan-title">Дождитесь ответа специалиста</span>
                <p class="item-how-get-loan-p">С вами свяжется специалист залоговой компании, чтобы сообщить вам предварительное решение и согласовать дальнейшее оформление заявки</p>
            </div>
            <div class="item-how-get-loan">
                <span class="item-how-get-loan-title">Передайте залог на оценку</span>
                <p class="item-how-get-loan-p">Вам нужно будет встретиться со специалистом компании, чтобы он оценил закладываемое имущество и рассчитал стоимость займа</p>
            </div>
            <div class="item-how-get-loan">
                <span class="item-how-get-loan-title">Подготовьте требуемые документы</span>
                <p class="item-how-get-loan-p">Вам понадобятся документы, подтверждающие личность и право собственности на залог — конкретный список вы получите в компании</p>
            </div>
            <div class="item-how-get-loan">
                <span class="item-how-get-loan-title">Заключите договор и получите деньги</span>
                <p class="item-how-get-loan-p">Заключите договор залога в отделении компании или у ее выездного специалиста — после этого вы получите деньги любым удобным способом</p>
            </div>

        </div>
    </div>

    <div class="container">
        {!! Shortcode::compile('
            [vsezaimy_accordion]

            [vsezaimy_accordion_item title="Требования к заемщику"]
            <ul>
                <li>Возраст от 18 до 65 лет</li>
                <li>Гражданство РФ</li>
                Регистрация в регионе присутствия компании</li>
                <li>Наличие постоянного источника дохода</li>
                <li>Наличие права собственности на закладываемое имущество</li>
            </ul>
            [/vsezaimy_accordion_item]

            [vsezaimy_accordion_item title="Требования к авто"]
            <ul>
                <li>Возраст до 5 лет (для отечественных авто) или до 7 лет (для иномарки)</li>
                <li>Регистрация на территории РФ</li>
                <li>Исправное техническое состояние, отсутствие серьезных неполадок</li>
                <li>Наличие страхования ОСАГО</li>
                <li>Отсутствие ареста, залога или других обременений</li>
            </ul>
            [/vsezaimy_accordion_item]

            [vsezaimy_accordion_item title="Требования к недвижимости"]
            <ul>
                <li>Квартира в капитальном многоквартирном доме, частный дом, земельный участок или коммерческая недвижимость</li>
                <li>Расположение в регионе присутствия залоговой компании</li>
                <li>Пригодное для проживания состояние — недвижимость не должна быть признана ветхой или аварийной</li>
                <li>Письменное согласие других собственников недвижимости</li>
                <li>Отсутствие ареста, ипотеки, залога или других обременений</li>
            </ul>
            [/vsezaimy_accordion_item]
            [/vsezaimy_accordion]
        ') !!}
    </div>



    <div class="container">
        <span class="sub-title">Вопросы и ответы</span>
        {!! Shortcode::compile('
                    [vsezaimy_accordion]

                    [vsezaimy_accordion_item title="Чем залог автомобиля отличается от залога ПТС?"]
                    <p>В первом случае в качестве залога передается сам автомобиль — вам придется оставить его на стоянке залоговой компании. Во втором случае вы передаете паспорт технического средства — автомобиль остается у вас, и вы сможете пользоваться им дальше.</p>
                    [/vsezaimy_accordion_item]

                    [vsezaimy_accordion_item title="Какие документы обязательны для оформления займа под залог?"]
                    <p>Зависит от типа залога, который вы предоставляете. Для автомобиля и ПТС это обычно паспорт, водительское удостоверение, ПТС и СТС, если требуется — полисы ОСАГО и КАСКО. Для недвижимости — паспорт, свидетельство о собственности, выписка из ЕГРП и документ, подтверждающий согласие других собственников. При необходимости залоговая компания может запросить другие документы и сведения.</p>
                    [/vsezaimy_accordion_item]

                    [vsezaimy_accordion_item title="Можно ли оформить заем под залог онлайн?"]
                    <p>При оформлении займа под залог вам потребуется встретиться со специалистом залоговой компании, чтобы он оценил имущество и подготовил необходимые документы. Поэтому полностью онлайн оформить такой займ не получится. Однако, вы можете оставить предварительную онлайн-заявку, чтобы узнать вероятное решение по займу и подробности его оформления.</p>
                    [/vsezaimy_accordion_item]

                    [vsezaimy_accordion_item title="Можно ли продлить залоговый займ или погасить его досрочно?"]
                    <p>Зависит от условий страховой компании. Обычно залоговый заем, как и обычный, можно вернуть досрочно или продлить. Чтобы это сделать, необходимо согласовать действия с займодавцем и, если потребуется, уплатить комиссию.</p>
                    [/vsezaimy_accordion_item]

                    [vsezaimy_accordion_item title="Я работаю неофициально или имею плохую кредитную историю, могу ли я оформить займ под залог?"]
                    <p>При оформлении залогового займа требования к доходу, месту работы и кредитной истории заемщика менее строгие, чем у необеспеченного займа. Причина в том, что здесь гарантией погашения долга в срок выступает закладываемое имущество. Если вы не вернете деньги, то займодавец может изъять залог.</p>
                    [/vsezaimy_accordion_item]

                    [/vsezaimy_accordion]
                ') !!}
    </div>



    <div class="container">
            <p>По всей России работает большое количество залоговых компаний, предлагающих займы под залог автомобиля, ПТС или недвижимости. Выбрать среди них надежную организацию, которая предложит удобные условия займа, очень сложно. Если вы не можете сделать это самостоятельно, то вам поможет наш сервис. Мы сами подберем для вас и вашего залога компанию с подходящими условиями.</p>
            <p>Чтобы воспользоваться нашим сервисом, укажите в заявке ваши контактные данные и информацию о вашем залоге — тип и характеристики (например, марку и пробег для авто, либо тип и метраж для недвижимости). Мы проанализируем вашу заявку и подберем проверенную залоговую компанию в вашем регионе, которая предложит наиболее выгодные условия. Для уточнения вопросов в течение нескольких минут после отправки заявки с вами свяжется наш консультант.</p>


        <hr>
        <p>Внимание!<br>
            #ВсеЗаймыОнлайн не выдает займы под залог самостоятельно. Мы только принимаем заявки и передаем их в залоговые компании. Решение по вашей заявке займодавец будет принимать сам.
        </p>
    </div>






        </div>





    <div class="modal fade" id="ZalogiLandingModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>

        <style>
            .first-block{
                padding: 70px;
            }

            .first-block-p{font-weight: bold; text-align: center}


            .landing-form{display: flex;flex-wrap: wrap;
                flex-direction: row;}
            .phone-wrap, .property-wrap, .bnt-wrap{flex: 1; padding: 0 15px;justify-content: center;}

            .sub-title{display: block;
                text-align: center;
                font-size: 1.5rem;
                font-weight: bold;
                margin: 45px 0 30px;}


            .our-pluses{display: flex;
                text-align: center;
                flex-wrap: wrap;
                flex-direction: row;}
            .our-pluses .item-plus{flex: 1; padding: 15px;justify-content: center;}
            .our-pluses .item-plus-icon{width: 48px; height: 48px; background: #ccc;    display: inline-block; }
            .our-pluses .item-plus-title{font-weight: bold;display: block;margin: 15px 0}
            .our-pluses .item-plus-p{margin-bottom: 45px}


            .our-types-wrap{
                background-color: #e9eff1;
                background-image: url(/old_theme/img/glints.png);
                padding: 30px;
            }
            .our-types{display: flex; text-align: center;flex-wrap: wrap;
                flex-direction: row;}
            .our-types .item-types{flex: 1; padding: 15px;justify-content: center;}
            .our-types .item-types-icon{width: 48px; height: 48px; background: #ccc;    display: inline-block; }
            .our-types .item-types-title{font-weight: bold;display: block;margin: 15px 0}
            .our-types .item-types-p{}


            .how-get-loan{display: flex; text-align: center;
                flex-wrap: wrap;
                flex-direction: row;}
            .how-get-loan .item-how-get-loan{flex: 1;padding: 15px;justify-content: center;}
            .how-get-loan .item-how-get-loan-title{font-weight: bold;display: block;margin: 15px 0}
            .how-get-loan .item-how-get-loan-p{}

            @media screen and (max-width: 992px){
                .our-pluses .item-plus{
                    flex-basis: calc(50% - 30px);
                    flex-direction: column;
                }
                .how-get-loan .item-how-get-loan{
                    flex-basis: calc(50% - 30px);
                    flex-direction: column;
                }
            }


            @media screen and (max-width: 768px){
                .phone-wrap, .property-wrap, .bnt-wrap{
                    flex-direction: column;
                    margin: 15px 0;
                    flex-basis: calc(100% - 15px);
                }
                .our-pluses .item-plus{
                    flex-basis: calc(100% - 15px);
                }
                .how-get-loan .item-how-get-loan{
                    flex-basis: calc(100% - 15px);
                }
                .our-types .item-types{
                    flex-basis: calc(100% - 15px);
                }
            }

        </style>



    @endsection


@section('additional-scripts')
    <script async src="/old_theme/js/typed.min.js"></script>
    <script>
        $(function(){
            var ArrValues = [
                '- подбор займов под залог в вашем городе',
                '- заявка в проверенные залоговые компании',
                '- залог автомобиля, ПТС, недвижимости и другого имущества',
                '- только надежные и лицензированные залоговые компании',
                '- бесплатно подберем для вас подходящий вариант'
            ];
            new Typed('#typed', {
                strings: ArrValues,
                typeSpeed: 60,
                backSpeed: 0,
                smartBackspace: true, // this is a default
                loop: true
            });
        })
    </script>
    <script defer src="/old_theme/js/jquery.maskedinput.min.js"></script>
    <script>
        $(function(){
            $("#zalogi_phone").mask("(89999999999)",
                {
                    autoclear: false,
                    completed: function () {
                        window.phone = $(this).val();
                    }
                }
            );
        });

    </script>
    <script>
        $('#zalogiLandingForm').on('submit', function (e) {
            e.preventDefault();
            var data = {};
            data['phone'] = $('#zalogi_phone').val();
            data['property'] = $('#zalogi_property').val();
            data['_token'] = $('meta[name=csrf-token]').attr('content');

            if ($('#zalogi_phone').val().search('_') != -1){
                alert('Проверьте правильность ввода телефона');
                return false;
            }

            $.ajax({
                url: "/forms/zalogi_landing",
                method: "POST",
                data: data,
                success: function(message){
                    $('#ZalogiLandingModal .modal-body').html('<p>'+message+'</p>');
                    $('#ZalogiLandingModal').modal();
                    $('#zalogi_phone').val('');
                    $('#zalogi_property').val('');
                }
            });
        });

    </script>
@endsection