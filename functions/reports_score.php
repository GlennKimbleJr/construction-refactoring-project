<?php 

if (isset($_GET['score'])) {

    $contacts = $db->getData("SELECT id FROM contacts");
    
    foreach ($contacts as $contact) {

        $score = $db->getFirst(
            "SELECT sum(score) as sum FROM bidders WHERE contact_id = ? AND score != '0'", 
            [$contact['id']]
        );

        $scoredBidTotal = $db->getCount(
            "SELECT NULL FROM bidders WHERE contact_id = ? AND score != '0'",
            [$contact['id']]
        );

        $scoreAverage = $score['sum'] / $scoredBidTotal;

        if ($score['sum']) {
            $db->setData("UPDATE contacts SET score_per = ? WHERE id = ?", 
                [$scoreAverage, $contact['id']]
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

    $contacts = $db->getData("SELECT * FROM contacts WHERE score_per != '0' ORDER BY score_per");
    
    foreach ($contacts as $contact) {
        echo "<div class='z'>
            <tr>
                <td align='center' width='35%'>
                    <font size='1'>{$contact['company']}</font>
                </td>
                
                <td align='center' width='15%'>
                    <font size='1'>{$contact['city']}</font>
                </td>
                
                <td align='center' width='10%'>
                    <font size='1'>{$contact['state']}</font>
                </td>
                
                <td align='center' width='30%'>
                    <font size='1'>{$contact['type']}</font>
                </td>
                
                <td align='center' width='10%'>
                    <font size='1'><b>{$contact['score_per']}</b></font>
                </td>
            </tr>
        </div>";
    }

    echo "</table>
    </div><br><br>
    
    <div id='pagingControls'></div>";
}
