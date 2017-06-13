<?php

// Starts Script

if (isset($_GET['new'])) {

    // checks to see if posted
    if (isset($_POST['name'])) {
        $name2 = $_POST['name'];
        $name = mysql_real_escape_string($name2);

        // inserts information into database
        $query_startseason = "INSERT INTO `type` (name) VALUES ('$name')";
        $result_startseason = mysql_query($query_startseason);
        if ($result_startseason) {
            die('<br><br>Created!');
        } else {
            die('<br><br>Error! Unable to create categories.');
        }
    }
    ?>

    <h3>Start a New Category</h3>
    <form action="" method="POST">
        <p>
            <label>Name: </label>
            <input id="name" type="text" name="name" required placeholder="Joe Bob's Remodel" />
        </p>

        <input class="btn register" type="submit" name="submit" value="Create" />
    </form>

    <?php
}
