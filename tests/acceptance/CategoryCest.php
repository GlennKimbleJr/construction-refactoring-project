<?php 

class CategoryCest
{
    public function addANewCategory(AcceptanceTester $I)
    {
        $I->amOnPage('/categories.php');
        $I->click('+ ADD NEW');
        $I->see('Start a New Category');

        $category = make('categories');

        $I->fillField(['id' => 'name'], $category->name);
        $I->click('Create');
        $I->see('Created!');

        $I->seeInDatabase('categories', [
            'name' => $category->name
        ]);

        $I->click('VIEW LIST');
        $I->see($category->name);
    }

    public function editACategoriesDetails(AcceptanceTester $I)
    {
        $category = $I->create('categories');

        $I->amOnPage('/categories.php?view');
        $I->see($category->name);
        $I->click($category->name);

        $I->see('EDIT Category');
        $I->seeInField(['id' => 'name'], $category->name);

        $I->fillField(['id' => 'name'], $category->name = 'New Name');
        $I->click('Update');
        $I->see('Updated!');

        $I->click('VIEW LIST');
        $I->see($category->name);
        $I->click($category->name);

        $I->see('EDIT Category');
        $I->seeInField(['id' => 'name'], $category->name);
    }

    public function deleteAnExistingCategory(AcceptanceTester $I)
    {
        $category = $I->create('categories');

        $I->amOnPage('/categories.php?view');
        $I->see($category->name);

        $I->click($category->name);
        $I->see('EDIT');

        $I->click('DELETE');
        $I->click('YES');
        $I->see('DELETED!');

        $I->click('VIEW LIST');
        $I->dontSee($category->name);

        $I->dontSeeInDatabase('categories', [
            'name' => $category->name
        ]);
    }
}
