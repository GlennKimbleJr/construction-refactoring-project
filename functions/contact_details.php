<?php 

if (isset($_GET['details'])) {

    $contact = $db->getFirst('SELECT c.*, cat.name as type FROM contacts as c, categories as cat WHERE c.category_id = cat.id AND c.id = ?', [$_GET['details']]);

    if (empty($contact)) {
        echo $templates->render('message', [
            'template' => 'contact',
            'message' => 'Error: Unable to find data.'
        ]); die();
    }

    $contactZones = $db->getData('SELECT * FROM contacts_zones as cz, zones as z WHERE cz.zone_id = z.id AND cz.contact_id = ?', [$_GET['details']]);
    
    $zoneString = '';
    foreach ($contactZones as $key => $value) {
        if ($key == 0) {
            $zoneString = $value['name'];
            continue;
        }

        $zoneString .= "&nbsp;&nbsp;&&nbsp;&nbsp;&nbsp; {$value['name']}";
    }

    echo $templates->render('contact/details', [
        'zoneString' => $zoneString,
        'contact' => $contact
    ]);
}
