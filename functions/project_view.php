<?php 

// Starts Script
if (isset($_GET['view'])) {

    echo "<h3>
        View All Projects - <a href='?open'><u>Open Only</u></a> | <a href='?closed'><u>Closed Only</u></a>
    </h3>

    <div id='pagenation'>";

    $projects = $db->getData("SELECT * FROM project ORDER BY bidduedate");
    if (! count($projects)) {
        die('Could not get data.');
    }
    
    foreach ($projects as $project) {
        $id = $project['id'];
        $name = $project['name'];
        $datedate = $project['bidduedate'];

        echo "<div class='z'>
            <a href='?details=$id'>$name</a> - $datedate | <a href='?edit=$id'>EDIT</a>
        </div>";
    }

    echo "</div><br><br>
        <div id='pagingControls'></div>";
}

if (isset($_GET['open'])) {
    echo "<h3>View Open Projects - <a href='?view'><u>All Projects</u></a> | <a href='?closed'><u>Closed Only</u></a></h3>";
    echo "<div id='pagenation'>";

    $projects = $db->getData("SELECT * FROM project WHERE completedate = '' ORDER BY bidduedate");
    if (! count($projects)) {
        die('Could not get data.');
    }
    
    foreach ($projects as $project) {
        $id = $project['id'];
        $name = $project['name'];
        $datedate = $project['bidduedate'];

        echo "<div class='z'>
            <a href='?details=$id'>$name</a> - $datedate | <a href='?edit=$id'>EDIT</a>
        </div>";
    }

    echo "</div><br><br>
        <div id='pagingControls'></div>";
}

if (isset($_GET['closed'])) {
    echo "<h3>View Closed Projects - <a href='?view'><u>All Projects</u></a> | <a href='?open'><u>Open Only</u></a></h3>";

    echo "<div id='pagenation'>";

    $projects = $db->getData("SELECT * FROM project WHERE completedate != '' ORDER BY bidduedate");
    if (! count($projects)) {
        die('Could not get data.');
    }
    
    foreach ($projects as $project) {
        $id = $project['id'];
        $name = $project['name'];
        $datedate = $project['bidduedate'];

        echo "<div class='z'>
            <a href='?details=$id'>$name</a> - $datedate | <a href='?edit=$id'>EDIT</a>
        </div>";
    }

    echo "</div><br><br>
        <div id='pagingControls'></div>";
}
