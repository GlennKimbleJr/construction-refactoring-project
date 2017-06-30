<?php 

require('../functions/connect.php');
if (empty($_GET) && empty($_POST)) {
    echo $templates->render('report', ['title' => 'Reports Menu']);
}

require('../functions/reports_bid.php');
require('../functions/reports_score.php');
