<?php 

if (isset($_GET['edit'])) {

    if (isset($_POST['name'])) {
        $query = $db->setData("UPDATE supers SET name = ?, phone = ? WHERE id = ?", [
            htmlspecialchars(trim($_POST['name'])), 
            trim($_POST['phone']), 
            intval($_POST['id2'])
        ]);

        echo $templates->render('message', [
            'template' => 'super',
            'message' => $db->updated($query) ? '<br><br>Updated!' : '<br><br>Update Error'
        ]); die();
    }

    $super = $db->getFirst("SELECT * FROM supers WHERE id = ?", [intval($_GET['edit'])]);
    if (! count($super)) {
        echo $templates->render('message', [
            'template' => 'super',
            'message' => 'Could not get data.'
        ]); die();
    }
    
    echo $templates->render('super/edit', [
        'title' => 'Edit a Superintendant',
        'super' => $super
    ]);
}
