<?php 

// Starts Script
if (isset($_GET['new'])) {

    // checks to see if posted
    if (isset($_POST['name'])) {
        $name2 = $_POST['name'];
        $name = htmlspecialchars($name2);
        $phone = $_POST['phone'];

        // inserts information into database
        $query = $db->setData("INSERT INTO `super` (name, phone) VALUES (?, ?)", [$name, $phone]);
        if ($db->updated($query)) {
            die('<br><br>Created!');
        } else {
            die('<br><br>Error! Unable to create super.');
        }
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
