<?php 

if (isset($_GET['view'])) {
    echo $templates->render('super/view', [
        'title' => 'View All Superintendants',
        'supers' => $db->getData("SELECT * FROM supers ORDER BY name")
    ]);
}
