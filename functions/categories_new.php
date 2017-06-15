<?php

// Create a new category.
if (isset($_GET['new'])) {

    // checks to see if posted
    if (isset($_POST['name'])) {

        $query = $db->setData('INSERT INTO `type` (name) VALUES (?)', 
            [htmlspecialchars($_POST['name'])]
        );
        
        die($db->updated($query) ? '<br><br>Created!' : '<br><br>Error! Unable to create categories.');
    }
    ?>

    <h3>Start a New Category</h3>
    <form action="" method="POST">
        <p>
            <label>Name: </label>
            <input id="name" type="text" name="name" required placeholder="Category Name" />
        </p>

        <input class="btn register" type="submit" name="submit" value="Create" />
    </form>

    <?php
}
