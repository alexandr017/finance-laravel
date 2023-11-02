@extends ('admin.layouts.app')
@section ('title', 'Создание карточки')
@section ('h1', 'Создание карточки')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>


<form method="POST" action="/admin/cards/cards/create_save" novalidate>
    <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">


  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#global" aria-controls="global" role="tab" data-toggle="tab">Общие поля для всех карточек</a></li>
    <li role="presentation"><a href="#universal" aria-controls="universal" role="tab" data-toggle="tab">Поля для выбранной категории</a></li>
  </ul>

  <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="global">
            <div class="form-group">
                <label for="title"><i>*</i> Заголовок:</label>
                <input class="form-control" type="text" name="title" value="" id="title" required="true">
            </div>

            <div class="form-group">
                <label for="product_title">Чистое название продукта:</label>
                <input class="form-control" type="text" name="product_title" value="" id="product_title">
            </div>

            <div class="form-group">
                <label for="flow">Поток:</label>
                {{ Form::select('flow',[1 => 'Первый', 2 => 'Второй', 3 => 'Третий'],1,['class'=>'form-control','id'=>'flow'])}}
            </div>


            <div class="form-group">
                <label for="logo"><i>*</i> Лого URL:</label>
                <input class="form-control" type="text" name="logo" value="" id="logo" required="true">
            </div>
            <div class="form-group">
                <label for="link_1"><i>*</i> Главный URL для перехода:</label>
                <input class="form-control" type="text" value="" name="link_1" id="link_1" required="true">
            </div>
            <div class="form-group">
                <label for="link_2">Резервный URL для перехода:</label>
                <input class="form-control" type="text" value="" name="link_2" id="link_2">
            </div>
            <div class="form-group">
                <label for="link_type">Какой URL показывать:</label>
                {{ Form::select('link_type',['1' => 'Главный', '0' => 'Резервный'],1,['class'=>'form-control','id'=>'link_type'])}}
            </div>
            <div class="form-group">
                <label for="yandex_event">Событие Яндекс.Метрики:</label>
                <input class="form-control" type="text" value="" name="yandex_event" id="yandex_event">
            </div>
            <div class="form-group">
                <label for="promo">Является промо:</label>
                {{ Form::select('promo',['1' => 'Является', '0' => 'Не является'],0,['class'=>'form-control','id'=>'promo'])}}
            </div>
            <div class="form-group">
                <label for="km5"><i>*</i> КМ5:</label>
                <input type="number" id="km5" class="form-control" min="1" max="10" step="0.1" name="km5" required="true" value="3">
            </div>

            <div class="form-group">
                <label for="math_range">Математическая модель:</label>
                <input type="number" id="math_range" class="form-control" min="1" max="10" step="0.1" name="math_range" readonly>
            </div>

            <div class="form-group">
                <label for="card_type">Тип карточки (для Кейтаро):</label>
                <input type="text" id="card_type" class="form-control" name="card_type">
            </div>

            <div class="form-group">
                <label for="license">Лицензия:</label>
                <input type="text" id="license" class="form-control" name="license">
            </div>

            <div class="form-group">
                <label for="label">Бейдж:</label>
                {{ Form::select('label',[
                '0' => 'Отключен',
                '1' => 'Набирает популярность',
                '2' => '5 лет на рынке',
                '3' => 'Новинка',
                '4' => 'Рекомендуем',
                '5' => 'Лучшие отзывы',
                '6' => 'Большой % одобрений',
                '7' => 'Акция',
                '8' => 'Без страховки',
                '9' => 'Большие бонусы',
                '10' => 'Быстрое решение',
                '11' => 'Быстрые выплаты',
                '12' => 'Доставка',
                '13' => 'Крупные суммы',
                '14' => 'Лучшие условия',
                '15' => 'Низкие проценты',
                '16' => 'Под залог',
                '17' => 'Премиальным клиентам',
                '18' => 'Рассрочка',
                '19' => 'Для валютных сделок',
                '20' => 'За день',
                '21' => 'Счет и касса',
                '22' => 'Для бизнеса',
                ],0,['class'=>'form-control','id'=>'label'])}}
            </div>



            <div class="form-group">
                <label for="site_availability">Сайт доступен по специальному сертификату (ссылка подробнее):</label>
                <input class="form-control" type="text" name="site_availability" value="" id="site_availability">
            </div>

            <div class="form-group">
                <label for="downloads">Загрузки:</label> <button class="btn btn-success" id="addItem"><i class="fa fa-plus"></i></button>
                <div id="downloadsFileds">
                    <div class="row">
                        <div class="col-md-5">URL документа</div>
                        <div class="col-md-5">Текст ссылки</div>
                        <div class="col-md-2"></div>
                        <br><br>
                    </div>
                </div>
                <textarea style="display: none" name="downloads" id="downloads"></textarea>
            </div>
            <div class="form-group">
                <label for="support_link">Служба поддержки:</label>
                <input class="form-control" type="text" value="" name="support_link" id="support_link">
            </div>
            <div class="form-group">
                <label for="account_link">Личный кабинет:</label>
                <input class="form-control" type="text" value="" name="account_link" id="account_link">
            </div>

            <div class="form-group">
                <label for="link_to_entity">Ссылка на сущность (банк / компания):</label>
                <input class="form-control" type="text" value="" name="link_to_entity" id="link_to_entity">
            </div>
            <div class="form-group">
                <label for="link_to_reviews_page">Ссылка на отзывы:</label>
                <input class="form-control" type="text" value="" name="link_to_reviews_page" id="link_to_reviews_page">
            </div>


            <div class="form-group">
                <label for="company_id">Компания (для привязки отзывов и рейтинга):</label>
                {{Form::select('company_id',$companiesArr,null,['class'=>'form-control','id'=>'company_id'])}}
            </div>

            <div class="form-group">
                <label for="company_id2">Дополнительная компания:</label>
                {{Form::select('company_id2',$companiesArr,null,['class'=>'form-control','id'=>'company_id2','multiple'=>true])}}
            </div>

            <div class="form-group">
                <label for="bank_id">Банк:</label>
                {{Form::select('bank_id',$banksArr,null,['class'=>'form-control','id'=>'bank_id'])}}
            </div>

            <div class="form-group">
                <label for="show_in_habs">Отображать на хабовой:</label>
                {{ Form::select('show_in_habs',['1' => 'Да', '0' => 'Нет'],1,['class'=>'form-control','id'=>'show_in_habs'])}}
            </div>

            <div class="form-group">
                <label for="days_off">Список выходных дней (каждый с новой строки в формате день-месяц-год) <i>02-12-2020</i>:</label>
                <textarea name="days_off" id="days_off" class="form-control"></textarea>
            </div>


            <?php $vzo_icons = \Config::get('icons');  ?>
            <div class="form-group">
                <label for="icons">Иконки:</label><br>
                @for ($i = 1; $i <= 95; $i++)
                    <div class="checkbox width-33">
                        <label><input name="icons[]" value="{{$i}}" type="checkbox"> <img src="/images/ic/icon-{{$i}}.png" alt=""> @if(isset($vzo_icons[$i])) {{$vzo_icons[$i]['name']}} @endif </label>
                    </div>
                @endfor
            </div>

            <div class="form-group">
                <label for="scale_1">Шкала 1 (<span id="scale_1_label"></span>):</label>
                <input class="form-control" type="number" min="0" max="10" name="scale_1" id="scale_1">
            </div>

            <div class="form-group">
                <label for="scale_2">Шкала 2 (<span id="scale_2_label"></span>):</label>
                <input class="form-control" type="number" min="0" max="10" name="scale_2" id="scale_2">
            </div>

            <div class="form-group">
                <label for="scale_3">Шкала 3 (<span id="scale_3_label"></span>):</label>
                <input class="form-control" type="number" min="0" max="10" name="scale_3" id="scale_3">
            </div>

            <div class="form-group">
                <label for="scale_4">Шкала 4 (<span id="scale_4_label"></span>):</label>
                <input class="form-control" type="number" min="0" max="10" name="scale_4" id="scale_4">
            </div>

            <div class="form-group">
                <label for="scale_5">Шкала 5 (<span id="scale_5_label"></span>):</label>
                <input class="form-control" type="number" min="0" max="10" name="scale_5" id="scale_5">
            </div>

            <div class="form-group">
                <label for="status">Статус:</label>
                {{ Form::select('status',['1' => 'Включена', '0' => 'Отключена'],1,['class'=>'form-control','id'=>'status'])}}
            </div>
            
        </div>


        <div role="tabpanel" class="tab-pane" id="universal">
            <div class="form-group">
                <label for="category_id"><i>*</i> Категория:</label>
                {{ Form::select('category_id',$cardsCategoriesArr,null,['class'=>'form-control','id'=>'category_id','required'=>true])}}
            </div>
            <div id="ajax_fields"></div>
        </div>

    </div>

    <button type="submit" class="btn btn-success pull-right"><i class="fa fa-floppy-o"></i> Создать</button>

