
<div class="form-group">
    <label for="name"><i class="red">*</i> Имя</label>
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

<div class="form-group">
    <label for="photo"><i class="red">*</i> Ссылка на фото</label>
    <input type="text" class="form-control" name="photo" id="photo" required
           @if(old('photo'))
               value="{{old('photo')}}"
           @else
               @if(isset($item))
                   value="{{$item->photo}}"
        @endif
        @endif
    >
</div>

@include('admin.v2.includes.seo-fields')

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
    <label for="lead"><i class="red">*</i> Лид</label>
    <input type="text" class="form-control" name="lead" id="lead" required
           @if(old('lead'))
               value="{{old('lead')}}"
           @else
               @if(isset($item))
                   value="{{$item->lead}}"
        @endif
        @endif
    >
</div>


<div class="form-group">
    <label for="content">Контент</label>
    <?php
    $content = old('content')
        ? old('content')
        : (isset($item) ? $item->content : '');
    ?>
    <textarea class="form-control" name="content" id="content">{{$content}}</textarea>
</div>


<div class="form-group">
    <label for="email"><i class="red">*</i> Email</label>
    <input type="email" class="form-control" name="email" id="email" required
           @if(old('email'))
               value="{{old('email')}}"
           @else
               @if(isset($item))
                   value="{{$item->email}}"
        @endif
        @endif
    >
</div>

<div class="form-group">
    <label for="job"><i class="red">*</i> Работа/Должность</label>
    <input type="text" class="form-control" name="job" id="job" required
           @if(old('job'))
               value="{{old('job')}}"
           @else
               @if(isset($item))
                   value="{{$item->job}}"
        @endif
        @endif
    >
</div>

<div class="form-group">
    <label for="education">Образование</label>
    <input type="text" class="form-control" name="education" id="education"
           @if(old('education'))
               value="{{old('education')}}"
           @else
               @if(isset($item))
                   value="{{$item->education}}"
        @endif
        @endif
    >
</div>


<div class="form-group">
    <label for="vk_link">Ссылка ВК</label>
    <input type="url" class="form-control" name="vk_link" id="vk_link"
           @if(old('vk_link'))
               value="{{old('vk_link')}}"
           @else
               @if(isset($item))
                   value="{{$item->vk_link}}"
        @endif
        @endif
    >
</div>

<div class="form-group">
    <label for="telegram_link">Ссылка телеграм</label>
    <input type="url" class="form-control" name="telegram_link" id="telegram_link"
           @if(old('vk_link'))
               value="{{old('telegram_link')}}"
           @else
               @if(isset($item))
                   value="{{$item->telegram_link}}"
        @endif
        @endif
    >
</div>


<div class="form-group">
    <label for="sort_order"><i class="red">*</i> Порядок отображения / сортировки</label>
    <input type="number" class="form-control" name="sort_order" id="sort_order" step="1" required
           @if(old('sort_order'))
               value="{{old('sort_order')}}"
           @else
               @if(isset($item))
                   value="{{$item->sort_order}}"
                @else
                    value="500"
                @endif
           @endif
    >
</div>

@include('admin.v2.includes.rating')

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
        window.CKEDITOR_elements = ['content'];
    </script>
    <script src="/admin/modules/ckeditor/ckeditor.js"></script>
    <script src="/admin/modules/ckeditor/config.js"></script>
@endsection
