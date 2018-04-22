<?php $this->layout('super', ['title' => $title]) ?>

<form action="/superintendents/<?=$this->e($super['id'])?>" method="POST">
    <input id="id2" type="hidden" name="id2" required value="<?=$this->e($super['id'])?>">

    <div class="form-group">
        <label>Name: </label>
        <input class="form-control" id="name" type="text" name="name" required value="<?=$this->e($super['name'])?>">
    </div>

    <div class="form-group">
        <label>Phone: </label>
        <input class="form-control" id="phone" type="text" name="phone" required value="<?=$this->e($super['phone'])?>">
    </div>

    <input class="btn btn-success register" type="submit" name="submit" value="Update">
    <a href="/superintendents/<?=$this->e($super['id'])?>/delete" class="btn btn-danger">Delete</a>
</form>
