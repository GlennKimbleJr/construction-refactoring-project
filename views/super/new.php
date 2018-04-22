<?php $this->layout('super', ['title' => $title]) ?>
<form action="/superintendents" method="POST">
    <div class="form-group">
        <label>Name: </label>
        <input class="form-control" id="name" type="text" name="name" required>
    </div>

    <div class="form-group">
        <label>Phone: </label>
        <input class="form-control" id="phone" type="text" name="phone" required>
    </div>

    <input class="btn btn-success register" type="submit" name="submit" value="Create">
</form>
