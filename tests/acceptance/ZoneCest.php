<?php 

class ZoneCest
{
    public function _before(AcceptanceTester $I)
    {
        $this->zone = $I->create('zones');
    }

    public function addANewZone(AcceptanceTester $I)
    {
        $I->amOnPage('/zones');
        $I->dontSee('Test Zone');

        $I->click('+ ADD NEW');
        $I->see('Start a New Zone');
        $I->fillField(['id' => 'name'], 'Test Zone');
        $I->click('Create');
        $I->see('Created!');

        $I->click('VIEW LIST');
        $I->see('Test Zone');
    }

    public function editAZonesDetails(AcceptanceTester $I)
    {
        $I->amOnPage('/zones');
        $I->see($this->zone->name);

        $I->click($this->zone->name);
        $I->see('EDIT');
        $I->seeInField(['id' => 'name'], $this->zone->name);
        $I->fillField(['id' => 'name'], 'New Zone Name');
        $I->click('Update');
        $I->see('Updated!');

        $I->click('VIEW LIST');
        $I->see('New Zone Name');
    }

    public function deleteAExistingZone(AcceptanceTester $I)
    {
        $I->amOnPage('/zones');
        $I->see($this->zone->name);

        $I->click($this->zone->name);
        $I->see('EDIT');
        $I->click('DELETE');
        $I->click('YES');
        $I->see('DELETED!');

        $I->click('VIEW LIST');
        $I->dontSee($this->zone->name);
        $I->dontSeeInDatabase('zones', [
            'name' => $this->zone->name
        ]);
    }
}
