<?php 

class ZoneCest
{
    public function addANewZone(AcceptanceTester $I)
    {
        $I->amOnPage('/zone.php');
        $I->click('+ ADD NEW');
        $I->see('Start a New Zone');

        $zone = make('zones');

        $I->fillField(['id' => 'name'], $zone->name);
        $I->click('Create');
        $I->see('Created!');

        $I->seeInDatabase('zones', [
            'name' => $zone->name
        ]);

        $I->click('VIEW LIST');
        $I->see($zone->name);
    }

    public function editAZonesDetails(AcceptanceTester $I)
    {
        $zone = $I->create('zones');

        $I->amOnPage('/zone.php?view');
        $I->see($zone->name);
        $I->click($zone->name);

        $I->see('EDIT');
        $I->seeInField(['id' => 'name'], $zone->name);

        $I->fillField(['id' => 'name'], $zone->name = 'New Name');
        $I->click('Update');
        $I->see('Updated!');

        $I->click('VIEW LIST');
        $I->see($zone->name);
        $I->click($zone->name);

        $I->see('EDIT');
        $I->seeInField(['id' => 'name'], $zone->name);
    }

    public function deleteAExistingZone(AcceptanceTester $I)
    {
        $zone = $I->create('zones');

        $I->amOnPage('/zone.php?view');
        $I->see($zone->name);
        $I->click($zone->name);
        $I->see('EDIT');
        $I->click('DELETE');
        $I->click('YES');
        $I->see('DELETED!');
        $I->click('VIEW LIST');
        $I->dontSee($zone->name);

        $I->dontSeeInDatabase('zones', [
            'name' => $zone->name
        ]);
    }
}
