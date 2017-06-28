<?php 

class SuperCest
{
    public function addANewSuperintendent(AcceptanceTester $I)
    {
        $I->amOnPage('/super.php');
        $I->click('+ ADD NEW');
        $I->see('Add New Superintendent');

        $super = make('supers');

        $I->fillField(['id' => 'name'], $super->name);
        $I->fillField(['id' => 'phone'], $super->phone);
        $I->click('Add');
        $I->see('Created!');

        $I->seeInDatabase('supers', [
            'name' => $super->name, 
            'phone' => $super->phone
        ]);

        $I->click('VIEW LIST');
        $I->see("{$super->name} - {$super->phone}");
    }

    public function editASuperintendentsDetails(AcceptanceTester $I)
    {
        $super = $I->create('supers');

        $I->amOnPage('/super.php?view');
        $I->see($super->name);
        $I->see($super->phone);
        $I->click($super->name);

        $I->see('EDIT Superintendent');
        $I->seeInField(['id' => 'name'], $super->name);
        $I->seeInField(['id' => 'phone'], $super->phone);

        $I->fillField(['id' => 'name'], $super->name = 'New Name');
        $I->fillField(['id' => 'phone'], $super->phone = '111-111-1111');
        $I->click('Update');
        $I->see('Updated!');

        $I->click('VIEW LIST');
        $I->see($super->name);
        $I->see($super->phone);
        $I->click($super->name);

        $I->see('EDIT Superintendent');
        $I->seeInField(['id' => 'name'], $super->name);
        $I->seeInField(['id' => 'phone'], $super->phone);
    }

    public function deleteAnExistingSuperintedent(AcceptanceTester $I)
    {
        $super = $I->create('supers');

        $I->amOnPage('/super.php?view');
        $I->see($super->name);
        $I->see($super->phone);
        $I->click($super->name);
        $I->see('EDIT');
        $I->click('DELETE');
        $I->click('YES');
        $I->see('DELETED!');
        $I->click('VIEW LIST');
        $I->dontSee($super->name);
        $I->dontSee($super->phone);

        $I->dontSeeInDatabase('supers', [
            'name' => $super->name,
            'phone' => $super->phone
        ]);
    }
}
