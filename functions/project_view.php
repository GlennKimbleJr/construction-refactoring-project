<?php 

if (isset($_GET['view'])) {
    echo $templates->render('project/view', [
        'title' => 'Project Menu',
        'projects' => $db->getData("SELECT * FROM projects ORDER BY bidduedate"),
        'headline' => "View All Projects - <a href='?open'><u>Open Only</u></a> | <a href='?closed'><u>Closed Only</u></a>",
    ]);
}

if (isset($_GET['open'])) {
    echo $templates->render('project/view', [
        'title' => 'Project Menu',
        'projects' => $db->getData("SELECT * FROM projects WHERE completedate = '' ORDER BY bidduedate"),
        'headline' => "View Open Projects - <a href='?view'><u>All Projects</u></a> | <a href='?closed'><u>Closed Only</u></a>",
    ]);
}

if (isset($_GET['closed'])) {
    echo $templates->render('project/view', [
        'title' => 'Project Menu',
        'projects' => $db->getData("SELECT * FROM projects WHERE completedate != '' ORDER BY bidduedate"),
        'headline' => "View Closed Projects - <a href='?view'><u>All Projects</u></a> | <a href='?open'><u>Open Only</u></a>",
    ]);
}
