<?php 

function contactViewTemplate($contacts, $title = 'View All Contacts') {
    echo "<h3>{$title}</h3>";

    echo "<table width='100%' cellspacing='1' cellpadding='1' border='1'>
        <tr>
            <td align='center' width='25%'><font size='1'><b>company</b></font></td>
            <td align='center' width='14%'><font size='1'><a href='?viewf'><b>first</b></a></font></td>
            <td align='center' width='14%'><font size='1'><a href='?viewl'><b>last</b></a></font></td>
            <td align='center' width='14%'><font size='1'><a href='?viewc'><b>city</b></a></font></td>
            <td align='center' width='6%'><font size='1'><a href='?views'><b>state</b></a></font></td>
            <td align='center' width='17%'><font size='1'><a href='?viewt'><b>type</b></a></font></td>
            <td align='center' width='10%'><font size='1'><b>EDIT</b></font></td>
        </tr>
    </table>

    <div id='pagenation'>";

    foreach ($contacts as $contact) {

        echo "<div class='z'>
            <table width='100%' cellspacing='1' cellpadding='1' border='1'>
                <tr>
                    <td align='center' width='25%'>
                        <font size='1'><a href='?details={$contact['id']}'>{$contact['company']}</a></font>
                    </td>
                    <td align='center' width='14%'><font size='1'>{$contact['first']}</font></td>
                    <td align='center' width='14%'><font size='1'>{$contact['last']}</font></td>
                    <td align='center' width='14%'><font size='1'>{$contact['city']}</font></td>
                    <td align='center' width='6%'><font size='1'>{$contact['state']}</font></td>
                    <td align='center' width='17%'><font size='1'>{$contact['type']}</font></td>
                    <td align='center' width='10%'><font size='1'><a href='?edit={$contact['id']}'>EDIT</a></font></td>
                </tr>
            </table>
        </div>";
    }

    echo "</div><br><br>
        <div id='pagingControls'></div>";
}

if (isset($_GET['view'])) {
    $contacts = $db->getData("SELECT c.*, cat.name as type FROM contacts as c, categories as cat WHERE cat.id = c.category_id ORDER BY c.company");
    contactViewTemplate($contacts);
}

if (isset($_GET['viewf'])) {
        $contacts = $db->getData("SELECT c.*, cat.name as type FROM contacts as c, categories as cat WHERE cat.id = c.category_id ORDER BY c.first, c.company");
    contactViewTemplate($contacts, 'View All Contacts - Sort by FIRST');
}

if (isset($_GET['viewl'])) {
        $contacts = $db->getData("SELECT c.*, cat.name as type FROM contacts as c, categories as cat WHERE cat.id = c.category_id ORDER BY c.last, c.company");
    contactViewTemplate($contacts, 'View All Contacts - Sort by LAST');
}

if (isset($_GET['viewc'])) {
        $contacts = $db->getData("SELECT c.*, cat.name as type FROM contacts as c, categories as cat WHERE cat.id = c.category_id ORDER BY c.city, c.company");
    contactViewTemplate($contacts, 'View All Contacts - Sort by CITY');
}

if (isset($_GET['views'])) {
        $contacts = $db->getData("SELECT c.*, cat.name as type FROM contacts as c, categories as cat WHERE cat.id = c.category_id ORDER BY c.state, c.company");
    contactViewTemplate($contacts, 'View All Contacts - Sort by STATE');
}

if (isset($_GET['viewt'])) {
        $contacts = $db->getData("SELECT c.*, cat.name as type FROM contacts as c, categories as cat WHERE cat.id = c.category_id ORDER BY type, c.company");
    contactViewTemplate($contacts, 'View All Contacts - Sort by TYPE');
}

if (isset($_GET['type'])) {
    echo "<h3>SELECT A TYPE</h3>";

    $contacts = $db->getData("SELECT * FROM categories ORDER BY name");
    
    foreach ($contacts as $contact) {
        echo "<A href='?t={$contact['id']}'>{$contact['name']}</a><br>";
    }
}

if (isset($_GET['t'])) {
    $type = $db->getFirst("SELECT name FROM categories WHERE id = ?", [intval($_GET['t'])]);

    $contacts = $db->getData("SELECT c.*, cat.name as type FROM contacts as c, categories as cat WHERE c.category_id = cat.id AND c.category_id = ? ORDER BY c.company", [intval($_GET['t'])]);
    
    contactViewTemplate($contacts, "View Contacts - {$type['name']}");
}

if (isset($_GET['tf'])) {
    $type = $db->getFirst("SELECT name FROM categories WHERE id = ?", [intval($_GET['tf'])]);

    $contacts = $db->getData("SELECT c.*, cat.name as type FROM contacts as c, categories as cat WHERE c.category_id = cat.id AND c.category_id = ? ORDER BY c.first, c.company", [intval($_GET['tf'])]);
    
    contactViewTemplate($contacts, "View Contacts - {$type['name']}");
}

