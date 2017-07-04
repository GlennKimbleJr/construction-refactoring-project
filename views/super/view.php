<?php $this->layout('super', ['title' => $title]) ?>
<h3>View All Superintendents</h3>

<div id='pagenation'>
    <?php foreach($supers as $super): ?>
        <div class='z'>
            <a href='/superintendents/<?=$this->e($super['id'])?>/edit'>
                <?=$this->e($super['name'])?>
            </a> - <?=$this->e($super['phone'])?>
        </div>
    <?php endforeach ?>
</div><br>
<br>

<div id='pagingControls'></div>