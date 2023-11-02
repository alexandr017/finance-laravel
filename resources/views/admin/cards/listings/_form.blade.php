<div class="form-group">
    <label for="category_id"><i class="red">*</i> Категория</label>
    <?php
    $current_category = old('category_id')
        ? old('category_id')
        : (isset($item) ? $item->category_id : null);
    ?>
    {!! Form::select('category_id',$categories,$current_category,['id'=>'category_id','class' => 'form-control','required' => true]) !!}
</div>
{{--<div class="form-group">--}}
{{--    <label for="parent_id">ID родительского листинга <span class="input_counter"></span></label>--}}
{{--    <input type="text" class="form-control" name="parent_id" id="parent_id"--}}
{{--           @if(old('parent_id'))--}}
{{--           value="{{old('parent_id')}}"--}}
{{--           @else--}}
{{--           @if(isset($item))--}}
{{--           value="{{$item->parent_id}}"--}}
{{--            @endif--}}
{{--            @endif--}}
{{--    >--}}
{{--</div>--}}

@include('admin.includes.partials.seo-fields')


<div class="form-group">
    <label for="alias"><i>*</i> Постоянная ссылка:</label> <span class="btn btn-default btn-xs translate"><i class="fa fa-language"></i></span>
    <input type="text" class="form-control" name="alias" id="alias"
           @if(old('alias'))
               value="{{old('alias')}}"
           @else
               @if(isset($item))
                   value="{{$item->alias}}"
            @endif
            @endif
    >
</div>


{{--<div class="form-group">--}}
{{--    <label for="h2">h2 <span class="input_counter"></span></label>--}}
{{--    <input type="text" class="form-control" name="h2" id="h2" --}}
{{--           @if(old('h2'))--}}
{{--           value="{{old('h2')}}"--}}
{{--           @else--}}
{{--           @if(isset($item))--}}
{{--           value="{{$item->h2}}"--}}
{{--            @endif--}}
{{--            @endif--}}
{{--    >--}}
{{--</div>--}}

{{--<div class="form-group">--}}
{{--    <label for="img">Изображение <span class="input_counter"></span></label>--}}
{{--    <input type="text" class="form-control" name="img" id="img" --}}
{{--           @if(old('img'))--}}
{{--           value="{{old('img')}}"--}}
{{--           @else--}}
{{--           @if(isset($item))--}}
{{--           value="{{$item->img}}"--}}
{{--            @endif--}}
{{--            @endif--}}
{{--    >--}}
{{--</div>--}}

{{--<div class="form-group">--}}
{{--    <label for="og_img">Изображение OpenGraph <span class="input_counter"></span></label>--}}
{{--    <input type="text" class="form-control" name="og_img" id="og_img"--}}
{{--           @if(old('og_img'))--}}
{{--           value="{{old('og_img')}}"--}}
{{--           @else--}}
{{--           @if(isset($item))--}}
{{--           value="{{$item->og_img}}"--}}
{{--            @endif--}}
{{--            @endif--}}
{{--    >--}}
{{--</div>--}}

{{--<div class="form-group">--}}
{{--    <label for="infographic">Идентификатор инфографики <span class="input_counter"></span></label>--}}
{{--    <input type="text" class="form-control" name="infographic" id="infographic"--}}
{{--           @if(old('infographic'))--}}
{{--           value="{{old('infographic')}}"--}}
{{--           @else--}}
{{--           @if(isset($item))--}}
{{--           value="{{$item->infographic}}"--}}
{{--            @endif--}}
{{--            @endif--}}
{{--    >--}}
{{--</div>--}}

<div class="form-group">
    <label for="lead"><i class="red">*</i> Лид-абзац <span class="input_counter"></span></label>
    <?php
    $lead = old('lead')
        ? old('lead')
        : (isset($item) ? $item->lead : '');
    ?>
    <textarea class="form-control" name="lead" id="lead" required>{{$lead}}</textarea>
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

{{--<div class="form-group">--}}
{{--    <label for="total_compare_label">Метка итогового сравнения <span class="input_counter"></span></label>--}}
{{--    <input type="text" class="form-control" name="total_compare_label" id="total_compare_label"--}}
{{--           @if(old('total_compare_label'))--}}
{{--           value="{{old('total_compare_label')}}"--}}
{{--           @else--}}
{{--           @if(isset($item))--}}
{{--           value="{{$item->total_compare_label}}"--}}
{{--            @endif--}}
{{--            @endif--}}
{{--    >--}}
{{--</div>--}}

{{--<div class="form-group">--}}
{{--    <label for="total_compare_text">Текст итогового сравнения <span class="input_counter"></span></label>--}}
{{--    <input type="text" class="form-control" name="total_compare_text" id="total_compare_text"--}}
{{--           @if(old('total_compare_text'))--}}
{{--           value="{{old('total_compare_text')}}"--}}
{{--           @else--}}
{{--           @if(isset($item))--}}
{{--           value="{{$item->total_compare_text}}"--}}
{{--            @endif--}}
{{--            @endif--}}
{{--    >--}}
{{--</div>--}}

{{--<div class="form-group">--}}
{{--    <label for="city_id">Город</label>--}}
{{--    <?php--}}
{{--    $current_city = old('city_id')--}}
{{--        ? old('city_id')--}}
{{--        : (isset($item) ? $item->city_id : null);--}}
{{--    ?>--}}
{{--    {!! Form::select('city_id',$cities,$current_city,['id'=>'status','class' => 'form-control']) !!}--}}
{{--</div>--}}


{{--<div class="form-group">--}}
{{--    <label for="number_in_exel">Номер в базе ВЗО <span class="input_counter"></span></label>--}}
{{--    <input type="text" class="form-control" name="number_in_exel" id="number_in_exel"--}}
{{--           @if(old('number_in_exel'))--}}
{{--           value="{{old('number_in_exel')}}"--}}
{{--           @else--}}
{{--           @if(isset($item))--}}
{{--           value="{{$item->number_in_exel}}"--}}
{{--            @endif--}}
{{--            @endif--}}
{{--    >--}}
{{--</div>--}}

{{--<div class="form-group">--}}
{{--    <label for="source_of_cards">Ранжирование:</label>--}}
{{--    <?php--}}
{{--    $current_source_of_cards = old('source_of_cards')--}}
{{--        ? old('source_of_cards')--}}
{{--        : (isset($item) ? $item->source_of_cards : 0);--}}
{{--    ?>--}}
{{--    {{ Form::select('source_of_cards',[0 => 'К5М (общий список)', 1 => 'Математическая модель', 2 => 'Индивидуальный список'],$current_source_of_cards,['class'=>'form-control','id'=>'source_of_cards'])}}--}}
{{--    @if(isset($item))--}}
{{--    Перейти к <a href="/admin/cards/listings/{{$item->id}}/edit/personal-order">индивидуальному ранжированию</a>--}}
{{--    @endif--}}
{{--</div>--}}


<div class="form-group">
    <label for="status"><i class="red">*</i> Статус</label>
    <?php
    $current_status = old('status')
        ? old('status')
        : (isset($item) ? $item->status : 1);
    ?>
    {!! Form::select('status',[0 => 'Выключено', 1 => 'Включено'],$current_status,['id'=>'status','class' => 'form-control','required' => true]) !!}
</div>


<script src="/admin-assets/tinymce/js/tinymce/tinymce.min.js"></script>
<script src="/admin-assets/tinymce/wysiwyg.js"></script>
<script>
    tInit('#content');
</script>