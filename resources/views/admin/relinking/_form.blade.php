<div class="form-group">
    <label for="category_id"><i class="red">*</i> Категория</label>
    <?php $category = (isset($item->category_id)) ? $item->category_id : null; ?>
    {{ Form::select('category_id',$cardsCategoriesArr,$category,['class'=>'form-control','id'=>'category_id','required'=>true])}}
</div>
<div class="form-group">
    <label for="group_title"><i class="red">*</i> Название Группы</label>
    <?php $relinking_group_id = (isset($item->relinking_group_id)) ? $item->relinking_group_id : null; ?>
    <?php $groupCat = ($category != null) ? $category : 1; ?>
    {{ Form::select('relinking_group_id',$relinkingGroupsArr[$groupCat]->pluck('group_name','id'),$relinking_group_id,['class'=>'form-control','id'=>'relinking_group_id','required'=>true])}}
</div>
<div class="form-group">
    <label for="title"><i class="red">*</i> Название</label>
    <input type="text" class="form-control" name="title" id="title"
           @if(old('title'))
    value="{{old('title')}}"
    @else
    @if(isset($item))
    value="{{$item->title}}"
    @endif
    @endif
    >
</div>

<div class="form-group">
    <label for="link"><i class="red">*</i> Ссылка</label>
    <input type="text" class="form-control" name="link" id="link"
           @if(old('link'))
    value="{{old('link')}}"
    @else
    @if(isset($item))
    value="{{$item->link}}"
    @endif
    @endif
    >
</div>

<div class="form-group">
    <label for="sort_order"> Значение сортировки</label>
    <input type="number" class="form-control" name="sort_order" id="sort_order"
           @if(old('sort_order'))
               value="{{old('sort_order')}}"
           @else
               @if(isset($item))
                   value="{{$item->sort_order}}"
    @endif
    @endif

</div>

<script>
    $(document).ready(function () {
        var categorySelect = $('#category_id');
        var relinkingGroupSelect = $('#relinking_group_id');

        categorySelect.on('change', function () {
            var selectedCategoryId = $(this).val();
            $.ajax({
                url: '/admin/get-relinking-groups/' + selectedCategoryId,
                type: 'GET',
                success: function (data) {
                    relinkingGroupSelect.empty();
                    $.each(data, function (id,item) {
                        relinkingGroupSelect.append($('<option>', {
                            value: item.id,
                            text: item.group_name
                        }));
                    });
                }
            });
        });
    });
</script>
