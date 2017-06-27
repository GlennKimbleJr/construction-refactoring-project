<?php 

if (isset($_GET['new'])) {

    if (isset($_POST['name'])) {

        $query = $db->setData("INSERT INTO `zones` (name) VALUES (?)", [
            htmlspecialchars(trim($_POST['name']))
        ]);

        die($db->updated($query) ? '<br><br>Created!' : '<br><br>Error! Unable to create zone.');
    }
    ?>

    <h3>Start a New Zone | <a href='' rel='imgtip[0]'><b><u>VIEW MAP</u></b></a></h3>

    <form action="" method="POST">
        <p>
            <label>Name: </label>
            <input id="name" type="text" name="name" required placeholder="FL - Northwest" />
        </p>

        <input class="btn register" type="submit" name="submit" value="Create" />
    </form>

    <?php
}
