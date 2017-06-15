<?php 

// Starts Script
if (isset($_GET['score'])) {

    $contacts = $db->getData("SELECT * FROM contact");
    
    foreach ($contacts as $contact) {

        $score = $db->getFirst(
            "SELECT sum(score) as sum FROM bid_contactors WHERE company = ? AND score != '0'", 
            [$contact['company']]
        );

        $scoredBidTotal = $db->getCount(
            "SELECT NULL FROM bid_contactors WHERE company = ? AND score != '0'",
            [$contact['company']]
        );

        $scoreAverage = $score['sum'] / $scoredBidTotal;

        if ($score['sum']) {
            $db->setData("UPDATE contact SET score_per=? WHERE company=?", 
                [$scoreAverage, $contact['company']]
            );
        }
    }

    echo "<h3>Score %</h3>

        <div id='pagenation'>

            <table width='100%' cellspacing='1' cellpadding='1' border='1'>
            <tr>
                <td align='center' width='35%'><font size='1'><b>company</b></font></td>
                <td align='center' width='15%'><font size='1'><b>city</b></font></td>
                <td align='center' width='10%'><font size='1'><b>state</b></font></td>
                <td align='center' width='30%'><font size='1'><b>type</b></font></td>
                <td align='center' width='10%'><font size='1'><b>score</b></font></td>
            </tr>";

    $contacts = $db->getData("SELECT * FROM contact WHERE score_per != '0' ORDER BY score_per");
    
    foreach ($contacts as $contact) {
        $id = $contact['id'];
        $city2 = $contact['city'];
        $city = substr($city2, 0, 18);
        $state = $contact['state'];
        $type2 = $contact['type'];
        $type = substr($type2, 0, 18);
        $company2 = $contact['company'];
        $company = substr($company2, 0, 18);
        $score = $contact['score_per'];
        
        echo "<div class='z'>
            <tr>
                <td align='center' width='35%'><font size='1'>$company</font></td>
                <td align='center' width='15%'><font size='1'>$city</font></td>
                <td align='center' width='10%'><font size='1'>$state</font></td>
                <td align='center' width='30%'><font size='1'>$type</font></td>
                <td align='center' width='10%'><font size='1'><b>$score</b></font></td>
            </tr>
        </div>";
    }

    echo "</table>
    </div><br><br>
    
    <div id='pagingControls'></div>";
}
