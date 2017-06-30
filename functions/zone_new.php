<?php 

if (isset($_GET['new'])) {

    if (isset($_POST['name'])) {

        $query = $db->setData("INSERT INTO `zones` (name) VALUES (?)", [
            htmlspecialchars(trim($_POST['name']))
        ]);

        echo $templates->render('message', [
            'template' => 'zone',
            'message' => $db->updated($query) ? '<br><br>Created!' : '<br><br>Error! Unable to create zone.'
        ]); die();
    }
    
    echo $templates->render('zone/new');
}
