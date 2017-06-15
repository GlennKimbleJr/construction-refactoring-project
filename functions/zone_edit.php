<?php 

// Starts Script
if (isset($_GET['edit'])) {

    // checks to see if posted

    if (isset($_POST['name'])) {
        $id2 = $_POST['id2'];
        $name = $_POST['name'];
        $name2 = htmlspecialchars($name);

        // updates information in the database
        $query = $db->setData("UPDATE zone SET name=? WHERE id=?", [$name2, $id2]);
        if (! $db->updated($query)) {
            die('<br><br>Update Error');
        } else {
           die('<br><br>Updated!');
        } 
    }

    $did = $_GET['edit'];

    $zone = $db->getFirst("SELECT * FROM zone WHERE id=?", [$did]);
    if (! count($zone)) {
        die('Could not get data.');
    }
    
    $Mid = $zone['id'];
    $Mname = $zone['name'];

    ?>

    <h3>
        EDIT Category | 
        <a href='' rel='imgtip[0]'><b><u>VIEW MAP</u></b></a> | 
        [ <a href="?delete=<?php echo "$did"; ?>"><font color="red">DELETE</font></a> ]
    </h3>

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
