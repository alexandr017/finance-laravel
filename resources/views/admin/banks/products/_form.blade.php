<?php
//$scales = App\Models\Companies\CompaniesUrl::getScales();
//$scalesJson = json_encode($scales, JSON_INVALID_UTF8_SUBSTITUTE);
?>
<script>
    <?php /*
    //var scalesJson = '{!! $scalesJson !!}';
    //var scalesObj = JSON.parse(scalesJson);
 */ ?>
</script>

<div class="form-group">
    <label for="product_name"><i class="red">*</i> Название продукта <span class="input_counter"></span></label>
    <input type="text" class="form-control" name="product_name" id="product_name" required
           @if(old('product_name'))
    value="{{old('product_name')}}"
    @else
    @if(isset($item))
    value="{{$item->product_name}}"
    @endif
    @endif
    >
</div>


<div class="form-group">
    <label for="alias"><i class="red">*</i> Алиас</label>
    <input type="text" class="form-control" name="alias" id="alias" required
           @if(old('alias'))
    value="{{old('alias')}}"
    @else
    @if(isset($item))
    value="{{$item->alias}}"
    @endif
    @endif
    >
</div>


<div class="form-group">
    <label for="is_cashback"><i class="red">*</i> Относится к категории кэшбэк</label>
    <?php
    $current_is_cashback = old('is_cashback')
        ? old('is_cashback')
        : (isset($item) ? $item->is_cashback : 0);
    ?>
    {!! Form::select('is_cashback',[0 => 'Нет', 1 => 'Да'],$current_is_cashback,['id'=>'is_cashback','class' => 'form-control','required' => true]) !!}
</div>

@include('admin.includes.partials.seo-fields-without-url')

<div class="form-group">
    <label for="img">Изображение <span class="input_counter"></span></label>
    <input type="text" class="form-control" name="img" id="img"
           @if(old('img'))
    value="{{old('img')}}"
    @else
    @if(isset($item))
    value="{{$item->img}}"
    @endif
    @endif
    >
</div>

<div class="form-group">
    <label for="og_img">Изображение OpenGraph <span class="input_counter"></span></label>
    <input type="text" class="form-control" name="og_img" id="og_img"
           @if(old('og_img'))
    value="{{old('og_img')}}"
    @else
    @if(isset($item))
    value="{{$item->og_img}}"
    @endif
    @endif
    >
</div>


<div class="form-group">
    <label for="lead">Лид-абзац <span class="input_counter"></span></label>
    <?php
    $lead = old('lead')
        ? old('lead')
        : (isset($item) ? $item->lead : '');
    ?>
    <textarea class="form-control" name="lead" id="lead">{{$lead}}</textarea>
</div>



<div class="form-group">
    <label for="scale_1">Шкала {{$scalesName['scale1'] ?? ' 1'}}</label>
    <input type="text" class="form-control" name="scale_1" id="scale_1"
           @if(old('scale_1'))
    value="{{old('scale_1')}}"
    @else
    @if(isset($item))
    value="{{$item->scale_1}}"
    @endif
    @endif
    >
</div>

<div class="form-group">
    <label for="scale_2">Шкала {{$scalesName['scale2'] ?? ' 2'}}</label>
    <input type="text" class="form-control" name="scale_2" id="scale_2"
           @if(old('scale_2'))
    value="{{old('scale_2')}}"
    @else
    @if(isset($item))
    value="{{$item->scale_2}}"
    @endif
    @endif
    >
</div>



<div class="form-group">
    <label for="scale_3">Шкала {{$scalesName['scale3'] ?? ' 3'}}</label>
    <input type="text" class="form-control" name="scale_3" id="scale_3"
           @if(old('scale_3'))
    value="{{old('scale_3')}}"
    @else
    @if(isset($item))
    value="{{$item->scale_3}}"
    @endif
    @endif
    >
</div>


<div class="form-group">
    <label for="scale_4">Шкала {{$scalesName['scale4'] ?? ' 4'}}</label>
    <input type="text" class="form-control" name="scale_4" id="scale_4"
           @if(old('scale_4'))
    value="{{old('scale_4')}}"
    @else
    @if(isset($item))
    value="{{$item->scale_4}}"
    @endif
    @endif
    >
</div>



