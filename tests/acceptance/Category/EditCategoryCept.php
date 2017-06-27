<?php 

$I = new AcceptanceTester($scenario);
$I->wantTo('Edit a categories details');

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
