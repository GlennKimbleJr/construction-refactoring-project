<?php

// Delete Contact
if (isset($_GET['delete'])) {
    $contactId = intval($_GET['delete']);

    echo "<h1>ARE YOU SURE?</h1>
        <br>
        <h2>
            <a href='?delyes={$contactId}'>YES</a> | 
            <a href='?edit={$contactId}'>NO</a>
        </h2>";
}

// Confirm Delete Contact
if (isset($_GET['delyes'])) {
    $db->setData('DELETE FROM contact WHERE id = ?', 
        [intval($_GET['delyes'])]
    );

    die('<h1>contact DELETED!</h1><br>');
}
