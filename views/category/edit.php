<?php $this->layout('category', ['title' => $title]) ?>

<form action="/categories/<?=$this->e($category['id'])?>" method="POST">
        <input id="id2" type="hidden" name="id2" required value="<?=$this->e($category['id'])?>">

        <div class="form-group">
            <label>Name: </label>
            <input class="form-control" id="name" type="text" name="name" required value="<?=$this->e($category['name'])?>">
        </div>

        <input class="btn btn-success register" type="submit" name="submit" value="Update">
        <a class="btn btn-danger" href="/categories/<?=$this->e($category['id'])?>/delete">Delete</a>
</form>
