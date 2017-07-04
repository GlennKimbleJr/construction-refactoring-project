<?php $this->layout('contact', ['title' => 'Select a Category']) ?>
<h3>SELECT A TYPE</h3>

<?php foreach($categories as $category): ?>
<a href='?t=<?=$this->e($category['id'])?>'>
    <?=$this->e($category['name'])?>
</a><br>
<?php endforeach ?>