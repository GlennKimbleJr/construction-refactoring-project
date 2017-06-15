<?php 

// Starts Script
if (isset($_GET['bid'])) {

    $contacts = $db->getData("SELECT * FROM contact");
    
    foreach ($contacts as $contact) {

        $willBidCount = $db->getCount(
            "SELECT null FROM bid_contactors WHERE company = ? AND status='will'",
            [$contact['company']]
        );

        $wontBidCount = $db->getCount(
            "SELECT null FROM bid_contactors WHERE company = ? AND status='wont'",
            [$contact['company']]
        );

        $totalBids = $willBidCount + $wontBidCount;
        $bidPercentage = ($willBidCount / $totalBids) * 100;

        if ($totalBids) {
            $db->setData("UPDATE contact SET bid_per=? WHERE company=?", 
                [$bidPercentage, $contact['company']]
            );
        }
    }

    echo "<h3>Bid %</h3>

        <div id='pagenation'>

        <table width='100%' cellspacing='1' cellpadding='1' border='1'>
            <tr>
                <td align='center' width='35%'><font size='1'><b>company</b></font></td>
                <td align='center' width='15%'><font size='1'><b>city</b></font></td>
                <td align='center' width='10%'><font size='1'><b>state</b></font></td>
                <td align='center' width='30%'><font size='1'><b>type</b></font></td>
                <td align='center' width='10%'><font size='1'><b>bid %</b></font></td>
            </tr>";


    $contacts = $db->getData("SELECT * FROM contact WHERE bid_per > 0 ORDER BY bid_per");
    
    foreach ($contacts as $contact) {
        $id = $contact['id'];
        $city2 = $contact['city'];
        $city = substr($city2, 0, 18);
        $state = $contact['state'];
        $type2 = $contact['type'];
        $type = substr($type2, 0, 18);
        $company2 = $contact['company'];
        $company = substr($company2, 0, 18);
        $bid = $contact['bid_per'];     
        echo "<div class='z'>
            <tr>
                <td align='center' width='35%'><font size='1'>$company</font></td>
                <td align='center' width='15%'><font size='1'>$city</font></td>
                <td align='center' width='10%'><font size='1'>$state</font></td>
                <td align='center' width='30%'><font size='1'>$type</font></td>
                <td align='center' width='10%'><font size='1'><b>$bid %</b></font></td>
            </tr>
        </div>";
    }

    echo "</table>
    </div><br><br>
    
    <div id='pagingControls'></div>";
}
