<?php 

if (isset($_GET['edit'])) {

    $category = $db->getFirst('SELECT * FROM categories WHERE id = ?', [intval($_GET['edit'])]);

    if (empty($category)) {
        echo $templates->render('message', [
            'template' => 'category',
            'message' => 'Error: Unable to find data.'
        ]); die();
    }

    if (isset($_POST['name'])) {
        $query = $db->setData('UPDATE categories SET name = ? WHERE id = ?', [
            htmlspecialchars(trim($_POST['name'])), 
            intval($_POST['id2'])
        ]);

        echo $templates->render('message', [
            'template' => 'category',
            'message' => $db->updated($query) ? '<br><br>Updated!' : '<br><br>Update Error'
        ]); die();
    }

    echo $templates->render('category/edit', [
        'title' => 'Edit a Category',
        'category' => $category
    ]);
}
