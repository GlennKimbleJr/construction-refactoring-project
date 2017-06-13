<?php

// Starts Script
if (isset($_GET['delete'])) {
    $did = $_GET['delete'];

    echo "<h1>ARE YOU SURE?</h1><br>
    <h2><a href='?delyes=$did'>YES</a> | <a href='?edit=$did'>NO</a></h2>";
}

if (isset($_GET['delyes'])) {
    $delid = $_GET['delyes'];
    
    $delete_match = "DELETE FROM `type` WHERE id = '$delid'";
    $delete_works = mysql_query( $delete_match, $connection );
    die('<h1>DELETED!</h1><br>');
}
