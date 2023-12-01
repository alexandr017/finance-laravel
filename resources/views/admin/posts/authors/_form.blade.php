<input type="number" name="id" value="{{$author->id ?? 0}}" hidden>

<div class="form-group">
    <label for="name"><i>*</i> Имя:</label>
    <input type="text" class="form-control" name="name" id="name" required
           @if(old('name'))
               value="{{old('name')}}"
           @else
               @if(isset($author))
                   value="{{$author->name}}"
            @endif
            @endif
    >
</div>

<div class="form-group">
    <label for="roditelny"><i>*</i> Имя в родительном подеже:</label>
    <input type="text" class="form-control" name="roditelny" id="roditelny" required
           @if(old('roditelny'))
               value="{{old('roditelny')}}"
           @else
               @if(isset($author))
                   value="{{$author->roditelny}}"
                @endif
            @endif
    >
</div>

<div class="form-group">
    <label for="photo"><i>*</i> Фото:</label>
    <input type="text" class="form-control" name="photo" id="photo" required
           @if(old('photo'))
               value="{{old('photo')}}"
           @else
               @if(isset($author))
                   value="{{$author->photo}}"
              @endif
            @endif
    >
</div>

<div class="form-group">
    <label for="small_photo">Фото превью:</label>
    <input type="text" class="form-control" name="small_photo" id="small_photo"
           @if(old('small_photo'))
               value="{{old('small_photo')}}"
           @else
               @if(isset($author))
                   value="{{$author->small_photo}}"
              @endif
            @endif
    >
</div>

<hr>

<div class="form-group">
    <label for="position"><i>*</i> Должность:</label>
    <input type="text" class="form-control" name="position" id="position" required
           @if(old('position'))
               value="{{old('position')}}"
           @else
               @if(isset($author))
                   value="{{$author->position}}"
               @endif
            @endif
    >
</div>

<div class="form-group">
    <label for="duties">Над чем работает:</label>
    <?php
    $duties = old('duties')
        ? old('duties')
        : (isset($author) ? $author->duties : '');
    ?>
    <textarea class="form-control" name="duties" id="duties">{{$duties}}</textarea>
</div>

<div class="form-group">
    <label for="education">Образование:</label>
    <?php
    $education = old('education')
        ? old('education')
        : (isset($author) ? $author->education : '');
    ?>
    <textarea class="form-control" name="education" id="education">{{$education}}</textarea>
</div>

<hr>

<div class="form-group">
    <label for="email"><i>*</i> Email:</label>
    <input type="email" class="form-control" name="email" id="email" required
           @if(old('email'))
               value="{{old('email')}}"
           @else
               @if(isset($author))
                   value="{{$author->email}}"
               @endif
            @endif
    >
</div>

<div class="form-group">
    <label for="links">Ссылки:</label>
    <?php
    $links = old('links')
        ? old('links')
        : (isset($author) ? $author->links : '');
    ?>
    <textarea class="form-control" name="links" id="links">{{$links}}</textarea>
</div>

<div class="form-group">
    <label for="link_facebook">Фейсбук:</label>
    <input type="text" class="form-control" name="link_facebook" id="link_facebook"
           @if(old('link_facebook'))
               value="{{old('link_facebook')}}"
           @else
               @if(isset($author))
                   value="{{$author->link_facebook}}"
               @endif
            @endif
    >
</div>

<div class="form-group">
    <label for="link_vk">ВК:</label>
    <input type="text" class="form-control" name="link_vk" id="link_vk"
           @if(old('link_vk'))
               value="{{old('link_vk')}}"
           @else
               @if(isset($author))
                   value="{{$author->link_vk}}"
            @endif
            @endif
    >
</div>

<div class="form-group">
    <label for="link_inst">Инста:</label>
    <input type="text" class="form-control" name="link_inst" id="link_inst"
           @if(old('link_inst'))
               value="{{old('link_inst')}}"
           @else
               @if(isset($author))
                   value="{{$author->link_inst}}"
            @endif
            @endif
    >
</div>

<div class="form-group">
    <label for="yandex_q">Яндекс Кью:</label>
    <input type="text" class="form-control" name="yandex_q" id="yandex_q"
           @if(old('yandex_q'))
               value="{{old('yandex_q')}}"
           @else
               @if(isset($author))
                   value="{{$author->yandex_q}}"
            @endif
            @endif
    >
</div>

<hr>

<div class="form-group">
    <label for="text"><i>*</i> Текст (кратко):</label>
    <?php
    $text = old('text')
        ? old('text')
        : (isset($author) ? $author->text : '');
    ?>
    <textarea class="form-control" name="text" id="text" required>{{$text}}</textarea>
</div>

<div class="form-group">
    <label for="content">Контент:</label>
    <?php
    $content = old('content')
        ? old('content')
        : (isset($author) ? $author->content : '');
    ?>
    <textarea class="form-control" name="content" id="content">{{$content}}</textarea>
</div>

<div class="form-group">
    <label for="sort_order"><i>*</i> Порядок:</label>
    <input type="text" class="form-control" name="sort_order" id="sort_order" required
           @if(old('sort_order'))
               value="{{old('sort_order')}}"
           @else
               @if(isset($author))
                   value="{{$author->sort_order}}"
               @endif
            @endif
    >
</div>

<div class="form-group">
    <label for="title">Мета title:</label>
    <?php
    $title = old('title')
        ? old('title')
        : (isset($author) ? $author->title : '');
    ?>
    <textarea class="form-control" name="title" id="title">{{$title}}</textarea>
</div>

<div class="form-group">
    <label for="meta_description">Мета описание:</label>
    <?php
    $meta_description = old('meta_description')
        ? old('meta_description')
        : (isset($author) ? $author->meta_description : '');
    ?>
    <textarea class="form-control" name="meta_description" id="meta_description">{{$meta_description}}</textarea>
</div>

<div class="form-group">
    <label for="third_party_publications">Сторонние публикации <i style="color: #6B7073">(Заголовок@ссылка)</i><span class="input_counter"></span></label>
    <?php
    $third_party_publications = old('third_party_publications')
        ? old('third_party_publications')
        : (isset($author) ? $author->third_party_publications : '');
    ?>
    <textarea class="form-control" name="third_party_publications" id="third_party_publications">{{$third_party_publications}}</textarea>
</div>

<div class="form-group">
    <label for="publications_vzo">Публикации на Финансов <i style="color: #6B7073">(Заголовок@ссылка)</i><span class="input_counter"></span></label>
    <?php
    $publications_vzo = old('publications_vzo')
        ? old('publications_vzo')
        : (isset($author) ? $author->publications_vzo : '');
    ?>
    <textarea class="form-control" name="publications_vzo" id="publications_vzo">{{$publications_vzo}}</textarea>
</div>

<div class="form-group">
    <label for="status">Статус:</label>
    <?php
    $current_status = (isset($author))
        ? $author->status
        : 1
    ?>
    {{Form::select('status',['1'=>'Включен','0'=>'Выключен'],$current_status,['id'=>'status','class' => 'form-control'])}}
</div>