</form>
    
    <div class="clearfix"></div>


<style type="text/css">
.tab-content{padding: 15px;border: 1px solid #ccc;margin-bottom: 15px;}
.panel-info>.panel-heading{background: #c8e3f1;}
.skin-blue .wrapper, .skin-blue .main-sidebar, .skin-blue .left-side{background-color: #1D1F20;background-image: linear-gradient(145deg, #1D1F20, #404348);}
.content-wrapper{background: #f1f1f1}
.skin-blue .main-header .navbar {background-color: #2d76a0;}
.breadcrumb {padding: 8px 15px;margin-bottom: 20px;list-style: none;background-color: #e4e4e4;border-radius: 4px;border: 1px solid #b9b3b3;}
.breadcrumb a{color: #000}
.tab-content {background: #fff;}
.width-50{display: inline-block; width: 48.9%;}
.width-33{display: inline-block; width: 33%;}
</style>

<script type="text/javascript">
    $('#category_id').on('change',function(){
        $.ajax({
            type: "POST",
            url: "/admin/cards/get_fields",
            data: {
                '_token': $('#key').val(),
                'id': $(this).val()
            },
            //dataType: "json",
            success: function(data){
                $('#ajax_fields').html(data['fields']);
                $('#ajax_listings').html(data['listings']);

                $('#scale_1_label').text(data['scales']['scale1']);
                $('#scale_2_label').text(data['scales']['scale2']);
                $('#scale_3_label').text(data['scales']['scale3']);
                $('#scale_4_label').text(data['scales']['scale4']);
                $('#scale_5_label').text(data['scales']['scale5']);

            }
        });
    });
</script>



<script type="text/javascript">

$('#addItem').on('click',function(e){
    e.preventDefault();
    var code = '<div class="row">'+
        '<div class="col-md-5"><input type="text" class="form-control href"></div>'+
        '<div class="col-md-5"><input type="text" class="form-control lab"></div>'+
        '<div class="col-md-2"><button class="removeItem btn btn-danger"><i class="fa fa-remove"></i></button></div>'+
    '<br><br></div>';
    $('#downloadsFileds').append(code);
});

$(document).on('click','.removeItem',function(e){
    e.preventDefault();
    $(this).parent().parent().remove();
});

$('form').on('submit',function(){
    var HrefArr = [];
    $('.href').each(function(){
        HrefArr.push($(this).val());
    });
    var LabelArr = [];
    $('.lab').each(function(){
        LabelArr.push($(this).val());
    });

    var res = [];
    var tmp = {};
    var count = HrefArr.length;
    for(var i=0; i<count; i++){
        tmp ['href'] = HrefArr[i];
        tmp ['label'] = LabelArr[i];
        res.push(tmp);
        tmp = {};
    }
    var json = JSON.stringify(res);
    $('#downloads').val(json);
});

</script>


<script type="text/javascript">
$(document).ready(function() {
    $('#company_id').select2();
    $('#company_id2').select2();
    $('#bank_id').select2();
});
</script>




@stop