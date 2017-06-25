<?php 

if (isset($_GET['delete'])) {

    $did = intval($_GET['delete']);

    echo "<h1>ARE YOU SURE?</h1><br>
        <h2><a href='?delyes={$did}'>YES</a> | <a href='?edit={$did}'>NO</a></h2>";
}


if (isset($_GET['delyes'])) {
    $db->setData("DELETE FROM `super` WHERE id = ?", [intval($_GET['delyes'])]);
    
    die('<h1>DELETED!</h1><br>');
}
