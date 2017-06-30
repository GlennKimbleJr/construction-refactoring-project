<?php 

if (isset($_GET['edit'])) {

    if (isset($_POST['id2'])) {

        $query = $db->setData(
            'UPDATE contacts SET first = ?, last = ?, street = ?, city = ?, state = ?, email = ?, officephone = ?, cellphone = ?, fax = ?, category_id = ?, company = ?, zip = ? WHERE id = ?', [
                trim($_POST['first']), 
                trim($_POST['last']), 
                trim($_POST['street']), 
                trim($_POST['city']), 
                trim($_POST['state']), 
                trim($_POST['email']), 
                trim($_POST['officephone']), 
                trim($_POST['cellphone']), 
                trim($_POST['fax']), 
                intval($_POST['type']), 
                htmlspecialchars($_POST['company']), 
                trim($_POST['zip']), 
                intval($_POST['id2'])
            ]);

        $db->setData("DELETE FROM `contacts_zones` WHERE `contact_id` = ?", [
            intval($_POST['id2'])
        ]);

        if (isset($_POST['zone']) && is_array($_POST['zone'])) { foreach ($_POST['zone'] as $zone_id) {
            $db->setData("INSERT INTO `contacts_zones` (`contact_id`, `zone_id`) VALUES (?, ?)", [
                intval($_POST['id2']), 
                $zone_id
            ]);
        }}

        echo $templates->render('message', [
            'template' => 'contact',
            'message' => '<br><br>Updated!'
        ]); die();
    }

    $contact = $db->getFirst('SELECT * FROM contacts WHERE id = ?', [
        intval($_GET['edit'])
    ]);

    if (empty($contact)) {
        echo $templates->render('message', [
            'template' => 'contact',
            'message' => 'Error: Unable to find data.'
        ]); die();
    }

    $contactZones = $db->getData(
        'SELECT zone_id FROM contacts_zones as cz, zones as z WHERE cz.zone_id = z.id AND cz.contact_id = ?', 
        [intval($_GET['edit'])]
    );

    $contactZones = array_map(function($zone) {
        return $zone['zone_id'];
    }, $contactZones);

    $zones = $db->getData('SELECT * FROM zones ORDER BY name');
    $categories = $db->getData('SELECT * FROM categories ORDER BY name');
    
    echo $templates->render('contact/edit', [
        'zones' => $zones,
        'categories' => $categories,
        'contact' => $contact,
        'contactZones' => $contactZones
    ]);
}
