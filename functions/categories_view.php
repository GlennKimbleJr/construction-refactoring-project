<?php

// Starts Script
if (isset($_GET['view'])) {

    echo "<h3>View All Categories</h3><div id='pagenation'>";

    $categories = $db->getData("SELECT * FROM type ORDER BY name");
    
    foreach ($categories as $category) {
        $id = $category['id'];
        $name = $category['name'];

        echo "<div class='z'><a href='?edit=$id'>$name</a></div>";
    }

    echo "</div><br><br><div id='pagingControls'></div>";
}
