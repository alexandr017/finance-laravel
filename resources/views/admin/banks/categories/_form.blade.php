<div class="form-group">
    <label for="category_id"><i class="red">*</i> Категория</label>
    <?php
    $current_category_id = old('category_id')
        ? old('category_id')
        : (isset($item) ? $item->category_id : null);
    ?>
    {!! Form::select('category_id',$freeCategoryPages,$current_category_id,['id'=>'category_id','class' => 'form-control','required' => true]) !!}
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
    <label for="scale_1">Шкала 1</label>
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
    <label for="scale_2">Шкала 2</label>
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
    <label for="scale_3">Шкала 3</label>
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
    <label for="scale_4">Шкала 4</label>
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
    <label for="scale_5">Шкала 5</label>
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