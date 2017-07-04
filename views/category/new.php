<?php $this->layout('category', ['title' => $title]) ?>
<h3>Start a New Category</h3>
<form action="" method="POST">
    <p>
        <label>Name: </label>
        <input id="name" type="text" name="name" required placeholder="Category Name" />
    </p>

    <input class="btn register" type="submit" name="submit" value="Create" />
</form>