<?php 

if (isset($_GET['score'])) {

    // Update contacts score
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

    echo $templates->render('report/score', [
        'title' => 'Reports: Score',
        'contacts' => $db->getData("SELECT * FROM contacts WHERE score_per != '0' ORDER BY score_per")
    ]);
}
