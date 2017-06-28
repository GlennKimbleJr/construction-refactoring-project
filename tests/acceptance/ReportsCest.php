<?php 

class ReportsCest
{
    public function seeASubcontractorsBidPercentageChangeAfterAcceptingAndDecliningBids(AcceptanceTester $I)
    {
        $contact = $I->create('contacts');

        $I->amOnPage('/reports.php?bid');
        $I->dontsee($contact->company);
        $I->seeInDatabase('contacts', [
            'company' => $contact->company,
            'bid_per' => '0'
        ]);

        $I->create('bidders', [
            'status' => 'will',
            'contact_id' => $contact->id
        ]);
        $I->click('BID');
        $I->see($contact->company);
        $I->see('100 %');
        $I->seeInDatabase('contacts', [
            'company' => $contact->company,
            'bid_per' => '100'
        ]);

        $I->create('bidders', [
            'status' => 'wont',
            'contact_id' => $contact->id
        ]);
        $I->click('BID');
        $I->see($contact->company);
        $I->see('50 %');
        $I->seeInDatabase('contacts', [
            'company' => $contact->company,
            'bid_per' => '50'
        ]);
    }

    public function seeASubcontractorsAverageScoreChangeAfterBeingRated(AcceptanceTester $I)
    {
        $contact = $I->create('contacts');
        $I->amOnPage('/reports.php?score');
        $I->dontsee($contact->company);
        $I->seeInDatabase('contacts', [
            'company' => $contact->company,
            'score_per' => '0'
        ]);

        $I->create('bidders', [
            'contact_id' => $contact->id,
            'score' => '5'
        ]);
        $I->click('SCORE');
        $I->see($contact->company);
        $I->canSeeInSource('<b>5</b>');
        $I->seeInDatabase('contacts', [
            'company' => $contact->company,
            'score_per' => '5'
        ]);

        $I->create('bidders', [
            'contact_id' => $contact->id,
            'score' => '1'
        ]);
        $I->click('SCORE');
        $I->see($contact->company);
        $I->canSeeInSource('<b>3</b>');
        $I->seeInDatabase('contacts', [
            'company' => $contact->company,
            'score_per' => '3'
        ]);
    }
}
