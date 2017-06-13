<?php 

if (isset($_GET['print'])) {
    $did = $_GET['print'];
    $name = $_GET['name'];
    $selectusercheck3c3 = "SELECT * FROM project WHERE id = '$did'";
    $selectusercheck_works3c3 = mysql_query( $selectusercheck3c3, $connection );
    
    if (! $selectusercheck_works3c3) {
       die('Could not get data: ' . mysql_error());
    }
    
    while ($selectusercheck_row3c3 = mysql_fetch_array($selectusercheck_works3c3, MYSQL_ASSOC)) {
        $oname3 = $selectusercheck_row3c3['owner_name'];
        $ophone3 = $selectusercheck_row3c3['owner_phone'];
        $sname3 = $selectusercheck_row3c3['super_name'];
        $sphone3 = $selectusercheck_row3c3['super_phone'];
    }

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
    
    $selectusercheck3b = "SELECT * FROM bid_contactors WHERE project_id = '$did' AND win = '1' ORDER BY category";
    $selectusercheck_works3b = mysql_query( $selectusercheck3b, $connection );
    if (! $selectusercheck_works3b) {
        die('Could not get data: ' . mysql_error());
    }
    
    while ($selectusercheck_row3b = mysql_fetch_array($selectusercheck_works3b, MYSQL_ASSOC)) {
        $company3b = $selectusercheck_row3b['company'];
        $category3b = $selectusercheck_row3b['category'];

        $selectusercheck3c = "SELECT * FROM contact WHERE company = '$company3b'";
        $selectusercheck_works3c = mysql_query( $selectusercheck3c, $connection );
        if (! $selectusercheck_works3c) {
            die('Could not get data: ' . mysql_error());
        }
        
        while ($selectusercheck_row3c = mysql_fetch_array($selectusercheck_works3c, MYSQL_ASSOC)) {
            $phone3c = $selectusercheck_row3c['officephone'];
            $phone4c = $selectusercheck_row3c['cellphone'];

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
}
