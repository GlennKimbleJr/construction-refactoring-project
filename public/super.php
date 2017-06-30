<?php 

require('../functions/connect.php');
if (empty($_GET) && empty($_POST)) {
    echo $templates->render('super', ['title' => 'Super Menu']);
}

require('../functions/super_new.php');
require('../functions/super_view.php');
require('../functions/super_edit.php');
require('../functions/super_delete.php');

