<?php 

require('../functions/connect.php');
if (empty($_GET) && empty($_POST)) {
    echo $templates->render('contact', ['title' => 'Categories Menu']);
}

require('../functions/categories_new.php');
require('../functions/categories_view.php');
require('../functions/categories_edit.php');
require('../functions/categories_delete.php');

