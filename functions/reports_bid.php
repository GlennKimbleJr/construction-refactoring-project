<?php 

if (isset($_GET['bid'])) {

    $contacts = $db->getData("SELECT id FROM contact");
    
    foreach ($contacts as $contact) {

        $willBidCount = $db->getCount(
            "SELECT null FROM bidders WHERE contact_id = ? AND status='will'",
            [$contact['id']]
        );

        $wontBidCount = $db->getCount(
            "SELECT null FROM bidders WHERE contact_id = ? AND status='wont'",
            [$contact['id']]
        );

        $totalBids = $willBidCount + $wontBidCount;
        $bidPercentage = ($willBidCount / $totalBids) * 100;

        if ($totalBids) {
            $db->setData("UPDATE contact SET bid_per=? WHERE id=?", 
                [$bidPercentage, $contact['id']]
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
        echo "<div class='z'>
            <tr>
                <td align='center' width='35%'>
                    <font size='1'>" . substr($contact['company'], 0, 18) . "</font>
                </td>

                <td align='center' width='15%'>
                    <font size='1'>" . substr($contact['city'], 0, 18) . "</font>
                </td>
                
                <td align='center' width='10%'>
                    <font size='1'>{$contact['state']}</font>
                </td>
                
                <td align='center' width='30%'>
                    <font size='1'>" . substr($contact['type'], 0, 18) . "</font>
                </td>
                
                <td align='center' width='10%'>
                    <font size='1'><b>{$contact['bid_per']} %</b></font>
                </td>
            </tr>
        </div>";
    }

    echo "</table>
    </div><br><br>
    
    <div id='pagingControls'></div>";
}
