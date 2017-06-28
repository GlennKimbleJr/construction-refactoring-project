<?php 

class ReportsCest
{
    public function _before(AcceptanceTester $I)
    {
        $this->contact = $I->create('contacts');
    }

    public function seeASubcontractorsBidPercentageChangeAfterAcceptingAndDecliningBids(AcceptanceTester $I)
    {
        $I->amOnPage('/reports.php?bid');
        $I->dontsee($this->contact->company);

        $I->create('bidders', [
            'status' => 'will',
            'contact_id' => $this->contact->id
        ]);

        $I->click('BID');
        $I->see($this->contact->company);
        $I->see('100 %');

        $I->create('bidders', [
            'status' => 'wont',
            'contact_id' => $this->contact->id
        ]);

        $I->click('BID');
        $I->see($this->contact->company);
        $I->see('50 %');
    }

    public function seeASubcontractorsAverageScoreChangeAfterBeingRated(AcceptanceTester $I)
    {
        $I->amOnPage('/reports.php?score');
        $I->dontsee($this->contact->company);

        $I->create('bidders', [
            'contact_id' => $this->contact->id,
            'score' => '5'
        ]);

        $I->click('SCORE');
        $I->see($this->contact->company);
        $I->canSeeInSource('<b>5</b>');

        $I->create('bidders', [
            'contact_id' => $this->contact->id,
            'score' => '1'
        ]);

        $I->click('SCORE');
        $I->see($this->contact->company);
        $I->canSeeInSource('<b>3</b>');
    }
}
