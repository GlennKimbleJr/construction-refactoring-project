<?php 

$I = new AcceptanceTester($scenario);
$I->wantTo('Add a new category.');

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
