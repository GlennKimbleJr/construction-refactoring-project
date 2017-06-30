<?php 

require('../functions/connect.php');
if (empty($_GET) && empty($_POST)) {
    echo $templates->render('project', ['title' => 'Project Menu']);
}

require('../functions/project_new.php');
require('../functions/project_view.php');
require('../functions/project_details.php');
require('../functions/project_edit.php');
require('../functions/project_delete.php');
require('../functions/project_choose.php');
