<input type="hidden" name="id" value="{{$childrenPage->id ?? 0}}">
<input type="hidden" name="company_id" value="{{$company->id ?? 0}}">

<div class="form-group">
    <label for="type_id"><i>*</i> Тип страницы:</label>
    {{Form::select('type_id', $childrenPageTypes, $childrenPage->type_id ?? 0 ,['id'=>'type_id','class' => 'form-control'])}}
</div>

<div class="form-group">
    <label for="h1"><i>*</i> H1:</label>
    <input class="form-control" type="text" name="h1" id="h1"
           @if(old('h1'))
               value="{{old('h1')}}"
           @else
               @if(isset($childrenPage))
                   value="{{$childrenPage->h1}}"
            @endif
            @endif
    >
</div>

<div class="form-group">
    <label for="title"><i>*</i> Title:</label>
    <input class="form-control" type="text" name="title" id="title"
           @if(old('title'))
               value="{{old('title')}}"
           @else
               @if(isset($childrenPage))
                   value="{{$childrenPage->title}}"
            @endif
            @endif
    >
</div>
<div class="form-group">
    <label for="breadcrumb">Хлебные крошки:</label>
    <input class="form-control" type="text" name="breadcrumb" id="breadcrumb"
           @if(old('breadcrumb'))
               value="{{old('breadcrumb')}}"
           @else
               @if(isset($childrenPage))
                   value="{{$childrenPage->breadcrumb}}"
            @endif
            @endif
    >
</div>
<div class="form-group">
    <label for="lead">Лид:</label>
    <textarea class="form-control" name="lead" id="lead">{{$childrenPage->lead ?? old('lead') ?? ''}}</textarea>
</div>

<div class="form-group">
    <label for="content"><i>*</i> Контент:</label>
    <textarea class="form-control" name="content" id="content">{{$childrenPage->content ?? old('content') ?? ''}}</textarea>
</div>

<div class="form-group">
    <label for="meta_description"><i>*</i> Мета - описание:</label>
    <textarea class="form-control" type="text" name="meta_description" id="meta_description">{{$childrenPage->meta_description ?? old('meta_description') ?? ''}}</textarea>
</div>
<div class="form-group">
    <label for="status"><i>*</i> Статус:</label>
    {{ Form::select('status', ['1' => 'Включена', '0' => 'Отключена'], $childrenPage->status ?? 1, array('id' => 'status', 'class' => 'form-control')) }}
</div>

<script src="/admin-assets/tinymce/js/tinymce/tinymce.min.js"></script>
<script src="/admin-assets/tinymce/wysiwyg.js"></script>

<script>
    let selectPageType = document.querySelector('#type_id');
    let contentFormGroup = document.querySelector('#content');

    let contentFormGroupCopy = contentFormGroup.cloneNode(true);

    let tInitContentPagesTypes = [1, 2, 8];

    selectPageType.addEventListener('change', () => {
        if (tInitContentPagesTypes.includes(+selectPageType.value)) {

            tInit('#content');
            return;
        }
        tinymce.remove("#content");
    })
    tInit('#content');

</script>