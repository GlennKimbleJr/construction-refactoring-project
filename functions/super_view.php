<?php 

if (isset($_GET['view'])) {

    echo "<h3>View All Superintendents</h3>
        
        <div id='pagenation'>";

    $supers = $db->getData("SELECT * FROM supers ORDER BY name");
    foreach ($supers as $super) {
        echo "<div class='z'><a href='?edit={$super['id']}'>{$super['name']}</a> - {$super['phone']}</div>";
    }

    echo "</div><br><br>
        <div id='pagingControls'></div>";
}
