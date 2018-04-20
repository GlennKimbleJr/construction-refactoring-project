<?php $this->layout('category', ['title' => $title]) ?>

<form action="/categories" method="POST">
        <label>Name: </label>
        <input id="name" type="text" name="name" required placeholder="Category Name" />
        <input class="btn btn-sm btn-success register" type="submit" name="submit" value="Create" />
</form>
