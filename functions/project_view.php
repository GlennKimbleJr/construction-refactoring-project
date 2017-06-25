<?php 

function projectTemplate($projects) {
    if (! count($projects)) {
        return 'Could not get data.';
    }

    $html = "<div id='pagenation'>";

    foreach ($projects as $project) {
        $html .= "<div class='z'>
            <a href='?details={$project['id']}'>
                {$project['name']}
            </a> - {$project['bidduedate']} | <a href='?edit=1&project={$project['id']}'>EDIT</a>
        </div>";
    }

    $html .= "</div><br><br>";
    $html .= "<div id='pagingControls'></div>";

    return $html;
}

if (isset($_GET['view'])) {

    echo "<h3>
        View All Projects - <a href='?open'><u>Open Only</u></a> | <a href='?closed'><u>Closed Only</u></a>
    </h3>";

    echo projectTemplate(
        $db->getData("SELECT * FROM project ORDER BY bidduedate")
    );
}

if (isset($_GET['open'])) {
    echo "<h3>View Open Projects - <a href='?view'><u>All Projects</u></a> | <a href='?closed'><u>Closed Only</u></a></h3>";
    
    echo projectTemplate(
        $db->getData("SELECT * FROM project WHERE completedate = '' ORDER BY bidduedate")
    );
}

if (isset($_GET['closed'])) {
    echo "<h3>View Closed Projects - <a href='?view'><u>All Projects</u></a> | <a href='?open'><u>Open Only</u></a></h3>";

    echo projectTemplate(
        $db->getData("SELECT * FROM project WHERE completedate != '' ORDER BY bidduedate")
    );
}
