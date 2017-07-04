<?php $this->layout('super', ['title' => $title]) ?>
<h3>
    EDIT Superintendent | 
    [ <a href="/superintendents/<?=$this->e($super['id'])?>/delete"><font color="red">DELETE</font></a> ]
</h3>

<form action="/superintendents/<?=$this->e($super['id'])?>" method="POST">
    <input id="id2" type="hidden" name="id2" required value="<?=$this->e($super['id'])?>" />

    <p>
        <label>Name: </label>
        <input id="name" type="text" name="name" required value="<?=$this->e($super['name'])?>" />
    </p>
    
    <p>
        <label>Phone: </label>
        <input id="phone" type="text" name="phone" required value="<?=$this->e($super['phone'])?>" />
    </p>

    <input class="btn register" type="submit" name="submit" value="Update" />
</form>