if (isset($_GET['tl'])) {
    $type = $db->getFirst("SELECT name FROM categories WHERE id = ?", [intval($_GET['tl'])]);

    $contacts = $db->getData("SELECT c.*, cat.name as type FROM contacts as c, categories as cat WHERE c.category_id = cat.id AND c.category_id = ? ORDER BY c.last, c.company", [intval($_GET['tl'])]);
    
    contactViewTemplate($contacts, "View Contacts - {$type['name']}");
}

if (isset($_GET['tc'])) {
    $type = $db->getFirst("SELECT name FROM categories WHERE id = ?", [intval($_GET['tc'])]);

    $contacts = $db->getData("SELECT c.*, cat.name as type FROM contacts as c, categories as cat WHERE c.category_id = cat.id AND c.category_id = ? ORDER BY c.city, c.company", [intval($_GET['tc'])]);
    
    contactViewTemplate($contacts, "View Contacts - {$type['name']}");
}

if (isset($_GET['ts'])) {
    $type = $db->getFirst("SELECT name FROM categories WHERE id = ?", [intval($_GET['ts'])]);

    $contacts = $db->getData("SELECT c.*, cat.name as type FROM contacts as c, categories as cat WHERE c.category_id = cat.id AND c.category_id = ? ORDER BY c.state, c.company", [intval($_GET['ts'])]);
    
    contactViewTemplate($contacts, "View Contacts - {$type['name']}");
}

if (isset($_GET['zone'])) {
    echo "<h3>SELECT A ZONE</h3>";

    $zones = $db->getData("SELECT * FROM zones ORDER BY name");
    
    foreach ($zones as $zone) {
        echo "<A href='?z={$zone['id']}'>{$zone['name']}</a><br>";
    }
}

if (isset($_GET['z'])) {
    $zone = $db->getFirst("SELECT * FROM zones WHERE id = ?", [intval($_GET['z'])]);

    $contacts = $db->getData("SELECT c.* FROM contacts as c, contacts_zones as cz WHERE cz.contact_id = c.id AND cz.zone_id = ? ORDER BY c.company", [$zone['id']]);
    
    contactViewTemplate($contacts, "View Contacts - {$zone['name']}");
}

if (isset($_GET['zf'])) {
    $zone = $db->getFirst("SELECT * FROM zones WHERE id = ?", [intval($_GET['zf'])]);

    $contacts = $db->getData("SELECT c.* FROM contacts as c, contacts_zones as cz WHERE cz.contact_id = c.id AND cz.zone_id = ? ORDER BY c.first, c.company", [$zone['id']]);
    
    contactViewTemplate($contacts, "View Contacts - {$zone['name']}");
}

if (isset($_GET['zl'])) {
    $zone = $db->getFirst("SELECT * FROM zones WHERE id = ?", [intval($_GET['zl'])]);

    $contacts = $db->getData("SELECT c.* FROM contacts as c, contacts_zones as cz WHERE cz.contact_id = c.id AND cz.zone_id = ? ORDER BY c.last, c.company", [$zone['id']]);
    
    contactViewTemplate($contacts, "View Contacts - {$zone['name']}");
}

if (isset($_GET['zc'])) {
    $zone = $db->getFirst("SELECT * FROM zones WHERE id = ?", [intval($_GET['zc'])]);

    $contacts = $db->getData("SELECT c.* FROM contacts as c, contacts_zones as cz WHERE cz.contact_id = c.id AND cz.zone_id = ? ORDER BY c.city, c.company", [$zone['id']]);
    
    contactViewTemplate($contacts, "View Contacts - {$zone['name']}");
}

if (isset($_GET['zs'])) {
    $zone = $db->getFirst("SELECT * FROM zones WHERE id = ?", [intval($_GET['zs'])]);

    $contacts = $db->getData("SELECT c.* FROM contacts as c, contacts_zones as cz WHERE cz.contact_id = c.id AND cz.zone_id = ? ORDER BY c.state, c.company", [$zone['id']]);
    
    contactViewTemplate($contacts, "View Contacts - {$zone['name']}");
}

if (isset($_GET['zt'])) {
    $zone = $db->getFirst("SELECT * FROM zones WHERE id = ?", [intval($_GET['zt'])]);

    $contacts = $db->getData("SELECT c.* FROM contacts as c, contacts_zones as cz WHERE cz.contact_id = c.id AND cz.zone_id = ? ORDER BY c.type, c.company", [$zone['id']]);
    
    contactViewTemplate($contacts, "View Contacts - {$zone['name']}");
}
