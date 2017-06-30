<?php 

if (isset($_GET['edit'])) {

    if (isset($_POST['name'])) 
    {
        $query = $db->setData(
            "UPDATE projects SET name=?, bidduedate=?, zone_id=?, plans=?, location=?, planuser=?, planpass=?, owner_name=?, owner_phone=?, super_id=? WHERE id=?",
            [
                htmlspecialchars(trim($_POST['name'])),
                trim($_POST['due3']) . '-' . trim($_POST['due1']) . '-' . trim($_POST['due2']), 
                intval($_POST['zone']),
                trim($_POST['plans']), 
                trim($_POST['location']), 
                trim($_POST['planuser']), 
                trim($_POST['planpass']), 
                trim($_POST['owner_name']), 
                trim($_POST['owner_phone']), 
                intval($_POST['super']),
                intval($_POST['id2'])
            ]
        );

        echo $templates->render('message', [
            'template' => 'project',
            'message' => $db->updated($query) ? '<br><br>Project Updated!' : '<br><br>Update Error'
        ]); die();
    }

    $project = $db->getFirst("SELECT p.*, z.name as zone_name FROM projects as p, zones as z WHERE p.zone_id = z.id AND p.id=?", [intval($_GET['project'])]);

    if (! count($project)) {
        echo $templates->render('message', [
            'template' => 'project',
            'message' => 'Could not get data.'
        ]); die();
    }
    
    $date1 = substr($project['bidduedate'], 5, -3);
    $date2 = substr($project['bidduedate'], 8);
    $date3 = substr($project['bidduedate'], 0, -6);
    if ($date1 == "01") { $date4 = "Jan"; }
    if ($date1 == "02") { $date4 = "Feb"; }
    if ($date1 == "03") { $date4 = "Mar"; }
    if ($date1 == "04") { $date4 = "Apr"; }
    if ($date1 == "05") { $date4 = "May"; }
    if ($date1 == "06") { $date4 = "Jun"; }
    if ($date1 == "07") { $date4 = "Jul"; }
    if ($date1 == "08") { $date4 = "Aug"; }
    if ($date1 == "09") { $date4 = "Sep"; }
    if ($date1 == "10") { $date4 = "Oct"; }
    if ($date1 == "11") { $date4 = "Nov"; }
    if ($date1 == "12") { $date4 = "Dec"; }

    echo $templates->render('project/edit', [
        'title' => 'Edit Project',
        'project' => $project,
        'date1' => $date1,
        'date2' => $date2,
        'date3' => $date3,
        'date4' => $date4,
        'zones' => $db->getData("SELECT * FROM zones ORDER BY name"),
        'supers' => $db->getData("SELECT id, name FROM supers ORDER BY name")
    ]);
}
