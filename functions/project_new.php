<?php 

if (isset($_GET['new'])) {

    if (isset($_POST['name'])) {

        $query = $db->setData(
            "INSERT INTO `projects` (name, bidduedate, completedate, zone_id, plans, location, planuser, planpass, owner_name, owner_phone, super_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
            [
                htmlspecialchars(trim($_POST['name'])), 
                trim($_POST['due3']) . '-' . trim($_POST['due1']) . '-' . trim($_POST['due2']), 
                '', 
                intval($_POST['zone']),
                trim($_POST['plans']), 
                trim($_POST['location']), 
                trim($_POST['planuser']), 
                trim($_POST['planpass']), 
                trim($_POST['owner_name']), 
                trim($_POST['owner_phone']), 
                intval($_POST['super']), 
            ]
        );

        echo $templates->render('message', [
            'template' => 'project',
            'message' => $db->updated($query) ? '<br><br>Project Created!' : '<br><br>Error! Unable to create project.'
        ]); die();
    }

    echo $templates->render('project/new', [
        'title' => 'Add New Project',
        'supers' => $db->getData("SELECT * FROM supers ORDER BY name"),
        'zones' => $db->getData("SELECT * FROM zones ORDER BY name")
    ]);
}
