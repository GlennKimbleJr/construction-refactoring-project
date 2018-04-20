<?php $this->layout('category', ['title' => $title]) ?>

<form action="/categories/<?=$this->e($category['id'])?>" method="POST">
        <input id="id2" type="hidden" name="id2" required value="<?=$this->e($category['id'])?>" />
        <label>Name: </label>
        <input id="name" type="text" name="name" required value="<?=$this->e($category['name'])?>" />
        <input class="btn btn-sm btn-success register" type="submit" name="submit" value="Update" />
        <a class="btn btn-sm btn-danger" href="/categories/<?=$this->e($category['id'])?>/delete">Delete</a>
</form>
