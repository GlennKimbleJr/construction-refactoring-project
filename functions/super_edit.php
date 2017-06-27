<?php 

if (isset($_GET['edit'])) {

    if (isset($_POST['name'])) {
        $query = $db->setData(
            "UPDATE supers SET name = ?, phone = ? WHERE id = ?",
            [
                htmlspecialchars(trim($_POST['name'])), 
                trim($_POST['phone']), 
                intval($_POST['id2'])
            ]
        );

        die($db->updated($query) ? '<br><br>Updated!' : '<br><br>Update Error');
    }

    $superId = intval($_GET['edit']);
    $super = $db->getFirst("SELECT * FROM supers WHERE id = ?", [$superId]);
    if (! count($super)) {
        die('Could not get data.');
    }
    ?>

    <h3>
        EDIT Superintendent | 
        [ <a href="?delete=<?=$superId;?>"><font color="red">DELETE</font></a> ]
    </h3>

    <form action="" method="POST">
        <input id="id2" type="hidden" name="id2" required value="<?=$superId;?>" />

        <p>
            <label>Name: </label>
            <input id="name" type="text" name="name" required value="<?=$super['name'];?>" />
        </p>
        
        <p>
            <label>Phone: </label>
            <input id="phone" type="text" name="phone" required value="<?=$super['phone'];?>" />
        </p>

        <input class="btn register" type="submit" name="submit" value="Update" />
    </form>

    <?php
}
