<?php

// Starts Script
if (isset($_GET['delete'])) {
    $did = $_GET['delete'];

    echo "<h1>ARE YOU SURE?</h1><br>
    <h2><a href='?delyes=$did'>YES</a> | <a href='?edit=$did'>NO</a></h2>";
}

if (isset($_GET['delyes'])) {
    $delid = $_GET['delyes'];

    $db->setData('DELETE FROM type WHERE id = ?', [$delid]);
    
    die('<h1>DELETED!</h1><br>');
}
