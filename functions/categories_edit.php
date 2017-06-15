<?php

// Edit Category
if (isset($_GET['edit'])) {

    $category = $db->getFirst('SELECT * FROM type WHERE id = ?', [intval($_GET['edit'])]);

    if (empty($category)) {
        die('Error: Unable to find data.');
    }

    // checks to see if posted
    if (isset($_POST['name'])) {

        $query = $db->setData('UPDATE type SET name = ? WHERE id = ?', 
            [htmlspecialchars(trim($_POST['name'])), intval($_POST['id2'])]
        );

        die($db->updated($query) ? '<br><br>Updated!' : '<br><br>Update Error');
    }
    ?>

    <h3>
        EDIT Category | 
        [ 
            <a href="?delete=<?= $category['id'] ?>">
                <font color="red">DELETE</font>
            </a> 
        ]
    </h3>
    
    <form action="" method="POST">
        <p>
            <label>Name: </label>
            <input id="id2" type="hidden" name="id2" required value="<?= $category['id'] ?>" />
            <input id="name" type="text" name="name" required value="<?= $category['name'] ?>" />
        </p>

        <input class="btn register" type="submit" name="submit" value="Update" />
    </form>

    <?php
}
