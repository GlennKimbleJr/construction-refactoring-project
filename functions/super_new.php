<?php 

if (isset($_GET['new'])) {

    if (isset($_POST['name'])) {
        $query = $db->setData("INSERT INTO `super` (name, phone) VALUES (?, ?)", [
            htmlspecialchars(trim($_POST['name'])), 
            trim($_POST['phone'])
        ]);

        die($db->updated($query) ? '<br><br>Created!' : '<br><br>Error! Unable to create super.');
    }
    ?>

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
    
    <?php
}
