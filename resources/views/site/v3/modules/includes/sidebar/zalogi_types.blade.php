<div class="side-block-dart">
    <div class="side-title">Тип займа <i class="fa fa-angle-down"></i></div>
    <div class="side-box links-list">
        <?php foreach($zalogi_types as $zalogi_key => $zalogi_value) : ?>
        <a href="/zalogi/<?= $zalogi_key ?>"><?= $zalogi_value ?></a><br>
        <?php endforeach; ?>
    </div>
</div>