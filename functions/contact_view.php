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
    $contacts = $db->getData("SELECT * FROM contacts ORDER BY company");
    contactViewTemplate($contacts);
}

if (isset($_GET['viewf'])) {
    $contacts = $db->getData("SELECT * FROM contacts ORDER BY first, company");
    contactViewTemplate($contacts, 'View All Contacts - Sort by FIRST');
}

if (isset($_GET['viewl'])) {
    $contacts = $db->getData("SELECT * FROM contacts ORDER BY last, company");
    contactViewTemplate($contacts, 'View All Contacts - Sort by LAST');
}

if (isset($_GET['viewc'])) {
    $contacts = $db->getData("SELECT * FROM contacts ORDER BY city, company");
    contactViewTemplate($contacts, 'View All Contacts - Sort by CITY');
}

if (isset($_GET['views'])) {
    $contacts = $db->getData("SELECT * FROM contacts ORDER BY state, company");
    contactViewTemplate($contacts, 'View All Contacts - Sort by STATE');
}

if (isset($_GET['viewt'])) {
    $contacts = $db->getData("SELECT * FROM contacts ORDER BY type, company");
    contactViewTemplate($contacts, 'View All Contacts - Sort by TYPE');
}

if (isset($_GET['type'])) {
    echo "<h3>SELECT A TYPE</h3>";

    $contacts = $db->getData("SELECT * FROM categories ORDER BY name");
    
    foreach ($contacts as $contact) {
        $name = $contact['name'];

        echo "<A href='?t=$name'>$name</a><br>";
    }
}

if (isset($_GET['t'])) {
    $contacts = $db->getData("SELECT * FROM contacts WHERE type = ? ORDER BY company", [$_GET['t']]);
    contactViewTemplate($contacts, "View Contacts - {$_GET['t']}");
}

if (isset($_GET['tf'])) {
    $contacts = $db->getData("SELECT * FROM contacts WHERE type = ? ORDER BY first, company", [$_GET['tf']]);
    contactViewTemplate($contacts, "View Contacts - {$_GET['tf']}");
}

if (isset($_GET['tl'])) {
    $contacts = $db->getData("SELECT * FROM contacts WHERE type = ? ORDER BY last, company", [$_GET['tl']]);
    contactViewTemplate($contacts, "View Contacts - {$_GET['tl']}");
}

if (isset($_GET['tc'])) {
    $contacts = $db->getData("SELECT * FROM contacts WHERE type = ? ORDER BY city, company", [$_GET['tc']]);
    contactViewTemplate($contacts, "View Contacts - {$_GET['tc']}");
}

if (isset($_GET['ts'])) {
    $contacts = $db->getData("SELECT * FROM contacts WHERE type = ? ORDER BY state, company", [$_GET['ts']]);
    contactViewTemplate($contacts, "View Contacts - {$_GET['ts']}");
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
