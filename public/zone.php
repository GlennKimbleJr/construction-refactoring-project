<?php 

require('../functions/connect.php');
if (empty($_GET) && empty($_POST)) {
    echo $templates->render('zone', ['title' => 'Zone Menu']);
}

require('../functions/zone_new.php'); 
require('../functions/zone_view.php'); 
require('../functions/zone_edit.php'); 
require('../functions/zone_delete.php'); 
