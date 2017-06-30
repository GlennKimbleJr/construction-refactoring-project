<?php 

if (isset($_GET['choose'])) {

    $projectId = intval($_GET['choose']);

    $categories = $db->getData("SELECT * FROM categories ORDER BY name");

    foreach ($categories as $key=>$category) {
        $categories[$key]['bidders'] = $db->getData( "SELECT c.company FROM bidders as b, contacts as c WHERE b.contact_id = c.id AND b.project_id = ? AND b.category_id = ?", [
                $projectId, 
                $category['id']
        ]);
    }

    echo $templates->render('project/choose_category', [
        'title' => 'Choose a Category',
        'projectId' => $projectId,
        'categories' => $categories
    ]);
}

if (isset($_GET['choose2'])) {

    $projectId = intval($_GET['choose2']);

    $category = $db->getFirst('SELECT * FROM categories WHERE id = ?', [intval($_GET['c'])]);

    $project = $db->getFirst("SELECT * FROM projects WHERE id = ?", [$projectId]);

    $zoneContacts = $db->getData("SELECT c.id, c.company FROM contacts as c, contacts_zones as cz WHERE c.id = cz.contact_id AND c.category_id = ? AND cz.zone_id = ? ORDER BY c.company", [
        $category['id'], 
        $project['zone_id']
    ]);

    $bidders = $db->getData("SELECT c.company FROM bidders as b, contacts as c WHERE b.contact_id = c.id AND b.project_id = ? AND b.category_id = ?", [
        $projectId, 
        $category['id']
    ]);

    echo $templates->render('project/choose_sub', [
        'title' => 'Choose a Sub-Contractor',
        'projectId' => $projectId,
        'category' => $category,
        'project' => $project,
        'zoneContacts' => $zoneContacts,
        'bidders' => $bidders,
    ]);
}

// checks to see if posted
if (isset($_POST['company'])) {
    $contactId = intval($_POST['company']);

    if (! $db->getCount("SELECT null FROM contacts WHERE id = ?", [$contactId])) {
        echo $templates->render('message', [
            'template' => 'project',
            'message' => 'Could not get data'
        ]); die();
    }

    $query = $db->setData("INSERT INTO `bidders` (project_id, contact_id, category_id, status, win, score) VALUES (?, ?, ?, ?, ?, ?)", [
            intval($_POST['did']), 
            $contactId,
            intval($_POST['c']), 
            '', 
            '', 
            'NA', 
        ]);

    echo $templates->render('message', [
        'template' => 'project',
        'message' => $db->updated($query) ? '<br><br>Sucess!' : '<br><br>Error!'
    ]);
}
