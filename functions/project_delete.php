<?php 

if (isset($_GET['delete'])) {
    $projectId = intval($_GET['delete']);

    echo $templates->render('message', [
        'template' => 'project',
        'message' => "<h1>ARE YOU SURE?</h1><br>
        <h2><a href='?delyes={$projectId}'>YES</a> | <a href='?edit={$projectId}'>NO</a></h2>"
    ]); die();
}

// Confirm
if (isset($_GET['delyes'])) {
    $db->setData("DELETE FROM `projects` WHERE id = ?", [intval($_GET['delyes'])]);
    
    echo $templates->render('message', [
        'template' => 'project',
        'message' => '<h1>PROJECT DELETED!</h1><br>'
    ]); die();
}
