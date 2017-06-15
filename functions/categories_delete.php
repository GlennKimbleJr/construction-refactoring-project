<?php

// Delete Category
if (isset($_GET['delete'])) {
    $categoryId = intval($_GET['delete']);

    echo "<h1>ARE YOU SURE?</h1>
        <br>
        <h2>
            <a href='?delyes={$categoryId}'>YES</a> | 
            <a href='?edit={$categoryId}'>NO</a>
        </h2>";
}

// Confirm Delete Category
if (isset($_GET['delyes'])) {
    $db->setData('DELETE FROM type WHERE id = ?', 
        [intval($_GET['delyes'])]
    );

    die('<h1>DELETED!</h1><br>');
}
