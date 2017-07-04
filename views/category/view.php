<?php $this->layout('category', ['title' => $title]) ?>
<h3>View All Categories</h3>
<div id='pagenation'>

<?php foreach($categories as $category): ?>
    <div class='z'>
        <a href='/categories/<?=$this->e($category['id'])?>/edit'>
            <?=$this->e($category['name'])?>
        </a>
    </div>
<?php endforeach ?>

</div><br>
<br>

<div id='pagingControls'></div>