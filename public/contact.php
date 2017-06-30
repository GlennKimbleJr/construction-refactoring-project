<?php 

require('../functions/connect.php');
if (empty($_GET) && empty($_POST)) {
    echo $templates->render('contact', ['title' => 'Contact Menu']);
}

require('../functions/contact_new.php');
require('../functions/contact_view.php');
require('../functions/contact_details.php');
require('../functions/contact_edit.php');
require('../functions/contact_delete.php');
