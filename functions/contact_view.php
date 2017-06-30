<?php 

if (isset($_GET['view'])) {
    echo $templates->render('contact/view', [
        'header' => 'View All Contacts',
        'contacts' => $db->getData("SELECT c.*, cat.name as type FROM contacts as c, categories as cat WHERE cat.id = c.category_id ORDER BY c.company")
    ]);
}

if (isset($_GET['viewf'])) {
    echo $templates->render('contact/view', [
        'header' => 'View All Contacts - Sort by FIRST',
        'contacts' => $db->getData("SELECT c.*, cat.name as type FROM contacts as c, categories as cat WHERE cat.id = c.category_id ORDER BY c.first, c.company")
    ]);
}

if (isset($_GET['viewl'])) {
    echo $templates->render('contact/view', [
        'header' => 'View All Contacts - Sort by Last',
        'contacts' => $db->getData("SELECT c.*, cat.name as type FROM contacts as c, categories as cat WHERE cat.id = c.category_id ORDER BY c.last, c.company")
    ]);
}

if (isset($_GET['viewc'])) {
    echo $templates->render('contact/view', [
        'header' => 'View All Contacts - Sort by CITY',
        'contacts' => $db->getData("SELECT c.*, cat.name as type FROM contacts as c, categories as cat WHERE cat.id = c.category_id ORDER BY c.city, c.company")
    ]);
}

if (isset($_GET['views'])) {
    echo $templates->render('contact/view', [
        'header' => 'View All Contacts - Sort by STATE',
        'contacts' => $db->getData("SELECT c.*, cat.name as type FROM contacts as c, categories as cat WHERE cat.id = c.category_id ORDER BY c.state, c.company")
    ]);
}

if (isset($_GET['viewt'])) {
    echo $templates->render('contact/view', [
        'header' => 'View All Contacts - Sort by TYPE',
        'contacts' => $db->getData("SELECT c.*, cat.name as type FROM contacts as c, categories as cat WHERE cat.id = c.category_id ORDER BY type, c.company")
    ]);
}

if (isset($_GET['type'])) {
    echo $templates->render('contact/view_select_category', [
        'categories' => $db->getData("SELECT * FROM categories ORDER BY name")
    ]);
}

if (isset($_GET['t'])) {
    $type = $db->getFirst("SELECT name FROM categories WHERE id = ?", [intval($_GET['t'])]);

    echo $templates->render('contact/view', [
        'header' => "View Contacts - {$type['name']}",
        'contacts' => $db->getData("SELECT c.*, cat.name as type FROM contacts as c, categories as cat WHERE c.category_id = cat.id AND c.category_id = ? ORDER BY c.company", [intval($_GET['t'])])
    ]);
}

if (isset($_GET['tf'])) {
    $type = $db->getFirst("SELECT name FROM categories WHERE id = ?", [intval($_GET['tf'])]);
    
    echo $templates->render('contact/view', [
        'header' => "View Contacts - {$type['name']}",
        'contacts' => $db->getData("SELECT c.*, cat.name as type FROM contacts as c, categories as cat WHERE c.category_id = cat.id AND c.category_id = ? ORDER BY c.first, c.company", [intval($_GET['tf'])])
    ]);
}

if (isset($_GET['tl'])) {
    $type = $db->getFirst("SELECT name FROM categories WHERE id = ?", [intval($_GET['tl'])]);

    echo $templates->render('contact/view', [
        'header' => "View Contacts - {$type['name']}",
        'contacts' => $db->getData("SELECT c.*, cat.name as type FROM contacts as c, categories as cat WHERE c.category_id = cat.id AND c.category_id = ? ORDER BY c.last, c.company", [intval($_GET['tl'])])
    ]);
}

