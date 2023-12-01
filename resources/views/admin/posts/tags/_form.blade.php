<div class="form-group">
    <label for="tag"><i class="red">*</i> Название</label>
    <input type="text" class="form-control" name="tag" id="tag" required
           @if(old('tag'))
    value="{{old('tag')}}"
    @else
    @if(isset($item))
    value="{{$item->tag}}"
    @endif
    @endif
    >
</div>

<div class="form-group">
    <label for="category_id"><i class="red">*</i> Категория:</label>
    <?php
        $currentCategoryID = null;
        if (old('category_id')) {
            $currentCategoryID = old('category_id');
        } elseif (isset($item)) {
            $currentCategoryID = $item->category_id;
        }
    ?>
    {{Form::select('category_id', $categoriesArr, $currentCategoryID, ['id'=>'category_id', 'class' => 'form-control'])}}
</div>
<div class="form-group">
    <label for="tags">Родительский тег:</label>
    <?php
        $parentTagId = null;
        if (old('parent_tag')) {
            $parentTagId = old('parent_tag');
        } elseif (isset($item)) {
            $parentTagId = $item->parent_id;
        }
    ?>
    {{Form::select('parent_id',$tagsArr,$parentTagId,['id'=>'parent_tag','class' => 'form-control'])}}
</div>

<script>
    let categorySelector = document.querySelector('#category_id');
    let tagsSelector = document.querySelector('#parent_tag');

    categorySelector.addEventListener('change', () => {
        showSelectedCategoryTags();
        tagsSelector.selectedIndex = 0;
    });

    showSelectedCategoryTags();

    function showSelectedCategoryTags() {
        tagsSelector.querySelectorAll('optgroup').forEach(group => {
            if (group.label != categorySelector.value) {
                group.setAttribute('hidden', '');
                return;
            }

            group.removeAttribute('hidden');
        });
    }
</script>