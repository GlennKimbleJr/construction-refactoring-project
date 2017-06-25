<?php 

if (isset($_GET['edit'])) {

    if (isset($_POST['name'])) {
        $query = $db->setData("UPDATE zone SET name = ? WHERE id = ?", [
            htmlspecialchars(trim($_POST['name'])), 
            intval($_POST['id2'])
        ]);

        die($db->updated($query) ? '<br><br>Updated!' : '<br><br>Update Error');
    }

    $zoneId = intval($_GET['edit']);

    $zone = $db->getFirst("SELECT name FROM zone WHERE id = ?", [$zoneId]);
    if (! count($zone)) {
        die('Could not get data.');
    }
    ?>

    <h3>
        EDIT Category | 
        <a href='' rel='imgtip[0]'><b><u>VIEW MAP</u></b></a> | 
        [ <a href="?delete=<?=$zoneId;?>"><font color="red">DELETE</font></a> ]
    </h3>

    <form action="" method="POST">
        <p>
            <label>Name: </label>
            <input id="id2" type="hidden" name="id2" required value="<?=$zoneId;?>" />
            <input id="name" type="text" name="name" required value="<?=$zone['name'];?>" />
        </p>

        <input class="btn register" type="submit" name="submit" value="Update" />
    </form>

    <?php
}
