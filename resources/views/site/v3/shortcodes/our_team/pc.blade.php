<div class="row rgotu">
    @foreach ($authors as $value)
        <div class="col-50-percent" id="{{str_slug($value->name)}}">
            <div class="gfbx">
                <img loading="lazy" src='{!! $value->photo !!}' alt='{!! $value->name !!}'><br>
                <b>{!! $value->name !!}</b>
                <br>
                {!! $value->links !!}
            </div>
            <p class="gbx">{!! $value->text !!}</p>
        </div>
    @endforeach
    <?php /*
    <div style="padding: 15px; outline: 1px solid #ccc;margin: 5px 15px;">
        <div class="experts_wrap">
            <div class="experts_item" id="aleksandr-kozhemyakin">
                <img loading="lazy" class="expert_photo" src="/images/authors/zibert.png" alt="Юлия Зиберт" style="max-width: 160px">
                <span class="expert_name">Юлия Зиберт</span>
                <p class="expert_info">Бывший главный редактор Микрокредитов РФ, сейчас работает на аналогичной должности в нашем проекте. До этого работала в различных СМИ, включая один из крупнейших банковских ресурсов Банкир.ру. Зиберт возглавляет новую команду журналистов, которая работает над новостями для #ВЗО. Через нее проходят все публикации перед добавлением на сайт.</p>
                <div class="clearfix"></div>
            </div>
        </div>
    </div> */ ?>
</div>