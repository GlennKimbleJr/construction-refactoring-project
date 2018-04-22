<?php $this->layout('category', ['title' => $title]) ?>

<form action="/categories" method="POST">
    <div class="form-group">
        <label>Name: </label>
        <input class="form-control" id="name" type="text" name="name" required>
    </div>

    <input class="btn btn-success register" type="submit" name="submit" value="Create" />
</form>
