<?php 

if (isset($_GET['view'])) {
    echo $templates->render('zone/view', [
        'zones' => $db->getData("SELECT * FROM zones ORDER BY name")
    ]);
}
