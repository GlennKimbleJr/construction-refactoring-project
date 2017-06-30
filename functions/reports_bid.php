<?php 

if (isset($_GET['bid'])) {

    // Update contacts bid percentage
    $contacts = $db->getData("SELECT id FROM contacts");
    
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
            $db->setData("UPDATE contacts SET bid_per=? WHERE id=?", 
                [$bidPercentage, $contact['id']]
            );
        }
    }

    echo $templates->render('report/bid', [
        'title' => 'Reports: Bid Percentage',
        'contacts' => $db->getData("SELECT * FROM contacts WHERE bid_per > 0 ORDER BY bid_per")
    ]);
}