if (isset($_GET['tc'])) {
    $type = $db->getFirst("SELECT name FROM categories WHERE id = ?", [intval($_GET['tc'])]);
    
    echo $templates->render('contact/view', [
        'header' => "View Contacts - {$type['name']}",
        'contacts' => $db->getData("SELECT c.*, cat.name as type FROM contacts as c, categories as cat WHERE c.category_id = cat.id AND c.category_id = ? ORDER BY c.city, c.company", [intval($_GET['tc'])])
    ]);
}

if (isset($_GET['ts'])) {
    $type = $db->getFirst("SELECT name FROM categories WHERE id = ?", [intval($_GET['ts'])]);
    
    echo $templates->render('contact/view', [
        'header' => "View Contacts - {$type['name']}",
        'contacts' => $db->getData("SELECT c.*, cat.name as type FROM contacts as c, categories as cat WHERE c.category_id = cat.id AND c.category_id = ? ORDER BY c.state, c.company", [intval($_GET['ts'])])
    ]);
}

if (isset($_GET['zone'])) {
    echo $templates->render('contact/view_select_zone', [
        'zones' => $db->getData("SELECT * FROM zones ORDER BY name")
    ]);
}

if (isset($_GET['z'])) {
    $zone = $db->getFirst("SELECT * FROM zones WHERE id = ?", [intval($_GET['z'])]);
    
    echo $templates->render('contact/view', [
        'header' => "View Contacts - {$zone['name']}",
        'contacts' => $db->getData("SELECT c.* FROM contacts as c, contacts_zones as cz WHERE cz.contact_id = c.id AND cz.zone_id = ? ORDER BY c.company", [$zone['id']])
    ]);
}

if (isset($_GET['zf'])) {
    $zone = $db->getFirst("SELECT * FROM zones WHERE id = ?", [intval($_GET['zf'])]);

    echo $templates->render('contact/view', [
        'header' => "View Contacts - {$zone['name']}",
        'contacts' => $db->getData("SELECT c.* FROM contacts as c, contacts_zones as cz WHERE cz.contact_id = c.id AND cz.zone_id = ? ORDER BY c.first, c.company", [$zone['id']])
    ]);
}

if (isset($_GET['zl'])) {
    $zone = $db->getFirst("SELECT * FROM zones WHERE id = ?", [intval($_GET['zl'])]);

    echo $templates->render('contact/view', [
        'header' => "View Contacts - {$zone['name']}",
        'contacts' => $db->getData("SELECT c.* FROM contacts as c, contacts_zones as cz WHERE cz.contact_id = c.id AND cz.zone_id = ? ORDER BY c.last, c.company", [$zone['id']])
    ]);
}

if (isset($_GET['zc'])) {
    $zone = $db->getFirst("SELECT * FROM zones WHERE id = ?", [intval($_GET['zc'])]);
    
    echo $templates->render('contact/view', [
        'header' => "View Contacts - {$zone['name']}",
        'contacts' => $db->getData("SELECT c.* FROM contacts as c, contacts_zones as cz WHERE cz.contact_id = c.id AND cz.zone_id = ? ORDER BY c.city, c.company", [$zone['id']])
    ]);
}

if (isset($_GET['zs'])) {
    $zone = $db->getFirst("SELECT * FROM zones WHERE id = ?", [intval($_GET['zs'])]);

    echo $templates->render('contact/view', [
        'header' => "View Contacts - {$zone['name']}",
        'contacts' => $db->getData("SELECT c.* FROM contacts as c, contacts_zones as cz WHERE cz.contact_id = c.id AND cz.zone_id = ? ORDER BY c.state, c.company", [$zone['id']])
    ]);
}

if (isset($_GET['zt'])) {
    $zone = $db->getFirst("SELECT * FROM zones WHERE id = ?", [intval($_GET['zt'])]);
    
    echo $templates->render('contact/view', [
        'header' => "View Contacts - {$zone['name']}",
        'contacts' => $db->getData("SELECT c.* FROM contacts as c, contacts_zones as cz WHERE cz.contact_id = c.id AND cz.zone_id = ? ORDER BY c.type, c.company", [$zone['id']])
    ]);
}
