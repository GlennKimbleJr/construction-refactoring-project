<?php 

if (isset($_GET['view'])) {
    echo $templates->render('category/view', [
        'title' => 'View Categories',
        'categories' => $db->getData("SELECT * FROM categories ORDER BY name")
    ]);
}
