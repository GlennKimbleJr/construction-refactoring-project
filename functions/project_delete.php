<?php 

if (isset($_GET['delete'])) {
    $projectId = intval($_GET['delete']);

    echo "<h1>ARE YOU SURE?</h1><br>
        <h2><a href='?delyes={$projectId}'>YES</a> | <a href='?edit={$projectId}'>NO</a></h2>";
}

// Confirm
if (isset($_GET['delyes'])) {
    $projectId = intval($_GET['delyes']);
    
    $db->setData("DELETE FROM `projects` WHERE id = ?", [$projectId]);
    
    die('<h1>PROJECT DELETED!</h1><br>');
}
