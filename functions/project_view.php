<?php 

// Starts Script
if (isset($_GET['view'])) {

    echo "<h3>
        View All Projects - <a href='?open'><u>Open Only</u></a> | <a href='?closed'><u>Closed Only</u></a>
    </h3>

    <div id='pagenation'>";

    $selectusercheck = "SELECT * FROM project ORDER BY bidduedate";
    $selectusercheck_works = mysql_query( $selectusercheck, $connection );
    if (! $selectusercheck_works) {
        die('Could not get data: ' . mysql_error());
    }
    
    while ($selectusercheck_row = mysql_fetch_array($selectusercheck_works, MYSQL_ASSOC)) {
        $id = $selectusercheck_row['id'];
        $name = $selectusercheck_row['name'];
        $datedate = $selectusercheck_row['bidduedate'];

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

    $selectusercheck = "SELECT * FROM project WHERE completedate = '' ORDER BY bidduedate";
    $selectusercheck_works = mysql_query( $selectusercheck, $connection );
    if (! $selectusercheck_works) {
        die('Could not get data: ' . mysql_error());
    }
    
    while ($selectusercheck_row = mysql_fetch_array($selectusercheck_works, MYSQL_ASSOC)) {
        $id = $selectusercheck_row['id'];
        $name = $selectusercheck_row['name'];
        $datedate = $selectusercheck_row['bidduedate'];

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

    $selectusercheck = "SELECT * FROM project WHERE completedate != '' ORDER BY bidduedate";
    $selectusercheck_works = mysql_query( $selectusercheck, $connection );
    if (! $selectusercheck_works) {
        die('Could not get data: ' . mysql_error());
    }
    
    while( $selectusercheck_row = mysql_fetch_array($selectusercheck_works, MYSQL_ASSOC)) {
        $id = $selectusercheck_row['id'];
        $name = $selectusercheck_row['name'];
        $datedate = $selectusercheck_row['bidduedate'];

        echo "<div class='z'>
            <a href='?details=$id'>$name</a> - $datedate | <a href='?edit=$id'>EDIT</a>
        </div>";
    }

    echo "</div><br><br>
        <div id='pagingControls'></div>";
}
