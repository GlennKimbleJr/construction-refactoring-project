<?php 

if (isset($_GET['delete'])) {
    $did = intval($_GET['delete']);

    echo $templates->render('message', [
        'template' => 'super',
        'message' => "<h1>ARE YOU SURE?</h1><br>
            <h2><a href='?delyes={$did}'>YES</a> | <a href='?edit={$did}'>NO</a></h2>"
    ]); die();
}

// Confirm
if (isset($_GET['delyes'])) {
    $db->setData("DELETE FROM `supers` WHERE id = ?", [intval($_GET['delyes'])]);
    
    echo $templates->render('message', [
        'template' => 'super',
        'message' => '<h1>DELETED!</h1><br>'
    ]); die();
}
