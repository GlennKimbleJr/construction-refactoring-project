<?php 

if (isset($_GET['details'])) {

    $contact = $db->getFirst('SELECT * FROM contacts WHERE id = ?', [$_GET['details']]);
    $contactZones = $db->getData('SELECT * FROM contacts_zones as cz, zones as z WHERE cz.zone_id = z.id AND cz.contact_id = ?', [$_GET['details']]);

    if (empty($contact)) {
        die('Error: Unable to find data.');
    }

    $zoneString = '';
    foreach ($contactZones as $key => $value) {
        if ($key == 0) {
            $zoneString = $value['name'];
            continue;
        }

        $zoneString .= "&nbsp;&nbsp;&&nbsp;&nbsp;&nbsp; {$value['name']}";
    }

    echo "<u><b>{$contact['company']}</b></u>&nbsp;&nbsp;&nbsp; {$contact['type']}. | 
        <a href='?edit={$contact['id']}'><font color='red'>EDIT</font></a><br><br>

        <table width='100%'>
            <tr>
                <td width='5%'>&nbsp;</td>
                <td width='95%'>
                    <font size='1'>
                        {$zoneString}<br>
                        { <a href='' rel='imgtip[0]'><b><u>VIEW MAP</u></b></a> }
                    </font>
                </td>
            </tr>
        </table><br> 
        {$contact['first']} {$contact['last']}<br>
        {$contact['street']}. {$contact['city']}, {$contact['state']}. {$contact['zip']}<br><br>

        <table width='400'>
            <tr>
                <td width='33'>Cell:<br> {$contact['cellphone']}</td>
                <td width='33'>Office:<br> {$contact['officephone']}</td>
                <td width='33'>Fax:<br> {$contact['fax']}</td>
            </tr>
        </table>
    
        <h2>
            <a href='mailto:{$contact['email']}'>{$contact['email']}</a>
        </h2>";
}
