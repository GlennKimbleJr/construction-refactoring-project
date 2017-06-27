<?php 

if (isset($_GET['view'])) {

    echo "<h3>View All Categories</h3><div id='pagenation'>";

    $categories = $db->getData("SELECT * FROM categories ORDER BY name");
    
    foreach ($categories as $category) {
        echo "<div class='z'><a href='?edit={$category['id']}'>{$category['name']}</a></div>";
    }

    echo "</div><br><br><div id='pagingControls'></div>";
}
