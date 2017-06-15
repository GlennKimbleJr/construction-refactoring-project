<?php 

if (isset($_GET['print'])) {
    $did = $_GET['print'];
    $name = $_GET['name'];

    $project = $db->getFirst("SELECT * FROM project WHERE id = ?", [$did]);
    
    if (! count($project)) {
       die('Could not get data');
    }
        
    $oname3 = $project['owner_name'];
    $ophone3 = $project['owner_phone'];
    $sname3 = $project['super_name'];
    $sphone3 = $project['super_phone'];

    echo "<b>General Contractor:</b> Company Name. Contact Phone<br>License # License. <br><br>
        <b>Owner:</b> $oname3 - $ophone3<br><br>
        <b>Superintendent:</b> $sname3 - $sphone3";

    echo "<h1><b>$name</h1>";

    echo "<table width='850' cellspacing='2' cellpadding='2' border='1'>
        <tr>
            <td width='350'><b>Division</b></td>
            <td width='250'><b>Company</b></td>
            <td width='125' align='center'><b>Office Phone</b></td>
            <td width='125' align='center'><b>Cell Phone</b></td>
        </tr>
    </table>";
    
    $winners = $db->getData(
        "SELECT * FROM bid_contactors WHERE project_id = ? AND win = ? ORDER BY category", 
        [$did, 1]
    );
    
    foreach ($winners as $winner) {
        $company3b = $winner['company'];
        $category3b = $winner['category'];

        $contact = $db->getFirst("SELECT * FROM contact WHERE company = ?", [$company3b]);
        
        $phone3c = $contact['officephone'];
        $phone4c = $contact['cellphone'];

        echo "<table width='850' cellspacing='2' cellpadding='2' border='1'>
            <tr>
                <td width='350'>$category3b</td>
                <td width='250'><b>$company3b</b></td>
                <td width='125' align='center'>$phone3c</td>
                <td width='125' align='center'>$phone4c</td>
            </tr>
        </table>";
    }
}
