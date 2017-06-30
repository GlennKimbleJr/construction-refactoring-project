<?php 

if (isset($_GET['new'])) {

    if (isset($_POST['name'])) {

        $query = $db->setData('INSERT INTO `categories` (name) VALUES (?)', [
            htmlspecialchars($_POST['name'])
        ]);
        
        echo $templates->render('message', [
            'template' => 'category',
            'message' => $db->updated($query) ? '<br><br>Created!' : '<br><br>Error! Unable to create categories.'
        ]); die();
    }

    echo $templates->render('category/new', ['title' => 'Add a New Category']);
}
