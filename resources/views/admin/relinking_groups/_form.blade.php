<div class="form-group">
    <label for="group_name"><i class="red">*</i> Название Группы</label>
    <input type="text" class="form-control" name="group_name" id="group_name"
           @if(old('group_name'))
               value="{{old('group_name')}}"
           @else
               @if(isset($item))
                   value="{{$item->group_name}}"
            @endif
            @endif
    >
</div>
<div class="form-group">
    <label for="sort_order"><i class="red">*</i> Значение сортировки</label>
    <input type="text" class="form-control" name="sort_order" id="sort_order"
           @if(old('sort_order'))
               value="{{old('sort_order')}}"
           @else
               @if(isset($item))
                   value="{{$item->sort_order}}"
            @endif
            @endif
    >
</div>
<div class="form-group">
    <label for="category_id"><i class="red">*</i> Категория</label>
    <?php $category = (isset($item->category_id)) ? $item->category_id : null; ?>
    {{ Form::select('category_id',$cardsCategoriesArr,$category,['class'=>'form-control','id'=>'category_id','required'=>true])}}
</div>


{{--<div class="form-group">--}}
{{--    <label for="sort_order"> Тип сортировки</label>--}}
{{--    <?php--}}
{{--        $sortOrderArr = ['0'=>'Вниз','1'=>'Вверх'];--}}
{{--        $sortOrder = (isset($item->sort_order)) ? $item->sort_order : 0;--}}
{{--    ?>--}}
{{--    {{ Form::select('sort_order',$sortOrderArr,$sortOrder,['class'=>'form-control','id'=>'sort_order'])}}--}}
{{--</div>--}}

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
