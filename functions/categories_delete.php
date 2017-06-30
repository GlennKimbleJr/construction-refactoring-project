<?php 

if (isset($_GET['delete'])) {
    $categoryId = intval($_GET['delete']);

    echo $templates->render('message', [
        'template' => 'category',
        'message' => "<h1>ARE YOU SURE?</h1>
        <br>
        <h2>
            <a href='?delyes={$categoryId}'>YES</a> | 
            <a href='?edit={$categoryId}'>NO</a>
        </h2>"
    ]); die();
}

// Confirm
if (isset($_GET['delyes'])) {
    $db->setData('DELETE FROM categories WHERE id = ?', [
        intval($_GET['delyes'])
    ]);

    echo $templates->render('message', [
        'template' => 'category',
        'message' => '<h1>DELETED!</h1><br>'
    ]); die();
}
