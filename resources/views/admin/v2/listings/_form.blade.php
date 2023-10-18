
<div class="form-group">
    <label for="parent_id">ID родительского листинга</label>
    <input type="text" class="form-control" name="parent_id" id="parent_id"
           @if(old('parent_id'))
               value="{{old('parent_id')}}"
           @else
               @if(isset($item))
                   value="{{$item->parent_id}}"
        @endif
        @endif
    >
</div>

<div class="form-group">
    <label for="name"><i class="red">*</i> Название</label>
    <input type="text" class="form-control" name="name" id="name" required
           @if(old('name'))
               value="{{old('name')}}"
           @else
               @if(isset($item))
                   value="{{$item->name}}"
        @endif
        @endif
    >
</div>


@include('admin.v2.includes.seo-fields')

'description' => [],
'slug' => [],
'meta_title' => [],

<div class="form-group">
    <label for="url"><i class="red">*</i> URL (без https://kursy.ru/)</label>
    <input type="text" class="form-control" name="url" id="url" required
           @if(old('url'))
               value="{{old('url')}}"
           @else
               @if(isset($item))
                   value="{{$item->urls->url}}"
        @endif
        @endif
    >
</div>


<div class="form-group">
    <label for="author_id"><i class="red"></i> Автор</label>
    <select name="author_id" id="author_id" class="form-control">
        @foreach($employees as $id => $name)
            <option value="{{$id}}" @if(isset($item) && $item->author_id == $id) selected @endif>{{$name}}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="preview"><i class="red">*</i> Превью</label>
    <input type="text" class="form-control" name="preview" id="preview" required
           @if(old('preview'))
               value="{{old('preview')}}"
           @else
               @if(isset($item))
                   value="{{$item->preview}}"
        @endif
        @endif
    >
</div>




<div class="form-group">
    <label for="lead"><i class="red"></i> Лид</label>
    <?php
    $lead = old('lead')
        ? old('lead')
        : (isset($item) ? $item->lead : '');
    ?>
    <textarea class="form-control" name="lead" id="lead">{{$lead}}</textarea>
</div>


<div class="form-group">
    <label for="content"><i class="red"></i> Контент</label>
    <?php
    $content = old('content')
        ? old('content')
        : (isset($item) ? $item->content : '');
    ?>
    <textarea class="form-control" name="content" id="content">{{$content}}</textarea>
</div>

@include('admin.v2.includes.rating')

'rating_sum' => [],

<div class="form-group">
    <label for="status"><i class="red ">*</i> Статус</label>
    <select name="status" id="status" class="form-control" required>
        <option value="1" @if(isset($item) && $item->status == 1) selected @endif>Включен</option>
        <option value="0" @if(isset($item) && $item->status == 0) selected @endif>Отключен</option>
    </select>
</div>

@section('additional-scripts')
    @parent
    <script>
        window.CKEDITOR_elements = ['lead', 'content'];
    </script>
    <script src="/admin/modules/ckeditor/ckeditor.js"></script>
    <script src="/admin/modules/ckeditor/config.js"></script>
@endsection
