<?php 

if (isset($_GET['edit'])) {

    if (isset($_POST['name'])) {
        $query = $db->setData("UPDATE zones SET name = ? WHERE id = ?", [
            htmlspecialchars(trim($_POST['name'])), 
            intval($_POST['id2'])
        ]);

        echo $templates->render('message', [
            'template' => 'zone',
            'message' => $db->updated($query) ? '<br><br>Updated!' : '<br><br>Update Error'
        ]); die();
    }

    $zone = $db->getFirst("SELECT id, name FROM zones WHERE id = ?", [intval($_GET['edit'])]);
    if (! count($zone)) {
        echo $templates->render('message', [
            'template' => 'zone',
            'message' => 'Could not get data.'
        ]); die();
    }

    echo $templates->render('zone/edit', [
        'zone' => $zone,
    ]); die();
}
