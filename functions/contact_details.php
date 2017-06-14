<?php
// Starts Script
if (isset($_GET['details'])) {
    $did = $_GET['details'];

    $contact = $db->getFirst('SELECT * FROM contact WHERE id = ?', [$did]);
    
    $mid = $contact['id'];
    $mfirst = $contact['first'];
    $mlast = $contact['last'];
    $mstreet = $contact['street'];
    $mcity = $contact['city'];
    $mstate = $contact['state'];
    $mzone = $contact['zone'];
    $memail = $contact['email'];
    $mofficephone = $contact['officephone'];
    $mcellphone = $contact['cellphone'];
    $mfax = $contact['fax'];
    $mtype = $contact['type'];
    $mcompany = $contact['company'];
    $mzip = $contact['zip'];
    $mzone2a = $contact['zone2'];
    $mzone3a = $contact['zone3'];
    $mzone4a = $contact['zone4'];
    $mzone5a = $contact['zone5'];
    $mzone6a = $contact['zone6'];
    $mzone7a = $contact['zone7'];
    $mzone8a = $contact['zone8'];
    $mzone9a = $contact['zone9'];

    $zoneString = $mzone;
    if ($mzone2a != '') { $zoneString .= "&nbsp;&nbsp;&&nbsp;&nbsp;&nbsp; $mzone2a"; }
    if ($mzone3a != '') { $zoneString .= "&nbsp;&nbsp;&&nbsp;&nbsp;&nbsp; $mzone3a"; }
    if ($mzone4a != '') { $zoneString .= "&nbsp;&nbsp;&&nbsp;&nbsp;&nbsp; $mzone4a"; }
    if ($mzone5a != '') { $zoneString .= "&nbsp;&nbsp;&&nbsp;&nbsp;&nbsp; $mzone5a"; }
    if ($mzone6a != '') { $zoneString .= "&nbsp;&nbsp;&&nbsp;&nbsp;&nbsp; $mzone6a"; }
    if ($mzone7a != '') { $zoneString .= "&nbsp;&nbsp;&&nbsp;&nbsp;&nbsp; $mzone7a"; }
    if ($mzone8a != '') { $zoneString .= "&nbsp;&nbsp;&&nbsp;&nbsp;&nbsp; $mzone8a"; }
    if ($mzone9a != '') { $zoneString .= "&nbsp;&nbsp;&&nbsp;&nbsp;&nbsp; $mzone9a"; }
    
    echo "<u><b>$mcompany</b></u>&nbsp;&nbsp;&nbsp; $mtype. | 
        <a href='?edit=$did'><font color='red'>EDIT</font></a><br><br>

        <table width='100%'>
            <tr>
                <td width='5%'>&nbsp;</td>
                <td width='95%'>
                    <font size='1'>
                        $zoneString<br>
                        { <a href='' rel='imgtip[0]'><b><u>VIEW MAP</u></b></a> }
                    </font>
                </td>
            </tr>
        </table><br> 
        $mfirst $mlast<br>
        $mstreet. $mcity, $mstate. $mzip<br><br>

        <table width='400'>
            <tr>
                <td width='33'>Cell:<br> $mcellphone</td>
                <td width='33'>Office:<br> $mofficephone</td>
                <td width='33'>Fax:<br> $mfax</td>
            </tr>
        </table>
    
        <h2>
            <a href='mailto:$memail'>$memail</a>
        </h2>";
}
