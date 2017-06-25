<?php 

if (isset($_GET['details'])) {

    $contact = $db->getFirst('SELECT * FROM contact WHERE id = ?', [$_GET['details']]);

    if (empty($contact)) {
        die('Error: Unable to find data.');
    }

    $zoneString = $contact['zone'];
    if (! empty($contact['zone2']) ) { $zoneString .= "&nbsp;&nbsp;&&nbsp;&nbsp;&nbsp; {$contact['zone2']}"; }
    if (! empty($contact['zone3']) ) { $zoneString .= "&nbsp;&nbsp;&&nbsp;&nbsp;&nbsp; {$contact['zone3']}"; }
    if (! empty($contact['zone4']) ) { $zoneString .= "&nbsp;&nbsp;&&nbsp;&nbsp;&nbsp; {$contact['zone4']}"; }
    if (! empty($contact['zone5']) ) { $zoneString .= "&nbsp;&nbsp;&&nbsp;&nbsp;&nbsp; {$contact['zone5']}"; }
    if (! empty($contact['zone6']) ) { $zoneString .= "&nbsp;&nbsp;&&nbsp;&nbsp;&nbsp; {$contact['zone6']}"; }
    if (! empty($contact['zone7']) ) { $zoneString .= "&nbsp;&nbsp;&&nbsp;&nbsp;&nbsp; {$contact['zone7']}"; }
    if (! empty($contact['zone8']) ) { $zoneString .= "&nbsp;&nbsp;&&nbsp;&nbsp;&nbsp; {$contact['zone8']}"; }
    if (! empty($contact['zone9']) ) { $zoneString .= "&nbsp;&nbsp;&&nbsp;&nbsp;&nbsp; {$contact['zone9']}"; }
    
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
