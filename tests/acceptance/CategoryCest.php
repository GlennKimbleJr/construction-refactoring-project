<?php 

class CategoryCest
{
    public function _before(AcceptanceTester $I)
    {
        $this->category = $I->create('categories');
    }

    public function addANewCategory(AcceptanceTester $I)
    {
        $I->amOnPage('/categories.php');
        $I->dontSee('New Category Name');

        $I->click('+ ADD NEW');
        $I->see('Start a New Category');
        $I->fillField(['id' => 'name'], 'New Category Name');
        $I->click('Create');
        
        $I->see('Created!');
        $I->click('VIEW LIST');
        $I->see('New Category Name');
    }

    public function editACategoriesDetails(AcceptanceTester $I)
    {
        $I->amOnPage('/categories.php?view');
        $I->see($this->category->name);
        $I->click($this->category->name);

        $I->see('EDIT Category');
        $I->seeInField(['id' => 'name'], $this->category->name);
        $I->fillField(['id' => 'name'], $this->category->name = 'New Name');
        $I->click('Update');
        $I->see('Updated!');

        $I->click('VIEW LIST');
        $I->see($this->category->name);
        $I->click($this->category->name);
        $I->see('EDIT Category');
        $I->seeInField(['id' => 'name'], $this->category->name);
    }

    public function deleteAnExistingCategory(AcceptanceTester $I)
    {
        $I->amOnPage('/categories.php?view');
        $I->see($this->category->name);
        $I->click($this->category->name);
        
        $I->see('EDIT');
        $I->click('DELETE');
        $I->click('YES');
        $I->see('DELETED!');

        $I->click('VIEW LIST');
        $I->dontSee($this->category->name);
        $I->dontSeeInDatabase('categories', [
            'name' => $this->category->name
        ]);
    }
}
