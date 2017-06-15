<?php 

// Starts Script
if (isset($_GET['view'])) {

    echo "<h3>View All Superintendents</h3>
        
        <div id='pagenation'>";


    $supers = $db->getData("SELECT * FROM super ORDER BY name");
    
    foreach ($supers as $super) {
        $id = $super['id'];
        $name = $super['name'];
        $phone = $super['phone'];

        echo "<div class='z'><a href='?edit=$id'>$name</a> - $phone</div>";
    }

    echo "</div><br><br>
        <div id='pagingControls'></div>";
}
