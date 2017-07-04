<?php 

class SuperCest
{
    public function _before(AcceptanceTester $I)
    {
        $this->super = $I->create('supers');
    }

    public function addANewSuperintendent(AcceptanceTester $I)
    {
        $I->amOnPage('/superintendents');
        $I->dontSee('Test Name - 555-555-5555');

        $I->click('+ ADD NEW');
        $I->see('Add New Superintendent');
        $I->fillField(['id' => 'name'], 'Test Name');
        $I->fillField(['id' => 'phone'], '555-555-5555');
        $I->click('Add');
        $I->see('Created!');

        $I->click('VIEW LIST');
        $I->see('Test Name - 555-555-5555');
    }

    public function editASuperintendentsDetails(AcceptanceTester $I)
    {
        $I->amOnPage('/superintendents');
        $I->see($this->super->name);
        $I->see($this->super->phone);

        $I->click($this->super->name);
        $I->see('EDIT Superintendent');
        $I->seeInField(['id' => 'name'], $this->super->name);
        $I->seeInField(['id' => 'phone'], $this->super->phone);
        $I->fillField(['id' => 'name'], 'Updated Super Name');
        $I->fillField(['id' => 'phone'], '111-111-1111');
        $I->click('Update');
        $I->see('Updated!');

        $I->click('VIEW LIST');
        $I->see('Updated Super Name');
        $I->see('111-111-1111');
    }

    public function deleteAnExistingSuperintedent(AcceptanceTester $I)
    {
        $I->amOnPage('/superintendents');
        $I->see($this->super->name);
        $I->see($this->super->phone);

        $I->click($this->super->name);
        $I->see('EDIT');
        $I->click('DELETE');
        $I->click('YES');
        $I->see('DELETED!');

        $I->click('VIEW LIST');
        $I->dontSee($this->super->name);
        $I->dontSee($this->super->phone);
        $I->dontSeeInDatabase('supers', [
            'name' => $this->super->name,
            'phone' => $this->super->phone
        ]);
    }
}
