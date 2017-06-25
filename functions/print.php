<?php 

if (isset($_GET['print'])) {
    $project = $db->getFirst("SELECT * FROM project WHERE id = ?", [intval($_GET['print'])]);
    
    if (! count($project)) {
       die('Could not get data');
    }

    echo "<b>General Contractor:</b> Company Name. Contact Phone<br>License # License. <br><br>
        <b>Owner:</b> {$project['owner_name']} - {$project['owner_phone']}<br><br>
        <b>Superintendent:</b> {$project['super_name']} - {$project['super_phone']}";

    echo '<h1><b>' . htmlspecialchars($_GET['name']) . '</h1>';

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
        [intval($_GET['print']), 1]
    );
    
    foreach ($winners as $winner) {
        $contact = $db->getFirst("SELECT * FROM contact WHERE company = ?", [$winner['company']]);

        echo "<table width='850' cellspacing='2' cellpadding='2' border='1'>
            <tr>
                <td width='350'>{$winner['category']}</td>
                <td width='250'><b>{$winner['company']}</b></td>
                <td width='125' align='center'>{$contact['officephone']}</td>
                <td width='125' align='center'>{$contact['cellphone']}</td>
            </tr>
        </table>";
    }
}
