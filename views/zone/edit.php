<?php $this->layout('zone', ['title' => 'Edit Zone']) ?>

<form action="/zones/<?=$this->e($zone['id'])?>" method="POST">
    <input id="id2" type="hidden" name="id2" required value="<?=$this->e($zone['id'])?>">

    <div class="form-group">
        <label>Name: </label>
        <input class="form-control" id="name" type="text" name="name" required value="<?=$this->e($zone['name'])?>">
    </div>

    <input class="btn btn-success register" type="submit" name="submit" value="Update">
    <a class="btn btn-danger" href="/zones/<?=$this->e($zone['id'])?>/delete">Delete</a>
</form>
