<br class="clearfix">
  <ul class="pagination">
  <?php if(ceil($pages) >= 5) { ?>
  <?php if($page < 5) : ?>
    <li<?php if($page==1) echo ' class="active"';?>><a href="/{{$postCategory->alias_category}}">1</a></li>
    <li<?php if($page==2) echo ' class="active"';?>><a href="/{{$postCategory->alias_category}}/page/2">2</a></li>
    <li<?php if($page==3) echo ' class="active"';?>><a href="/{{$postCategory->alias_category}}/page/3">3</a></li>
    <li<?php if($page==4) echo ' class="active"';?>><a href="/{{$postCategory->alias_category}}/page/4">4</a></li>
    <li<?php if($page==5) echo ' class="active"';?>><a href="/{{$postCategory->alias_category}}/page/5">5</a></li>
    <li><a href="/{{$postCategory->alias_category}}/page/<?= $pages ?>"><span aria-hidden="true">&raquo;</span></a></li>
    <?php else : ?>
        <li><a href="/{{$postCategory->alias_category}}"><span aria-hidden="true">&laquo;</span></a></li>
        <li><a href="/{{$postCategory->alias_category}}/page/<?= ($page - 2) ?>"><?= ($page - 2) ?></a></li>
        <li><a href="/{{$postCategory->alias_category}}/page/<?= ($page - 1) ?>"><?= ($page - 1) ?></a></li>
        <li class="active"><span><?= $page ?></span></li>
        <?php if($page <= (ceil($pages) -2)): ?>
            <li><a href="/{{$postCategory->alias_category}}/page/<?= ($page + 1) ?>"><?= ($page + 1) ?></a></li>
            <?php if($page < (ceil($pages) -1)): ?>
                <li><a href="/{{$postCategory->alias_category}}/page/<?= ($page + 2) ?>"><?= ($page + 2) ?></a></li>
                <?php if(($page != ceil($pages)) && ($page+2 != ceil($pages))): ?>
                    <li><a href="/{{$postCategory->alias_category}}/page/<?= $pages ?>"><span aria-hidden="true">&raquo;</span></a></li>
                <?php endif ?>
            <?php endif ?>
        <?php else : ?>
            <?php if($page+1 != ceil($pages) && ($page != $pages)) : ?>
                <li><a href="/{{$postCategory->alias_category}}/page/<?= $pages ?>"><span aria-hidden="true">&raquo;</span></a></li>
            <?php else : ?>
                <?php if($page == ceil($pages)) : ?>
                <?php else : ?>
                    <li><a href="/{{$postCategory->alias_category}}/page/<?= $pages ?>"><span aria-hidden="true"><?= $pages ?></span></a></li>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
    <?php endif; ?>

<?php } elseif(ceil($pages) == 4){ ?>
    <li<?php if($page==1) echo ' class="active"';?>><a href="/{{$postCategory->alias_category}}">1</a></li>
    <li<?php if($page==2) echo ' class="active"';?>><a href="/{{$postCategory->alias_category}}/page/2">2</a></li>
    <li<?php if($page==3) echo ' class="active"';?>><a href="/{{$postCategory->alias_category}}/page/3">3</a></li>
    <li<?php if($page==4) echo ' class="active"';?>><a href="/{{$postCategory->alias_category}}/page/4">4</a></li>
<?php } elseif(ceil($pages) == 3){ ?>
    <li<?php if($page==1) echo ' class="active"';?>><a href="/{{$postCategory->alias_category}}">1</a></li>
    <li<?php if($page==2) echo ' class="active"';?>><a href="/{{$postCategory->alias_category}}/page/2">2</a></li>
    <li<?php if($page==3) echo ' class="active"';?>><a href="/{{$postCategory->alias_category}}/page/3">3</a></li>
<?php } elseif(ceil($pages) == 2){ ?>
    <li<?php if($page==1) echo ' class="active"';?>><a href="/{{$postCategory->alias_category}}">1</a></li>
    <li<?php if($page==2) echo ' class="active"';?>><a href="/{{$postCategory->alias_category}}/page/2">2</a></li>
    <?php } ?>
  </ul>