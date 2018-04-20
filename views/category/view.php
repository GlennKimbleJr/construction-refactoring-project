<?php $this->layout('category', ['title' => $title]) ?>

<div id='pagenation'>
<?php foreach($categories as $category): ?>
    <div class='z'>
        <a href='/categories/<?=$this->e($category['id'])?>/edit'>
            <?=$this->e($category['name'])?>
        </a>
    </div>
<?php endforeach ?>
</div>
<hr>
<div id='pagingControls'></div>
