<?php $this->layout('super', ['title' => $title]) ?>
<h3>Add New Superintendent</h3>

<form action="" method="POST">
    <p>
        <label>Name: </label>
        <input id="name" type="text" name="name" required placeholder="Joe Bob" />
    </p>
    
    <p>
        <label>Phone: </label>
        <input id="phone" type="text" name="phone" required placeholder="xxx-xxx-xxxx" />
    </p>

    <input class="btn register" type="submit" name="submit" value="Add" />
</form>