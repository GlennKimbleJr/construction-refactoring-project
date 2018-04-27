<?php $this->layout('contact', ['title' => 'Select a Division']) ?>

<?php foreach($categories as $category): ?>
<a href='/contacts/categories/<?=$this->e($category['id'])?>'>
    <?=$this->e($category['name'])?>
</a><br>
<?php endforeach ?>
