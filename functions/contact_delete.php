<?php 

if (isset($_GET['delete'])) {
    $contactId = intval($_GET['delete']);

    echo $templates->render('message', [
        'template' => 'contact',
        'message' => "<h1>ARE YOU SURE?</h1><br>
            <h2>
                <a href='?delyes={$contactId}'>YES</a> | 
                <a href='?edit={$contactId}'>NO</a>
            </h2>"
    ]); die();
}

// Confirm
if (isset($_GET['delyes'])) {
    $db->setData('DELETE FROM contacts WHERE id = ?', [
        intval($_GET['delyes'])
    ]);

    echo $templates->render('message', [
        'template' => 'contact',
        'message' => "<h1>contact DELETED!</h1><br>"
    ]); die();
}