<div class="form-group">
    <label for="scale_5">Шкала {{$scalesName['scale5'] ?? ' 5'}}</label>
    <input type="text" class="form-control" name="scale_5" id="scale_5"
           @if(old('scale_5'))
    value="{{old('scale_5')}}"
    @else
    @if(isset($item))
    value="{{$item->scale_5}}"
    @endif
    @endif
    >
</div>


<div class="form-group">
    <label for="content">Контент <span class="input_counter"></span></label>
    <?php
    $content = old('content')
        ? old('content')
        : (isset($item) ? $item->content : '');
    ?>
    <textarea class="form-control" name="content" id="content">{{$content}}</textarea>
</div>



<div class="form-group">
    <label for="status">Закрыт</label>
    <?php
    $current_closed_status = old('closed')
        ? old('closed')
        : (isset($item) ? $item->closed : 0);
    ?>
    {!! Form::select('closed',[0 => 'Нет', 1 => 'Да'],$current_closed_status,['id'=>'closed','class' => 'form-control']) !!}
</div>





<div class="form-group">
    <label for="cards">Карточки</label>
    <?php
    if(!isset($current_cards)) {
        $current_cards = old('cards')
            ? old('cards')
            :  null;
    }
    ?>
    {!! Form::select('cards[]',$cards,$current_cards,['id'=>'cards','class' => 'form-control', 'multiple' => true]) !!}
</div>



<div class="form-group">
    <label for="status"><i class="red">*</i> Продукт имеет отдельную страницу</label>
    <?php
    $current_separate_page = old('separate_page')
        ? old('separate_page')
        : (isset($item) ? $item->separate_page : 1);
    ?>
    {!! Form::select('separate_page',[0 => 'Нет', 1 => 'Да'],$current_separate_page,['id'=>'separate_page','class' => 'form-control','required' => true]) !!}
</div>
<div class="form-group">
    <label for="show_other_banks_best_offers">Показывать лучшие предложения других банков</label>
    <?php
    $current_show_other_banks_best_offers = old('show_other_banks_best_offers')
        ? old('show_other_banks_best_offers')
        : (isset($item) ? $item->show_other_banks_best_offers : 0);
    ?>
    {!! Form::select('show_other_banks_best_offers',[0 => 'Скрыть', 1 => 'Показать'], $current_show_other_banks_best_offers, ['id'=>'show_other_banks_best_offers','class' => 'form-control']) !!}
</div>
<div class="form-group">
    <label for="not_actual_product">Плашка актуальности продукта</label>
    <?php
    $current_not_actual_product = old('not_actual_product')
        ? old('not_actual_product')
        : (isset($item) ? $item->not_actual_product : 0);
    ?>
    {!! Form::select('not_actual_product',[0 => 'Скрыть', 1 => 'Показать'], $current_not_actual_product, ['id'=>'not_actual_product','class' => 'form-control']) !!}
</div>

<div class="form-group">
    <label for="status"><i class="red">*</i> Статус</label>
    <?php
    $current_status = old('status')
        ? old('status')
        : (isset($item) ? $item->status : 1);
    ?>
    {!! Form::select('status',[0 => 'Выключено', 1 => 'Включено'],$current_status,['id'=>'status','class' => 'form-control','required' => true]) !!}
</div>

<?php
//    if(\Auth::id() == 12467) {
//        dd($item);
//    }
//$scales = App\Algorithms\General\Banks\ProductScaleNames::getScales(1);
//$scalesJson = json_encode($scales, JSON_INVALID_UTF8_SUBSTITUTE);
?>

<?php
/*
$scales = App\Models\Companies\CompaniesUrl::getScales();
$scalesJson = json_encode($scales, JSON_INVALID_UTF8_SUBSTITUTE);
?>
<script>
    var scalesJson = '{!! $scalesJson !!}';
    var scalesObj = JSON.parse(scalesJson);
    var scalesArr = Object.keys(scalesObj).map(function(key) {
        return [Number(key), scalesObj[key]];
    });
    //console.log(scalesObj[1].scale1);
</script>
*/ ?>

<link href="/admin-assets/select2/select2.min.css" rel="stylesheet" />
<script src="/admin-assets/select2/select2.min.js"></script>




<script src="/admin-assets/tinymce/js/tinymce/tinymce.min.js"></script>
<script src="/admin-assets/tinymce/wysiwyg.js"></script>
<script>
    tInit('#content');
    $(document).ready(function() {
        $('#cards').select2();
    });
</script>
