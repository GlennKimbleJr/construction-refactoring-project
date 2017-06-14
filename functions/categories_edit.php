<?php

// Starts Script
if (isset($_GET['edit'])) {

    $did = $_GET['edit'];

    // checks to see if posted
    if (isset($_POST['name'])) {
        $id2 = $_POST['id2'];
        $name = $_POST['name'];
        $name2 = htmlspecialchars($name);

        // updates information in the database
        $query = $db->setData('UPDATE type SET name = ? WHERE id = ?', [$name2, $id2]);
        if (! $db->updated($query)) {
            die('<br><br>Update Error');
        } else {
            die('<br><br>Updated!');
        }
    }

    $selectusercheck_row = $db->getData('SELECT * FROM type WHERE id = ?', [$did]);
    $Mid = $selectusercheck_row[0]['id'];
    $Mname = $selectusercheck_row[0]['name'];

    ?>

    <h3>EDIT Category | [ <a href="?delete=<?php echo "$did"; ?>"><font color="red">DELETE</font></a> ]</h3>
    <form action="" method="POST">
        <p>
            <label>Name: </label>
            <input id="id2" type="hidden" name="id2" required value="<?php echo"$did"; ?>" />
            <input id="name" type="text" name="name" required value="<?php echo"$Mname"; ?>" />
        </p>

        <input class="btn register" type="submit" name="submit" value="Update" />
    </form>

    <?php
}
