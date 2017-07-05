<?php $this->layout('category', ['title' => $title]) ?>
<h3>
    EDIT Category | 
    [ 
        <a href="/categories/<?=$this->e($category['id'])?>/delete">
            <font color="red">DELETE</font>
        </a> 
    ]
</h3>

<form action="/categories/<?=$this->e($category['id'])?>" method="POST">
    <p>
        <label>Name: </label>
        <input id="id2" type="hidden" name="id2" required value="<?=$this->e($category['id'])?>" />
        <input id="name" type="text" name="name" required value="<?=$this->e($category['name'])?>" />
    </p>

    <input class="btn register" type="submit" name="submit" value="Update" />
</form>