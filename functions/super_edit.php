<?php 

// Starts Script
if (isset($_GET['edit'])) {

    // checks to see if posted
    if (isset($_POST['name'])) {
        $id2 = $_POST['id2'];
        $name = $_POST['name'];
        $name2 = mysql_real_escape_string($name);
        $phone = $_POST['phone'];

        // updates information in the database
        $query = $db->setData(
            "UPDATE super SET name=?, phone=? WHERE id=?",
            [$name2, $phone, $id2]
        );
        if (! $db->updated($query)) {
            die('<br><br>Update Error');
        } else {
            die('<br><br>Updated!');
        }
    }

    $did = $_GET['edit'];

    $super = $db->getFirst("SELECT * FROM super WHERE id=?", [$did]);
    if (! count($super)) {
        die('Could not get data.');
    }
    
    $Mid = $super['id'];
    $Mname = $super['name'];
    $Mphone = $super['phone'];

    ?>

    <h3>
        EDIT Superintendent | 
        [ <a href="?delete=<?php echo "$did"; ?>"><font color="red">DELETE</font></a> ]
    </h3>

    <form action="" method="POST">
        <input id="id2" type="hidden" name="id2" required value="<?php echo"$did"; ?>" />

        <p>
            <label>Name: </label>
            <input id="name" type="text" name="name" required value="<?php echo"$Mname"; ?>" />
        </p>
        
        <p>
            <label>Phone: </label>
            <input id="phone" type="text" name="phone" required value="<?php echo"$Mphone"; ?>" />
        </p>

        <input class="btn register" type="submit" name="submit" value="Update" />
    </form>

    <?php
}
