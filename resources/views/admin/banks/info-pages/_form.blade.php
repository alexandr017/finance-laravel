<div class="form-group">
    <label for="type_id"><i class="red">*</i> Тип страницы</label>
    <?php
    $current_type = old('type_id')
        ? old('type_id')
        : (isset($item) ? $item->type_id : null);
    ?>
    {!! Form::select('type_id',$freeTypePages,$current_type,['id'=>'type_id','class' => 'form-control','required' => true]) !!}
</div>

@include('admin.includes.partials.seo-fields-without-url')

<div class="form-group">
    <label for="lead">Лид <span class="input_counter"></span></label>
    <?php
    $lead = old('lead')
        ? old('lead')
        : (isset($item) ? $item->lead : '');
    ?>
    <textarea class="form-control" name="lead" id="lead">{{$lead}}</textarea>
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