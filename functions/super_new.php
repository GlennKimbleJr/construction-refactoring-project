<?php 

if (isset($_GET['new'])) {

    if (isset($_POST['name'])) {
        $query = $db->setData("INSERT INTO `supers` (name, phone) VALUES (?, ?)", [
            htmlspecialchars(trim($_POST['name'])), 
            trim($_POST['phone'])
        ]);

        echo $templates->render('message', [
            'template' => 'super',
            'message' => $db->updated($query) ? '<br><br>Created!' : '<br><br>Error! Unable to create super.'
        ]); die();
    }

    echo $templates->render('super/new', ['title' => 'Add a New Superintendant']);
}
